<?php
	namespace App;

	use Tymon\JWTAuth\Contracts\JWTSubject;
	use Illuminate\Notifications\Notifiable;
	use Illuminate\Foundation\Auth\User as Authenticatable;

	class User extends Authenticatable implements JWTSubject {
		use Notifiable;

		/**
		 * The attributes that are mass assignable.
		 *
		 * @var array
		 */
		protected $fillable = [
			'name',
			'email',
			'password',
			'company_id',
			'staff',
			'position'
		];

		/**
		 * The attributes that should be hidden for arrays.
		 *
		 * @var array
		 */
		protected $hidden = [
			'password',
			'remember_token',
		];

		public function submissions() {
			return $this->hasMany('App\Submission');
		}

		public function riddles() {
			return $this->hasMany('App\Riddle', 'winner_id');
		}

		/**
		 * Get the identifier that will be stored in the subject claim of the JWT.
		 *
		 * @return mixed
		 */
		public function getJWTIdentifier() {
			return $this->getKey();
		}

		/**
		 * Return a key value array, containing any custom claims to be added to the JWT.
		 *
		 * @return array
		 */
		public function getJWTCustomClaims() {
			return [];
		}

		/**
		 * @return \Illuminate\Database\Eloquent\Relations\HasOne
		 */
		public function company() {
			return $this->hasOne('App\Company', 'id');
		}
	}
