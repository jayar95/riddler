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
		public $user;

		/**
		 * @var Riddle
		 */
		public $riddle;

		public $answer;

		/**
		 * Create a new message instance.
		 * @param User $user
		 * @param Riddle $riddle
		 * @param string $answer
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
