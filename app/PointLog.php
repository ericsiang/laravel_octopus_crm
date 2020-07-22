<?php

namespace App;

use App\Member;
use Illuminate\Database\Eloquent\Model;

class PointLog extends Model
{   

    protected $guarded=[];//黑名單，欄位不可賦值

    const OPT_MEMBER_REGISTER = 1;  // 用户注册
    const OPT_EMAIL_VERIFY = 2;   // 邮箱验证
    const OPT_MEMBER_LOGIN = 3;     // 用户登录

    public static $OPT_MESSAGE = [
        self::OPT_MEMBER_REGISTER => '會員註冊',
        self::OPT_EMAIL_VERIFY => '信箱驗證',
        self::OPT_MEMBER_LOGIN => '會員登入'
    ];

    // 不同操作对应积分映射关系
    public static $OPT_POINT = [
        self::OPT_MEMBER_REGISTER => 50,
        self::OPT_EMAIL_VERIFY => 30,
        self::OPT_MEMBER_LOGIN => 10
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

}
