<?php
namespace App\Http\Controllers\Admin;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Repositories\Quiz\QuizRepository;
use App\Repositories\Quiz\ExportImport;
use App\Http\Requests\Admin\Quiz\CategoryRequest;
use App\Http\Requests\Admin\Quiz\TestlistRequest;
use App\Http\Requests\Admin\Quiz\TestdetaiRequest;
class QuizController extends Controller
{
    public function getTestCategory(Request $Request)
    {
        SEOTools::setTitle("Danh mục - Trắc nghiệm ");
        SEOTools::opengraph()->setUrl(\URL::current());
        $QuizRepository = new QuizRepository();
        $data =  $QuizRepository->getTestCategory($Request);
        return view('admin.pages.quiz.testcategory.list',['data'=>$data]);
    }
    public function getTestCategoryEdit(Request $Request)
    {
        $QuizRepository = new QuizRepository();
        $data =  $QuizRepository->getTestCategoryByID($Request->uniqid);
        return json_encode( $data);
    }
    public function postTestCategoryEdit (CategoryRequest $request)
    {
        $QuizRepository = new QuizRepository();
        $result = $QuizRepository->editTestCategory($request);
        if($result){
            return json_encode (array('status'=>'success','msg'=>'Cập nhật thành công'));
        }else{
            return json_encode (array('status'=>'success','msg'=>'Cập nhật thất bại !'));
        }
    }
    public function postTestCategoryAdd(CategoryRequest $request)
    {
        $QuizRepository = new QuizRepository();
        $result = $QuizRepository->addTestCategory($request);
        if($result){
            return json_encode (array('status'=>'success','msg'=>'Thêm thành công'));
        }else{
            return json_encode (array('status'=>'success','msg'=>'Thêm thất bại !'));
        }
    }
    public function postTestCategoryDelete(Request $request)
    {
        $QuizRepository = new QuizRepository();
        $result = $QuizRepository->deleteTestCategory($request);
        if($result){
            return json_encode (array('status'=>'success','msg'=>'Xóa thành công'));
        }else{
            return json_encode (array('status'=>'success','msg'=>'Xóa thất bại !'));
        }
    }
    public function getTestList(Request $request)
    {
        $QuizRepository = new QuizRepository();
        $category =  $QuizRepository->getTestCategoryByID($request->uniqid);
        if($category){
            $request['test_categoryID']=$category->id;
            SEOTools::setTitle("{$category->name}");
            SEOTools::opengraph()->setUrl(\URL::current());
            $data =  $QuizRepository->getTestList($request);

            return view('admin.pages.quiz.testlist.list',['data'=>$data,'category'=>$category]);
        }else{
            return false;
        }
    }
    public function getTestListEdit(Request $Request)
    {
        $QuizRepository = new QuizRepository();
        $data =  $QuizRepository->getTestListByID($Request->uniqid);
        return json_encode( $data);
    }
    public function postTestListEdit (TestlistRequest $request)
    {
        $QuizRepository = new QuizRepository();
        $result = $QuizRepository->editTestList($request);
        if($result){
            return json_encode (array('status'=>'success','msg'=>'Cập nhật thành công'));
        }else{
            return json_encode (array('status'=>'success','msg'=>'Cập nhật thất bại !'));
        }
    }
    public function postTestListAdd(TestlistRequest $request)
    {
        $QuizRepository = new QuizRepository();
        $result = $QuizRepository->addTestList($request);
        if($result){
            return json_encode (array('status'=>'success','msg'=>'Thêm thành công'));
        }else{
            return json_encode (array('status'=>'success','msg'=>'Thêm thất bại !'));
        }
    }
    public function postTestListDelete(Request $request)
    {
        $QuizRepository = new QuizRepository();
        $result = $QuizRepository->deleteTestList($request);
        if($result){
            return json_encode (array('status'=>'success','msg'=>'Xóa thành công'));
        }else{
            return json_encode (array('status'=>'success','msg'=>'Xóa thất bại !'));
        }
    }
    ///////////////////////////////////// Test Details ///////////////////////
    public function getTestDetail(Request $request,$uniqid)
    {
        $QuizRepository = new QuizRepository();
        $info =  $QuizRepository->getCategoryAndTestListByID($uniqid);
        if($info){
            $request['testlistID'] = $info->testlistID;
            $info->name = "{$info->name} - {$info->testlist_name}";
            // dd($info);
            SEOTools::setTitle($info->name);
            SEOTools::opengraph()->setUrl(\URL::current());
            $data =  $QuizRepository->getTestDetail($request);
            $countDetail = $QuizRepository->countDetais($request);
            return view('admin.pages.quiz.testdetail.list',['data'=>$data,'info'=>$info,'countDetail'=>$countDetail]);
        }else{
            return false;
        }
    }
    public function getTestDetailEdit(Request $Request)
    {
        $QuizRepository = new QuizRepository();
        $data =  $QuizRepository->getTestDetailByID($Request->uniqid);
        return json_encode( $data);
    }
    public function postTestDetailEdit (TestdetaiRequest $request)
    {
        $QuizRepository = new QuizRepository();
        $result = $QuizRepository->editTestDetail($request);
        if($result){
            return json_encode (array('status'=>'success','msg'=>'Cập nhật thành công'));
        }else{
            return json_encode (array('status'=>'success','msg'=>'Cập nhật thất bại !'));
        }
    }
    public function postTestDetailAdd(TestdetaiRequest $request)
    {
        $QuizRepository = new QuizRepository();
        $result = $QuizRepository->addTestDetail($request);
        if($result){
            return json_encode (array('status'=>'success','msg'=>'Thêm thành công'));
        }else{
            return json_encode (array('status'=>'success','msg'=>'Thêm thất bại !'));
        }
    }
    public function postTestDetailDelete(Request $request)
    {
        $QuizRepository = new QuizRepository();
        $result = $QuizRepository->deleteTestDetail($request);
        if($result){
            return json_encode (array('status'=>'success','msg'=>'Xóa thành công'));
        }else{
            return json_encode (array('status'=>'success','msg'=>'Xóa thất bại !'));
        }
    }
    public function postExportSample(Request $request)
    {
        $ExportImport = new ExportImport();
        return $ExportImport->export($request);
    }
    public function postImport(Request $request)
    {
        $ExportImport = new ExportImport();
        $rs =  $ExportImport->import($request);
        return json_encode($rs);
    }
}
