<?php
	namespace App;

	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\Relations\BelongsTo;

	class Submission extends Model {
		/**
		 * @var array
		 */
		protected $fillable = [
			'user_id',
			'answer',
			'riddle_id'
		];

		/**
		 * @return BelongsTo
		 */
		public function user(): BelongsTo {
			return $this->belongsTo('App\User');
		}
	}
