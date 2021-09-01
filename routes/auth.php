<?php
Route::get(setting()->route_login,"LoginController@getLogin")->name('admin.auth.login');
Route::post(setting()->route_login,"LoginController@ajaxLogin")->name('admin.auth.ajaxLogin');