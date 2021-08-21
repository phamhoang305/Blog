<?php


namespace App\Http\Controllers\Admin;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Models\Posts;
use App\Repositories\Posts\PostsRepository;
use App\Http\Requests\Web\Post\PostRequest;
use App\Http\Requests\Web\Post\ActionRequest;
use Auth;
class PostController extends Controller
{
    public $showData = "admin";
    public function getPostPublic(Request $request)
    {
        $request['type'] ='published';
        $request['showData'] =$this->showData;
        $PostsRepository = new PostsRepository();
        $posts = $PostsRepository->getPostByAdmin($request);
        SEOTools::setTitle(user()->full_name." - Bài viết công khai");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("admin.pages.post.public",['showData'=>$this->showData,'type'=>'public','posts'=>$posts,'search'=>$request->q,'category'=>$request->c]);
    }
    public function getPostDraft(Request $request)
    {
        $request['type'] ='draft';
        $request['showData'] =$this->showData;
        $PostsRepository = new PostsRepository();
        $posts = $PostsRepository->getPostByAdmin($request);
        SEOTools::setTitle(user()->full_name." - Bài viết nháp");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("admin.pages.post.draft",['showData'=>$this->showData,'type'=>'draft','posts'=>$posts,'search'=>$request->q,'category'=>$request->c]);
    }
    public function getPostApprove(Request $request)
    {
        $request['type'] ='approve';
        $request['showData'] =$this->showData;
        $PostsRepository = new PostsRepository();
        $posts = $PostsRepository->getPostByAdmin($request);
        SEOTools::setTitle(user()->full_name." - Chờ phê duyệt");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("admin.pages.post.approve",['showData'=>$this->showData,'type'=>'approve','posts'=>$posts,'search'=>$request->q,'category'=>$request->c]);
    }
    public function getPostLock(Request $request)
    {
        $request['type'] ='lock';
        $request['showData'] =$this->showData;
        $PostsRepository = new PostsRepository();
        $posts = $PostsRepository->getPostByAdmin($request);
        SEOTools::setTitle(user()->full_name." - Bài viết đã khóa");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("admin.pages.post.lock",['showData'=>$this->showData,'type'=>'lock','posts'=>$posts,'search'=>$request->q,'category'=>$request->c]);
    }
    public function getPostTrash(Request $request)
    {
        $request['trash'] =true;
        $request['showData'] =$this->showData;
        $PostsRepository = new PostsRepository();
        $posts = $PostsRepository->getPostByAdmin($request);
        SEOTools::setTitle(user()->full_name." - Bài viết đã xóa");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("admin.pages.post.trash",['showData'=>$this->showData,'type'=>'trash','posts'=>$posts,'search'=>$request->q,'category'=>$request->c]);
    }
    public function getAdd(Request $request)
    {
        SEOTools::setTitle(Auth::user()->full_name." - Viết bài");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("web.pages.publish.action",['post'=>new Posts(),'showData'=>$this->showData,'type'=>'insert','typePage'=>true]);
    }
    public function getEdit(Request $request){
        $PostsRepository = new PostsRepository();
        $post = $PostsRepository->getPostByID($request);
        if($post){
            SEOTools::setTitle("Cập nhật - ".$post->post_title);
            SEOTools::opengraph()->setUrl(\URL::current());
            $tags = $PostsRepository->getTagsByPostID($post->id);
            return view("web.pages.publish.action",['post'=>$post,'showData'=>$this->showData,'type'=>'update','typePage'=>true,'tags'=>$tags]);
        }else{
            return view("web.pages.publish.nodata");
        }

    }
    public function approvePublic(PostRequest $request)
    {
        $request['status_approve']="";
        $url = getRedirectPublish($request);
        $PostsRepository = new PostsRepository();
        $result = $PostsRepository->updatePost($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Duyệt bài viết thành công " ,'url'=>$url), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Duyệt bài viết thất bại !" ,'url'=>$url), 200);
        }
    }
    public function postEdit(PostRequest $request)
    {
        $url = getRedirectPublish($request);
        $PostsRepository = new PostsRepository();
        $result = $PostsRepository->updatePost($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật bài viết thành công " ,'url'=>$url), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Cập nhật bài viết thất bại !" ,'url'=>$url), 200);
        }
    }
    public function postAdd(PostRequest $request)
    {
        $url = getRedirectPublish($request);
        $PostsRepository = new PostsRepository();
        $result = $PostsRepository->insertPost($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Viết bài thành công " ,'url'=>$url), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Viết bài thất bại !" ,'url'=>$url), 200);
        }
    }
    public function postUnlock(ActionRequest $request)
    {
        $PostsRepository = new PostsRepository();
        $result = $PostsRepository->unLockPost($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Mở khóa thành công " ), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Mở khóa không thành công !" ), 200);
        }
    }
    public function postLock(ActionRequest $request)
    {
        $PostsRepository = new PostsRepository();
        $result = $PostsRepository->lockPost($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Khóa thành công " ), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"khóa không thành công !" ), 200);
        }
    }
    public function postTrash(ActionRequest $request)
    {
        $PostsRepository = new PostsRepository();
        $result = $PostsRepository->trashPost($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Xóa thành công " ), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Xóa không thành công !" ), 200);
        }
    }
    public function postDelete(ActionRequest $request)
    {
        $PostsRepository = new PostsRepository();
        $result = $PostsRepository->deletePost($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Xóa vĩnh viễn thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Xóa vĩnh viễn không thành công !"), 200);
        }
    }
    public function postRestore(ActionRequest $request)
    {
        $PostsRepository = new PostsRepository();
        $result = $PostsRepository->restorePost($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Khôi phục thành công " ), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Khôi phục không thành công !"), 200);
        }
    }
}
