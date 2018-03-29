<?php

	namespace App\Mail;

	use App\Riddle;
	use App\User;
	use Illuminate\Bus\Queueable;
	use Illuminate\Mail\Mailable;
	use Illuminate\Queue\SerializesModels;

	class WinnerNotificationMailable extends Mailable {
		use Queueable, SerializesModels;

		/**
		 * @var User
		 */
		protected $user;

		/**
		 * @var Riddle
		 */
		protected $riddle;

		protected $answer;

		/**
		 * Create a new message instance.
		 * @param User $user
		 *
		 * @return void
		 */
		public function __construct(User $user, Riddle $riddle, $answer) {
			$this->user = $user;
			$this->riddle = $riddle;
			$this->answer = $answer;
		}

		/**
		 * Build the message.
		 *
		 * @return $this
		 */
		public function build() {
			return $this->subject('New Riddle winner: ' . $this->user->name)
				->view('emails.winner-notification');
		}
	}
