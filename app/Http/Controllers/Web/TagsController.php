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
class TagsController extends Controller
{
    public $CategorysRepository;
    public $PostsRepository;

    public function __construct(CategorysRepository $CategorysRepository,PostsRepository $PostsRepository){
        $this->CategorysRepository = $CategorysRepository;
        $this->PostsRepository = $PostsRepository;
    }
    public function getPostTag(Request $request,$tag_slug)
    {
        $request['tag_slug']=$tag_slug;
        $tag = $this->PostsRepository->getTagBySlug($request);
        if($tag){
            $posts = $this->PostsRepository->getPostByTagSlug($request);
            SEOTools::setTitle("Tag - ".$tag->tag);
            SEOTools::setDescription($tag->tag);
            SEOTools::opengraph()->setUrl(\URL::current());
            SEOMeta::addMeta('article:published_time', $tag->created_at, 'property');
            SEOMeta::addMeta('article:section',$tag->tag, 'property');
            OpenGraph::addProperty("site_name",setting()->name);
            OpenGraph::addProperty('locale','vi');
            $path = '/uploads/defaults/tags.png';
            if(\File::exists(public_path($path))){
                OpenGraph::addProperty('image',asset($path));
                OpenGraph::addProperty('image:secure_url',asset($path));
                OpenGraph::addProperty("twitter:image",asset($path));
                $image = getimagesize(public_path($path));
                OpenGraph::addProperty("image:width",$image[0]);
                OpenGraph::addProperty("image:height",$image[1]);
            }
            OpenGraph::addProperty('url',url()->current());
            OpenGraph::addProperty('article:published_time', $tag->created_at);
            OpenGraph::addProperty('article:modified_time', $tag->updated_at);
            OpenGraph::addProperty("twitter:site", setting()->name);
            OpenGraph::addProperty("twitter:title",$tag->tag);
            return view('web.pages.posts.tags',['posts'=>$posts,'tag'=>$tag]);
        }else{
            $post = $this->PostsRepository->getPostDefault();
            SEOTools::setTitle($post->post_title);
            SEOTools::opengraph()->setUrl(\URL::current());
            return view("web.pages.posts.nodata",['post'=>$post]);
        }
    }
}
