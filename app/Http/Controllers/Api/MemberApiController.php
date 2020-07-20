<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Member;
use Validator;//新增自訂驗證時須加
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Validation\ValidationException;
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

    

        return response()->json(
            [
                'success'=>true,
                'token' => $token,
                'data'  =>  JWTAuth::user()
            ]);

    }

    public function register(Request $request)
    {
        
        $this->validateion($request->all());

        $input=$request->all(); 
        $input['password']=bcrypt($input['password']);
        //dd($input);
        $input['card_num']=uniqid();
        $member=Member::create($input);
      
        //註冊後，是否執行登入
        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }

        return response()->json([
            'success'   =>  true,
            'data'      =>  $member
        ], 200);
        
    }


    public function update(Request $request,Member $member)
    {      
        $input=$request->except(['email','token']); 

        $this->validateion($input,'update');
        $input['password']=bcrypt($input['password']);
        
       
        $member->update($input);
        
        return response()->json([
            'success'   =>  true,
            'data'      =>  $member
        ], 200);

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
            ], 401/*JsonResponse::HTTP_UNPROCESSABLE_ENTITY*/ ));
        }
        

    }

     


}
