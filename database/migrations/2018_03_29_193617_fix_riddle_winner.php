<?php

	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;

	class FixRiddleWinner extends Migration {
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up() {
			Schema::table('riddles', function (Blueprint $table) {
				$table->dropForeign('riddles_winner_foreign');

				$table->renameColumn('winner', 'winner_id');

				$table->foreign('winner_id')->references('id')->on('users');
			});
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down() {
			//
		}
	}
