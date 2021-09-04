<?php
namespace App\Http\Controllers\Web;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Repositories\Quiz\QuizRepository;
use App\Http\Requests\Admin\Quiz\CategoryRequest;
use App\Http\Requests\Admin\Quiz\TestlistRequest;
use App\Http\Requests\Admin\Quiz\TestdetaiRequest;
class QuizController extends Controller
{
    public function getTestCategory(Request $Request)
    {
        $Request['status']=0;
        SEOTools::setTitle("Học thi trắc nghiệm online - Chủ đề ");
        SEOTools::opengraph()->setUrl(\URL::current());
        SEOTools::setDescription("Luyện thi trắc nghiệm trực tuyến, trắc nghiệm online, thi thử trắc nghiệm trực tuyến online các môn");
        OpenGraph::addProperty('locale','vi');
        $path = '/assets/images/defaults/test.png';
        if(\File::exists(public_path($path))){
            OpenGraph::addProperty('image',asset($path));
            OpenGraph::addProperty('image:secure_url',asset($path));
            OpenGraph::addProperty("twitter:image",asset($path));
            $image = getimagesize(public_path($path));
            OpenGraph::addProperty("image:width",$image[0]);
            OpenGraph::addProperty("image:height",$image[1]);
        }
        OpenGraph::addProperty('url',url()->current());
        $QuizRepository = new QuizRepository();
        $data =  $QuizRepository->getTestCategory($Request);
        return view('web.pages.quiz.category',['data'=>$data]);
    }
    public function getTestList(Request $request)
    {
        $QuizRepository = new QuizRepository();
        $request['status']=0;
        $category =  $QuizRepository->getTestCategoryByID($request->uniqid);
        if($category){
            $request['test_categoryID']=$category->id;
            SEOTools::setTitle("{$category->name}");
            SEOTools::setDescription("{$category->des}");
            SEOTools::opengraph()->setUrl(\URL::current());
            OpenGraph::addProperty('locale','vi');
            $path = '/assets/images/defaults/test.png';
            if(\File::exists(public_path($path))){
                OpenGraph::addProperty('image',asset($path));
                OpenGraph::addProperty('image:secure_url',asset($path));
                OpenGraph::addProperty("twitter:image",asset($path));
                $image = getimagesize(public_path($path));
                OpenGraph::addProperty("image:width",$image[0]);
                OpenGraph::addProperty("image:height",$image[1]);
            }
            OpenGraph::addProperty('url',url()->current());
            $data =  $QuizRepository->getTestList($request);
            return view('web.pages.quiz.testlist',['data'=>$data,'category'=>$category]);
        }else{
            return false;
        }
    }
    public function postTestDetail(Request $request)
    {
        $QuizRepository = new QuizRepository();
        $testlist =  $QuizRepository->getTestListByID($request->uniqid);
        if($testlist){
            $testdetais =  $QuizRepository->getTestDetailClient($testlist->id);
            return json_encode(array(
                'testlist'=>$testlist,
                'testdetails'=>$testdetais,
                'count'=>$testdetais->count()
            ));
        }

    }
    public function getTestDetail(Request $request)
    {
        $QuizRepository = new QuizRepository();
        $info =  $QuizRepository->getCategoryAndTestListByID($request->uniqid);
        // dd($info);
        if($info){
            $request['testlistID'] = $info->testlistID;
            $data =  $QuizRepository->getTestDetailClient(intval($info->testlistID));
            $info->name = "{$info->testlist_name} - {$info->name}";
            SEOTools::setTitle($info->name);
            SEOTools::opengraph()->setUrl(\URL::current());
            SEOTools::setDescription($info->des);
            SEOMeta::addKeyword($info->des);
            SEOMeta::addMeta('article:published_time', $info->created_at, 'property');
            SEOMeta::addMeta('article:section',$info->name, 'property');
            OpenGraph::addProperty("site_name",$info->name);
            OpenGraph::addProperty('locale','vi');
            $path = '/assets/images/defaults/test.png';
            if(\File::exists(public_path($path))){
                OpenGraph::addProperty('image',asset($path));
                OpenGraph::addProperty('image:secure_url',asset($path));
                OpenGraph::addProperty("twitter:image",asset($path));
                $image = getimagesize(public_path($path));
                OpenGraph::addProperty("image:width",$image[0]);
                OpenGraph::addProperty("image:height",$image[1]);
                JsonLd::addImage(asset($path));
            }
            OpenGraph::addProperty('url',url()->current());
            OpenGraph::addProperty('WebSite:published_time', setting()->created_at);
            OpenGraph::addProperty('WebSite:modified_time', setting()->updated_at);
            OpenGraph::addProperty("twitter:site", setting()->name);
            OpenGraph::addProperty("twitter:title",setting()->name);
            JsonLd::setTitle($info->name);
            JsonLd::setDescription($info->des);
            JsonLd::setType('WebSite');

            // dd($data[3]);
            $test_result =  $QuizRepository->getTestResultByID_TestList($request);
            return view('web.pages.quiz.testdetail',['data'=>($data),'count'=>$data->count(),'info'=>$info,"test_result"=>$test_result]);
        }else{
            return false;
        }
    }
    public function postSaveTest(Request $request)
    {
        $QuizRepository = new QuizRepository();
        $result = $QuizRepository->saveDataTest($request);
        if($result){
            $url = route('web.quiz.resultdetail').'/'. $result->results_uniqid;
            return json_encode (array('status'=>'success','msg'=>'Nộp bài thành công','url'=>$url));
        }else{
            return json_encode (array('status'=>'success','msg'=>'Nộp bài thất bại !'));
        }
    }
    public function getHistoryTest(Request $request)
    {
        SEOTools::setTitle("Lịch sử");
        SEOTools::opengraph()->setUrl(\URL::current());
        $QuizRepository = new QuizRepository();
        $data = $QuizRepository->getHistoryTest($request);
        return view('web.pages.quiz.history',['data'=>$data]);
    }
    public function getResultDetail(Request $request)
    {
        $QuizRepository = new QuizRepository();
        $data =  $QuizRepository->getResulDetail($request);
        // dd( $data);
        SEOTools::setTitle($data->category_name." - ".$data->testlist_name);
        SEOTools::opengraph()->setUrl(\URL::current());
        $request['testlistID']= $data->testlistID;
        $test_result =  $QuizRepository->getTestResultByID_TestList($request);
        return view('web.pages.quiz.result-detail',['data'=>$data,'test_result'=>$test_result]);
    }
}
