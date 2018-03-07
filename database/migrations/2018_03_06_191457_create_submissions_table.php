<?php

	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;

	class CreateSubmissionsTable extends Migration {
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up() {
			Schema::create('submissions', function(Blueprint $table) {
				//structure
				$table->increments('id');
				$table->integer('user_id')->unsigned()->nullable(false);
				$table->text('answer', 255)->nullable(false);
				$table->timestamps();

				//relationships
				$table->foreign('user_id')->references('id')->on('users');
			});
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down() {
			Schema::dropIfExists('submissions');
		}
	}
