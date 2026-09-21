<?php

namespace App\Policies;

use App\Models\TenantOrder;
use App\Models\User;
use App\Support\Tenancy\TenantContext;

class TenantOrderPolicy
{
    public function view(User $user, TenantOrder $tenantOrder): bool
    {
        return app(TenantContext::class)->has()
            && $tenantOrder->tenant_id === app(TenantContext::class)->id();
    }

    public function update(User $user, TenantOrder $tenantOrder): bool
    {
        return app(TenantContext::class)->has()
            && $tenantOrder->tenant_id === app(TenantContext::class)->id();
    }

    public function delete(User $user, TenantOrder $tenantOrder): bool
    {
        return app(TenantContext::class)->has()
            && $tenantOrder->tenant_id === app(TenantContext::class)->id();
    }
}
