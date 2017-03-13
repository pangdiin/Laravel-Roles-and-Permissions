<?php

Route::get('/', function (\Illuminate\Http\Request $request) {
	$user = $request->user();

	dd($user->hasPermissionTo('edit posts'));
});

Auth::routes();

Route::get('/home', 'HomeController@index');
