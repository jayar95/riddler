<?php
	namespace App\Http\Resources;

	use Illuminate\Http\Resources\Json\JsonResource;

	class RiddleResource extends JsonResource {
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
				'active' => $this->active,
				'content' => $this->content,
				'created_at' => $this->created_at,
				'deleted_at' => $this->deleted_at,
				'max_submission_count' => $this->max_submission_count,
				'title' => $this->title,
				'updated_at' => $this->updated_at,
				'winner' => new UserResource($this->winner),
				'submission_count' => $this->getSubmissionCount()
			];
		}
	}
