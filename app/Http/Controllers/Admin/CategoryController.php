<?php

namespace App\Http\Controllers\Admin;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Repositories\Categorys\CategorysRepository;
use App\Http\Requests\Admin\Category\ParentRequest;
use App\Http\Requests\Admin\Category\SubRequest;

class CategoryController extends Controller
{

    public function getParentCategpry(Request $request)
    {
        SEOTools::setTitle("Danh mục cha");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("admin.pages.category.parent-category");
    }
    public function getSubCategory(Request $request)
    {
        SEOTools::setTitle("Danh mục con");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("admin.pages.category.sub-categpry");
    }
    public function getParentDatatable(Request $request)
    {
        $CategorysRepository = new CategorysRepository();
        $result= $CategorysRepository->getParentDatatable($request);
        return json_encode($result);
    }
    public function getSubDatatable(Request $request)
    {
        $CategorysRepository = new CategorysRepository();
        $result= $CategorysRepository->getSubDatatable($request);
        return json_encode($result);
    }
    // Parent
    public function getParentEdit(Request $request)
    {
        $CategorysRepository = new CategorysRepository();
        $result= $CategorysRepository->getCategoryByID($request);
        return json_encode($result);
    }
    public function postParentEdit(ParentRequest $request)
    {
        $CategorysRepository = new CategorysRepository();
        $result= $CategorysRepository->editParentCategory($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Cập nhật thất bại !" ), 200);
        }

    }
    public function postParentAdd(ParentRequest $request)
    {
        $CategorysRepository = new CategorysRepository();
        $result= $CategorysRepository->addParentCategory($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Thêm thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Thêm thất bại !" ), 200);
        }

    }
    public function postParentDelete(Request $request)
    {
        $CategorysRepository = new CategorysRepository();
        $result= $CategorysRepository->deleteCategory($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Xóa thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Xóa thất bại !" ), 200);
        }
    }
    // Sub
    public function getSubEdit(Request $request)
    {
        $CategorysRepository = new CategorysRepository();
        $result= $CategorysRepository->getCategoryByID($request);
        return json_encode($result);
    }
    public function postSubEdit(SubRequest $request)
    {
        $CategorysRepository = new CategorysRepository();
        $result= $CategorysRepository->editSubCategory($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Cập nhật thất bại !" ), 200);
        }

    }
    public function postSubAdd(SubRequest $request)
    {
        $CategorysRepository = new CategorysRepository();
        $result= $CategorysRepository->addSubCategory($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Thêm thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Thêm thất bại !" ), 200);
        }

    }
    public function postSubDelete(Request $request)
    {
        $CategorysRepository = new CategorysRepository();
        $result= $CategorysRepository->deleteCategory($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Xóa thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Xóa thất bại !" ), 200);
        }
    }
}
