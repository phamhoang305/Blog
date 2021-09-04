<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
class CheckStatusLoginRegister
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $Request ,Closure $next)
    {
        if(setting()->user_login_register_status=='on'){
            return $next($Request);
        }else{
             return redirect()->route('web.home.index')->with('status','Yêu cầu của bạn không được tìm thấy !');
        }
    }
}
