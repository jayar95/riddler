<?php
	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class Riddle extends Model {
		protected $fillable = [
			'content',
			'title',
			'winner',
		];

		/**
		 * @return \Illuminate\Database\Eloquent\Relations\HasOne
		 */
		public function winner() {
			return $this->hasOne('App\User', 'winner');
		}
	}
