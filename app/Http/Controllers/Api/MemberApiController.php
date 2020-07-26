<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Member;
use Validator;//新增自訂驗證時須加
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\MemberRegistered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\MemberApiResource;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Exceptions\HttpResponseException;

class MemberApiController extends Controller
{

    public $loginAfterSignUp = true;//註冊後，是否直接執行登入


    public function login(Request $request)
    {
        $input=$request->only('email','password');
       
        $token = null;

        if(!$token = JWTAuth::attempt($input)){
            return response()->json(
                [
                    'success'=>false,
                    'message' => '請確認帳號密碼',
                ],401);
        }

        //控制只輸出哪些欄位
        $data=new MemberApiResource(JWTAuth::user());
        

        return response()->json(
            [
                'success'=>true,
                'token' => $token,
                'data'  =>  $data,
            ], 200);

    }

    public function logout(Request $request)
    {
        
        JWTAuth::invalidate($request->token);
        
        return response()->json(
            [
                'success'=>true,
                'message' => 'Already logged out',
            ], 200);
    }


    public function register(Request $request)
    {
        
        
        $this->validateion($request->all());

        $input=$request->all(); 
        $input['password']=bcrypt($input['password']);
        //dd($input);
        $input['card_num']=uniqid();

        $expire_time=time()+180;
        $email_token=$input['email'].'&'.Str::random(5).'&'.$expire_time;
        $input['email_token']=encrypt($email_token);
        

        $member=Member::create($input);

        $token = JWTAuth::fromUser($member);
        //dd($token);
        $url='http://'.$request->server('HTTP_HOST').'/api/member/verify_email?email_token='.$input['email_token'];
        //Mail::to($input['email'])->send('test')->subject('Verify your email address');
        
        $mail_data=[
            'subject'=>'Verify your email address',
            'url'=>$url,
        ];



        Mail::send('admin.mail.verify_email', $mail_data , function($message) use ($input) {
            $message->to($input['email'],$input['name'])
                ->subject('Verify your email address');
        });

        //訂閱者監聽事件
        event(new MemberRegistered(Member::WHERE('mem_id',$member->mem_id)->get()[0]));

        //註冊後，是否執行登入
        /*if ($this->loginAfterSignUp) {
            return $this->login($request);
        }*/

        return response()->json([
            'success'   =>  true,
            'data'      =>  $member,
        ], 200);
        
    }


    public function update(Request $request,Member $member)
    {      
        $jwt_mem=JWTAuth::parseToken()->authenticate();
        
    
        if($jwt_mem->mem_id != $member->mem_id){
            return response()->json([
                'success'   =>  false,
                'message'      =>  'Token not match with member account',
            ], 400);
        }

        $input=$request->except(['email','token']); 

        $this->validateion($input,'update');
        $input['password']=bcrypt($input['password']);
        
       
        $member->update($input);
        
        return response()->json([
            'success'   =>  true,
            'data'      =>  $member
        ], 200);

    }

    public function verifyEmail(Request $request)
    {
        $input=$request->only(['email_token']);
        
        //判斷decrypt是否成功
        try {
            $email_token=decrypt($input['email_token']);
        } catch (DecryptException  $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400/*JsonResponse::HTTP_UNPROCESSABLE_ENTITY*/ );

        }
       
      
        $email_token_arr=explode('&',$email_token);
        $email=$email_token_arr[0];
        $expire_time=$email_token_arr[2];
        $now_time=time()-86399;

       
        if($now_time > $expire_time){
            //email_token過期
            return response()->json([
                'success'   =>  false,
                'message'      =>  'Email Token has expired'
            ], 401);
        }else{
          
            $member=Member::WHERE('email',$email)->WHERE('email_token',$input['email_token'])->get();
            
            if($member->count()){
                $member[0]->update(['email_auth'=>1]);
                
                return response()->json([
                    'success'   =>  true,
                    'message'      =>  'Email verification succeeded'
                ], 200);
            }else{
                return response()->json([
                    'success'   =>  false,
                    'message'      =>  'Member account can no find'
                ], 401);
            }
        }

    } 

    public function validateion($input,$type='')
    {   
        
       
        $rule=[
            'email'=>'required|email|unique:members,email',
            'name'=>'required',
            'password'=>'required',
            'phone'=>'required|size:10',
            'sex'=>'required',
            'city_id'=>'required|numeric',
            'area_id'=>'required|numeric',
            'address'=>'required',
        ];

        $message=[
            'email.required'=>'email為必填欄位',
            'email.email'=>'需為email格式',
            'email.unique'=>'email已存在',
            'name.required'=>'name為必填欄位',
            'password.required'=>'password為必填欄位',
            'phone.required'=>'phone為必填欄位',
            'phone.size'=>'phone為10碼',
            'phone.numeric'=>'phone只能為數字',
            'sex.required'=>'sex為必填欄位',
            'city_id.required'=>'city_id為必填欄位',
            'city_id.numeric'=>'city_id只能為數字',
            'area_id.required'=>'area_id為必填欄位',
            'area_id.numeric'=>'area_id只能為數字',
            'address.required'=>'address為必填欄位'
        ];
        
        
        if($type=='update'){
            unset($rule['email']);
        }
        
        $validator=Validator::make($input,$rule,$message);


        //應用於請求不符合驗證規則時，回應json格式
        $errors = (new ValidationException($validator))->errors();
        
        if($errors){
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => $errors
            ], 400/*JsonResponse::HTTP_UNPROCESSABLE_ENTITY*/ ));
        }
        

    }

     


}
