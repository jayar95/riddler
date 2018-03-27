<?php
	namespace App;

	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\Relations\BelongsTo;

	class RiddleAnswer extends Model {
		protected $fillable = [
			'riddle_id',
			'answer',
		];

		public $timestamps = false;

		/**
		 * @return BelongsTo
		 */
		public function riddle(): BelongsTo {
			return $this->belongsTo('App\Riddle');
		}
	}
