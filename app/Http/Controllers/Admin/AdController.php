<?php
namespace App\Http\Controllers\Admin;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Repositories\Ad\AdRepository;

class AdController extends Controller
{

    public function getList(Request $Request)
    {
        SEOTools::setTitle("Không gian - Quảng cáo ");
        SEOTools::opengraph()->setUrl(\URL::current());
        $AdRepository = new AdRepository();
        $data =  $AdRepository->getAdList($Request);
        return view('admin.pages.ad.list',['data'=>$data]);
    }
    public function getEdit(Request $Request)
    {
        SEOTools::setTitle("Cập nhật");
        SEOTools::opengraph()->setUrl(\URL::current());
        $AdRepository = new AdRepository();
        $ad =  $AdRepository->getAdByID($Request);
        return view('admin.pages.ad.action',['ad'=>$ad]);
    }
    public function postEdit (Request $request)
    {
        $AdRepository = new AdRepository();
        $result = $AdRepository->updateAd($request);
        if($result){
            return json_encode (array('status'=>'success','msg'=>'Cập nhật thành công'));
        }else{
            return json_encode (array('status'=>'success','msg'=>'Cập nhật thất bại !'));
        }
    }
    public function postSaveAdSene (Request $request)
    {
        $AdRepository = new AdRepository();
        $result = $AdRepository->saveAdSene($request);
        if($result){
            return json_encode (array('status'=>'success','msg'=>'Cập nhật thành công'));
        }else{
            return json_encode (array('status'=>'success','msg'=>'Cập nhật thất bại !'));
        }
    }
    public function postStatus(Request $request)
    {
        $AdRepository = new AdRepository();
        $result = $AdRepository->statusAd($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật trạng thái công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Cập nhật trạng thái không thành công !"), 200);
        }
    }

}
