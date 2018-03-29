<?php

	namespace App\Mail;

	use App\User;
	use Illuminate\Bus\Queueable;
	use Illuminate\Mail\Mailable;
	use Illuminate\Queue\SerializesModels;

	class RegistrationNotificationMailable extends Mailable {
		use Queueable, SerializesModels;

		/**
		 * @var User
		 */
		protected $user;

		/**
		 * Create a new message instance.
		 * @param User $user
		 *
		 * @return void
		 */
		public function __construct(User $user) {
			$this->user = $user;
		}

		/**
		 * Build the message.
		 *
		 * @return $this
		 */
		public function build() {
			return $this->subject('New User Registration ' . $this->user->name)
				->view('emails.registration-notification');
		}
	}
