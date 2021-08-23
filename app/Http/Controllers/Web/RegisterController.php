<?php

namespace App\Http\Controllers\Web;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Auth\AuthRepositories;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Web\Register\RegisterRequest;

class RegisterController extends Controller
{
    public $AuthRepositories;
    public function __construct(
        AuthRepositories $AuthRepositories
    ){
        $this->AuthRepositories = $AuthRepositories;
    }
    public function getRegister(Request $request)
    {
        SEOTools::setTitle("Đăng ký -  Thành viên");
        SEOTools::opengraph()->setUrl(\URL::current());

        if($request->session()->get('url')==null){
            $request->session()->put('url', url()->previous());
        }
        return view('web.pages.auth.register');
    }
    public function ajaxRegister(RegisterRequest $request)
    {
        if($request->type=='confirm'){
            $rs =  $this->email_authentication($request);
            if($rs==true){
                return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Chúng tôi đã gửi cho bạn mã đến : {$request->email} Vui lòng kiểm tra mã trong email của bạn. Mã này gồm 6 số. "), 200);
            }else{
                return  response()->json(array(
                    'status'=>'error',
                    'icon'=>'error',
                    'msg'=>"Hiện tại máy chủ không thể thực hiện được vui lòng thử lại ! ",
                    "error"=>$rs,
                ), 200);
            }
        }else{
            $code = Session::get('code');
            if($code==$request->code){
                $_checkLogin = $this->AuthRepositories->_register($request);
                $url = $request->session()->get('url');
                if($_checkLogin){
                    configMail();
                    $rs =  _sendMail([
                        "template"=>"web.pages.auth.template-mail.register",
                        "data"=>[
                            "full_name"=>$request->full_name,
                            "email"=>$request->email
                        ],
                        "mailSend"=>[setting()->MAIL_RECEIVE],
                        "subject"=>"Đăng ký thành viên mới"
                    ]);
                    Session::put('code',"");
                    \Auth::attempt(['email'=>$request->email,'password'=>$request->password]);
                    $request->session()->forget('url');
                    return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Đăng ký thành công" ,'url'=>$url), 200);
                }else{
                    return  response()->json(array('status'=>'error','icon'=>'error','msg'=>"Đăng ký thất bại ! "), 200);
                }
            }else{
                return  response()->json(array('status'=>'error','icon'=>'error','msg'=>"Mã xác thực không hợp lệ vui lòng nhập lại ! "), 200);
            }
        }
    }
    public function email_authentication($request)
    {
        configMail();
        $codeRandom = RandomString();
        Session::put('code',$codeRandom);
        $codes =  str_split($codeRandom);
        $rs =  _sendMail([
            "template"=>"web.pages.auth.template-mail.email_authentication",
            "data"=>[
                "full_name"=>$request->full_name,
                "email"=>$request->email,
                "codes"=>$codes
            ],
            "mailSend"=>[$request->email,setting()->MAIL_RECEIVE],
            "subject"=>"Mã xác thực tài khoản"
        ]);
        // dd($rs);
        if($rs===true){
            return true;
        }else{
            return false;
        }
    }
}
