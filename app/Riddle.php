<?php
	namespace App;

	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\SoftDeletes;

	class Riddle extends Model {
		use SoftDeletes;

		/**
		 * @var array
		 */
		protected $fillable = [
			'content',
			'title',
			'winner',
			'active',
			'max_submission_count'
		];

		/**
		 * @var array
		 */
		protected $dates = ['deleted_at'];

		/**
		 * @return \Illuminate\Database\Eloquent\Relations\HasOne
		 */
		public function winner() {
			return $this->hasOne('App\User', 'winner');
		}

		public function answers() {
			return $this->hasMany('App\RiddleAnswer');
		}

		public function submissions() {
			return $this->hasMany('App\Submission');
		}

		/**
		 * @return int
		 */
		public function getSubmissionCount(): int {
			return Submission::where('riddle_id', $this->id)
				 ->count();
		}

		/**
		 * @param User $user
		 *
		 * @return int
		 */
		public function getSubmissionCountByUser(User $user): int {
			return Submission::where('riddle_id', $this->id)
				->where('user_id', $user->id)
				->count();
		}

		/**
		 * @param User $user
		 *
		 * @return bool
		 */
		public function submittedToday(User $user): bool {
			$submission = Submission::where('riddle_id', $this->id)
				->where('user_id', $user->id)
				->orderBy('id', 'desc')
				->first();

			if (!$submission)
				return false;

			$lastSubmit = (new \DateTime($submission->created_at))->format('Y-m-d');

			$tz = new \DateTimeZone(config('app.timezone'));
			$today = (new \DateTime())->setTimezone($tz)->format('Y-m-d');

			return ($lastSubmit === $today);
		}
	}
