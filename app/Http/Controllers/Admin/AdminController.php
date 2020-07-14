<?php

namespace App\Http\Controllers\Admin;

use App\Log;
use App\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        $accounts=Account::WHERE('status','!=',2)->WHERE('acc_id','!=',1)->get();

        return view('admin.accounts.adminList',compact('accounts'));
    }

    public function show(){
        $add=true;
        return view('admin.accounts.adminAdd',compact('add')); 
    }

    public function store(Request $request){
        $this->validation($request);
        $input=$request->only('account','password','name'); 
       
        $count=Account::WHERE('status','!=',2)->WHERE('account','=',$input['account'])->count();
        if($count>0){ //判斷使用者是否存在
            return redirect(route('admin.show',['add'=>true]))->with(['msg'=>'帳號已存在']);
        }

        //dd($input);
        //新增使用者
        Account::create(['account'=>$input['account'],'password'=>bcrypt($input['password']),'name'=>$input['name'],'status'=>1]);

        $accounts=Account::WHERE('status','!=',2)->WHERE('acc_id','!=',1)->get();

        return  redirect(route('admin.index',['accounts'=>$accounts])); 
    }

    public function edit(Account $account){
      
        return  view('admin.accounts.adminEdit',compact('account')); 
    }

    public function update(Request $request,Account $account){
        //dd($request->all());
        //$this->validation($request);
      
        $input=$request->only(['account','password','name']);
       
        if($input['password']==NULL){
            $request->request->remove('password');
            unset($input['password']);
        }else{
            $input['password']=bcrypt($input['password']);
        }
   
        $this->validation($request);     

        $acc_id=$account->acc_id;

        $count=Account::WHERE('status','!=',2)->WHERE('account','=',$input['account'])->WHERE('acc_id','!=',$acc_id)->count();
        if($count>0){ //排除自己外的，判斷使用者是否存在
            return redirect(route('admin.edit',$account))->with(['msg'=>'帳號已存在']);
        }

        $account->update($input);

        return  redirect(route('admin.edit',$account))->with(['msg'=>'修改成功']); 
    }

    public function changeStatus(Account $account){
       
        if($account->status==1){
            $account->update(['status'=>3]);
        }else{
            $account->update(['status'=>1]); 
        }

        return 'success';
        //return redirect(route('admin.index'));
    }


    public function destory(Account $account){
        //修改狀態為2刪除
        //$account->update(['status'=>2]);

       
        $account->delete();

        $accounts=Account::WHERE('status','!=',2)->WHERE('acc_id','!=',1)->get();

        return 'success';

    }

    public function validation($request){
        $rule=[
            'account'=>'required',
            'name'=>'required',
            'password'=>'sometimes|required|max:16|min:8'
        ];

        //dd($rule);
        
        $this->validate($request, $rule,[
            'required'=>'請填寫欄位',
            'max'=>'請輸入:max字以下',
            'min'=>'請輸入超過:min字',
        ]);
        
    }


}
