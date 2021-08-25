<?php
use Illuminate\Support\Facades\Cache;
use voku\helper\HtmlDomParser;
use Jenssegers\Agent\Agent;
use App\Repositories\Categorys\CategorysRepository;
use App\Repositories\Users\UsersRepository;
use App\Repositories\Posts\PostsRepository;
use App\Models\Users;
use App\Models\Comments;
use App\Models\Follows;
use App\Models\Tags;
use App\Models\Categorys;
use App\Views\PostsView;
use App\Models\Posts;
use App\Models\Roles;
use App\Models\Ad;
use App\Models\Setting;
use App\Repositories\Quiz\QuizRepository;
use Illuminate\Support\Facades\Auth;
function Kilobyte()
{
    return 3072;
}
function getMenu(){
    return Cache::rememberForever('getMenu', function(){
        $Categorys = new CategorysRepository();
        $result =  $Categorys->getMenu();
        return $result;
    });
}
function getSubMenu(){
    $getSubMenu = Cache::remember("getSubMenu",setting()->cache_seconds, function(){
        $result =  Categorys::where('cate_parentID','!=',NULL)->get();
        return $result;
    });
    return $getSubMenu;
}

function getAllAds()
{
    $getAllAds = Cache::remember("getAllAds",setting()->cache_seconds, function(){
        return Ad::where('status','=','on')->get();
    });
    return  $getAllAds;
}

function getAds($key)
{
    foreach (getAllAds() as $item){
        if($item->type==$key){
            return $item->code;
        }
    }
    return "";
}
function getRoles()
{
    $getRoles = Cache::remember("getRoles",setting()->cache_seconds, function(){
        return Roles::get();
    });
    return $getRoles;
}
function getTags()
{
    $getTags = Cache::remember("getTags",setting()->cache_seconds, function(){
        return Tags::groupBy('tag_slug')->get();
    });
    return $getTags;
}
function getPagesHeader()
{
    $getPagesHeader = Cache::remember("getPagesHeader",setting()->cache_seconds, function(){
        return Posts::where('post_view_type','=','PAGE')->where('post_status','=','published')->where('page_status_header','=','show')->get();
    });
    return $getPagesHeader;
}
function getPagesSidebar()
{
    $getPagesSidebar = Cache::remember("getPagesSidebar",setting()->cache_seconds, function(){
        return Posts::where('post_view_type','=','PAGE')->where('post_status','=','published')->where('page_status_sidebar','=','show')->get();
    });
    return $getPagesSidebar;
}
function countCommentsPostID ($postID)
{
   return Comments::where('commentable_id','=',$postID)->count();
}
// MyContent
function countPostPublicMyContent()
{
    return PostsView::where('post_status','=','published')
    ->where('post_status_admin','=','published')
    ->where('post_trash','=',NULL)
    ->where('post_trash_admin','=',NULL)
    ->where('post_approve','=',NULL)
    ->where('user_id','=',user()->id)
    ->count();
}

