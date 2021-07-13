<?php

namespace App\Http\Middleware;

use App\Helpers\CustomDataBaseConnector;
use App\Models\Project;
use Closure;
use Illuminate\Http\Request;

class SwitchTenantMiddleWare
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
        $connector = new CustomDataBaseConnector();
        $project = Project::where('subdomain', $request->subdomain)->first();
        if (!$project) {
            abort(404, "Not Authorized");
        } else {
            $connector->configure($project->db_name)->use();
        }

        return $next($request);
    }
}
