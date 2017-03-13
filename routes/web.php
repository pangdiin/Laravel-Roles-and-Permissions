<?php

Route::get('/', function (\Illuminate\Http\Request $request) {
	$user = $request->user();

	dd($user->can('edit posts'));
});

Auth::routes();

Route::get('/home', 'HomeController@index');
