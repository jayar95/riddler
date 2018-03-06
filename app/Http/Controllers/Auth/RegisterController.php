<?php

	namespace App\Http\Controllers\Auth;

	use App\User;
	use App\Http\Controllers\Controller;
	use Illuminate\Support\Facades\Validator;
	use Illuminate\Http\Request;

	class RegisterController extends Controller {
		/**
		 * Create a new controller instance.
		 *
		 * @return void
		 */
		public function __construct() {
			$this->middleware('guest');
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
				'password' => 'required|string|min:6|confirmed',
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

		/**
		 * Handle a registration request for the application.
		 *
		 * @param  \Illuminate\Http\Request $request
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function register(Request $request) {
			$this->validator($request->all())->validate();

			event(new Registered($user = $this->create($request->all())));

			$this->guard()->login($user);

			return $this->registered($request, $user)
				?: redirect($this->redirectPath());
		}

		/**
		 * Get the guard to be used during registration.
		 *
		 * @return \Illuminate\Contracts\Auth\StatefulGuard
		 */
		protected function guard() {
			return Auth::guard();
		}

		/**
		 * The user has been registered.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  mixed                    $user
		 *
		 * @return mixed
		 */
		protected function registered(Request $request, $user) {
			//
		}
	}
