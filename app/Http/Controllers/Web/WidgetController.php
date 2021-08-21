<?php

namespace App\Http\Controllers\Web;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Views\PostsView;
use App\Repositories\Users\UsersRepository;
use App\Repositories\Posts\PostsRepository;
class WidgetController extends Controller
{
    public function getWidget(Request $request)
    {
        $data = array(
            'randomPosts'=>$this->randomPosts(),
            'postTopView'=>$this->postTopView(),
            'tags'=>$this->getTags(),
            'authors'=>$this->getAuthors()
        );
        if($request->_loadhome){
            $PostsRepository = new PostsRepository();
            $data['posthome']= view('web.pages.home.includes.render-post-ajax',['posts'=>$PostsRepository->getPostPageHome($request)])->render();
        }
        if($request->_cate_slug&&$request->_postID){
            $data['sameCategory'] = $this->sameCategory($request->_cate_slug,$request->_postID);
        }
        return json_encode($data);
    }
    public function randomPosts()
    {
        return view('web.formControl.random-posts')->render();
    }
    public function postTopView()
    {
        return view('web.formControl.post-top-view')->render();
    }
    public function getTags()
    {
        return view('web.formControl.tags')->render();
    }
    public function getAuthors()
    {
        return view('web.formControl.top-authors',['_topAuthors'=>getTopAuthors(), 'headerTopAuth'=>true])->render();
    }
    public function sameCategory($_cate_slug,$_postID)
    {
        return view('web.formControl.same-category',['_cate_slug'=>$_cate_slug,'_postID'=>$_postID])->render();
    }


}
