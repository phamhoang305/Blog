<?php
namespace App\Repositories\Users;

use App\Repositories\EloquentRepository;
use App\Models\Users;
use App\Models\Follows;
use App\User;
use App\Views\UsersView;
use DB;
use Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
class UsersRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Users::class;
    }
    public function getInfoUserByID($id)
    {
       return UsersView::where('id','=',$id)->first();
    }
    public function _insert($data)
    {
        $users = new Users();
        $users->full_name = $data->full_name;
        $users->phone = $data->phone;
        if(!empty($data->password)){
            $users->password = bcrypt($data->password);
        }else{
            $users->password = bcrypt("123456");
        }
        $result = $users->save();
        if($result) return true;
        return false;
    }
    public function getTopAuthors($request=null,$limit=10)
    {
        if($request!=null){
            $page = intval($request->get('page', 1));
        }else{
            $page =1;
        }
        $size = $limit;
        $offset= 0;
        if($page>=2){
            $offset = ($page * $size) - $size;
        }
        $data =    \DB::select(sqlInfoUser($offset,$size));
        $collect = collect($data);
        $dataPaginator = new LengthAwarePaginator(
            $collect,
            UsersView::count(),
            $size
        );
        $dataPaginator->withPath(route('web.author.index'));
        return $dataPaginator;

    }
    public function getAuthByUsername($username)
    {
        $UsersView = UsersView::where('username','=',$username)->first();
        // dd($UsersView);
        if($UsersView){
            $UsersView->CountFollows==null?0:$UsersView->CountFollows;
            $UsersView->CountFollowing==null?0:$UsersView->CountFollowing;
            $UsersView->CountPosts==null?0:$UsersView->CountPosts;
            return $UsersView;
        }else{
            return null ;
        }


    }
    public function getAuthInfo()
    {
        $UsersView = UsersView::find(user()->id);
        $UsersView->CountFollows==null?0:$UsersView->CountFollows;
        $UsersView->CountFollowing==null?0:$UsersView->CountFollowing;
        return $UsersView;
    }
    public function getListUserDasboard($limit=10)
    {
        return UsersView::orderBy('id','desc')->limit($limit)->get();
    }
    public function addFollows($data)
    {
        if(user()->id==intval($data->id)){
            $UsersView = new  UsersView();
            $UsersView->status = false;
            return $UsersView;
        }
        $Follows = Follows::where('follow_user_id','=',user()->id)->where('user_id','=',$data->id)->first();
        // dd( $Follows);
        if(!$Follows){
            $follow_remove_id = DB::table('follow_remove')->insertGetId([
                "user_id"=>$data->id,
            ]);
            $Follows =  new Follows();
            $Follows->follow_user_id=user()->id;
            $Follows->user_id=$data->id;
            $Follows->follow_remove_id=$follow_remove_id;
            $Follows->save();


            $UsersView =  UsersView::find($data->id);
            $UsersView->CountFollows==null?0:$UsersView->CountFollows;
            $UsersView->CountFollowing==null?0:$UsersView->CountFollowing;
            $UsersView->status = true;
            $UsersView->auth = $this->getAuthInfo();
            return $UsersView;
        }else{
            $UsersView = new  UsersView();
            $UsersView->status = false;
            return $UsersView;
        }
    }
    public function removeFollows($data)
    {
        if(user()->id==intval($data->id)){

            $UsersView = new  UsersView();
            $UsersView->status = false;
            return $UsersView;
        }
        $Follows = Follows::where('follow_user_id','=',user()->id)->where('user_id','=',$data->id)->first();
        if($Follows){
            $Follows = Follows::where('follow_user_id','=',user()->id)->where('user_id','=',$data->id)->delete();
            $UsersView =  UsersView::find($data->id);
            $UsersView->CountFollows==null?0:$UsersView->CountFollows;
            $UsersView->CountFollowing==null?0:$UsersView->CountFollowing;
            $UsersView->status = true;
            $UsersView->auth = $this->getAuthInfo();
            return $UsersView;
        }else{
            $UsersView = new  UsersView();
            $UsersView->status = false;
            // dd(1);
            return $UsersView;
        }
    }
    public function getFollowByUserID($data)
    {
        $where = array(
            ['follows.user_id','=',$data->userID]
        );
        if(Auth::check()){
            // $where[]=['users_view.id','!=',user()->id];
        }
        $result =  UsersView::join('follows','follows.follow_user_id','=','users_view.id')
        ->where($where)
        ->select('users_view.*','users_view.id as userID')
        ->paginate(10);
        return $result;
        // dd($result);
    }
    public function getFollowingByUserID($data)
    {
        return UsersView::join('follows','follows.user_id','=','users_view.id')
        ->where('follows.follow_user_id','=',$data->userID)
        ->select('users_view.*','users_view.id as userID')
        ->paginate(10);
    }
    public function updateProfile($data)
    {
        $user = Users::find(user()->id);
        $user->username = $data->username;
        if(trim($data->email)!=trim($user->email) ){
            $user->email_verified_token = uniqid().csrf_token().uniqid().user()->id;
            configMail();
            $rs =  _sendMail([
                "template"=>"vendor.mail.changeMail",
                "data"=>['email_verified_token'=>$user->email_verified_token],
                "mailSend"=>[$data->email],
                "subject"=>"Xác nhận email của bạn"
            ]);

            if($rs==true){
                $user->email = $data->email;
            }else{
                return false;
            }
        }
        $user->full_name = $data->full_name;
        $user->sex = $data->sex;
        $user->birthday = $data->birthday;
        $user->address = $data->address;
        $user->phone = $data->phone;
        $user->about = $data->about;
        $user->status_notice_userFollow = $data->status_notice_userFollow;
        // dd($data->all());
        if($user->save()){
            return true;
        }else{
            return false;
        }
    }
    public function getUserList($request=null)
    {
        $where = array(
            ['users_view.type','!=','userAdminDefault']
        );
        if(!empty($request->type)){
            if($request->type=='userAdminCreate'){
                $where[] = ['users_view.type','=',$request->type];
                if(!empty($request->role)){
                    $where[] = ['users_view.roleID','=',$request->role];
                }
            }
        }
        if(!empty($request->q)){
            $search = $request->q;
            $result =  UsersView::leftjoin('roles','roles.id','=','users_view.roleID')->where($where)
            ->Where(function($query)use($search){
                $query->where('users_view.id', 'LIKE', "%{$search}%")
                ->orWhere('users_view.full_name', 'LIKE',"%{$search}%")
                ->orWhere('users_view.email', 'LIKE',"%{$search}%")
                ->orWhere('users_view.username', 'LIKE',"%{$search}%")
                ->orWhere('users_view.phone', 'LIKE',"%{$search}%")
                ->orWhere('users_view.about', 'LIKE',"%{$search}%")
                ->orWhere('roles.role_name', 'LIKE',"%{$search}%")
                ->orWhere('users_view.created_at', 'LIKE',"%{$search}%");
            })
            ->select('users_view.*','roles.role_name')
            ->orderBy('id','desc')
            ->sortable()
            ->paginate(10);
            return $result;
        }else{

            $result =  UsersView::leftjoin('roles','roles.id','=','users_view.roleID')->where($where)
            ->where($where)
            ->select('users_view.*','roles.role_name')
            ->orderBy('id','desc')
            ->sortable()
            ->paginate(10);
            return $result;
        }
    }
    public function statusUser($request)
    {
        $result =  Users::find($request->id);

        if($result){
            if($result->type=='userAdminDefault'){
                return false;
            }
            if($result->id==user()->id){
                return false;
            }
            if($result->status==1){
                $result->status = 0;
            }else{
                $result->status = 1;
            }
            if($result->save())return true;
            return false;
        }return false;
    }
    public function deleteUser($request)
    {
        $result =  Users::find($request->id);
        if($result->type=='userAdminDefault'){
            return false;
        }
        if($result->id==user()->id){
            return false;
        }
        if($result->delete()){
            return true;
        }return false;
    }
    public function getUserByID($id)
    {
        $result = Users::where('id','=',$id)->first();
        if($result){
            if($result->type=='userAdminDefault'){
                return false;
            }
            if($result->id==user()->id){
                return false;
            }
            return $result;
        }
        return false;
    }
    public function editUser($data)
    {
        $user = Users::find($data->id);
        $user->username = $data->username;
        $user->email = $data->email;
        $user->full_name = $data->full_name;
        $user->roleID = $data->roleID;
        if($data->password!=''){
            $user->password =bcrypt($data->password);
        }
        $user->sex = $data->sex;
        $user->birthday = $data->birthday;
        $user->address = $data->address;
        $user->phone = $data->phone;
        $user->about = $data->about;
        $user->status_approve =$data->status_approve;
        if($user->save()){
            return true;
        }else{
            return false;
        }
    }
    public function addUser($data)
    {
        $user = new Users();
        $user->username = $data->username;
        $user->email = $data->email;
        $user->roleID = $data->roleID;
        if($data->password==''){
            $user->password = bcrypt('123456');
        }else{
            $user->password =$data->password;
        }
        $user->full_name = $data->full_name;
        $user->sex = $data->sex;
        $user->birthday = $data->birthday;
        $user->address = $data->address;
        $user->phone = $data->phone;
        $user->about = $data->about;
        $user->status_approve =$data->status_approve;
        $user->save();
        if($user){
            $user = Users::find($user->id);
            $user->username = time().$user->id;
            $user->save();
            return true;
        }else{
            return false;
        }
    }
    public function updatePassword($data)
    {
        $result = Users::where('id', '=',Auth::user()->id)->update(['password' => \Hash::make($data->new_password)]);
        if($result) return true;
        return false;
    }
}
