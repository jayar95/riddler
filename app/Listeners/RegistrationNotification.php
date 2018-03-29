<?php
	namespace App\Listeners;

	use App\User;
	use Illuminate\Auth\Events\Registered;
	use Illuminate\Support\Facades\Mail;
	use App\Mail\RegistrationNotificationMailable;

	class RegistrationNotification {
		/**
		 * NewRegistration constructor.
		 * @return void
		 */
		public function __construct() {
		}

		/**
		 * @param Registered $event
		 */
		public function handle(Registered $event) {
			$staffGroup = User::where('staff', true)->get();

			if ($staffGroup)
				/** @var User $staff */
				foreach ($staffGroup as $staff)
					Mail::to($staff)
						->queue(new RegistrationNotificationMailable($event->user));
		}
	}