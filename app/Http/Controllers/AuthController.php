<?php
	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use Illuminate\Http\JsonResponse;

	class AuthController extends Controller {
		/**
		 * AuthController constructor.
		 */
		public function __construct() {
			$this->middleware('auth:api', ['except' => ['login']]);
		}

		/**
		 * @param Request $request
		 *
		 * @return JsonResponse
		 */
		public function login(Request $request): JsonResponse {
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
		 * @return JsonResponse
		 */
		public function me(): JsonResponse {
			return response()->json(auth()->user());
		}

		/**
		 * @return JsonResponse
		 */
		public function logout(): JsonResponse {
			auth()->logout();

			return response()->json([
				'message' => 'Successfully logged out',
			]);
		}

		/**
		 * @return JsonResponse
		 */
		public function refresh(): JsonResponse {
			return $this->respondWithToken(auth()->refresh());
		}

		/**
		 * @param  string $token
		 *
		 * @return JsonResponse
		 */
		protected function respondWithToken($token): JsonResponse {
			return response()->json([
				'access_token' => $token,
				'token_type' => 'bearer',
				'expires_in' => auth()->factory()->getTTL() * 60,
			]);
		}
	}
