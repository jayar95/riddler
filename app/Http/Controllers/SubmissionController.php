<?php

	namespace App\Http\Controllers;

	use App\Submission;
	use Illuminate\Http\Request;

	class SubmissionController extends Controller {
		/**
		 * @var array
		 */
		private $validateFields = [
			'answer' => 'required',
		];

		public function __contruct() {
			$this->middleware('auth:api');
		}

		/**
		 * @param Request $request
		 *
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function create(Request $request) {
			$this->validate($request, $this->validateFields);

			$submission = Submission::create([
				'answer' => $request->get('answer'),
				'user_id' => auth()->user()->id,
			]);

			return response()->json($submission->toJson(), 201);
		}
	}
