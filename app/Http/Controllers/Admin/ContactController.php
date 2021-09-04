<?php

namespace App\Http\Controllers\Admin;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Repositories\Contact\ContactRepository;

class ContactController extends Controller
{
    public function getList(Request $Request)
    {
        SEOTools::setTitle("Tin nhắn liên hệ");
        SEOTools::opengraph()->setUrl(\URL::current());
        $ContactRepository = new  ContactRepository();
        $data =  $ContactRepository->getContactList($Request);
        return view('admin.pages.contact.list',['data'=>$data]);
    }
    public function postDelete(Request $request)
    {
        $ContactRepository = new  ContactRepository();
        $result = $ContactRepository->deleteContact($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Xóa thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Xóa không thành công !"), 200);
        }
    }
    public function getViewAjax(Request $request)
    {
        $ContactRepository = new  ContactRepository();
        $result = $ContactRepository->getContactByID($request);
        return  response()->json($result);
    }
    public function postReplyAjax(Request $request)
    {
        configMail();
        $rs = _sendMail([
            "template"=>"web.pages.contact.reply",
            "data"=>["body"=>$request->body],
            "mailSend"=>[$request->email],
            "subject"=>$request->subject
        ]);
        if($rs==true){
            return json_encode(array('status'=>"success","msg"=>"Gửi thành công"));
        }
        return json_encode(array('status'=>"error","msg"=>$rs));

    }
}
