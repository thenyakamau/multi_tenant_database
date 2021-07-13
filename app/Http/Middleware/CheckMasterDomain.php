<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckMasterDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if ($request->getHost() != config('tenant.master_domain')) {
            abort(401, "Unauthorized Access");
        }

        return $next($request);
    }
}
