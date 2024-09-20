<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Tenant;

class IdentifyTenantByDomain
{
    public function handle($request, Closure $next)
    {
        $host = $request->getHost();
        $tenant = Tenant::where('domain', $host)->firstOrFail();

        if ($tenant) {
            $tenant->makeCurrent();
        } else {
            abort(404);
        }

        return $next($request);
    }
}
