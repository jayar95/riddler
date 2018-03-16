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

		/**
		 * SuccessfulRiddleSubmission constructor.
		 *
		 * @param Riddle $riddle
		 * @param User   $winner
		 */
		public function __construct(Riddle $riddle, User $winner) {
			$this->riddle = $riddle;

			$this->winner = $winner;
		}
	}
