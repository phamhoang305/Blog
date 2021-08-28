<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post("change-dark-mode","LoginController@changeDarkMode")->name('web.dark.mode');
Route::get("forgot","LoginController@forgot")->name('web.forgot.index');
Route::post("forgot","LoginController@postForgot")->name('web.forgot.index');
Route::get("change-password","LoginController@getChangePassWord")->name('web.forgot.changePassWord');
Route::post("change-password","LoginController@postChangePassWord")->name('web.forgot.changePassWord');
Route::get('clear-cache', function() {
    $cache = Artisan::call('cache:clear');
    return json_encode(array('status'=>'success','msg'=>'Làm mới thành công'));
})->name('web.clear.cache');
Route::group(['prefix' => 'tools'], function () {
    Route::get("/","UtilityController@index")->name('web.tools.index');
    Route::group(['prefix' => 'css-gradient'], function () {
        Route::get("/","UtilityController@getCSSGradienIndex")->name('web.css_gradien.index');
        Route::post("page","UtilityController@getCSSGradienPage")->name('web.css_gradien.page');
    });
    Route::group(['prefix' => 'html-to-jsx'], function () {
        Route::get("/","UtilityController@gethtmltojsxindex")->name('web.htmltojsx.index');
        Route::post("page","UtilityController@gethtmltojsxpage")->name('web.htmltojsx.page');
    });
    Route::group(['prefix' => 'file-to-base64'], function () {
        Route::get("/","UtilityController@filetobase64")->name('web.filetobase64.index');
    });
    
});

    Route::group(['prefix' => '/widget'], function () {
        Route::get("/","WidgetController@getWidget")->name('web.widget.index');
    });
    Route::group(['prefix' => '/'], function () {
        Route::get("/","HomeController@index")->name('web.home.index');
        Route::get("/post-home","HomeController@getPostPageHome")->name('web.home.getposthome');
    });
    Route::group(['prefix' => 'search'], function () {
        Route::get("/","SearchController@getSearch")->name('web.search.index');
    });
    Route::group(['prefix' => '/lien-he'], function () {
        Route::get("/","ContactController@index")->name('web.contact.index');
        Route::post("sendContact","ContactController@sendContact")->name('web.contact.sendContact');
    });
    Route::group(['prefix' => 'login' ], function () {
        Route::group(['middleware' => ['CheckPageLogin','CheckStatusLoginRegister']], function () {
            Route::post("ajaxLogin","LoginController@ajaxLogin")->name('web.auth.ajaxLogin');
        });
        Route::get("ajaxLogout","LoginController@getLogout")->name('web.auth.logout');
    });
    Route::group(['prefix' => 'register'], function () {
        Route::group(['middleware' => ['CheckPageLogin','CheckStatusLoginRegister']], function () {
            Route::get("","RegisterController@getRegister")->name('web.auth.register');
            Route::post("ajaxRegister","RegisterController@ajaxRegister")->name('web.auth.ajaxRegister');
        });
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get("{username?}/{type?}","InfouserController@getInfouser")->name('web.user.index');
    });
    Route::group(['prefix' => 'author'], function () {
        Route::get("/","AuthorController@getAuthor")->name('web.author.index');
    });
    Route::group(['prefix' => 'publish','middleware'=>['CheckAuthWeb','CheckStatusAddPost']], function () {
        Route::post("add","PublishController@postAdd")->name('web.publish.add');
        Route::get("add","PublishController@getAdd")->name('web.publish.add');
    });
    Route::group(['prefix' => 'publish','middleware'=>['CheckAuthWeb']], function () {
        Route::post("edit","PublishController@postEdit")->name('web.publish.edit');
        Route::get("edit/{uniqid?}","PublishController@getEdit")->name('web.publish.edit');
        Route::post("unlock","PublishController@postUnlock")->name('web.publish.unlock');
        Route::post("lock","PublishController@postLock")->name('web.publish.lock');
        Route::post("trash","PublishController@postTrash")->name('web.publish.trash');
        Route::post("delete","PublishController@postDelete")->name('web.publish.delete');
        Route::post("restore","PublishController@postRestore")->name('web.publish.restore');
    });
    Route::group(['prefix' => 'me','middleware'=>['CheckAuthWeb']], function () {
        Route::group(['prefix' => 'follows'], function () {
            Route::post("addFollows","FollowsController@addFollows")->name('web.follows.addFollows');
            Route::post("removeFollows","FollowsController@removeFollows")->name('web.follows.removeFollows');
        });
        Route::get("public","MycontentController@getPostPublic")->name('web.me.public');
        Route::get("draft","MycontentController@getPostDraft")->name('web.me.draft');
        Route::get("lock","MycontentController@getPostLock")->name('web.me.lock');
        Route::get("approve","MycontentController@getPostApprove")->name('web.me.approve');
        Route::get("trash","MycontentController@getPostTrash")->name('web.me.trash');

        Route::group(['prefix' => 'profile'], function () {
            Route::get("/","InfouserController@getProfile")->name('web.user.profile');
            Route::post("update","InfouserController@postUpdateProfile")->name('web.user.updateProfile');
            Route::post("changePass","InfouserController@postChangePassword")->name('web.user.changePass');
            Route::post("changeMail","InfouserController@changeMail")->name('web.user.changeMail');
            Route::get("changePass","InfouserController@getSetting")->name('web.user.changePass');
        });
    });
    Route::get("confirm","InfouserController@confirmMail")->name('web.confirm.mail');
    Route::group(['prefix' => 'social'], function () {
        Route::get('oauth/{driver}', 'SocialController@redirectToProvider')->name('web.social.oauth');
        Route::get('oauth/{driver}/callback', 'SocialController@handleProviderCallback')->name('web.social.callback');
    });
    Route::group(['prefix' => 'tag'], function () {
        Route::get("{tag_slug}","TagsController@getPostTag")->name('web.tag.post');
    });
    Route::get('global.js', function () {
        return globalJS();
    })->name('global.js');
    Route::group(['prefix' => 'thi-trac-nghiem'], function () {
        Route::get("chu-de/","QuizController@getTestCategory")->name('web.quiz.category.view');
        Route::get("de-thi/{uniqid?}","QuizController@getTestList")->name('web.quiz.testlist.view');
        Route::post("chi-tiet-de-thi","QuizController@postTestDetail")->name('web.quiz.testdetail.view');
        Route::get("chi-tiet-de-thi/{uniqid?}","QuizController@getTestDetail")->name('web.quiz.testdetail.view');
        Route::post("saveTest","QuizController@postSaveTest")->name('web.quiz.saveTest');
        Route::group(['prefix' => 'lich-su','middleware'=>['CheckAuthWeb']], function () {
            Route::get("lam-bai","QuizController@getHistoryTest")->name('web.quiz.history');
        });
        Route::get("ket-qua-thi/{uniqid?}","QuizController@getResultDetail")->name('web.quiz.resultdetail');
    });
    Route::post("post-password","PostsController@postPassword")->name('web.posts.password');
    Route::group(['prefix' => '/'], function () {
        Route::any("{slug1?}/{slug2?}/{slug3?}","PostsController@getPost")->name('web.posts.index');
    });

