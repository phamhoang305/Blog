<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;
use Auth;
use App\Models\Roles;
class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle( $request, Closure $next,$key=null)
    {
            if(Auth::user()->type=='userAdminDefault'){
                return $next($request);
            }
            $data = Roles::where('id','=',(int)Auth::user()->roleID)->pluck('permission')->first();
            $array = collect(array());
            if($data){
                $array = collect(json_decode($data));
            }
            if($request->ajax()){
                if($array->contains($key)){
                    return $next($request);
                }else{
                    return response()->json(array(
                        "status"=>'error',
                        "msg"=>"Bạn không có quyền vui lòng kiểm trà lại ! "
                    ), 200);

                }
            }else{
                if($array->contains($key)){
                    return $next($request);
                }else{
                    return redirect()->route('admin.dashboard.view')->with('status','Bạn không có quyền vui lòng kiểm trà lại !');
                }
            }
    }
}
