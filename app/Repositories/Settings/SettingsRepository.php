<?php
namespace App\Repositories\Settings;

use App\Repositories\EloquentRepository;
use App\Models\Setting;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Cache;
class SettingsRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Setting::class;
    }
    public function testMail($data)
    {
        \Config::set("mail.driver",$data->MAIL_DRIVER);
        \Config::set("mail.host",$data->MAIL_HOST);
        \Config::set("mail.port",$data->MAIL_PORT);
        \Config::set("mail.from.address",$data->MAIL_FROM_ADDRESS);
        \Config::set("mail.from.name",$data->MAIL_FROM_NAME);
        \Config::set("mail.encryption",$data->MAIL_ENCRYPTION);
        \Config::set("mail.username",$data->MAIL_USERNAME);
        \Config::set("mail.password",$data->MAIL_PASSWORD);
        configMail();
        $rs =  _sendMail([
            "template"=>"vendor.mail.test",
            "data"=>[],
            "mailSend"=>[setting()->MAIL_RECEIVE],
            "subject"=>"TEST GỦI MAIL"
        ]);
        return $rs;
    }
    public function editMail($data)
    {
        $setting = Setting::find(1);
        $setting->MAIL_DRIVER = $data->MAIL_DRIVER;
        $setting->MAIL_HOST = $data->MAIL_HOST;
        $setting->MAIL_PORT = $data->MAIL_PORT;
        $setting->MAIL_FROM_ADDRESS = $data->MAIL_FROM_ADDRESS;
        $setting->MAIL_FROM_NAME = $data->MAIL_FROM_NAME;
        $setting->MAIL_ENCRYPTION = $data->MAIL_ENCRYPTION;
        $setting->MAIL_USERNAME = $data->MAIL_USERNAME;
        $setting->MAIL_PASSWORD = $data->MAIL_PASSWORD;
        $setting->MAIL_RECEIVE = $data->MAIL_RECEIVE;
        if($setting->save()){
            Cache::forget('setting');
            return true;
        }else{
            return false;
        }
    }
    public function editSetting($data)
    {
        $setting = Setting::find(1);
        $icon = $this->uploadImage($data,'icon');
        if($icon){
            $setting->icon = $icon;
        }
        $logo = $this->uploadImage($data,'logo');
        if($logo){
            $setting->logo = $logo;
        }
        $setting->title = $data->title;
        $setting->name = $data->name;
        $setting->post_page_number = $data->post_page_number;

        $setting->route_admin = trim($data->route_admin);
        $setting->route_login = trim($data->route_login);
        $setting->darkMode = $data->darkMode;

        $setting->contact_mail = $data->contact_mail;
        $setting->contact_phone = $data->contact_phone;
        $setting->contact_address = $data->contact_address;
        $setting->iframe_map = $data->iframe_map;

        $setting->sidebar_post_random_status = $data->sidebar_post_random_status;
        $setting->sidebar_top_author_status = $data->sidebar_top_author_status;
        $setting->sidebar_tag_status = $data->sidebar_tag_status;
        $setting->user_add_post_status = $data->user_add_post_status;
        $setting->user_login_register_status = $data->user_login_register_status;
        $setting->sidebar_top_postview_status = $data->sidebar_top_postview_status;
        $setting->cache_seconds = $data->cache_seconds;
        if($setting->save()){
            Cache::forget('setting');
            return true;
        }else{
            return false;
        }
    }
    public function saveSocialite($data)
    {
        $setting = Setting::find(1);
        $setting->facebook_status = $data->facebook_status;
        $setting->facebook_client_id = $data->facebook_client_id;
        $setting->facebook_client_secret = $data->facebook_client_secret;
        $setting->facebook_redirect = $data->facebook_redirect;
        $setting->google_status = $data->google_status;
        $setting->google_client_id = $data->google_client_id;
        $setting->google_client_secret = $data->google_client_secret;
        $setting->google_redirect = $data->google_redirect;
        $setting->github_status = $data->github_status;
        $setting->github_client_id = $data->github_client_id;
        $setting->github_client_secret = $data->github_client_secret;
        $setting->github_redirect = $data->github_redirect;
        if($setting->save()){
            Cache::forget('setting');
            return true;
        }else{
            return false;
        }
    }
    public function updateSeo($data)
    {
        $setting = Setting::find(1);
        $seoImage = $this->uploadImage($data,'seo');
        if($seoImage){
            $setting->seoImage = $seoImage;
        }
        $setting->title = $data->title;
        $setting->name = $data->name;
        $setting->des = $data->des;
        $setting->keywords = $data->keywords;
        $setting->Google_Analytics = $data->Google_Analytics;
        $setting->sitemap_frequency = $data->sitemap_frequency;
        if($setting->save()){
            Cache::forget('setting');
            return true;
        }else{
            return false;
        }
    }
    public function uploadImage($request,$type)
    {
        $file  = $request->file("file_{$type}");
        $path = "/uploads/settings/{$type}";
        if ($file) {
            if (\File::exists($path)) {
                \File::deleteDirectory($path);
            }
            $extension = $file->getClientOriginalExtension();
            $picture   = date('Y-m-d-His').'.'.$extension;
            \File::putFileAs("{$path}",$file,$picture);
            return  "{$path}/{$picture}";
        }
        return false;
    }
}
