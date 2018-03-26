<?php

	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;

	class CreateCompaniesTable extends Migration {
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up() {
			Schema::create('companies', function(Blueprint $table) {
				$table->increments('id');
				$table->text('company_name');
				$table->text('address_line_one');
				$table->text('address_line_two')->nullable();
				$table->text('city');
				$table->text('zip_code');
				$table->text('state');
				$table->timestamps();
				$table->softDeletes();
			});
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down() {
			Schema::dropIfExists('companies');
		}
	}
