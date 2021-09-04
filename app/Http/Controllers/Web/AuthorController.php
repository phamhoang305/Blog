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

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
class AuthorController extends Controller
{

    public $UsersRepository;
    public $PostsRepository;
    public function __construct(UsersRepository $UsersRepository,PostsRepository $PostsRepository){
        $this->UsersRepository = $UsersRepository;
        $this->PostsRepository = $PostsRepository;
    }
    public function getAuthor(Request $request)
    {
        SEOTools::setTitle(setting()->name." - Các tác giả ");
        SEOTools::opengraph()->setUrl(\URL::current());
        $topAuthors =  $this->UsersRepository->getTopAuthors($request);
        return view("web.pages.topAuthor.index",['topAuthors'=>$topAuthors]);
    }
}
