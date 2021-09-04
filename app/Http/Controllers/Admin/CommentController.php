<?php
namespace App\Http\Controllers\Admin;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Repositories\Comments\CommentsRepository;

class CommentController extends Controller
{
    public function getList(Request $Request)
    {
        SEOTools::setTitle("Bình luận ");
        SEOTools::opengraph()->setUrl(\URL::current());
        $CommentsRepository = new CommentsRepository();
        $data =  $CommentsRepository->getCommentsList($Request);
        return view('admin.pages.comment.list',['data'=>$data]);
    }
    public function postDelete(Request $request)
    {
        $CommentsRepository = new CommentsRepository();
        $result = $CommentsRepository->deleteComments($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Xóa thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Xóa không thành công !"), 200);
        }
    }
}
