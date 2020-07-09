<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;



class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    protected function guard(){
        return Auth::guard('admin');
    }

    public function login(Request $request)
    {   
       
        //dd($input); 
        $this->validate($request,
            [
                'account'=>'required',
                'password'=>'required',
            ],
            [
                'account.required'=>'請輸入帳號',
                'password.required'=>'請輸入密碼',
            ]
        );
       

        /*if($validate->passes()){
            //return redirect('/admin/signin')->with(['success'=>'登入成功']);
        }else{
            return redirect('/admin/signin')
                        ->with('msg','登入失敗，請確認帳號密碼是否正確')
                        ->withInput();//原本填寫的值

        }*/
         
    }

    public function logout(Request $request) {
        return redirect(route('admin.login'));
    }

}
