<?php

namespace App\Observers;

use App\Log;
use App\account;
use Illuminate\Support\Facades\Auth;

class AccountObserver
{   

    public function creating(account $account) 
    {   
        if(Auth::guard('admin')->check())
        {
            Log::create([
                'type'=>'info',
                'message'=>'管理者:'.Auth::guard('admin')->user()->name.'即將新增['.$account->acc_id.']:'.$account->account,
            ]);
        }
    }

    
    public function created(account $account)
    {   
        if(Auth::guard('admin')->check())
        {
            Log::create([
                'type'=>'info',
                'message'=>'管理者:'.Auth::guard('admin')->user()->name.'已經新增['.$account->acc_id.']:'.$account->name,
            ]);
        }
       
    }
    
    public function updating(account $account)
    {
        Log::create([
            'type'=>'info',
            'message'=>'管理者:'.Auth::guard('admin')->user()->name.'即將更新['.$account->acc_id.']:'.$account->name,
        ]);
    }


    public function updated(account $account)
    {   
        
        Log::create([
            'type'=>'info',
            'message'=>'管理者:'.Auth::guard('admin')->user()->name.'已經更新['.$account->acc_id.']:'.$account->name,
        ]);
    }

    public function deleting(account $account)
    {
        Log::create([
            'type'=>'info',
            'message'=>'管理者:'.Auth::guard('admin')->user()->name.'即將刪除['.$account->acc_id.']:'.$account->name,
        ]);
    }

    public function deleted(account $account)
    {
        Log::create([
            'type'=>'info',
            'message'=>'管理者:'.Auth::guard('admin')->user()->name.'已經刪除['.$account->acc_id.']:'.$account->name,
        ]);
    }


    public function restored(account $account)
    {
        //
    }


    public function forceDeleted(account $account)
    {
        //
    }
}
