<?php

namespace App\Policies;

use App\Models\Menu;
use App\Models\User;
use App\Support\Tenancy\TenantContext;

class MenuPolicy
{
    public function view(User $user, Menu $menu): bool
    {
        return app(TenantContext::class)->has()
            && $menu->tenant_id === app(TenantContext::class)->id();
    }

    public function update(User $user, Menu $menu): bool
    {
        return app(TenantContext::class)->has()
            && $menu->tenant_id === app(TenantContext::class)->id();
    }

    public function delete(User $user, Menu $menu): bool
    {
        return app(TenantContext::class)->has()
            && $menu->tenant_id === app(TenantContext::class)->id();
    }
}
