<?php

	namespace App\Http\Controllers;

	use App\User;
	use Illuminate\Foundation\Auth\RegistersUsers;
	use Illuminate\Support\Facades\Validator;
	use Illuminate\Http\Request;
	use Illuminate\Auth\Events\Registered;

	class RegisterController extends Controller {
		use RegistersUsers;

		/**
		 * Create a new controller instance.
		 *
		 * @return void
		 */
		public function __construct() {
			$this->middleware('guest');
		}

		/**
		 * @param Request $request
		 *
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function register(Request $request) {
			$this->validator($request->all())->validate();

			$user = $this->create($request->all());
			event(new Registered($user));

			return response()->json([
				'success' => 'true',
			]);
		}

		/**
		 * Get a validator for an incoming registration request.
		 *
		 * @param  array $data
		 *
		 * @return \Illuminate\Contracts\Validation\Validator
		 */
		protected function validator(array $data) {
			return Validator::make($data, [
				'name' => 'required|string|max:255',
				'email' => 'required|string|email|max:255|unique:users',
				'password' => 'required|string|min:6',
			]);
		}

		/**
		 * Create a new user instance after a valid registration.
		 *
		 * @param  array $data
		 *
		 * @return \App\User
		 */
		protected function create(array $data) {
			return User::create([
				'name' => $data['name'],
				'email' => $data['email'],
				'password' => bcrypt($data['password']),
			]);
		}
	}
