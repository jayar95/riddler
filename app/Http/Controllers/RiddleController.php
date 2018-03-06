<?php
	namespace App\Http\Controllers;

	use App\Exceptions\PermissionDeniedException;
	use App\Riddle;
	use App\User;
	use Illuminate\Http\Request;

	class RiddleController extends Controller {
		/**
		 * @var User $user
		 */
		private $user;

		public function __construct() {
			$this->middleware('auth:api');
			$this->user = auth()->user();
		}

		public function create(Request $request) {
			$this->validate($request, [
				'content' => 'required',
				'title' => 'required',
			]);

			if (!$this->user->staff)
				throw new PermissionDeniedException();

			//TODO
			$riddle = Riddle::create([]);
		}
	}
