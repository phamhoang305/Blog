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
class MycontentController extends Controller
{

    public $UsersRepository;
    public $PostsRepository;
    public $showData = 'showData';
    public function __construct(UsersRepository $UsersRepository,PostsRepository $PostsRepository){
        $this->UsersRepository = $UsersRepository;
        $this->PostsRepository = $PostsRepository;
    }
    public function getPostPublic(Request $request)
    {
        $request['type'] ='published';
        $posts = $this->PostsRepository->getPostByUserLogin($request);
        SEOTools::setTitle(user()->full_name." - Bài viết công khai");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("web.pages.my-content.post.public",['showData'=>$this->showData,'type'=>'public','posts'=>$posts,'search'=>$request->q,'category'=>$request->c]);
    }
    public function getPostDraft(Request $request)
    {
        $request['type'] ='draft';
        $posts = $this->PostsRepository->getPostByUserLogin($request);
        SEOTools::setTitle(user()->full_name." - Bài viết nháp");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("web.pages.my-content.post.draft",['showData'=>$this->showData,'type'=>'draft','posts'=>$posts,'search'=>$request->q,'category'=>$request->c]);
    }
    public function getPostApprove(Request $request)
    {
        $request['type'] ='approve';
        $posts = $this->PostsRepository->getPostByUserLogin($request);
        SEOTools::setTitle(user()->full_name." - Chờ phê duyệt");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("web.pages.my-content.post.approve",['showData'=>$this->showData,'type'=>'approve','posts'=>$posts,'search'=>$request->q,'category'=>$request->c]);
    }

    public function getPostLock(Request $request)
    {
        $request['type'] ='lock';
        $posts = $this->PostsRepository->getPostByUserLogin($request);
        SEOTools::setTitle(user()->full_name." - Bài viết đã khóa");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("web.pages.my-content.post.lock",['showData'=>$this->showData,'type'=>'lock','posts'=>$posts,'search'=>$request->q,'category'=>$request->c]);
    }
    public function getPostTrash(Request $request)
    {
        $request['trash'] =true;
        $posts = $this->PostsRepository->getPostByUserLogin($request);
        SEOTools::setTitle(user()->full_name." - Bài viết đã xóa");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("web.pages.my-content.post.trash",['showData'=>$this->showData,'type'=>'trash','posts'=>$posts,'search'=>$request->q,'category'=>$request->c]);
    }
}
