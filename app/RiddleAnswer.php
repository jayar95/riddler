<?php
	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class RiddleAnswer extends Model {
		protected $fillable = [
			'riddle_id',
			'answer',
		];

		/**
		 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
		 */
		public function riddle() {
			return $this->belongsTo('App\Riddle');
		}
	}
