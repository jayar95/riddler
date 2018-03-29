<?php
	namespace App\Events;

	use App\Riddle;
	use App\User;
	use Illuminate\Queue\SerializesModels;
	use Illuminate\Foundation\Events\Dispatchable;
	use Illuminate\Broadcasting\InteractsWithSockets;

	class SuccessfulRiddleSubmission {
		use Dispatchable, InteractsWithSockets, SerializesModels;

		/** @var Riddle $riddle */
		public $riddle;

		/** @var User $winner */
		public $winner;

		public $answer;

		/**
		 * SuccessfulRiddleSubmission constructor.
		 *
		 * @param Riddle $riddle
		 * @param User   $winner
		 * @param string $answer
		 */
		public function __construct(Riddle $riddle, User $winner, $answer) {
			$this->riddle = $riddle;

			$this->winner = $winner;

			$this->answer = $answer;
		}
	}
