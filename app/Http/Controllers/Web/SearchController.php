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

class SearchController extends Controller
{

    public $PostsRepository;
    public function __construct(PostsRepository $PostsRepository){
        $this->PostsRepository = $PostsRepository;
    }
    public function getSearch(Request $request)
    {
        $posts = $this->PostsRepository->getSearchPost($request);
        if($request->q!=""){
            SEOTools::setTitle("Tìm kiếm - ".$request->q);
        }else{
            SEOTools::setTitle("Tìm kiếm ");
        }

        SEOTools::setDescription(setting()->des);
        return view('web.pages.posts.search',['qSearch'=>$request->q,'posts'=>$posts]);
    }
}
