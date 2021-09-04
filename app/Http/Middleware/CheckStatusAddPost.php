<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
class CheckStatusAddPost
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
        if(Auth::user()->type=='userAdminDefault'||Auth::user()->type=='userAdminCreate'){
            return $next($Request);
        }else{
            if(setting()->user_add_post_status=='on'){
                return $next($Request);
            }else{
                return redirect()->route('web.home.index')->with('status','Yêu cầu của bạn không được tìm thấy !');
            }
        }

    }
}
