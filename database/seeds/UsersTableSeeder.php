<?php

	use Illuminate\Database\Seeder;
	use Illuminate\Support\Facades\DB;

	class UsersTableSeeder extends Seeder {
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run() {
			$company = DB::table('companies')->insertGetId([
					'company_name' => str_random(10),
				]);

			DB::table('users')->insert([
				'name' => str_random(10),
				'email' => 'text@example.com',
				'password' => bcrypt('password'),
				'company_id' => $company,
				'staff' => 0,
			]);
		}
	}
