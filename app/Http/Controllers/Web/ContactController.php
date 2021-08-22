<?php

namespace App\Http\Controllers\Web;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Contact\ContactRequest;
use App\Repositories\Contact\ContactRepository;
use Session;
class ContactController extends Controller
{

    public $ContactRepository;
    public function __construct(ContactRepository $ContactRepository){
        $this->ContactRepository = $ContactRepository;

    }
    public function index(Request $request)
    {
        SEOTools::setTitle("Liên hệ");
        SEOTools::setDescription(setting()->des);
        SEOMeta::addKeyword(setting()->keywords);
        SEOTools::opengraph()->setUrl(\URL::current());
        SEOMeta::addMeta('article:published_time', setting()->created_at, 'property');
        SEOMeta::addMeta('article:section',setting()->name, 'property');
        OpenGraph::addProperty("site_name",setting()->name);
        OpenGraph::addProperty('locale','vi');
        if(\File::exists(public_path(setting()->seoImage))&&setting()->seoImage!=null){
            $img =   asset(setting()->seoImage);
            $image = getimagesize(public_path(setting()->seoImage));
        }else{
            $img = asset('assets/images/defaults/photos-icon.png');
            $image = getimagesize(public_path('assets/images/defaults/photos-icon.png'));
        }
        OpenGraph::addProperty('image',($img));
        OpenGraph::addProperty('image:secure_url',($img));
        OpenGraph::addProperty("twitter:image",($img));
        OpenGraph::addProperty("image:width",$image[0]);
        OpenGraph::addProperty("image:height",$image[1]);
        OpenGraph::addProperty('url',url()->current());
        OpenGraph::addProperty('WebSite:published_time', setting()->created_at);
        OpenGraph::addProperty('WebSite:modified_time', setting()->updated_at);
        OpenGraph::addProperty("twitter:site", setting()->name);
        OpenGraph::addProperty("twitter:title",setting()->name);
        JsonLd::setTitle(setting()->title);
        JsonLd::setDescription(setting()->des);
        JsonLd::setType('WebSite');
        JsonLd::addImage(($img));
        return view("web.pages.contact.index",$this->MathResult());
    }
    public function sendContact(ContactRequest $request)
    {
        $MathResult = Session::get('MathResult');
        if($MathResult==intval($request->result)&&$request->result!=""){
            $result = $this->ContactRepository->sendContact($request);
            if($result){
                return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Gửi thành công",'math'=>$this->MathResult()), 200);
            }else{
                return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Gửi không thành công"), 200);
            }
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Lêu lêu bạn không phải là con người vui lòng đi chổ khác !"), 200);
        }
    }
    public function MathResult()
    {
        $MathType = RandomString(1,'+-');
        $A = intval(RandomString(1));
        $B = intval(RandomString(1));
        if($MathType=='+'){
            $C = $A+$B;
        }else{
            $C = $A-$B;
        }
        Session::put('MathResult',$C);
        return ['MathA'=>$A,'MathB'=>$B,'MathType'=>$MathType];
    }
}
