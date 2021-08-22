<?php

namespace App\Http\Controllers\Web;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class UtilityController extends Controller
{
    public function index(Request $request)
    {
        SEOTools::setTitle("Công cụ - trực tuyến");
        SEOTools::setDescription('Khám phá một loạt các công cụ trực tuyến, bao gồm CSS, mã, hình ảnh, SEO, trình chuyển đổi và các tiện ích chuỗi. Phát triển các ứng dụng của bạn với sự trợ giúp của các công cụ dưới đây.');
        SEOMeta::addKeyword('');
        SEOTools::opengraph()->setUrl(\URL::current());
        SEOMeta::addMeta('article:published_time', setting()->created_at, 'property');
        SEOMeta::addMeta('article:section',setting()->name, 'property');
        OpenGraph::addProperty("site_name",setting()->name);
        OpenGraph::addProperty('locale','vi');
        if ( file_exists(public_path(setting()->seoImage))&&setting()->seoImage!=""){
            $img = setting()->seoImage;
        }else{
            $img = "/uploads/defaults/photos-icon.png";
        }
        OpenGraph::addProperty('image',asset($img));
        OpenGraph::addProperty('image:secure_url',asset($img));
        OpenGraph::addProperty("twitter:image",asset($img));
        $image = getimagesize(public_path($img));
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
        JsonLd::addImage(asset($img));
        return view("web.utility.index");
    }
    //getCSSGradienIndex
    public function getCSSGradienIndex(Request $request)
    {
        SEOTools::setTitle(" CSS Gradient — Generator, Maker, and Background");
        SEOTools::setDescription('As a free css gradient generator tool, this website lets you create a colorful gradient background for your website, blog, or social media profile');
        SEOMeta::addKeyword('Generator, Maker, and Background');
        SEOTools::opengraph()->setUrl(\URL::current());
        $img = "/uploads/defaults/css_gradient.png";
        OpenGraph::addProperty('image',asset($img));
        OpenGraph::addProperty('image:secure_url',asset($img));
        OpenGraph::addProperty("twitter:image",asset($img));
        $image = getimagesize(public_path($img));
        OpenGraph::addProperty("image:width",$image[0]);
        OpenGraph::addProperty("image:height",$image[1]);
        OpenGraph::addProperty('url',url()->current());
        OpenGraph::addProperty('article:published_time', date('Y-m-d h:s:i'));
        OpenGraph::addProperty('article:modified_time', date('Y-m-d h:s:i'));
        OpenGraph::addProperty("twitter:site", 'CSS Gradient');
        OpenGraph::addProperty("twitter:title",'CSS Gradient');
        return view("web.utility.cssGradient.index");
    }
    public function getCSSGradienPage(Request $request)
    {
        SEOTools::setTitle("CSS-GRADIENT");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("web.utility.cssGradient.page");
    }
    // gethtmltojsxindex
    public function gethtmltojsxindex(Request $request)
    {
        SEOTools::setTitle("HTML to JSX");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("web.utility.htmltojsx.index");
    }
    public function gethtmltojsxpage(Request $request)
    {
        SEOTools::setTitle("HTML to JSX");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("web.utility.htmltojsx.page");
    }
}