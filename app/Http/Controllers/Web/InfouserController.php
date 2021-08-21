<?php

namespace App\Http\Controllers\Web;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Users\UsersRepository;
use App\Repositories\Posts\PostsRepository;
use App\Http\Requests\Web\Profile\ProfileRequest;
use App\Http\Requests\Web\Profile\ChangePassRequest;
use App\Models\Users;

class InfouserController extends Controller
{

    public $UsersRepository;
    public $PostsRepository;
    public function __construct(UsersRepository $UsersRepository,PostsRepository $PostsRepository){
        $this->UsersRepository = $UsersRepository;
        $this->PostsRepository = $PostsRepository;
    }
    public function getInfouser(Request $request)
    {
        if($request->username!=""&&$request->type!=""){
            if($request->type=='follow'){
                return $this->follow($request);
            }else{
                return $this->following($request);
            }
        }else{
            return $this->posts($request);
        }
    }

    public function posts($request)
    {
        $user = $this->UsersRepository->getAuthByUsername($request->username);
        if($user){
            $posts =  $this->PostsRepository->getPostByUsername($request->username);
            SEOTools::setTitle($user->full_name." - Bài viết");
            SEOTools::opengraph()->setUrl(\URL::current());
            $data = array(
                'user'=>$user,
                'posts'=>$posts,
                ''
            );
            return view("web.pages.infouser.post",$data);
        }else{
            return view("web.pages.damned.damned");

        }

    }
    public function follow($request)
    {
        $user = $this->UsersRepository->getAuthByUsername($request->username);
        if($user){
            $request['userID'] = $user->id;
            $_topAuthors =  $this->UsersRepository->getFollowByUserID($request);
            $data = array(
                'user'=>$user,
                '_topAuthors'=>$_topAuthors,
            );

            SEOTools::setTitle($user->full_name." - Người theo dõi");
            SEOTools::opengraph()->setUrl(\URL::current());
            return view("web.pages.infouser.follow",$data);
        }else{
            return view("web.pages.damned.damned");
        }
    }
    public function following($request)
    {
        $user = $this->UsersRepository->getAuthByUsername($request->username);
        if($user){
            $request['userID'] = $user->id;
            $_topAuthors =  $this->UsersRepository->getFollowingByUserID($request);
            SEOTools::setTitle($user->full_name." - Đang theo dõi");
            SEOTools::opengraph()->setUrl(\URL::current());
            $data = array(
                'user'=>$user,
                '_topAuthors'=>$_topAuthors,
            );
            return view("web.pages.infouser.following",$data);
        }else{
            return view("web.pages.damned.damned");

        }
    }
    public function confirmMail(Request $request)
    {
        $user  = Users::where('email_verified_token','=',$request->token)->first();
        if($user){
            $user->email_verified_token = NULL;
            $user->email_verified_at = date('Y-m-d h:s:i');
            $user->save();
            return redirect()->route('web.home.index')->with('status_confirmMail','Địa chỉ email của bạn đã được xác nhận thành công!');
        }else{
            return view("web.pages.damned.damned");
        }
    }
    public function getProfile(Request $request)
    {
        $user = $this->UsersRepository->getAuthByUsername(user()->username);
        if($user){
            SEOTools::setTitle(user()->full_name." - Hồ sơ");
            SEOTools::opengraph()->setUrl(\URL::current());
            return view("web.pages.infouser.profile",['type'=>'profile','user'=>$user]);
        }else{
            return view("web.pages.damned.damned");
        }
    }
    public function getSetting(Request $request)
    {
        $user = $this->UsersRepository->getAuthByUsername(user()->username);
        if($user){
            SEOTools::setTitle(user()->full_name." - Đỗi mật khẩu ");
            SEOTools::opengraph()->setUrl(\URL::current());
            return view("web.pages.infouser.changePass",['type'=>'changePass','user'=>$user]);
        }else{
            return view("web.pages.damned.damned");
        }
    }
    public function postUpdateProfile (ProfileRequest $request)
    {
        $result = $this->UsersRepository->updateProfile($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật thành công"), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'error','msg'=>"Cập nhật thất bại ! "), 200);
        }
    }
    public function postChangePassword(ChangePassRequest $request)
    {
        if (\Hash::check($request->old_password, \Auth::user()->password)) {
            $result =  $this->UsersRepository->updatePassword($request);
            if($result){
                return response()->json(array(
                    "status"=>'success',
                    "msg"=>"Cập nhật thành công "
                ), 200);
            }else{
                return response()->json(array(
                    "status"=>'error',
                    "msg"=>"Cập nhật thất bại"
                ), 200);
            }
        } else {
            return response()->json(array(
                "status"=>'error',
                "msg"=>"Mật củ khẩu không hợp lệ !"
            ), 200);
        }
    }
}
