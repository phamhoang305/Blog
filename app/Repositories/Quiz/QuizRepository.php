<?php
namespace App\Repositories\Quiz;

use App\Repositories\EloquentRepository;
use App\Models\Testcategory;
use App\Models\Testlist;
use App\Models\Testdetail;
use App\Models\Testresult;
use Auth;
use Cviebrock\EloquentSluggable\Services\SlugService;
use stdClass;

class QuizRepository extends EloquentRepository
{

    public function getModel()
    {
        return Testcategory::class;
    }
    public function getTestCategory($request)
    {
        $where[]=['id','!=',null];
         if(isset($request->status)){
            $where[]=['status','=',0];
        }
        if(!empty($request->q)){
            $search = $request->q;
            $result =  Testcategory::where($where)
            ->Where(function($query)use($search){
                $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE',"%{$search}%")
                ->orWhere('slug', 'LIKE',"%{$search}%")
                ->orWhere('created_at', 'LIKE',"%{$search}%");
            })
            ->orderBy('created_at','desc')
            ->sortable()
            ->paginate(10);
            return $result;
        }else{
            $result =  Testcategory::where($where)
            ->orderBy('created_at','desc')
            ->sortable()
            ->paginate(10);
            return $result;
        }

    }
    public function getTestCategoryByID($uniqid)
    {
        return Testcategory::where('uniqid','=',$uniqid)->first();
    }
    public function getCategoryAndTestListByID($uniqid)
    {
        return Testcategory::join('test_lists','test_lists.test_categoryID','=','test_categorys.id')
        ->where('test_lists.uniqid','=',$uniqid)
        ->select(
            'test_categorys.*',
            'test_lists.id as testlistID',
            'test_lists.test_categoryID',
            'test_lists.uniqid as testlist_uniqid',
            'test_lists.testlist_name',
            'test_lists.testlist_des',
            'test_lists.testlist_minutes'
        )
        ->first();
    }
    public function editTestCategory($request)
    {
        $Testcategory =  Testcategory::where('uniqid','=',$request->uniqid)->first();
        $Testcategory->name = $request->name;
        $Testcategory->des = $request->des;
        $Testcategory->order = $request->order;
        $Testcategory->status =$request->status;
        if($Testcategory->save()) return true;
        return false;
    }
    public function addTestCategory($request)
    {
        $Testcategory = new  Testcategory();
        $Testcategory->uniqid =uniqid();
        $Testcategory->name = $request->name;
        $Testcategory->des = $request->des;
        $Testcategory->order = $request->order;
        $Testcategory->status =$request->status;
        if($Testcategory->save()) return true;
        return false;
    }
    public function deleteTestCategory($request)
    {
        $Testcategory =  Testcategory::where('uniqid','=',$request->uniqid)->first();
        if($Testcategory->delete()) return true;
        return false;
    }
    //////////////////////////////////////////////Test list////////////////////////////////////////////////////////////
    public function getTestList($request)
    {
        $where[]=['id','!=',null];
         if(isset($request->status)){
            $where[]=['testlist_status','=',0];
        }
        // dd($where);
        if(!empty($request->q)){
            $search = $request->q;
            $result =  Testlist::where('test_categoryID','=',$request->test_categoryID)
                ->where($where)
                ->Where(function($query)use($search){
                $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('testlist_name', 'LIKE',"%{$search}%")
                ->orWhere('testlist_des', 'LIKE',"%{$search}%")
                ->orWhere('created_at', 'LIKE',"%{$search}%");
            })
            ->orderBy('testlist_order','asc')
            ->sortable()
            ->paginate(10);
            return $result;
        }else{
            $result =  Testlist::where('test_categoryID','=',$request->test_categoryID)
            ->where($where)
            ->orderBy('testlist_order','asc')
            ->sortable()
            ->paginate(10);
            // dd($result);
            return $result;
        }

    }
    public function getTestListByID($uniqid)
    {
        return Testlist::where('uniqid','=',$uniqid)->first();
    }
    public function editTestList($request)
    {
        $Testlist =  Testlist::where('uniqid','=',$request->uniqid)->first();
        $Testlist->testlist_name = $request->testlist_name;
        $Testlist->testlist_des = $request->testlist_des;
        $Testlist->testlist_order = $request->testlist_order;
        $Testlist->testlist_status =$request->testlist_status;
        $Testlist->testlist_minutes = $request->testlist_minutes;
        if($Testlist->save()) return true;
        return false;
    }
    public function addTestList($request)
    {
        $Testlist = new  Testlist();
        $Testlist->uniqid =uniqid();
        $Testlist->test_categoryID = $request->test_categoryID;
        $Testlist->testlist_name = $request->testlist_name;
        $Testlist->testlist_des = $request->testlist_des;
        $Testlist->testlist_order = $request->testlist_order;
        $Testlist->testlist_status =$request->testlist_status;
        $Testlist->testlist_minutes = $request->testlist_minutes;
        if($Testlist->save()) return true;
        return false;
    }
    public function deleteTestList($request)
    {
        $Testlist =  Testlist::where('uniqid','=',$request->uniqid)->first();
        if($Testlist->delete()) return true;
        return false;
    }
    ////////////////////////////////////////// getTestDetail /////////////////////////////////
    public function countDetais($request)
    {
        $where[]=['id','!=',null];
        return Testdetail::where('test_listID','=',$request->testlistID)
        ->where($where)->count();
    }
    public function getTestDetail($request)
    {
        $where[]=['id','!=',null];
         if(isset($request->status)){
            $where[]=['status','=',0];
        }
        if(!empty($request->q)){
            $search = $request->q;
            $result =  Testdetail::where('test_listID','=',$request->testlistID)
                ->where($where)
                ->Where(function($query)use($search){
                $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('title', 'LIKE',"%{$search}%")
                ->orWhere('created_at', 'LIKE',"%{$search}%");
            })
            ->orderBy('created_at','desc')
            ->sortable()
            ->paginate(10);
            return $result;
        }else{
            $result =  Testdetail::where('test_listID','=',$request->testlistID)
            ->where($where)
            ->orderBy('created_at','desc')
            ->sortable()
            ->paginate(10);
            return $result;
        }
    }
    public function getTestDetailClient($uniqid)
    {
        // dd($uniqid);
        $result =  Testdetail::where('test_listID','=',$uniqid)
            ->orderBy('created_at','desc')
            ->sortable()
            ->select('id','uniqid','test_listID','title','note','item')
            ->get();
        return $result;
    }
    public function getTestDetailByID($uniqid)
    {
        $item = Testdetail::where('uniqid','=',$uniqid)->first();
        $item->item = json_decode($item->item);
        return $item;
    }
    public function editTestDetail($request)
    {
        $Testdetail =  Testdetail::where('uniqid','=',$request->uniqid)->first();
        $Testdetail->title = $request->title;
        $Testdetail->note = $request->note;
        $Testdetail->item = $request->item;
        $Testdetail->status =$request->status;
        $Testdetail->check_uniqid =$request->check_uniqid;
        if($Testdetail->save()) return true;
        return false;
    }
    public function addTestDetail($request)
    {
        $Testdetail = new  Testdetail();
        $Testdetail->uniqid =uniqid();
        $Testdetail->test_listID = $request->test_listID;
        $Testdetail->title = $request->title;
        $Testdetail->note = $request->note;
        $Testdetail->item = $request->item;
        $Testdetail->status =$request->status;
        $Testdetail->check_uniqid =$request->check_uniqid;
        if($Testdetail->save()) return true;
        return false;
    }
    public function deleteTestDetail($request)
    {
        $Testdetail =  Testdetail::where('uniqid','=',$request->uniqid)->first();
        if($Testdetail->delete()) return true;
        return false;
    }
    public function saveDataTest($request)
    {
        $result_test = collect(json_decode($request->result_test));
        $error_number = 0;
        $true_number = 0;
        $nocheck_number = 0;
        // dd($result_test);
        foreach($result_test as $item){
            $Testdetail =  Testdetail::where('uniqid','=',$item->parentID)->first();
            if($item->childID==""){
                $nocheck_number =$nocheck_number+1;
            }else if($item->childID==$Testdetail->check_uniqid){
                $true_number =$true_number+1;
            }else{
                $error_number =$error_number+1;
            }
        }
        $Testresult = new Testresult();
        $Testresult->userID = Auth::user()->id;
        $Testresult->results_uniqid = uniqid();
        $Testresult->test_listID = $request->test_listID;
        $Testresult->result_test = $request->result_test;
        $Testresult->error_number = $error_number;
        $Testresult->true_number = $true_number;
        $Testresult->nocheck_number = $nocheck_number;
        $Testresult->save();
        return $Testresult;
    }
    public function getTestResultByID_TestList($request)
    {
        if(!empty($request->q)){
            $search = $request->q;
            $result =  Testresult::join('users','users.id','=','test_results.userID')
            ->where('test_results.test_listID','=',$request->testlistID)
            ->Where(function($query)use($search){
                    $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('users.full_name', 'LIKE',"%{$search}%")
                    ->orWhere('test_results.true_number', 'LIKE',"%{$search}%")
                    ->orWhere('test_results.error_number', 'LIKE',"%{$search}%")
                    ->orWhere('test_results.nocheck_number', 'LIKE',"%{$search}%")
                    ->orWhere('test_results.created_at', 'LIKE',"%{$search}%");
            })
            ->orderBy('created_at','desc')
            ->select(
                'users.full_name',
                'test_results.true_number',
                'test_results.error_number',
                'test_results.nocheck_number',
                'test_results.created_at'
            )
             // ->sortable()
            ->paginate(10);
            return $result;
        }else{
            $result =  Testresult::join('users','users.id','=','test_results.userID')
            ->where('test_listID','=',$request->testlistID)
            ->orderBy('created_at','desc')
            ->select(
                'users.full_name',
                'test_results.true_number',
                'test_results.error_number',
                'test_results.nocheck_number',
                'test_results.created_at'
            )
            // ->sortable()
            ->paginate(10);
            return $result;
        }
    }
    public function getHistoryTest($request)
    {
        if(!empty($request->q)){
            $search = $request->q;
            $result =  Testresult::join('test_lists','test_lists.id','=','test_results.test_listID')
            ->join('test_categorys','test_categorys.id','=','test_lists.test_categoryID')
            ->join('users','users.id','=','test_results.userID')
            ->where('users.id','=',Auth::user()->id)
            ->Where(function($query)use($search){
                    $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('users.full_name', 'LIKE',"%{$search}%")
                    ->orWhere('test_results.true_number', 'LIKE',"%{$search}%")
                    ->orWhere('test_results.error_number', 'LIKE',"%{$search}%")
                    ->orWhere('test_results.nocheck_number', 'LIKE',"%{$search}%")
                    ->orWhere('test_results.created_at', 'LIKE',"%{$search}%");
            })
            ->orderBy('test_results.id','desc')
            ->select(
                'test_categorys.name',
                'test_categorys.uniqid as category_uniqid',
                'test_lists.testlist_name',
                'test_lists.uniqid as testlist_uniqid',
                'users.full_name',
                'test_results.true_number',
                'test_results.error_number',
                'test_results.nocheck_number',
                'test_results.created_at',
                'test_results.id',
                'test_results.results_uniqid'
            )
             // ->sortable()
            ->paginate(10);
            return $result;
        }else{
            $result =  Testresult::join('test_lists','test_lists.id','=','test_results.test_listID')
            ->join('test_categorys','test_categorys.id','=','test_lists.test_categoryID')
            ->join('users','users.id','=','test_results.userID')
            ->where('users.id','=',Auth::user()->id)
            ->orderBy('test_results.id','desc')
            ->select(
                'test_categorys.name',
                'test_categorys.uniqid as category_uniqid',
                'test_lists.testlist_name',
                'test_lists.uniqid as testlist_uniqid',
                'users.full_name',
                'test_results.true_number',
                'test_results.error_number',
                'test_results.nocheck_number',
                'test_results.created_at',
                'test_results.id',
                'test_results.results_uniqid'
            )
            // ->sortable()
            ->paginate(10);
            return $result;
        }
    }
    public function getResulDetail($request)
    {
        $Testresult =  Testresult::join('test_lists','test_lists.id','=','test_results.test_listID')
        ->join('test_categorys','test_categorys.id','=','test_lists.test_categoryID')
        ->join('users','users.id','=','test_results.userID')
        ->where('test_results.results_uniqid','=',$request->uniqid)
        ->select(
            'test_categorys.name as category_name',
            'test_categorys.uniqid as category_uniqid',
            'test_lists.testlist_name',
            'test_lists.testlist_des',
            'test_lists.id as testlistID',
            'test_lists.uniqid as testlist_uniqid',
            'users.full_name','test_results.*'
        )->first();
        $result_test =  json_decode($Testresult->result_test);
        $Testdetail =  Testdetail::where('test_listID','=',$Testresult->test_listID)->get();
        $results = array();
        foreach($Testdetail as $item){
            foreach($result_test as $check){
                if($item->uniqid==$check->parentID){
                    $item->check = "";
                    $item->status = "";
                    if($check->childID==""){
                        $item->status = "Bỏ";
                    }else if($item->uniqid==$check->parentID){
                        $item->check = $check->childID;
                        if($item->check_uniqid==$check->childID){
                            $item->status = "Đúng";
                        }else{
                            $item->status = "Sai";
                        }

                    }else{
                        $item->status = "Sai";
                    }
                }
            }
            $results[]=$item;
        }

        $data = new \stdClass;
        $data->category_name =  $Testresult->category_name;
        $data->category_uniqid =  $Testresult->category_uniqid;
        $data->testlistID =  $Testresult->testlistID;
        $data->testlist_des =  $Testresult->testlist_des;
        $data->testlist_name =  $Testresult->testlist_name;
        $data->testlist_uniqid =  $Testresult->testlist_uniqid;
        $data->true_number =  $Testresult->true_number;
        $data->error_number =  $Testresult->error_number;
        $data->nocheck_number =  $Testresult->nocheck_number;
        $data->results = $results;
        return $data;
    }
}
