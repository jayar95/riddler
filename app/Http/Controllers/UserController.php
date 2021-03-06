<?php
	namespace App\Http\Controllers;

	use App\Exceptions\PermissionDeniedException;
	use App\Http\Resources\SubmissionResource;
	use App\Http\Resources\UserResource;
	use App\Mail\RegistrationApproved;
	use App\User;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Mail;

	class UserController extends Controller {
		public function list() {
			$users = User::where('approved', true)
				->where('staff', false)
				->with('company')
				->get();

			return response()->json(UserResource::collection($users), 200);
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
			$users = User::where('approved', false)
				->where('staff', false)
				->with('company')
				->get();

			return response()->json(UserResource::collection($users), 200);
		}

		public function approve(Request $request, User $user) {
			$user->approved = true;
			$user->save();

			Mail::to($user)->send(new RegistrationApproved());

			return response()->json($user->toArray(), 200);
		}

		public function setStaff(Request $request, User $user) {
			$user->staff = true;
			$user->approved = true;
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

		public function submissions(User $user) {
			if ($user->id !== auth()->user()->id || !auth()->user()->staff)
				throw new PermissionDeniedException();

			return SubmissionResource::collection($user->submissions);
		}
	}