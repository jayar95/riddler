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
	}
