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

	Route::get('riddle/{riddle}', 'RiddleController@read');

	Route::delete('riddle/{riddle}', 'RiddleController@delete')->middleware('staff.check');

	Route::post('riddle/{riddle}/submissions', 'RiddleController@createSubmission')->middleware('staff.check');

	Route::post('riddle/{riddle}/riddle-answer')->middleware('staff.check');