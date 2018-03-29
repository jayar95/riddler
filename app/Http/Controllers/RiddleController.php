<?php
	namespace App\Http\Controllers;

	use App\Events\SuccessfulRiddleSubmission;
	use App\Riddle;
	use App\RiddleAnswer;
	use App\Submission;
	use Illuminate\Http\JsonResponse;
	use Illuminate\Http\Request;

	class RiddleController extends Controller {
		/**
		 * @var array
		 */
		private $validateRiddleFields = [
			'content' => 'required',
			'title' => 'required',
			'max_submission_count' => 'required',
			'answers' => 'required'
		];

		/**
		 * @var array
		 */
		private $validateSubmissionFields = [
			'answer' => 'required',
		];

		/**
		 * RiddleController constructor.
		 */
		public function __construct() {
			$this->middleware('auth:api');
		}

		/**
		 * @param Request $request
		 *
		 * @return JsonResponse
		 */
		public function create(Request $request): JsonResponse {
			$this->validate($request, $this->validateRiddleFields);

			$riddle = Riddle::create([
				'content' => $request->get('content'),
				'title' => $request->get('title'),
				'max_submission_count' => $request->get('max_submission_count'),
			]);

			foreach ($request->get('answers') as $answer)
				RiddleAnswer::create([
					'riddle_id' => $riddle->id,
					'answer' => $answer,
				]);

			return response()->json($riddle->toArray(), 201);
		}

		/**
		 * @param Request $request
		 * @param Riddle  $riddle
		 *
		 * @return JsonResponse
		 */
		public function read(Request $request, Riddle $riddle): JsonResponse {
			return response()->json($riddle->toArray(), 200);
		}

		/**
		 * @param Request $request
		 * @param Riddle  $riddle
		 *
		 * @return JsonResponse
		 */
		public function update(Request $request, Riddle $riddle): JsonResponse {
			$this->validate($request, $this->validateRiddleFields);

			$riddle->update([
				'title' => $request->get('title'),
				'content' => $request->get('content'),
			]);

			$riddle->save();

			return response()->json($riddle->toArray(), 200);
		}

		public function setActive(Request $request, Riddle $riddle): JsonResponse {
			$oldRiddle = Riddle::where('active', true)->first();

			if ($oldRiddle) {
				$oldRiddle->active = false;

				$oldRiddle->save();
			}

			$riddle->active = true;

			$riddle->save();

			return response()->json($riddle->toArray(), 200);
		}

		/**
		 * @param Request $request
		 * @param Riddle  $riddle
		 *
		 * @return JsonResponse
		 * @throws \Exception
		 */
		public function delete(Request $request, Riddle $riddle): JsonResponse {
			$riddle->delete();

			return response()->json([
				'message' => 'Riddle deleted successfully',
			], 200);
		}

		/**
		 * @param Request $request
		 * @param Riddle  $riddle
		 *
		 * @return JsonResponse
		 */
		public function createSubmission(Request $request, Riddle $riddle): JsonResponse {
			$this->validate($request, $this->validateSubmissionFields);

			if ($riddle->maxSubmissionCount === $riddle->getSubmissionCountByUser(auth()->user()))
				return response()->json([
					'message' => 'Max submission limit reached.',
				], 200);

			$submission = Submission::create([
				'answer' => $request->get('answer'),
				'user_id' => auth()->user()->id,
				'riddle_id' => $riddle->id,
			]);

			$answerCorrect = false;
			if ($answers = $riddle->answers)
				foreach ($answers as $riddleAnswer)
					if ($riddleAnswer->answer === $submission->answer) {
						event(new SuccessfulRiddleSubmission($riddle, auth()->user(), $submission->answer));

						$answerCorrect = true;

						break;
					}

			return response()->json([
				'submission' => $submission->toArray(),
				'answerCorrect' => $answerCorrect
			], 201);
		}

		/**
		 * @param Request $request
		 * @param Riddle  $riddle
		 *
		 * @return JsonResponse
		 */
		public function createAnswer(Request $request, Riddle $riddle): JsonResponse {
			$this->validate($request, ['answer' => 'required']);

			$answer = RiddleAnswer::create([
				'answer' => $request->get('answer'),
				'riddle_id' => $riddle->id,
			]);

			return response()->json($answer->toJson(), 201);
		}

		/**
		 * @param Request $request
		 *
		 * @return JsonResponse
		 */
		public function current(Request $request): JsonResponse {
			/** @var Riddle $riddle */
			$riddle = Riddle::where('active', true)
				->first();

			$user = auth()->user();

			if ($riddle)
					$response = [
						'riddle' => $riddle->toArray(),
						'attempts_made' => $riddle->getSubmissionCountByUser($user),
						'submit_today' => $riddle->submittedToday($user)
					];
			else
				$response = ['message' => 'No current riddles'];

			return response()->json($response);
		}

		public function winners(): JsonResponse {

		}
	}
