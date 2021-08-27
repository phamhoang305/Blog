<?php

namespace App\Http\Controllers\Admin;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Repositories\Settings\SettingsRepository;
use App\Http\Requests\Admin\Setting\SettingRequest;
use App\Http\Requests\Admin\Setting\SettingMailRequest;
use App\Http\Requests\Admin\Setting\SettingSocialiteRequest;
use App\Models\Setting;
class SettingController extends Controller
{

    public function getSetting(Request $request)
    {

        SEOTools::setTitle("Cài đặt chung");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view('admin.pages.setting.setting');
    }
    public function getMail(Request $request)
    {
        SEOTools::setTitle("Cấu hình mail");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view('admin.pages.setting.mail');
    }
    public function postMail(SettingMailRequest $request)
    {
        $SettingsRepository = new SettingsRepository();
        if($request->type=='saveMail'){
            $result = $SettingsRepository->editMail($request);
            if($result===true){
                return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Lưu thành công " ), 200);
            }else{
                return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"$result" ), 200);
            }
        }else{
            $result = $SettingsRepository->testMail($request);
            if($result===true){
                return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Gửi thành công " ), 200);
            }else{
                return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"$result" ), 200);
            }
        }
    }
    public function postEdit(SettingRequest $request)
    {
        $SettingsRepository = new SettingsRepository();
        $route_admin = trim($request->route_admin);
        if($route_admin=='Admin'||$route_admin=='admin'||$route_admin=='Auth'||$route_admin=='Auth'){
            $request['route_admin'] = trim('cpanel');
        }else{
            $request['route_admin'] = $route_admin;
        }
        $route_login = trim($request->route_login);
        if($route_login=='Admin'||$route_login=='admin'){
            $request['route_login'] = $route_login;
        }else{
            $request['route_login'] = $route_login;

        }
        $result = $SettingsRepository->editSetting($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật thành công ",'url'=>route('web.home.index').'/'.$route_admin.'/'.'setting' ), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Cập nhật thất bại !" ), 200);
        }
    }
    public function getSocialite(Request $request)
    {
        SEOTools::setTitle("Cấu hình đăng nhập mạng xã hội");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view('admin.pages.setting.socialite');
    }
    public function postSocialite(SettingSocialiteRequest $request)
    {
        $SettingsRepository = new SettingsRepository();
        $result = $SettingsRepository->saveSocialite($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Cập nhật thất bại !" ), 200);
        }
    }
}
