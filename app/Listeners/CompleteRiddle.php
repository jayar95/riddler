<?php
	namespace App\Listeners;

	use App\Events\SuccessfulRiddleSubmission;
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
			$winner = $event->winner;
			$riddle = $event->riddle;

			$riddle->winner = $winner->id;
			$riddle->save();
		}
	}
