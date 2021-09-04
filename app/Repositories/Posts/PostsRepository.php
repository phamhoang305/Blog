<?php
namespace App\Repositories\Posts;

use App\Models\Follows;
use App\Repositories\EloquentRepository;
use App\Models\Posts;
use App\Models\Tags;
use App\Views\PostsView;
use App\Models\Categorys;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Image;
use DOMDocument;
use DB;
use voku\helper\HtmlDomParser;
use Illuminate\Support\Facades\Cache;
class PostsRepository  extends EloquentRepository
{

    protected $fillable =[
        'id',
        'uniqid',
        'thumbnail',
        'post_title',
        'post_slug',
        'post_view',
        'post_time',
        'created_at',
        'updated_at',
        'userID',
        'full_name',
        'username',
        'phone',
        'sex',
        'avatar',
        'email',
        'CountComments',
        'CountFollows',
        'CountFollowing',
        'categorysID',
        'cate_icon',
        'cate_name',
        'cate_slug',
        'cate_slug_parent'
    ];
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Posts::class;
    }
    public function Cacheforget()
    {
        Cache::forget('randomPosts');
        Cache::forget('getPostSlider');
        Cache::forget('sameCategory');
        Cache::forget('getTags');
    }
    public function sameCategory($cate_slug,$postID,$limit=5)
    {
        $sameCategory = Cache::remember("sameCategory",setting()->cache_seconds, function()use($cate_slug,$postID,$limit){
            return  PostsView::where('post_view_type','=','POST')
            ->where('post_approve','=',NULL)
            ->where('id','!=',$postID)
            ->where('cate_slug','=',$cate_slug)
            ->where('post_status','=','published')
            ->where('post_status_admin','=','published')
            ->where('post_trash','=',NULL)
            ->limit($limit)
            ->orderBy('created_at','desc')
            ->select($this->fillable)
            ->get();
        });
        return $sameCategory;
    }
    public function getPostViewTop($limit=5)
    {
        $getPostViewTop = Cache::remember("getPostViewTop",setting()->cache_seconds, function()use($limit){
            return  PostsView::where('post_view_type','=','POST')
                ->where('post_approve','=',NULL)
                ->where('post_status','=','published')
                ->where('post_status_admin','=','published')
                ->where('post_trash','=',NULL)
                ->limit($limit)
                ->select($this->fillable)
                ->orderBy('post_view','desc')
                ->get();
        });
        return $getPostViewTop;
    }
    public function randomPosts($limit =10)
    {
        $randomPosts = Cache::remember("randomPosts",setting()->cache_seconds, function() use ($limit){
            return PostsView::where('post_view_type','=','POST')
            ->where('post_status','=','published')
            ->where('post_status_admin','=','published')
            ->where('post_approve','=',NULL)
            ->where('post_trash','=',NULL)
            ->select($this->fillable)
            ->inRandomOrder()->take($limit)->get();
        });
        return $randomPosts;
    }
    public function getPostSlider($limit =10)
    {
        $getPostSlider = Cache::remember("getPostSlider",setting()->cache_seconds, function() use ($limit){
            return  PostsView::orderBy('id','desc')
            ->where('post_view_type','=','POST')
            ->where('post_status','=','published')
            ->where('post_status_admin','=','published')
            ->where('post_approve','=',NULL)
            ->where('post_trash','=',NULL)
            ->limit($limit)
            ->select($this->fillable)
            ->get();
        });
        return $getPostSlider;
    }
    public function getPostPageHome($request)
    {
            $result =  PostsView::orderBy('created_at','desc')
            ->where('post_view_type','=','POST')
            ->where('post_status','=','published')
            ->where('post_status_admin','=','published')
            ->where('post_approve','=',NULL)
            ->where('post_trash','=',NULL)
            ->select($this->fillable)
            ->paginate(setting()->post_page_number);
            return $result;
    }
    public function getPostByCategoryID($cate)
    {
        if($cate->cate_parentID==null){
            $catesID = Categorys::where('cate_parentID','=',$cate->id)->pluck('id')->toArray();
            if(count($catesID)>0){
                $result =  PostsView::whereIn('category_id',$catesID)
                ->where('post_view_type','=','POST')
                ->where('post_status','=','published')
                ->where('post_status_admin','=','published')
                ->where('post_approve','=',NULL)
                ->where('post_trash','=',NULL)
                ->orderBy('created_at','desc')
                ->select($this->fillable)
                ->paginate(setting()->post_page_number);
                return $result;
            }else{
                $result =  PostsView::where('category_id','=',$cate->id)
                ->where('post_view_type','=','POST')
                ->where('post_status','=','published')
                ->where('post_status_admin','=','published')
                ->where('post_approve','=',NULL)
                ->where('post_trash','=',NULL)
                ->orderBy('created_at','desc')
                ->select($this->fillable)
                ->paginate(setting()->post_page_number);
                return $result;
            }

        }else{
           $result =  PostsView::where('category_id','=',$cate->id)
            ->where('post_view_type','=','POST')
            ->where('post_status','=','published')
            ->where('post_status_admin','=','published')
            ->where('post_approve','=',NULL)
            ->where('post_trash','=',NULL)
            ->orderBy('created_at','desc')
            ->select($this->fillable)
            ->paginate(setting()->post_page_number);
            return $result;
        }
    }
    public function getTagsByPostID($postID)
    {
        $data =  Tags::where('postID','=',$postID)->pluck('tag')->toArray();
        if(is_array($data)&&count($data)>0){
            return implode(',',$data);
        }
        return "";
    }
    public function getPostSingleBySlug($post_slug)
    {
        $result =  PostsView::where('post_slug','=',$post_slug)
        ->where('post_status','=','published')
        ->where('post_status_admin','=','published')
        ->where('post_approve','=',NULL)
        ->where('post_trash','=',NULL)
        ->first();
        if($result){
            $result->post_content = setAttrDom($result->post_content);
            if(Auth::check()){
                $count = Follows::where('user_id','=',$result->userID)->where('follow_user_id','=',user()->id )->count();
                if($count>0){
                    $result->user_id=$count;
                }else{
                    $result->user_id=NULL ;
                }
            }
            $this->updatePostView($result->id);
        }
        return $result;
    }
    public function getPostByUsername($username)
    {
        $result =  PostsView::where('post_status','=','published')
        ->where('post_approve','=',NULL)
        ->where('username','=',$username)
        ->orderBy('created_at','desc')
        ->select($this->fillable)
        ->paginate(setting()->post_page_number);
        return $result;
    }
    public function getPostByUserLogin($request)
    {
        $where = array(
            ['post_view_type','=','POST']
        );
        if($request->type=='approve'){
            $where[]=['post_approve','=',$request->type];
        }else{
            $where[]=['post_status','=',$request->type];
            $where[]=['post_approve','=',NULL];
        }
        if(isset($request->trash)){
            if($request->type=='approve'){
                unset($where[1]);
            }else{
                unset($where[1]);
                unset($where[2]);
            }
            $where[]=['post_trash','!=',NULL];
        }else{
            $where[]=['post_trash','=',NULL];
        }
        $where[]=['user_id','=',user()->id];
        if(isset($request->c)&&!empty($request->c)){
            $cate =  Categorys::where('id','=',$request->c)->first();
            $whereIn = array();
            if($cate->cate_parentID==null){
                $catesID = Categorys::where('cate_parentID','=',$cate->id)->pluck('id')->toArray();
                if(count($catesID)>0){
                    $whereIn = $catesID;
                }else{
                    $whereIn[]=$request->c;
                }
            }else{
                $whereIn[]=$request->c;
            }
            // dd($whereIn);
            if(!empty($request->q)){
                $search = $request->q;
                $result =  PostsView::where($where)
                ->whereIn('category_id',$whereIn)
                ->Where(function($query)use($search){
                    $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('post_title', 'LIKE',"%{$search}%")
                    ->orWhere('cate_name', 'LIKE',"%{$search}%")
                    ->orWhere('email', 'LIKE',"%{$search}%")
                    ->orWhere('username','LIKE',"%{$search}%")
                    ->orWhere('full_name','LIKE',"%{$search}%");
                })
                ->orderBy('created_at','desc')
                ->select($this->fillable)
                ->paginate(setting()->post_page_number);
            }else{
                $result =  PostsView::where($where)
                ->whereIn('category_id',$whereIn)
                ->orderBy('created_at','desc')
                ->paginate(setting()->post_page_number);
            }
        }else{
            if(!empty($request->q)){
                $search = $request->q;
                $result =  PostsView::where($where)
                ->Where(function($query)use($search){
                    $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('post_title', 'LIKE',"%{$search}%")
                    ->orWhere('cate_name', 'LIKE',"%{$search}%")
                    ->orWhere('email', 'LIKE',"%{$search}%")
                    ->orWhere('username','LIKE',"%{$search}%")
                    ->orWhere('full_name','LIKE',"%{$search}%");
                })
                ->orderBy('created_at','desc')
                ->select($this->fillable)
                ->paginate(setting()->post_page_number);
            }else{
                $result =  PostsView::where($where)
                ->orderBy('created_at','desc')
                ->select($this->fillable)
                ->paginate(setting()->post_page_number);
            }
        }
        // dd($result);
        return $result;
    }
    public function getPostByAdmin($request)
    {
        $where = array( ['post_view_type','=','POST']);
        if($request->type=='approve'){
            $where[]=['post_approve','=',$request->type];
        }else{
            $where[]=['post_status_admin','=',$request->type];
            $where[]=['post_approve','=',NULL];
        }
        if(isset($request->trash)){
            if($request->type=='approve'){
                unset($where[1]);
            }else{
                unset($where[1]);
                unset($where[2]);
            }
            $where[]=['post_trash_admin','!=',NULL];
        }else{
            $where[]=['post_trash_admin','=',NULL];
        }
        // dd($where);
        if(isset($request->c)&&!empty($request->c)){
            $cate =  Categorys::where('id','=',$request->c)->first();
            $whereIn = array();
            if($cate->cate_parentID==null){
                $catesID = Categorys::where('cate_parentID','=',$cate->id)->pluck('id')->toArray();
                if(count($catesID)>0){
                    $whereIn = $catesID;
                }else{
                    $whereIn[]=$request->c;
                }
            }else{
                $whereIn[]=$request->c;
            }
            // dd($whereIn);
            if(!empty($request->q)){
                $search = $request->q;
                $result =  PostsView::where($where)
                ->whereIn('category_id',$whereIn)
                ->Where(function($query)use($search){
                    $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('post_title', 'LIKE',"%{$search}%")
                    ->orWhere('cate_name', 'LIKE',"%{$search}%")
                    ->orWhere('email', 'LIKE',"%{$search}%")
                    ->orWhere('username','LIKE',"%{$search}%")
                    ->orWhere('full_name','LIKE',"%{$search}%");
                })
                ->orderBy('created_at','desc')
                ->select($this->fillable)
                ->paginate(setting()->post_page_number);
            }else{
                $result =  PostsView::where($where)
                ->whereIn('category_id',$whereIn)
                ->orderBy('created_at','desc')
                ->paginate(setting()->post_page_number);
            }
        }else{
            if(!empty($request->q)){
                $search = $request->q;
                $result =  PostsView::where($where)
                ->Where(function($query)use($search){
                    $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('post_title', 'LIKE',"%{$search}%")
                    ->orWhere('cate_name', 'LIKE',"%{$search}%")
                    ->orWhere('email', 'LIKE',"%{$search}%")
                    ->orWhere('username','LIKE',"%{$search}%")
                    ->orWhere('full_name','LIKE',"%{$search}%");
                })
                ->orderBy('created_at','desc')
                ->select($this->fillable)
                ->paginate(setting()->post_page_number);
            }else{
                $result =  PostsView::where($where)
                ->orderBy('created_at','desc')
                ->select($this->fillable)
                ->paginate(setting()->post_page_number);
            }
        }
        // dd($result);
        return $result;
    }
    public function getPostByID($request)
    {
        if(isset($request->showData)&&$request->showData=='myContent'){
            $result =  PostsView::where('uniqid','=',$request->uniqid)->where('user_id','=',user()->id)->first();
        }else{
            $result =  PostsView::where('uniqid','=',$request->uniqid)->first();
        }
        return $result;
    }
    public function updatePost($request)
    {
        if(isset($request->showData)&&$request->showData=='myContent'){
            $post =  Posts::where('uniqid','=',$request->uniqid)->where('user_id','=',user()->id)->first();
        }else{
            $post =  Posts::where('uniqid','=',$request->uniqid)->first();
        }
        if(!$post)return false;
        $post->post_title = $request->post_title;
        $category_id = $request->category_id;
        if($request->category_sub_id!=""){
            $category_id =  $request->category_sub_id;
        }
        $path = $this->uploadImage($request,'update');
        if($path->thumbnail){
            $post->thumbnail = $path->thumbnail;
        }
        $post->category_id = $category_id;
        $post->post_slug = $this->getSlug($request,'update');
        if(isset($request->showData)&&$request->showData=='myContent'){
            $post->post_status = $request->post_status;
            if((user()->type=='userAdminDefault'||user()->type=='userAdminCreate')){
                $post->post_status_admin = $request->post_status;
            }
        }else{
            if((user()->type=='userAdminDefault'||user()->type=='userAdminCreate')){
                $post->post_status_admin = $request->post_status;
            }
            $post->post_status = $request->post_status;
            if($request->approve==true){
                $post->post_approve = NULL;
            }else{
                $post->post_approve = 'approve';
            }
        }
        $post->post_des = $request->post_des;
        $post->post_keywords = $request->post_keywords;
        $post->editor = $request->editor;
        if (!empty($request->post_password)) {
            $post->post_password = $request->post_password;
        }
        $post->save();
        if($post){
            $request['user_id']= $post->user_id;
            $request['uniqid']= $post->uniqid;
            $this->uploadImageContent($request,'update');
            $this->actionTags($request,'update');
            if($request->status_notice_userFollow=='on'){
                $this->sendMail($post->id);
            }
            $this->Cacheforget();
            return true;
        }return false;
    }
    public function insertPost($request)
    {
        $uniqid = uniqid().uniqid();
        $post = new Posts();
        $post->uniqid=$uniqid;
        $post->user_id = user()->id;
        $post->post_title = $request->post_title;
        $category_id = $request->category_id;
        if($request->category_sub_id!=""){
            $category_id =  $request->category_sub_id;
        }
        $path = $this->uploadImage($request,'insert');
        if($path->thumbnail){
            $post->thumbnail = $path->thumbnail;
        }
        $post->category_id = $category_id;
        $post->post_slug = $this->getSlug($request,'insert');

        $post->post_des = $request->post_des;
        $post->post_keywords = $request->post_keywords;
        $post->editor = $request->editor;
        $post->post_time = time();
        if(isset($request->showData)&&$request->showData=='myContent'){
            $post->post_status = $request->post_status;
            if((user()->type=='userAdminDefault'||user()->type=='userAdminCreate')){
                $post->post_status_admin = $request->post_status;
            }
        }else{
            if((user()->type=='userAdminDefault'||user()->type=='userAdminCreate')){
                $post->post_status_admin = $request->post_status;
            }
            $post->post_status = $request->post_status;
        }
        if(user()->status_approve=='on'){
            $post->post_approve = 'approve';
        }else{
            $post->post_approve = NULL;
        }
        if (!empty($request->post_password)) {
            $post->post_password = $request->post_password;
        }
        $post->save();
        if($post){
            $request['id']= $post->id;
            $request['user_id']= $post->user_id;
            $request['uniqid']= $post->uniqid;
            $this->actionTags($request,'insert');
            $this->uploadImageContent($request,'insert');
            if($request->status_notice_userFollow=='on'){
                if($post->post_approve!='approve'){
                    $this->sendMail($post->id);
                }
            }
            if($post->post_approve=='approve'){
                $this->sendMailApprove($post->id);
            }
            $this->Cacheforget();
            return true;
        }return false;
    }
    public function sendMail($id)
    {
        configMail();
        if(count(getMailFollows())>0){
            $result =  PostsView::where('id','=',$id)->first();
            if($result){
                if($result->cate_slug_parent!=""||$result->cate_slug_parent!=null){
                    $url = route('web.posts.index',[$result->cate_slug_parent,$result->cate_slug,$result->post_slug]);
                }else{
                    $url = route('web.posts.index',[$result->cate_slug,$result->post_slug]);
                }
                $rs =  _sendMail([
                    "template"=>"vendor.mail.noti-post",
                    "data"=>['url'=>$url,'post_title'=>$result->post_title],
                    "mailSend"=>getMailFollows(),
                    "subject"=>"BÀI VIẾT MỚI"
                ]);
            }
        }
    }
    public function sendMailApprove($id)
    {
        configMail();
        $result =  PostsView::where('id','=',$id)->first();
        if($result){
            if($result->cate_slug_parent!=""||$result->cate_slug_parent!=null){
                $url = route('web.posts.index',[$result->cate_slug_parent,$result->cate_slug,$result->post_slug]);
            }else{
                $url = route('web.posts.index',[$result->cate_slug,$result->post_slug]);
            }
            $rs =  _sendMail([
                "template"=>"vendor.mail.noti-post",
                "data"=>['url'=>$url,'post_title'=>$result->post_title],
                "mailSend"=>[setting()->MAIL_RECEIVE],
                "subject"=>"YÊU CẦU PHÊ DUYỆT"
            ]);
        }
    }
    public function removeImage($request)
    {
        $result =  Posts::where('uniqid','=',$request->uniqid)->first();
        if (\File::exists(public_path(($result->thumbnail)))) {
            \File::delete(public_path(($result->thumbnail)));
        }
    }
    public function uploadImage($request,$type)
    {
        $row = new \stdClass;
        $thumbnails  = "/uploads/thumbnails/max";
        $file      = $request->file('file_post_image');
        if($type=='insert'){
            if ($file) {
                $extension = $file->getClientOriginalExtension();
                $picture   = date('d-m-Y')."-".time()."-".uniqid().'.'.$extension;
                $file->move(public_path($thumbnails),$picture);
                $row->thumbnail ="{$thumbnails}/{$picture}";
                return  $row;
            }
            $row->thumbnail =false;
            return $row;
        }else{
            if($request->is_delete.''=='1'){
                $this->removeImage($request);
            }
            if ($file) {
                $this->removeImage($request);
                $extension = $file->getClientOriginalExtension();
                $picture   = date('d-m-Y')."-".time()."-".uniqid().'.'.$extension;
                $file->move(public_path($thumbnails),$picture);
                $row->thumbnail ="{$thumbnails}/{$picture}";
                return  $row;
            }
            $row->thumbnail =false;
            return $row;
        }
        $row->thumbnail =false;
        return $row;
    }
    public function uploadImageContent($request,$type)
    {
        $uniqid = $request->uniqid;
        $FOLDER  = "/uploads/contents/{$uniqid}";
        $post_content= $request->post_content;
        $dom = HtmlDomParser::str_get_html($post_content);
        $images = $dom->getElementsByTagName('img');
        $arrayImage = [];
        if($type=='insert'){
            \File::makeDirectory(public_path($FOLDER));
        }else{
            if(!\File::exists(public_path($FOLDER))){
                \File::makeDirectory(public_path($FOLDER));
            }
        }
        foreach($images as $img){
            $src = $img->getAttribute('src');
            if(preg_match('/data:image/', $src)){
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $extension = $groups['mime'];
                $filename = date('d-m-Y')."-".time()."-".uniqid().'.'.$extension;
                $filepath = "{$FOLDER}/$filename";
                Image::make($src)->save(public_path($filepath));
                $new_src = ($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $arrayImage[] = $filename;
            }else{
                if($src!=""){
                    $src = explode("/",$src);
                    $srcIndex = count($src);
                    $arrayImage[]=$src[$srcIndex-1];
                }
            }
        }
        $this->removeFileImageContent($FOLDER,collect($arrayImage));
        $post =  Posts::where('uniqid','=',$request->uniqid)->first();
        $post->post_content = $dom->save();
        $post->save();
    }
    public function removeFileImageContent($FOLDER,$arrayImage)
    {
        $path = public_path($FOLDER);
        $files = \File::allFiles($path);
        foreach($files as $item){
            if($arrayImage->contains($item->getFileName())==false){
                \File::delete(($item->getPathname()));
            }
        }
    }
    public function getPostDefault()
    {
        $result = new PostsView();
        $result->cate_icon = "/uploads/defaults/error-search.png";
        $result->post_title = "Yêu cầu của bạn không được tìm thấy !";
        return $result;
    }
    public function getSlug($request,$type)
    {
        if($type=='update'){
            $slug = SlugService::createSlug(Posts::class, 'post_slug', $request->post_title,['unique' => false]);
            $count = Posts::where('post_slug','=',$slug)->where('uniqid','!=',$request->uniqid)->count();
            if($count>0){
                return SlugService::createSlug(Posts::class, 'post_slug', $request->post_title,['unique' => true]);
            }
            return false;
        }else{
            return SlugService::createSlug(Posts::class, 'post_slug', $request->post_title,['unique' => true]);
        }
    }
    public function lockPost($request)
    {
        $uniqids = json_decode($request->uniqids);
        $arrayUpdate = array();
        $result =null;
        foreach($uniqids as $uniqid){
            if(isset($request->showData)&&$request->showData=='myContent'){
                $arrayUpdate['post_status']='lock';
            }else{
                $arrayUpdate['post_status']='lock';
                $arrayUpdate['post_status_admin']='lock';
            }
            $result =  Posts::where('uniqid','=',$uniqid)->update($arrayUpdate);
        }
        if($result){
            return true;
        }return false;

    }
    public function unLockPost($request)
    {
        $uniqids = json_decode($request->uniqids);
        $arrayUpdate = array();
        $result =null;
        foreach($uniqids as $uniqid){
            if(isset($request->showData)&&$request->showData=='myContent'){
                $arrayUpdate['post_status']='published';
            }else{
                $arrayUpdate['post_trash']=NULL;
                $arrayUpdate['post_status']='published';
                $arrayUpdate['post_status_admin']='published';
            }
            $result =  Posts::where('uniqid','=',$uniqid)->update($arrayUpdate);
        }
        if($result){
            return true;
        }return false;
    }
    public function trashPost($request)
    {
        $uniqids = json_decode($request->uniqids);
        $arrayUpdate = array();
        $result =null;
        foreach($uniqids as $uniqid){
            if(isset($request->showData)&&$request->showData=='myContent'){
                $arrayUpdate['post_trash']=time();
            }else{
                $arrayUpdate['post_trash']=time();
                $arrayUpdate['post_trash_admin']=time();
            }
            $result =  Posts::where('uniqid','=',$uniqid)->update($arrayUpdate);
        }
        if($result){
            return true;
        }return false;
    }
    public function restorePost($request)
    {
        $uniqids = json_decode($request->uniqids);
        $arrayUpdate = array();
        $result =null;
        foreach($uniqids as $uniqid){
            if(isset($request->showData)&&$request->showData=='myContent'){
                $arrayUpdate['post_trash']=NULL;
            }else{
                $arrayUpdate['post_trash']=NULL;
                $arrayUpdate['post_trash_admin']=NULL;
            }
            $result =  Posts::where('uniqid','=',$uniqid)->update($arrayUpdate);
        }
        if($result){
            return true;
        }return false;
    }
    public function deletePost($request)
    {
        $uniqids = json_decode($request->uniqids);
        $arrayUpdate = array();
        $result =null;
        foreach($uniqids as $uniqid){
            if(isset($request->showData)&&$request->showData=='myContent'){
                $arrayUpdate['post_trash']=NULL;
            }else{
                $arrayUpdate['post_trash']=NULL;
                $arrayUpdate['post_trash_admin']=NULL;
            }
            $post =  Posts::where('uniqid','=',$uniqid)->first();
            Tags::where('postID','=',$post->id)->delete();
            if($post){
                if(\File::exists(public_path($post->thumbnail))){
                    \File::delete(public_path($post->thumbnail));
                }
                if(\File::exists(public_path("/uploads/contents/".$post->uniqid))){
                    \File::deleteDirectory(public_path("/uploads/contents/".$post->uniqid));
                }
            }
            $result = $post->delete();
        }
        $this->Cacheforget();
        if($result){
            return true;
        }return false;
    }
    public function updatePostView($postID)
    {
        $Post = Posts::find($postID);
        $Post->post_view = $Post->post_view+1;
        if($Post->save())return true;
        return false;
    }
    public function actionTags($request,$type)
    {
       if($type=='update'){
           Tags::where('postID','=',$request->id)->delete();
           $tags = array();
           if($request->tags!=""){
               $tags = json_decode($request->tags);
           }
           $rows=array();
           if(is_array($tags)&&count($tags)>0){
               foreach($tags as $tag)
                $rows[]=['postID'=>$request->id,'tag'=>mb_strtoupper(trim($tag), "UTF-8") ,'tag_slug'=>to_slug($tag)];
           }
           if(count($rows)>0){
               Tags::insert($rows);
           }
       }else{
            $tags = array();
            if($request->tags!=""){
                $tags = json_decode($request->tags);
            }
            $rows=array();
            if(is_array($tags)&&count($tags)>0){
                foreach($tags as $tag)
                $rows[]=['postID'=>$request->id,'tag'=>mb_strtoupper(trim($tag), "UTF-8") ,'tag_slug'=>to_slug($tag)];
            }
            if(count($rows)>0){
                Tags::insert($rows);
            }
       }
    }
    public function getTagBySlug($request)
    {

        $tag = Tags::where('tag_slug','=',$request->tag_slug)->first();
        if($tag)return $tag;
        return false;
    }
    public function getPostByTagSlug($request)
    {
        $select = array();
        foreach($this->fillable as $sl){
            $select[]="view_posts.$sl";
        }
        $select[]="tags.id as tagID";
        // dd($select);
        $posts = PostsView::join('tags','tags.postID','=','view_posts.id')
        ->where('tags.tag_slug','=',$request->tag_slug)
        ->orderBy('view_posts.created_at','desc')
        ->select($select)
        ->paginate(setting()->post_page_number);
        if($posts)return $posts;
        return false;
    }
    public function getSearchPost($request)
    {
        $search = $request->q;
        if($search!=""){
            $posts = PostsView::Where(function($query)use($search){
                $query->where('view_posts.id', 'LIKE', "%{$search}%")
                ->orWhere('view_posts.post_title', 'LIKE',"%{$search}%")
                ->orWhere('view_posts.cate_name', 'LIKE',"%{$search}%")
                ->orWhere('view_posts.email', 'LIKE',"%{$search}%")
                ->orWhere('view_posts.username','LIKE',"%{$search}%")
                ->orWhere('view_posts.full_name','LIKE',"%{$search}%");
            })
            ->where('post_status','=','published')
            ->where('post_status_admin','=','published')
            ->orderBy('view_posts.created_at','desc')
            ->select($this->fillable)
            ->paginate(setting()->post_page_number);
            $posts->withPath(\URL::current()."?q=$request->q");
            return $posts;
        }else{
            return [];
        }

    }
}
