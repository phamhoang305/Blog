<?php
Route::group(['prefix' => setting()->route_admin], function () {
    Route::group(['prefix' => '/'], function () {
        Route::get("/","DashboardController@index")->name('admin.dashboard.view');
    });
    Route::group(['prefix' => '/category'], function () {
        Route::group(['prefix' => 'parent'], function () {
            Route::get("/","CategoryController@getParentCategpry")->name('admin.category.parent.view')->middleware('CheckPermission:category.view');
            Route::get("datatable","CategoryController@getParentDatatable")->name('admin.category.parent.datatable');
            Route::get("edit","CategoryController@getParentEdit")->name('admin.category.parent.edit')->middleware('CheckPermission:category.edit');
            Route::post("edit","CategoryController@postParentEdit")->name('admin.category.parent.edit')->middleware('CheckPermission:category.edit');
            Route::post("add","CategoryController@postParentAdd")->name('admin.category.parent.add')->middleware('CheckPermission:category.add');
            Route::post("delete","CategoryController@postParentDelete")->name('admin.category.parent.delete')->middleware('CheckPermission:category.delete');
        });
        Route::group(['prefix' => 'sub'], function () {
            Route::get("/","CategoryController@getSubCategory")->name('admin.category.sub.view')->middleware('CheckPermission:category.view');
            Route::get("datatable","CategoryController@getSubDatatable")->name('admin.category.sub.datatable');
            Route::get("edit","CategoryController@getSubEdit")->name('admin.category.sub.edit')->middleware('CheckPermission:category.edit');
            Route::post("edit","CategoryController@postSubEdit")->name('admin.category.sub.edit')->middleware('CheckPermission:category.edit');
            Route::post("add","CategoryController@postSubAdd")->name('admin.category.sub.add')->middleware('CheckPermission:category.add');
            Route::post("delete","CategoryController@postSubDelete")->name('admin.category.sub.delete')->middleware('CheckPermission:category.delete');
        });
    });
    Route::group(['prefix' => 'post'], function () {

        Route::post("add","PostController@postAdd")->name('admin.post.add')->middleware('CheckPermission:post.add');
        Route::post("edit","PostController@postEdit")->name('admin.post.edit')->middleware('CheckPermission:post.edit');
        Route::post("delete","PostController@postDelete")->name('admin.post.delete')->middleware('CheckPermission:post.delete');
        Route::post("trash","PostController@postTrash")->name('admin.post.trash')->middleware('CheckPermission:post.trash');
        Route::post("unlock","PostController@postUnlock")->name('admin.post.unlock')->middleware('CheckPermission:post.unlock');
        Route::post("lock","PostController@postLock")->name('admin.post.lock')->middleware('CheckPermission:post.lock');
        Route::post("restore","PostController@postRestore")->name('admin.post.restore')->middleware('CheckPermission:post.trash');
        Route::post("approvePublic","PostController@approvePublic")->name('admin.post.approvePublic')->middleware('CheckPermission:post.approvePublic');



        Route::get("add","PostController@getAdd")->name('admin.post.add')->middleware('CheckPermission:post.add');
        Route::get("edit/{uniqid?}","PostController@getEdit")->name('admin.post.edit')->middleware('CheckPermission:post.edit');
        Route::get("public","PostController@getPostPublic")->name('admin.post.public')->middleware('CheckPermission:post.public');
        Route::get("draft","PostController@getPostDraft")->name('admin.post.draft')->middleware('CheckPermission:post.draft');
        Route::get("lock","PostController@getPostLock")->name('admin.post.lock')->middleware('CheckPermission:post.lock');
        Route::get("trash","PostController@getPostTrash")->name('admin.post.trash')->middleware('CheckPermission:post.trash');
        Route::get("approve","PostController@getPostApprove")->name('admin.post.approve')->middleware('CheckPermission:post.approve');
    });
    Route::group(['prefix' => 'contact'], function () {
        Route::get("list","ContactController@getList")->name('admin.contact.view')->middleware('CheckPermission:contact.view');
        Route::get("viewAjax","ContactController@getViewAjax")->name('admin.contact.viewAjax')->middleware('CheckPermission:contact.view');
        Route::post("delete","ContactController@postDelete")->name('admin.contact.delete')->middleware('CheckPermission:contact.delete');
        Route::post("replyAjax","ContactController@postReplyAjax")->name('admin.contact.replyAjax')->middleware('CheckPermission:contact.reply');
    });
    Route::group(['prefix' => 'comment'], function () {
        Route::get("list","CommentController@getList")->name('admin.comment.view')->middleware('CheckPermission:comment.view');
        Route::post("delete","CommentController@postDelete")->name('admin.comment.delete')->middleware('CheckPermission:comment.delete');
    });
    Route::group(['prefix' => 'sitemap'], function () {
        Route::get("/","SitemapController@getIndex")->name('admin.sitemap.view')->middleware('CheckPermission:sitemap.view');
        Route::post("update","SitemapController@postUpdate")->name('admin.sitemap.update')->middleware('CheckPermission:sitemap.update');
        Route::get("dowload","SitemapController@getDowload")->name('admin.sitemap.dowload');
    });
    Route::group(['prefix' => 'page'], function () {
        Route::get("list","PageController@getList")->name('admin.page.view')->middleware('CheckPermission:page.view');
        Route::post("add","PageController@postAdd")->name('admin.page.add')->middleware('CheckPermission:page.add');
        Route::get("add","PageController@getAdd")->name('admin.page.add')->middleware('CheckPermission:page.add');
        Route::post("edit","PageController@postEdit")->name('admin.page.edit')->middleware('CheckPermission:page.edit');
        Route::get("edit/{id?}","PageController@getEdit")->name('admin.page.edit')->middleware('CheckPermission:page.edit');
        Route::post("delete","PageController@postDelete")->name('admin.page.delete')->middleware('CheckPermission:page.delete');
        Route::post("status","PageController@postStatus")->name('admin.page.status')->middleware('CheckPermission:page.status');
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get("list","UserController@getList")->name('admin.user.view')->middleware('CheckPermission:user.view');
        Route::post("add","UserController@postAdd")->name('admin.user.add')->middleware('CheckPermission:user.add');
        Route::get("add","UserController@getAdd")->name('admin.user.add')->middleware('CheckPermission:user.add');
        Route::post("edit","UserController@postEdit")->name('admin.user.edit')->middleware('CheckPermission:user.edit');
        Route::get("edit/{id?}","UserController@getEdit")->name('admin.user.edit')->middleware('CheckPermission:user.edit');
        Route::post("delete","UserController@postDelete")->name('admin.user.delete')->middleware('CheckPermission:user.delete');
        Route::post("status","UserController@postStatus")->name('admin.user.status')->middleware('CheckPermission:user.status');
    });
    Route::group(['prefix' => 'role'], function () {
        Route::get("list","RoleController@getList")->name('admin.role.view')->middleware('CheckPermission:role.view');
        Route::post("add","RoleController@postAdd")->name('admin.role.add')->middleware('CheckPermission:role.add');
        Route::get("add","RoleController@getAdd")->name('admin.role.add')->middleware('CheckPermission:role.add');
        Route::post("edit","RoleController@postEdit")->name('admin.role.edit')->middleware('CheckPermission:role.edit');
        Route::get("edit/{id?}","RoleController@getEdit")->name('admin.role.edit')->middleware('CheckPermission:role.edit');
        Route::post("delete","RoleController@postDelete")->name('admin.role.delete')->middleware('CheckPermission:role.delete');
        Route::post("status","RoleController@postStatus")->name('admin.role.status')->middleware('CheckPermission:role.status');
    });
    Route::group(['prefix' => 'setting'], function () {
        Route::get("/","SettingController@getSetting")->name('admin.setting.view')->middleware('CheckPermission:setting.view');
        Route::post("edit","SettingController@postEdit")->name('admin.setting.edit')->middleware('CheckPermission:setting.edit');
        Route::get("mail","SettingController@getMail")->name('admin.setting.mail')->middleware('CheckPermission:setting.mail.view');
        Route::post("mail","SettingController@postMail")->name('admin.setting.mail')->middleware('CheckPermission:setting.mail.edit');
        Route::get("socialite","SettingController@getSocialite")->name('admin.setting.socialite')->middleware('CheckPermission:setting.socialite.view');
        Route::post("socialite","SettingController@postSocialite")->name('admin.setting.socialite')->middleware('CheckPermission:setting.socialite.edit');
    });
    Route::group(['prefix' => 'ad'], function () {
        Route::get("/","AdController@getList")->name('admin.ad.view')->middleware('CheckPermission:ad.view');
        Route::post("edit","AdController@postEdit")->name('admin.ad.edit')->middleware('CheckPermission:ad.edit');
        Route::get("edit/{id?}","AdController@getEdit")->name('admin.ad.edit')->middleware('CheckPermission:ad.edit');
        Route::post("status","AdController@postStatus")->name('admin.ad.status')->middleware('CheckPermission:ad.status');
        Route::post("saveAdSene","AdController@postSaveAdSene")->name('admin.ad.saveAdSene')->middleware('CheckPermission:ad.edit');
    });
    Route::group(['prefix' => 'quiz'], function () {
        Route::group(['prefix' => 'test-category'], function () {
            Route::get("/","QuizController@getTestCategory")->name('admin.quiz.testcategory.view')->middleware('CheckPermission:quiz.view');
            Route::get("add","QuizController@getTestCategoryAdd")->name('admin.quiz.testcategory.add')->middleware('CheckPermission:quiz.add');
            Route::post("add","QuizController@postTestCategoryAdd")->name('admin.quiz.testcategory.add')->middleware('CheckPermission:quiz.add');
            Route::post("edit","QuizController@postTestCategoryEdit")->name('admin.quiz.testcategory.edit')->middleware('CheckPermission:quiz.edit');
            Route::get("edit/{uniqid?}","QuizController@getTestCategoryEdit")->name('admin.quiz.testcategory.edit')->middleware('CheckPermission:quiz.edit');
            Route::post("status","QuizController@postTestCategoryStatus")->name('admin.quiz.testcategory.status')->middleware('CheckPermission:quiz.edit');
            Route::post("delete","QuizController@postTestCategoryDelete")->name('admin.quiz.testcategory.delete')->middleware('CheckPermission:quiz.delete');
        });
        Route::group(['prefix' => 'test-list'], function () {
            Route::get("view/{uniqid?}","QuizController@getTestList")->name('admin.quiz.testlist.view')->middleware('CheckPermission:quiz.view');
            Route::get("add","QuizController@getTestListAdd")->name('admin.quiz.testlist.add')->middleware('CheckPermission:quiz.add');
            Route::post("add","QuizController@postTestListAdd")->name('admin.quiz.testlist.add')->middleware('CheckPermission:quiz.add');
            Route::post("edit","QuizController@postTestListEdit")->name('admin.quiz.testlist.edit')->middleware('CheckPermission:quiz.edit');
            Route::get("edit/{uniqid?}","QuizController@getTestListEdit")->name('admin.quiz.testlist.edit')->middleware('CheckPermission:quiz.edit');
            Route::post("status","QuizController@postTestListStatus")->name('admin.quiz.testlist.status')->middleware('CheckPermission:quiz.edit');
            Route::post("delete","QuizController@postTestListDelete")->name('admin.quiz.testlist.delete')->middleware('CheckPermission:quiz.delete');
        });
        Route::group(['prefix' => 'test-detail'], function () {
            Route::get("view/{uniqid?}","QuizController@getTestDetail")->name('admin.quiz.testdetail.view')->middleware('CheckPermission:quiz.view');
            Route::get("add","QuizController@getTestDetailAdd")->name('admin.quiz.testdetail.add')->middleware('CheckPermission:quiz.add');
            Route::post("add","QuizController@postTestDetailAdd")->name('admin.quiz.testdetail.add')->middleware('CheckPermission:quiz.add');
            Route::post("edit","QuizController@postTestDetailEdit")->name('admin.quiz.testdetail.edit')->middleware('CheckPermission:quiz.edit');
            Route::get("edit/{uniqid?}","QuizController@getTestDetailEdit")->name('admin.quiz.testdetail.edit')->middleware('CheckPermission:quiz.edit');
            Route::post("status","QuizController@postTestDetailStatus")->name('admin.quiz.testdetail.status')->middleware('CheckPermission:quiz.edit');
            Route::post("delete","QuizController@postTestDetailDelete")->name('admin.quiz.testdetail.delete')->middleware('CheckPermission:quiz.delete');
            Route::post("export-sample","QuizController@postExportSample")->name('admin.quiz.testdetail.export');
            Route::post("import","QuizController@postImport")->name('admin.quiz.testdetail.import');
        });
    });
});
Route::group(['prefix' => 'sitemap'], function () {
    Route::get("show","SitemapController@showSitemap")->name('admin.sitemap.show');
    Route::get("cron-job","SitemapController@cronjobUpdate")->name('admin.sitemap.cronjobUpdate');
});
