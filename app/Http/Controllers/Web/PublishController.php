<?php

namespace App\Http\Controllers\Web;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Web\Post\PostRequest;
use App\Http\Requests\Web\Post\ActionRequest;

use App\Repositories\Categorys\CategorysRepository;
use App\Repositories\Posts\PostsRepository;
class PublishController extends Controller
{
    public $CategorysRepository;
    public $PostsRepository;
    public function __construct(CategorysRepository $CategorysRepository,PostsRepository $PostsRepository){
        $this->CategorysRepository = $CategorysRepository;
        $this->PostsRepository = $PostsRepository;
    }
    public function getAdd(Request $request){
        SEOTools::setTitle(Auth::user()->full_name." - Viết bài");
        SEOTools::opengraph()->setUrl(\URL::current());
        $post = new Posts();
        $post->editor = "tinymce";
        return view("web.pages.publish.action",['post'=>$post,'showData'=>'myContent','type'=>'insert','typePage'=>true]);
    }
    public function getEdit(Request $request){
        $post = $this->PostsRepository->getPostByID($request);
        // dd(\File::getVisibility($post->thumbnail));
        if($post){
            SEOTools::setTitle("Cập nhật - ".$post->post_title);
            SEOTools::opengraph()->setUrl(\URL::current());
            $tags = $this->PostsRepository->getTagsByPostID($post->id);
            return view("web.pages.publish.action",['post'=>$post,'showData'=>'myContent','type'=>'update','typePage'=>true,'tags'=>$tags]);
        }else{
            return view("web.pages.publish.nodata");
        }
    }
    public function postEdit(PostRequest $request)
    {
        $url = getRedirectPublish($request);
        $result = $this->PostsRepository->updatePost($request);
        // dd($result);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật bài viết thành công " ,'url'=>$url), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Cập nhật bài viết thất bại !" ,'url'=>$url), 200);
        }
    }
    public function postAdd(PostRequest $request)
    {

        $url = getRedirectPublish($request);
        $result = $this->PostsRepository->insertPost($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Viết bài thành công " ,'url'=>$url), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Viết bài thất bại !" ,'url'=>$url), 200);
        }
    }
    public function postUnlock(ActionRequest $request)
    {
        $result = $this->PostsRepository->unLockPost($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Mở khóa thành công " ), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Mở khóa không thành công !" ), 200);
        }
    }
    public function postLock(ActionRequest $request)
    {
        $result = $this->PostsRepository->lockPost($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Khóa thành công " ), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"khóa không thành công !" ), 200);
        }
    }
    public function postTrash(ActionRequest $request)
    {
        $result = $this->PostsRepository->trashPost($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Xóa thành công " ), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Xóa không thành công !" ), 200);
        }
    }
    public function postDelete(ActionRequest $request)
    {
        $result = $this->PostsRepository->deletePost($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Xóa vĩnh viễn thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Xóa vĩnh viễn không thành công !"), 200);
        }
    }
    public function postRestore(ActionRequest $request)
    {
        $result = $this->PostsRepository->restorePost($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Khôi phục thành công " ), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Khôi phục không thành công !"), 200);
        }
    }
}
