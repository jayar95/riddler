<?php
	namespace App\Listeners;

	use App\Events\SuccessfulRiddleSubmission;
	use App\User;
	use Illuminate\Queue\InteractsWithQueue;
	use Illuminate\Contracts\Queue\ShouldQueue;

	class CompleteRiddle {
		/**
		 * Create the event listener.
		 *
		 * @return void
		 */
		public function __construct() {
			//
		}

		/**
		 * Handle the event.
		 *
		 * @param  SuccessfulRiddleSubmission $event
		 *
		 * @return void
		 */
		public function handle(SuccessfulRiddleSubmission $event) {
			/** @var User $winner */
			$winner = $event->winner;
			$riddle = $event->riddle;

			$riddle->winner_id = $winner->id;
			$riddle->save();
		}
	}