function countPostApproveMyContent()
{
    return PostsView::where('post_approve','=','approve')
    ->where('post_trash','=',NULL)
    ->where('post_trash_admin','=',NULL)
    ->where('user_id','=',user()->id)
    ->count();
}
function countPostDraftMyContent()
{
    return PostsView::where('post_status','=','draft')
    ->where('post_trash','=',NULL)
    ->where('post_trash_admin','=',NULL)
    ->where('post_approve','=',NULL)
    ->where('user_id','=',user()->id)
    ->count();
}
function countPostLockMyContent()
{
    return PostsView::where('post_status','=','lock')
    ->where('post_trash','=',NULL)
    ->where('post_trash_admin','=',NULL)
    ->where('user_id','=',user()->id)
    ->where('post_approve','=',NULL)
    ->count();
}
function countPostTrashMyContent()
{
    return PostsView::where('post_trash','!=',NULL)
    ->where('user_id','=',user()->id)
    ->count();
}
function countFollowLogin($userID)
{
    $count =  Follows::where('follow_user_id','=',user()->id)->where('user_id','=',$userID)->count();
    if($count>0){
        return $count;
    }return NULL;
}
// Admin
function countCategoryAdmin()
{
    return Categorys::count();
}
function countPostPublicAdmin()
{
    return PostsView::where('post_view_type','=','POST')
    ->where('post_status_admin','=','published')
    ->where('post_status','=','published')
    ->where('post_trash','=',NULL)
    ->where('post_trash_admin','=',NULL)
    ->where('post_approve','=',NULL)
    ->count();
}
function countPostTrashAdmin()
{
    return PostsView::where('post_view_type','=','POST')->where('post_approve','=',NULL)->where('post_trash_admin','!=',NULL)->count();
}
function countPostDraftAdmin()
{
    return PostsView::where('post_view_type','=','POST')->where('post_approve','=',NULL)->where('post_status_admin','=','draft')->where('post_trash_admin','=',NULL)->count();
}
function countPostLockAdmin()
{
    return PostsView::where('post_view_type','=','POST')->where('post_approve','=',NULL)->where('post_status_admin','=','lock')->where('post_trash_admin','=',NULL)->count();
}
function countPostApproveAdmin(){
    return PostsView::where('post_view_type','=','POST')->where('post_approve','=','approve')
    ->where('post_trash','=',NULL)
    ->where('post_trash_admin','=',NULL)
    ->count();
}

function countUserAdmin()
{
    return Users::where('status','=','0')->where('type','!=','userAdminDefault')->where('type','!=','userCreate')->count();
}
function countUserMembers ()
{
    return Users::where('status','=','0')->where('type','=','userCreate')->count();
}

function updatePostView($postID)
{
    $Posts = new PostsRepository();
    return $Posts->updatePostView($postID);
}
function randomPosts($limit)
{
    $Posts = new PostsRepository();
    return $Posts->randomPosts($limit);
}
function sliderPosts($limit)
{
    $Posts = new PostsRepository();
    return $Posts->getPostSlider($limit);
}
function getTopAuthors()
{
    $getTopAuthors = Cache::remember("getTopAuthors",setting()->cache_seconds, function(){
        $Users = new UsersRepository();
        return $Users->getTopAuthors(null,5);
    });
    return $getTopAuthors;
}
function setting(){
    return Cache::rememberForever('setting', function() {
        return \App\Models\Setting::find(1);
    });
}
function sameCategory($_cate_slug,$postID,$limit=5)
{
    $Posts = new PostsRepository();
    return $Posts->sameCategory($_cate_slug,$postID,$limit=5);
}
function getMailFollows()
{
    return Users::join('follows','follows.follow_user_id','=','users.id')->where('users.status_notice_userFollow','=','on')
    ->where('users.email','!=',NULL)
    ->pluck('users.email')->toArray();
}

