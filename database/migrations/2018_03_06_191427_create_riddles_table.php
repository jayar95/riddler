<?php
	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;

	class CreateRiddlesTable extends Migration {
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up() {
			Schema::create('riddles', function(Blueprint $table) {
				//structure
				$table->increments('id');
				$table->longText('content')->nullable(false);
				$table->string('title', 255)->nullable(false);
				$table->integer('winner')->unsigned()->nullable(true);
				$table->integer('max_submission_count')->unsigned();
				$table->boolean('active')->default(false)->nullable(false);
				$table->softDeletes();
				$table->timestamps();

				//relationships'
				$table->foreign('winner')->references('id')->on('users');
			});
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down() {
			Schema::dropIfExists('riddles');
		}
	}
