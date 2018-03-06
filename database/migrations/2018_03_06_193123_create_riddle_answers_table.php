<?php

	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;

	class CreateRiddleAnswersTable extends Migration {
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up() {
			Schema::create('riddle_answers', function(Blueprint $table) {
				//structure
				$table->increments('id');
				$table->integer('riddle_id')->unsigned()->nullable(false);
				$table->text('answer', 255)->nullable(false);

				//relationships
				$table->foreign('riddle_id')->references('id')->on('riddles');
			});
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down() {
			Schema::dropIfExists('riddle_answers');
		}
	}
