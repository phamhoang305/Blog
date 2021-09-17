<?php

namespace App\Http\Controllers\Web;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Categorys\CategorysRepository;
use App\Repositories\Posts\PostsRepository;
use App\Repositories\Pages\PagesRepository;
use App\Repositories\Users\UsersRepository;
use Config;
use stdClass;
use Illuminate\Support\Facades\Session;
class PostsController extends Controller
{
    public $CategorysRepository;
    public $PostsRepository;
    public $PagesRepository;
    public $UsersRepository;
    public function __construct(
        CategorysRepository $CategorysRepository,
        PostsRepository $PostsRepository,
        PagesRepository $PagesRepository,
        UsersRepository $UsersRepository
    ){
        $this->CategorysRepository = $CategorysRepository;
        $this->PostsRepository = $PostsRepository;
        $this->PagesRepository = $PagesRepository;
        $this->UsersRepository = $UsersRepository;
    }
    public function getPost(Request $request)
    {
        $cate =  $this->CategorysRepository->getInfoCatgoryBySlug($request->slug1,$request->slug2);
        // dd($cate);
        $page = null;
        $post = null;
        if($request->slug1!=null&&$request->slug2!=null&&$request->slug3!=null){

            $post =  $this->getPostSingleBySlug($request->slug3);
            if($post&&$post->post_view_type=='POST'){
                return $this->viewSingle($post);
            }else if($post&&$post->post_view_type=='PAGE'){
                return $this->viewPage($post);
            }else {
                return  $this->viewDefault();
            }
        }else{
            $post =  $this->getPostSingleBySlug($request->slug1);
            if($post&&$post->post_view_type=='POST'){
                return $this->viewSingle($post);
            }else if($post&&$post->post_view_type=='PAGE'){
                return $this->viewPage($post);
            }
        }

        if($cate){
            $posts = $this->getPostByCategory($cate);
            // dd( $cate);
            return $this->viewCategory($posts,$cate);
        }else{
            if($request->slug1!=null&&$request->slug2!=null&&$request->slug3!=null){
                $post = $this->getPostSingleBySlug($request->slug3);
            }else if($request->slug1!=null&&$request->slug2!=null&&$request->slug3==null){
                $post = $this->getPostSingleBySlug($request->slug2);
            }else if($request->slug1!=null&&$request->slug2==null&&$request->slug3==null){
                $post = $this->getPostSingleBySlug($request->slug1);
                if($post==null){
                    $page = $this->getPageSingleBySlug($request->slug1);
                }
            }
            if($post){
               return $this->viewSingle($post);
            }else if($page){
                return $this->viewPage($page);
            }
            else{
                return  $this->viewDefault();
            }
        }
    }
    public function viewDefault()
    {
        $post = $this->PostsRepository->getPostDefault();
        SEOTools::setTitle($post->post_title);
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("web.pages.posts.nodata",['post'=>$post]);
    }
    public function postPassword(Request $request)
    {
        $post = $this->PostsRepository->getPostByID($request);
        if($request->password===$post->post_password){
            Session::put('post_password',$post->post_password);
            return json_encode(array('status'=>'success'));
        }else{
            return json_encode(array('status'=>'error','msg'=>"Mật khẩu không hợp lệ !"));
        }
    }
    public function viewSingle($post)
    {
        $user = $this->UsersRepository->getInfoUserByID($post->userID);
        $user->user_id = $post->user_id;
        $user->userID = $post->userID;
        SEOMeta::setCanonical(\URL::current());
        SEOTools::setTitle($post->post_title);
        SEOTools::setDescription($post->post_des);
        SEOMeta::addKeyword($post->post_keywords);
        SEOTools::opengraph()->setUrl(\URL::current());
        SEOMeta::addMeta('article:published_time', $post->created_at, 'property');
        SEOMeta::addMeta('article:section',$post->cate_name, 'property');
        OpenGraph::addProperty("site_name",setting()->name);
        OpenGraph::addProperty('locale','vi');
        if(\File::exists(public_path($post->thumbnail))&&$post->thumbnail!=null){
            $post_image =   asset($post->thumbnail);
            $image = getimagesize(public_path($post->thumbnail));
        }else{
            $post_image = asset('assets/images/defaults/photos-icon.png');
            $image = getimagesize(public_path('assets/images/defaults/photos-icon.png'));
        }
        $post->img = $post_image;
        OpenGraph::addProperty('image',($post->img));
        OpenGraph::addProperty('image:secure_url',($post->img));
        OpenGraph::addProperty("twitter:image",($post->img));
        OpenGraph::addProperty("image:width",$image[0]);
        OpenGraph::addProperty("image:height",$image[1]);
        OpenGraph::addProperty('url',url()->current());
        SEOMeta::addMeta('author', $post->full_name);
        OpenGraph::addProperty('article:published_time', $post->created_at);
        OpenGraph::addProperty('article:modified_time', $post->updated_at);
        OpenGraph::addProperty("twitter:site", setting()->name);
        OpenGraph::addProperty("twitter:creator", $post->full_name);
        OpenGraph::addProperty("twitter:title",$post->post_title);
        JsonLd::setTitle($post->post_title.'-'.$post->cate_name);
        JsonLd::setDescription($post->post_des);
        JsonLd::setType('WebSite');
        JsonLd::addImage(($post->img));
        if(!empty($post->post_password)){
            if(!Session::has('post_password')&&Session::get('post_password')!=$post->post_password){
                return view('web.pages.posts.password',['post'=>$post]);
            }
        }else{
            Session::forget('post_password');
        }
        Config::set('comments.guest_commenting',setting()->user_login_register_status=='on'?false:true);
        return view("web.pages.posts.single",['post'=>$post,'user'=>[$user],'singleID'=>$post->uniqid ,'viewBlade'=>'single']);
    }
    public function viewCategory($posts,$cate)
    {
        SEOMeta::setCanonical(\URL::current());
        SEOTools::setTitle(($cate->cate_name));
        SEOTools::setDescription($cate->cate_des);
        SEOTools::opengraph()->setUrl(\URL::current());
        SEOMeta::addMeta('article:published_time', $cate->created_at, 'property');
        SEOMeta::addMeta('article:section',$cate->cate_name, 'property');
        OpenGraph::addProperty("site_name",setting()->name);
        OpenGraph::addProperty('locale','vi');
        if(\File::exists(public_path($cate->cate_icon))&&$cate->cate_icon!=null){
            $image = getimagesize(public_path($cate->cate_icon));
            $cate->cate_icon = $cate->img =   asset($cate->cate_icon);
        }else{
            $cate->cate_icon =  $cate->img = asset('assets/images/defaults/photos-icon.png');
            $image = getimagesize(public_path('assets/images/defaults/photos-icon.png'));
        }
        OpenGraph::addProperty('image',($cate->img));
        OpenGraph::addProperty('image:secure_url',($cate->img));
        OpenGraph::addProperty("twitter:image",($cate->img));
        OpenGraph::addProperty("image:width",$image[0]);
        OpenGraph::addProperty("image:height",$image[1]);
        OpenGraph::addProperty('url',url()->current());
        OpenGraph::addProperty('article:published_time', $cate->created_at);
        OpenGraph::addProperty('article:modified_time', $cate->updated_at);
        OpenGraph::addProperty("twitter:site", setting()->name);
        OpenGraph::addProperty("twitter:title",$cate->cate_name);
        JsonLd::setTitle($cate->cate_name);
        JsonLd::setDescription($cate->cate_des);
        JsonLd::setType('WebSite');
        JsonLd::addImage(($cate->img));
        return view("web.pages.posts.category",['posts'=>$posts,'cate'=>$cate]);
    }
    public function viewPage($post)
    {
        SEOMeta::setCanonical(\URL::current());
        SEOTools::setTitle($post->post_title);
        SEOTools::setDescription($post->post_des);
        SEOMeta::addKeyword($post->post_keywords);
        SEOTools::opengraph()->setUrl(\URL::current());
        SEOMeta::addMeta('article:published_time', $post->created_at, 'property');
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
        SEOMeta::addMeta('author', setting()->name);
        OpenGraph::addProperty('article:published_time', $post->created_at);
        OpenGraph::addProperty('article:modified_time', $post->updated_at);
        OpenGraph::addProperty("twitter:site", setting()->name);
        OpenGraph::addProperty("twitter:creator", setting()->name);
        OpenGraph::addProperty("twitter:title",$post->post_title);
        return view("web.pages.pages.index",['post'=>$post]);
    }
    public function getPostByCategory($cate)
    {
        $posts = $this->PostsRepository->getPostByCategoryID($cate);
        return $posts;
    }
    public function getPostSingleBySlug($post_slug)
    {
        return  $this->PostsRepository->getPostSingleBySlug($post_slug);
    }
    public function getPageSingleBySlug($slug)
    {
        return  $this->PagesRepository->getPageSingleBySlug($slug);
    }
}
