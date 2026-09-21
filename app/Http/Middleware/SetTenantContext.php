<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use App\Support\Tenancy\TenantContext;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetTenantContext
{
    public function handle(
        Request $request,
        Closure $next,
        TenantContext $tenantContext
    ): Response {
        $tenantSlug = $request->route('tenant');

        if (! $tenantSlug) {
            abort(404, 'Tenant tidak ditemukan.');
        }

        $tenant = Tenant::where('slug', $tenantSlug)
            ->where('status', 'aktif')
            ->first();

        if (! $tenant) {
            abort(404, 'Tenant tidak ditemukan atau tidak aktif.');
        }

        $tenantContext->set($tenant);

        try {
            return $next($request);
        } finally {
            $tenantContext->clear();
        }
    }
}
