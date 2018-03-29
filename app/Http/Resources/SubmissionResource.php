<?php

	namespace App\Http\Resources;

	use Illuminate\Http\Resources\Json\JsonResource;

	class SubmissionResource extends JsonResource {
		/**
		 * Transform the resource into an array.
		 *
		 * @param  \Illuminate\Http\Request $request
		 *
		 * @return array
		 */
		public function toArray($request) {
			return [
				'id' => $this->id,
				'user_id' => $this->user,
				'riddle' => $this->riddle,
				'answer' => $this->answer,
				'created_at' => $this->created_at,
			];
		}
	}
