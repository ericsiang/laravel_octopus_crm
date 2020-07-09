<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;


class Authenticate extends Middleware
{
    protected $redirectTo = '';


    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    protected function authenticate($request,array $guards)
    {
        if(empty($guards)){
            $guards=[null];
        }

        //check是否有登入
        foreach($guards as $guard){
            if($this->auth->guard($guard->check())){
                return $this->auth->shouldUse($guard);
            }
        }

        //尚未登入
        $guard=$guards[0];
        if ($guard == 'admin') {
            //返回登入頁面
            $this->redirectTo = route('admin.login');
        }

        throw new AuthenticationException(
            'Unauthenticated.', $guards, $this->redirectTo ? : $this->redirectTo($request)
        );

    }
}
