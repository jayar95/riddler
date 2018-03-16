<?php
	namespace App\Http\Controllers;

	use App\User;
	use Illuminate\Http\Request;

	class UserController extends Controller {
		public function list() {
			$users = User::where('active', 1)
				->get();

			return response()->json($users->toArray(), 200);
		}

		public function read(Request $request, User $user) {
			return response()->json($user->toArray(), 200);
		}

		public function delete(Request $request, User $user) {
			$user->delete();

			return response()->json([
				'message' => 'User deleted successfully',
			], 200);
		}

		public function registrations() {
			$users = User::where('active', 0)
				->get();

			return response()->json($users->toArray(), 200);
		}

		public function approve(Request $request, User $user) {
			$user->active = true;
			$user->save();

			return response()->json($user->toArray(), 200);
		}

		public function update(Request $request, User $user) {
			$this->validate($request, [
				'name' => 'required',
				'email' => 'required'
			]);

			$user->update([
				'name' => $request->get('name'),
				'email' => $request->get('email'),
			]);

			$user->save();

			return response()->json($user->toArray(), 200);
		}
	}