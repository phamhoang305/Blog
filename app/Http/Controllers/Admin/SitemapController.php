<?php

namespace App\Http\Controllers\Admin;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Repositories\Settings\SettingsRepository;
use App\Http\Requests\Admin\Role\RoleAddRequest;
use App\Http\Requests\Admin\Role\RoleEditRequest;
use App\Models\Roles;
use App\Models\Posts;
use App\Models\Categorys;
use App\Views\PostsView;
use App\Models\Testlist;
use Carbon\Carbon;
class SitemapController extends Controller
{
    public function getIndex(Request $request)
    {
        SEOTools::setTitle("Công cụ seo ");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view('admin.pages.sitemap.index');
    }
    public function postUpdate(Request $request)
    {
        $SettingsRepository  = new SettingsRepository();
        $result = $SettingsRepository->updateSeo($request);
        if($result){
            $this->cronjobUpdate($request);
            return json_encode (array('status'=>'success','msg'=>'Cập nhật sitemap thành công'));
        }else{
            return json_encode (array('status'=>'success','msg'=>'Cập nhật sitemap thất bại !'));
        }
    }
    public function showSitemap(Request $request)
    {
        $request['use_styles']=true;
        $this->cronjobUpdate($request);
        $sitemap = app()->make('sitemap');
        $sitemap->setCache(setting()->name, 60);
        if (!$sitemap->isCached()) {
            $sitemap = $this->home($sitemap);
            $sitemap = $this->quiz($sitemap);
            $sitemap = $this->contact($sitemap);
            $sitemap = $this->tags($sitemap);
            $sitemap = $this->search($sitemap);
            $sitemap = $this->category($sitemap);
            $sitemap = $this->post($sitemap);
            $sitemap = $this->page($sitemap);
            $sitemap = $this->css_gradient($sitemap);
        }
        return $sitemap->render('xml');
    }
    public function cronjobUpdate(Request $request)
    {
        if(!isset($request->use_styles)){
            \Config::set("sitemap.use_styles",false);
        }else{
            \Config::set("sitemap.use_styles",$request->use_styles);
        }
        $sitemap = \App::make('sitemap');
        $sitemap->add(url('/'), Carbon::now(), 1, setting()->sitemap_frequency);
        $sitemap = $this->home($sitemap);
        $sitemap = $this->quiz($sitemap);
        $sitemap = $this->contact($sitemap);
        $sitemap = $this->search($sitemap);
        $sitemap = $this->tags($sitemap);
        $sitemap = $this->category($sitemap);
        $sitemap = $this->post($sitemap);
        $sitemap = $this->page($sitemap);
        $sitemap = $this->css_gradient($sitemap);
        $sitemap->store('xml', 'sitemap');
        if($request->ajax()){
            return json_encode (array('status'=>'success','msg'=>'Cập nhật sitemap thành công ^^'));
        }
        return "CẬP NHẬT THÀNH CÔNG";
    }
    public function getDowload(Request $request)
    {
        $file= public_path(). "/sitemap.xml";
        return \Response::download($file, 'sitemap.xml');
    }
    //SET sitemap
    public  function home($sitemap)
    {
        $sitemap->add(route('web.home.index'),date('Y-m-d h:s:i'), 1, setting()->sitemap_frequency);
        return  $sitemap;
    }

    public function category($sitemap)
    {
        $posts =Categorys::limit(100)->orderBy('id','desc')->get();
        foreach ($posts as $value) {
            if($value->cate_slug!=null&&$value->cate_slug_parent!=null){
                $sitemap->add(route('web.posts.index',[$value->cate_slug_parent,$value->cate_slug]), $value->updated_at, 1, setting()->sitemap_frequency);
            }else{
                $sitemap->add(route('web.posts.index',$value->cate_slug), $value->updated_at, 1, setting()->sitemap_frequency);
            }

        }
        return  $sitemap;
    }
    public function post($sitemap)
    {
        $posts =PostsView::limit(100)->orderBy('id','desc')->get();
        foreach ($posts as $value) {
            if($value->cate_slug!=null&&$value->cate_slug_parent!=null){
                $sitemap->add(route('web.posts.index',[$value->cate_slug_parent,$value->cate_slug,$value->post_slug]), $value->updated_at, 2, setting()->sitemap_frequency);
            }else{
                $sitemap->add(route('web.posts.index',[$value->cate_slug,$value->post_slug]), $value->updated_at, 2, setting()->sitemap_frequency);
            }

        }
        return  $sitemap;
    }
    public function tags($sitemap)
    {
        $tags =getTags();
        foreach ($tags as $value) {
            $sitemap->add(route('web.tag.post',$value->tag_slug), $value->updated_at, 1, setting()->sitemap_frequency);
        }
        return  $sitemap;
    }
    public function quiz($sitemap)
    {
        $sitemap->add(route('web.quiz.category.view'),date('Y-m-d'), 1, setting()->sitemap_frequency);
        $result =  Testlist::where('testlist_status','=',0)
        ->orderBy('created_at','desc')->limit(15)->get();
        foreach($result as $value){
            $sitemap->add(route('web.quiz.testdetail.view',$value->uniqid), $value->updated_at, 1, setting()->sitemap_frequency);
        }
        return  $sitemap;
    }
    public function page($sitemap)
    {
        $posts =Posts::where('post_view_type','PAGE')->limit(15)->orderBy('id','desc')->get();
        foreach ($posts as $value) {
            $sitemap->add(route('web.posts.index',$value->post_slug), $value->updated_at, 1, setting()->sitemap_frequency);
        }
        return  $sitemap;
    }
    public  function contact($sitemap)
    {
        $sitemap->add(route('web.contact.index'),date('Y-m-d h:s:i'), 1, setting()->sitemap_frequency);
        return  $sitemap;
    }
    public  function search($sitemap)
    {
        $sitemap->add(route('web.search.index'),date('Y-m-d h:s:i'), 1, setting()->sitemap_frequency);
        return  $sitemap;
    }
    public  function css_gradient($sitemap)
    {
        $sitemap->add(route('web.css_gradien.index'),date('Y-m-d h:s:i'), 1, setting()->sitemap_frequency);
        return  $sitemap;
    }
}

