<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Laravel\Socialite\Facades\Socialite;
use Config;
use Auth;
use App\User;
class SocialController extends Controller
{
    public function __construct(){
        Config::set("services.facebook.client_id",setting()->facebook_client_id);
        Config::set("services.facebook.client_secret",setting()->facebook_client_secret);
        Config::set("services.facebook.redirect",route('web.social.callback','facebook'));
        Config::set("services.google.client_id",setting()->google_client_id);
        Config::set("services.google.client_secret",setting()->google_client_secret);
        Config::set("services.google.redirect",route('web.social.callback','google'));
        Config::set("services.github.client_id",setting()->github_client_id);
        Config::set("services.github.client_secret",setting()->github_client_secret);
        Config::set("services.github.redirect",route('web.social.callback','github'));



    }

    protected $providers = [
        'facebook','google','github'
    ];
    public function redirectToProvider(Request $request,$driver)
    {
        if(!$this->isProviderAllowed($driver)) {
            return $this->sendFailedResponse("{$driver} is not currently supported");
        }
        try {
            // dd(config('services.google'));
            return Socialite::driver($driver)->redirect();
        } catch (\Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }
    }
    public function handleProviderCallback($driver)
    {
        try {
            $user = Socialite::driver($driver)->user();
        } catch (\Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }
        return empty($user->email)
            ? $this->sendFailedResponse("No email id returned from {$driver} provider.")
            : $this->loginOrCreateAccount($user, $driver);
    }
    protected function sendSuccessResponse()
    {
        $url = route('web.home.index');
        if(\Session::has('url')){
            $url = \Session::get('url');
        }
        \Session::forget('url');
        return redirect($url);
    }
    protected function sendUpdatePhoneNumber()
    {
        return redirect()->route('web.user.profile')->with('status_login','Vui lòng cập nhật số điện thoại !');
    }
    protected function sendFailedResponse($msg = null)
    {
        return redirect()->back()->with('status_login', $msg ?: 'Unable to login, try with another provider to login.');
    }
    protected function loginOrCreateAccount($providerUser, $driver)
    {
        $User =User::where('email', $providerUser->getEmail())->first();
        if( $User ) {
            $User->update([
                'email'=>$providerUser->email,
                'full_name' => $providerUser->name,
                'nickname'=>$providerUser->nickname,
                'avatar' => $providerUser->avatar,
                'provider' => $driver,
                'provider_id' => $providerUser->id,
                'access_token' => $providerUser->token,
            ]);
        } else {
            if($providerUser->getEmail()){
                $User = new User();
                $User->email=$providerUser->email;
                $User->full_name =$providerUser->name;
                $User->nickname=$providerUser->nickname;
                $User->avatar = $providerUser->avatar;
                $User->provider = $driver;
                $User->provider_id = $providerUser->id;
                $User->access_token = $providerUser->token;
                $User->password = NULL;
                $User->username = uniqid();
                $User->save();
            }else{
                $this->sendFailedResponse("No email id returned from {$driver} provider.");
            }
        }
        Auth::login($User, true);
        return $this->sendSuccessResponse();
    }
    private function isProviderAllowed($driver)
    {
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }
}
