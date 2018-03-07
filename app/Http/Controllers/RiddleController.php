<?php
	namespace App\Http\Controllers;

	use App\Riddle;
	use Illuminate\Http\Request;

	class RiddleController extends Controller {
		public function __construct() {
			$this->middleware('auth:api');

			$this->middleware('staff.check');
		}

		public function create(Request $request) {
			$this->validate($request, [
				'content' => 'required',
				'title' => 'required',
			]);

			$riddle = Riddle::create([
				'content' => $request->get('content'),
				'title' => $request->get('title'),
			]);

			return $riddle->toJson();
		}
	}
