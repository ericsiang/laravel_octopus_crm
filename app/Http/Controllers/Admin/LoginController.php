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

    public function index()
    {
        if($this->guard()->check()){
            return redirect('/admin');
        }else{
            return view('admin.signin');
        }
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
       
        $credentials = $request->only('account', 'password');    
        $credentials['status']=1;
        $rememberme = $request->filled('rememberme'); 
       
        //驗證成功後，要進行的動作 
        if ($this->guard()->attempt($credentials,$rememberme))//驗證成功後，要進行的動作
        {  
            return redirect('/admin'); 
        }else{ //驗證失敗後，要進行的動作
            return redirect(route('admin.login'))
                        ->with('msg','登入失敗，請確認帳號密碼是否正確'); //回傳一次性session
        }
         
    }

    public function logout(Request $request) {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        //Auth::logout();
        return redirect(route('admin.login'));
    }

}
