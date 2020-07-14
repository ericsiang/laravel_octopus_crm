<?php

namespace App\Listeners;

use App\Log;
use App\Events\AccountDeleted;
use App\Events\AccountDeleting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccountEventSubscriber
{

   
     /**
     * 處理用户刪除前事件
     */
    public function onAccountDeleting($event) {
        //dd($event);
        //Log::info('用户即將刪除[' . $event->account->acc_id . ']:' . $event->account->account);
        Log::create([
            'type'=>'info',
            'message'=>'管理者:'.Auth::guard('admin')->user()->acc_id.'即將刪除['.$event->account->acc_id.']:'.$event->account->account,
        ]);
    }

    /**
     * 處理用户刪除后事件
     */
    public function onAccountDeleted($event) {
        //dd($event);
        //Log::info('用户已經刪除[' . $event->account->acc_id . ']:' . $event->account->account);
        Log::create([
            'type'=>'info',
            'message'=>'管理者:'.Auth::guard('admin')->user()->acc_id.'已經刪除['.$event->account->acc_id.']:'.$event->account->account,
        ]);
    }

    /**
     * 為訂閱者註冊監聽器
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        //dd($events);
        $events->listen(
            AccountDeleting::class,
            AccountEventSubscriber::class . '@onAccountDeleting'
        );

        $events->listen(
            AccountDeleted::class,
            AccountEventSubscriber::class . '@onAccountDeleted'
        );
    }


    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
    }
}
