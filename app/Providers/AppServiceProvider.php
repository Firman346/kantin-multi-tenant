<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\TenantOrder;
use App\Models\Withdrawal;
use App\Policies\MenuPolicy;
use App\Policies\TenantOrderPolicy;
use App\Policies\WithdrawalPolicy;
use App\Support\Tenancy\TenantContext;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->scoped(
            TenantContext::class,
            fn () => new TenantContext,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Menu::class, MenuPolicy::class);
        Gate::policy(TenantOrder::class, TenantOrderPolicy::class);
        Gate::policy(Withdrawal::class, WithdrawalPolicy::class);
    }
}
