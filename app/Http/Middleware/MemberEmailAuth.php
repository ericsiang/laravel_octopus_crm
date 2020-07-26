<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use App\Member;


class MemberEmailAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
   
      
        if(JWTAuth::parseToken()->authenticate()->email_auth!=1 )
        {
            return response()->json([
                'success'   =>  false,
                'data'      =>  'Email not verify'
            ], 401);
        }

       
       
        return $next($request);
    }
}
