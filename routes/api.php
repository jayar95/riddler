<?php
	use App\Http\Resources\RiddleResource;
	use App\Riddle;

	Route::group([
		'middleware' => 'api',
		'prefix' => 'auth',
	], function($router) {
		Route::post('login', 'AuthController@login');
		Route::post('logout', 'AuthController@logout');
		Route::post('refresh', 'AuthController@refresh');
		Route::post('me', 'AuthController@me');
	});

	Route::post('register', 'RegisterController@register');

	Route::get('riddle/list', function() {
		return new RiddleResource(Riddle::all());
	});

	Route::post('riddle', 'RiddleController@create')->middleware('staff.check');

	Route::get('riddle/current', 'RiddleController@current');

	Route::get('riddle/{riddle}', 'RiddleController@read');

	Route::delete('riddle/{riddle}', 'RiddleController@delete')->middleware('staff.check');

	Route::post('riddle/{riddle}/submit', 'RiddleController@createSubmission');

	Route::group([
		'middleware' => 'staff.check'
	], function($router) {
		Route::get('user/list', 'UserController@list');
		Route::get('user/registrations', 'UserController@registrations');
		Route::put('user/{user}/approve', 'UserController@approve');
		Route::get('user/{user}', 'UserController@read');
		Route::delete('user/{user}', 'UserController@delete');
		Route::put('user/{user}/update', 'UserController@update');
	});