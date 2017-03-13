<?php

Route::get('/', function (\Illuminate\Http\Request $request) {
	$user = $request->user();

	$user->updatePermissions(['edit posts']); //'edit posts','delete posts'

	return new \Illuminate\Http\Response('hello', 200);
});

Auth::routes();

Route::get('/home', 'HomeController@index');
