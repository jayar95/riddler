<?php
	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class Company extends Model {
		protected $fillable = [
			'company_name',
			'address_line_one',
			'address_line_two',
			'city',
			'state',
			'zip_code'
		];

		protected $dates = ['deleted_at'];
	}