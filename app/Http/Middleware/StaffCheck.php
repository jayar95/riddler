<?php

	namespace App\Http\Middleware;

	use App\Exceptions\PermissionDeniedException;

	use Closure;

	class StaffCheck {
		/**
		 * Handle an incoming request.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  \Closure                 $next
		 *
		 * @throws PermissionDeniedException
		 *
		 * @return mixed
		 */
		public function handle($request, Closure $next) {
			if (!auth()->user()->staff)
				throw new PermissionDeniedException();

			return $next($request);
		}
	}
