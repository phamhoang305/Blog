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
class FollowsController extends Controller
{

    public $UsersRepository;
    public function __construct(UsersRepository $UsersRepository){
        $this->UsersRepository = $UsersRepository;

    }
    public function addFollows(Request $request)
    {
        $result = $this->UsersRepository->addFollows($request);
        if($result->status){
            return response()->json(array('status'=>'success','msg'=>'Follow thành công ','data'=>$result), 200);
        }else{
            return response()->json(array('status'=>'error','msg'=>'Follow không thành công ','data'=>$result), 200);
        }

    }
    public function removeFollows(Request $request)
    {
        $result = $this->UsersRepository->removeFollows($request);
        if($result->status){
            return response()->json(array('status'=>'success','msg'=>'Hủy Follow thành công ','data'=>$result), 200);
        }else{
            return response()->json(array('status'=>'error','msg'=>'Hủy Follow không thành công ','data'=>$result), 200);
        }
    }

}
