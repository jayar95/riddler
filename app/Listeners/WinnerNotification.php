<?php
	namespace App\Listeners;

	use App\Events\SuccessfulRiddleSubmission;
	use App\Mail\WinnerNotificationMailable;
	use App\User;
	use Illuminate\Support\Facades\Mail;

	class WinnerNotification {
		/**
		 * WinnerNotification constructor.
		 * @return void
		 */
		public function __construct() {
		}

		/**
		 * @param SuccessfulRiddleSubmission $event
		 */
		public function handle(SuccessfulRiddleSubmission $event) {
			$staffGroup = User::where('staff', true)->get();

			if ($staffGroup)
				/** @var User $staff */
				foreach ($staffGroup as $staff)
					Mail::to($staff)
						->queue(new WinnerNotificationMailable($event->winner, $event->riddle, $event->answer));
		}
	}