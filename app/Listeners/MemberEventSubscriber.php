<?php

namespace App\Listeners;

use App\PointLog;
use App\Events\MemberRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MemberEventSubscriber
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function onMemberRegistered($event) {
        //dd($event);
        
        // 會員註冊成功後給點
        $event->member->points += PointLog::$OPT_POINT[PointLog::OPT_MEMBER_REGISTER];
        $event->member->save();
        
        // 保存到點數記錄日志
        $create_arr=[
            'calculation'=>1,//加點
            'point'=>PointLog::$OPT_POINT[PointLog::OPT_MEMBER_REGISTER],
            'message'=>PointLog::$OPT_MESSAGE[PointLog::OPT_MEMBER_REGISTER],
        ];

        $event->member->pointLogs()->create($create_arr);
       

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
            MemberRegistered::class,
            MemberEventSubscriber::class . '@onMemberRegistered'
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

    }
}
