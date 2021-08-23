<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
class CheckAuthAdmin
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

            if (Auth::check()) {
                if(Auth::user()->status==0){
                    if(Auth::user()->type=='userAdminCreate'||Auth::user()->type=='userAdminDefault'){
                        return $next($Request);
                    }else{
                        return redirect()->route('web.home.index')->with('status','Bạn không có quyền truy cập vào hệ thống !');
                    }
                }else{
                    return redirect()->route('web.auth.login')->with('status','Tài khoản của bạn đã bị khóa !');
                }
            }else {
                return redirect()->route('web.home.index')->with('status','Vui lòng đăng nhập để tiếp tục !');
            }

    }
}
