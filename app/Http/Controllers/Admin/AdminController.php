<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(){
        $accounts=Account::WHERE('status','!=',2)->WHERE('acc_id','!=',1)->get();

        return view('admin.accounts.adminList',compact('accounts'));
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

    public function edit(Account $account){
        return view('admin.accounts.adminEdit',compact('account')); 
    }

    

}
