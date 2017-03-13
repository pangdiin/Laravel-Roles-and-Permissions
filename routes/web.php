<?php

Route::get('/', function (\Illuminate\Http\Request $request) {
	$user = $request->user();

	dd($user->can('delete users'));
});

Auth::routes();

Route::get('/home', 'HomeController@index');
