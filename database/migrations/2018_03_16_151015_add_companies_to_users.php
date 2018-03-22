<?php

	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;

	class AddCompaniesToUsers extends Migration {
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up() {
			Schema::table('users', function(Blueprint $table) {
				$table->integer('company_id')->unsigned();
				$table->text('position', 255);

				//relationships'
				$table->foreign('company_id')->references('id')->on('companies');
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
