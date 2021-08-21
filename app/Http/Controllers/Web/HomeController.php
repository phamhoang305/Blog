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
use Auth;
class HomeController extends Controller
{

    public $PostsRepository;
    public function __construct(PostsRepository $PostsRepository){
        $this->PostsRepository = $PostsRepository;
    }
    public function index(Request $request)
    {
        // dd(getMenu());
        SEOMeta::setCanonical(\URL::current());
        SEOTools::setTitle(setting()->title);
        SEOTools::setDescription(setting()->des);
        SEOMeta::addKeyword(setting()->keywords);
        SEOTools::opengraph()->setUrl(\URL::current());
        SEOMeta::addMeta('article:published_time', setting()->created_at, 'property');
        SEOMeta::addMeta('article:section',setting()->name, 'property');
        OpenGraph::addProperty("site_name",setting()->name);
        OpenGraph::addProperty('locale','vi');
        if(\Storage::exists(setting()->seoImage)){
            $img =   asset("storage/".setting()->seoImage);
            $image = getimagesize("storage/".setting()->seoImage);
        }else{
            $img = asset('assets/images/defaults/photos-icon.png');
            $image = getimagesize('assets/images/defaults/photos-icon.png');
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
        return view("web.pages.home.index");
    }
    public function getPostPageHome(Request $request)
    {
        $posts = $this->PostsRepository->getPostPageHome($request);
        return view('web.pages.home.includes.render-post-ajax',['posts'=>$posts])->render();
    }
}
