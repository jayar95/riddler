<?php
	namespace App\Http\Controllers;

	use Illuminate\Http\Request;

	class AuthController extends Controller {
		/**
		 * @return void
		 */
		public function __construct() {
			$this->middleware('auth:api', ['except' => ['login']]);
		}

		/**
		 * @param Request $request
		 *
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function login(Request $request) {
			$this->validate($request, [
				'email' => 'required',
				'password' => 'required'
			]);

			$credentials = [
				'email' => $request->get('email'),
				'password' => $request->get('password'),
			];

			if (!$token = auth()->attempt($credentials))
				return response()->json(['error' => 'Unauthorized'], 401);

			return $this->respondWithToken($token);
		}

		/**
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function me() {
			return response()->json(auth()->user());
		}

		/**
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function logout() {
			auth()->logout();

			return response()->json([
				'message' => 'Successfully logged out',
			]);
		}

		/**
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function refresh() {
			return $this->respondWithToken(auth()->refresh());
		}

		/**
		 * @param  string $token
		 *
		 * @return \Illuminate\Http\JsonResponse
		 */
		protected function respondWithToken($token) {
			return response()->json([
				'access_token' => $token,
				'token_type' => 'bearer',
				'expires_in' => auth()->factory()->getTTL() * 60,
			]);
		}
	}