function getPostViewTop($limit=5)
{
    $Posts = new PostsRepository();
    return $Posts->getPostViewTop($limit);
}
function to_slug($str){
    $str = trim(mb_strtolower($str));
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);
    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    $str = preg_replace('/([\s]+)/', '-', $str);
    return $str;
}
function configMail()
{
    \Config::set("mail.driver",setting()->MAIL_DRIVER);
    \Config::set("mail.host",setting()->MAIL_HOST);
    \Config::set("mail.port",setting()->MAIL_PORT);
    \Config::set("mail.from.address",setting()->MAIL_FROM_ADDRESS);
    \Config::set("mail.from.name",setting()->MAIL_FROM_NAME);
    \Config::set("mail.encryption",setting()->MAIL_ENCRYPTION);
    \Config::set("mail.username",setting()->MAIL_USERNAME);
    \Config::set("mail.password",setting()->MAIL_PASSWORD);
}
function _sendMail($data = array('template'=>"",'data'=>[],'mailSend'=>[],'subject'=>'FDEV'))
{

        $mailSends = $data['mailSend'];
        $subject = $data['subject'];
        try{
            \Mail::send($data['template'],$data['data'],function ($message) use ($mailSends,$subject) {
                $message->to($mailSends)->subject($subject);
            });
            return true;
        }
        catch(\Exception $exception)
        {
            return ($exception->getMessage());
        }
}
function raddomClass($nodark=false)
{
    $data=  ['info','danger','success','warning'];
    return $data[intval(RandomString(1,"0123"))];
}
function RandomString($length = 6,$string=null)
{

    $characters = $string==null?'123456789': $string;

    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function _checkEmailUsers($request,$type=null)
{
    if($type=='insert'){
        $result = Users::where('email','=',$request->email)->where('email','!=',null)->count();
        if($result>0) return true;
        return false;
    }else{
        $result = Users::where('email','=',$request->email)->where('email','!=',null)->where('id','!=',$request->id)->count();
        if($result>0) return true;
        return false;
    }
}
function _checkPhoneUsers($request,$type=null)
{
    if($type=='insert'){
        $result = Users::where('phone','=',$request->phone)->where('phone','!=',null)->count();
        if($result>0) return true;
        return false;
    }else{
        $result = Users::where('phone','=',$request->phone)->where('phone','!=',null)->where('id','!=',$request->id)->count();
        if($result>0) return true;
        return false;
    }
}
function date_time($date)
{
    $time_input = strtotime($date);
    $date_input = getDate($time_input);
    return $date_input[0];
}
function time_Ago($time) {
    $diff     = time() -$time;
    $sec     = $diff;
    $min     = round($diff / 60 );
    $hrs     = round($diff / 3600);
    $days     = round($diff / 86400 );
    $weeks     = round($diff / 604800);
    $mnths     = round($diff / 2600640 );
    $yrs     = round($diff / 31207680 );
    if($sec <= 60) {
        echo "$sec giây trước";
    }
    else if($min <= 60) {
        if($min==1) {
            return "1 phút trước";
        }
        else {
            return "$min phút trước";
        }
    }
    // Check for hours
    else if($hrs <= 24) {
        if($hrs == 1) {
            return "1 giờ trước";
        }
        else {
            return "$hrs giờ trước";
        }
    }
    // Check for days
    else if($days <= 7) {
        if($days == 1) {
            return "Hôm qua";
        }
        else {
            return "$days ngày trước";
        }
    }
    // Check for weeks
    else if($weeks <= 4.3) {
        if($weeks == 1) {
            return "1 tuần trước";
        }
        else {
            return "$weeks tuần trước";
        }
    }
    // Check for months
    else if($mnths <= 12) {
        if($mnths == 1) {
            return "1 tháng trước";
        }
        else {
            return "$mnths tháng trước";
        }
    }
    // Check for years
    else {
        if($yrs == 1) {
            return "1 năm trước";
        }
        else {
            return "$yrs năm trước";
        }
    }
}
function user()
{
   return Auth::user();
}
function sqlInfoUser($start,$limit)
{
    $user_id = 0;
    if(Auth::check()){
        $user_id=user()->id;
    }
    $SQL = "SELECT DISTINCT users_view.id AS userID,follows.user_id,follows.follow_user_id,users_view.* FROM	users_view
            LEFT JOIN (
                    SELECT * FROM(
                        SELECT follows.user_id,follows.follow_user_id
                        FROM follows
                        WHERE follow_user_id = $user_id
                        GROUP BY follows.user_id
                    )AS follows
            ) AS follows
            ON users_view.id = follows.user_id
            ORDER BY `users_view`.`CountFollows` DESC LIMIT $limit OFFSET $start";
    return $SQL;
}
function xss_clean($data)
{
// Fix &entity\n;
$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

// Remove any attribute starting with "on" or xmlns
$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

// Remove javascript: and vbscript: protocols
$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

// Remove namespaced elements (we do not need them)
$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

// do
// {
//     // Remove really unwanted tags
//     $old_data = $data;
//     $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
// }
// while ($old_data !== $data);

// we are done...
return $data;
}
function checkRole($key)
{
    $roles = collect(array());

    if (Auth::user()->type == 'userAdminDefault') {
        return true;
    } else {
        $data = Cache::rememberForever("checkRole", function(){
            return Roles::where('id','=',(int)Auth::user()->roleID)->pluck('permission')->first();
        });
        // Kiểm tra nếu là tài khoản mà được chọn là quyền userAdminDefault  trùm thì cho qua luôn full hiện thị full menu
        if($data){
            $roles = collect(json_decode($data));
        }
        if ($roles->contains($key)) {
            return true;
        } else {
            return false;
        }
    }
}
function getRedirectPublish($request)
{

    $showData = $request->showData;
    // dd($showData,$request->all());
    if($showData=='myContent'){
        if($request->status_approve!=""){
            return route('web.me.approve');
        }else{
            if($request->post_status=='published'){
                return route('web.me.public');
            }else if($request->post_status=='draft'){
                return route('web.me.draft');
            }else{
                return route('web.me.lock');
            }
        }
    }else{
        if($request->status_approve!=""){
            return route('admin.post.approve');
        }else{
            if($request->post_status=='published'){
                return route('admin.post.public');
            }else if($request->post_status=='draft'){
                return route('admin.post.draft');
            }else{
                return route('admin.post.lock');
            }
        }
    }
}
function checkDrive()
{
    $agent = new Agent();
    // dd($agent);
    $thiet_bi = "Desktop";
    if($agent->isDesktop()){
        $thiet_bi="Desktop";
    }else if($agent->isMobile()){
        $thiet_bi="Mobile";
    }else if($agent->isTablet()){
        $thiet_bi="Tablet";
    }
    return $thiet_bi;
}
function getNameFile($fullPath)
{
    $fullPath = explode(";",$fullPath);
    if(count($fullPath)>1){
       return $fullPath[0];
    }else{
        return $fullPath[count($fullPath)-1];
    }
}
function getLogo(){
    if (\File::exists(public_path(setting()->logo))&&setting()->logo!=null){
         return asset(setting()->logo);
    }else{
        return asset("assets/images/defaults/photos-icon.png");
    }
}
function getIcon(){
    if(\File::exists(public_path(setting()->icon))&&setting()->icon!=null){
        return asset(setting()->icon);
    }else{
       return asset("/assets/images/defaults/photos-icon.png");
    }
}
function img_seoImage()
{
    if (\File::exists(public_path(setting()->seoImage))&&setting()->seoImage!=null){
        return asset(setting()->seoImage);
    }else{
        return asset('assets/images/defaults/photos-icon.png');
    }
}
function img_post($path){

    if (\File::exists(public_path($path))&&$path!=null){
        return asset("{$path}");
    }else{
        return asset('assets/images/defaults/photos-icon.png');
    }
}
function img_avatar($path,$email=null)
{
    if($path==''){
        $path = "https://www.gravatar.com/avatar/".md5($email)."jpg?s=64";
    }else{
        return $path;
    }
}
function img_category($path)
{
    if (\File::exists(public_path($path))&&$path!=null){
        return asset("{$path}");
    }else{
        return asset('/assets/images/defaults/photos-icon.png');
    }
}
function domDarkMode($attrs)
{
    $attrs= explode(";",$attrs);
    foreach($attrs as $key=>$value){
        $css= explode(":",$value)[0];
        if(trim($css)=='color'){$attrs[$key]="color:#ffff";}
        if(trim($css)=='background-color'){$attrs[$key]="background-color:#ffff";}

    }
    $str = implode(";",$attrs);
    // dd($str);
    return $str;
}
function setAttrDom($post_content)
{
    return $post_content;
    $dom = HtmlDomParser::str_get_html($post_content);
    $images = $dom->getElementsByTagName('img');
    $tables = $dom->getElementsByTagName('table');
    if(setting()->darkMode=='on'){
        foreach($dom->getElementsByTagName('span') as $dom_item){
            $style = $dom_item->getAttribute('style');
            $dom_item->setAttribute('style',domDarkMode($style));
        }
        foreach($dom->getElementsByTagName('p') as $dom_item){
            $style = $dom_item->getAttribute('style');
            $dom_item->setAttribute('style',domDarkMode($style));
        }
        foreach($dom->getElementsByTagName('tr') as $dom_item){
            $style = $dom_item->getAttribute('style');
            $dom_item->setAttribute('style',domDarkMode($style));
        }
        foreach($dom->getElementsByTagName('th') as $dom_item){
            $style = $dom_item->getAttribute('style');
            $dom_item->setAttribute('style',domDarkMode($style));
        }
        foreach($dom->getElementsByTagName('td') as $dom_item){
            $style = $dom_item->getAttribute('style');
            $dom_item->setAttribute('style',domDarkMode($style));
        }
    }
    foreach($tables as $table){
        $table->removeAttribute('style');
        $table->setAttribute('class',"table table-hover table-striped table-bordered table-sm");
    }
    foreach($images as $img){
        $img->removeAttribute('style');
        $img->removeAttribute('height');
        $img->removeAttribute('width');
        $img->setAttribute('class',"img-fluid img-thumbnail");
    }
    $dom->save();
    return $dom;
}
function str_ucfirst($str) {
   $str = mb_strtolower($str);
   return $str;
}
//date format
if (!function_exists('replace_month_name')) {
    function replace_month_name($str)
    {
        $str = trim($str);
        $str = str_replace("Jan", "Tháng 1", $str);
        $str = str_replace("Feb", "Tháng 2", $str);
        $str = str_replace("Mar", "Tháng 3", $str);
        $str = str_replace("Apr", "Tháng 5", $str);
        $str = str_replace("May", "Tháng 6", $str);
        $str = str_replace("Jun", "Tháng 6", $str);
        $str = str_replace("Jul", "Tháng 7", $str);
        $str = str_replace("Aug", "Tháng 8", $str);
        $str = str_replace("Sep", "Tháng 9", $str);
        $str = str_replace("Oct", "Tháng 10", $str);
        $str = str_replace("Nov", "Tháng 11", $str);
        $str = str_replace("Dec", "Tháng 12", $str);
        return $str;
    }
}
//date format
if (!function_exists('helper_date_format')) {
    function helper_date_format($datetime)
    {
        $date = date("M j, Y", strtotime($datetime));
        $date = replace_month_name($date);
        return $date;
    }
}
//print formatted hour
if (!function_exists('formatted_hour')) {
    function formatted_hour($timestamp)
    {
        return date("H:i", strtotime($timestamp));
    }
}
if (!function_exists('globalJS')) {
    function globalJS()
    {
        echo("var url_loading = '").asset('uploads/loading/loading.svg')."';\n";
        echo("var editor_content_css = '").asset('themes/plugins/tinymce/editor_content.css')."';\n";
        echo("var editor_ui_css = '").asset('themes/plugins/tinymce/editor_ui.css')."';\n";
        echo("var show_data = 'month'").";\n";
        echo("var Kilobyte = ").Kilobyte().";\n";
        echo("var drive = '").checkDrive()."';\n";
        echo("var post_page_number = '").setting()->post_page_number."';\n";
        echo("var isDarkMode = '").Route::currentRouteName()."';\n";
        echo("var url_widget = '").route('web.widget.index')."';\n";
        echo("var url_getposthome = '").route('web.home.getposthome')."';\n";
        header('Content-Type: text/javascript');
        exit();
    }
}
function storgeFile($str)
{
    $str =  \Illuminate\Support\Facades\Crypt::encrypt($str);
    return route('image.storgeFile',$str);
}
function _shuffle($array) {
    for ($i = count($array) - 1; $i > 0; $i--) {
      $j = floor(rand() * ($i + 1));
      $temp = $array[$i];
      $array[$i] = $array[$j];
      $array[$j] = $temp;
    }
    return $array;
}
