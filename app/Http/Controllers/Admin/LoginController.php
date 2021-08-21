<?php

namespace App\Http\Controllers\Admin;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Repositories\Auth\AuthRepositories;
use Auth;
use Illuminate\Contracts\Session\Session;

class LoginController extends Controller
{
    public function getLogin(Request $request)
    {
        SEOTools::setTitle("Đăng nhập");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view('admin.pages.auth.login');
    }
    public function ajaxLogin(Request $request)
    {
        $AuthRepositories = new AuthRepositories();
        $url = route('admin.dashboard.view');
        $_checkLogin = $AuthRepositories->_checkLogin($request->username,$request->password);
        if($_checkLogin){
            $request->session()->forget('url');
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Đăng nhập thành công ",'url'=>$url), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'error','msg'=>"Thông tin đăng nhập không hợp lệ ! "), 200);
        }
    }
    public function getLogout(Request $request)
    {
        if(Auth::logout()){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Đăng xuất thành công "), 200);
        }
        return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Đăng xuất thành công "), 200);
    }

}
