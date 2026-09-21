<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Withdrawal;
use App\Support\Tenancy\TenantContext;

class WithdrawalPolicy
{
    public function view(User $user, Withdrawal $withdrawal): bool
    {
        return app(TenantContext::class)->has()
            && $withdrawal->tenant_id === app(TenantContext::class)->id();
    }

    public function update(User $user, Withdrawal $withdrawal): bool
    {
        return app(TenantContext::class)->has()
            && $withdrawal->tenant_id === app(TenantContext::class)->id();
    }

    public function delete(User $user, Withdrawal $withdrawal): bool
    {
        return app(TenantContext::class)->has()
            && $withdrawal->tenant_id === app(TenantContext::class)->id();
    }
}
