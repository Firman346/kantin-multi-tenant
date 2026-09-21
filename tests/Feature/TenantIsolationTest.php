<?php

namespace Tests\Feature;

use App\Models\Menu;
use App\Models\Tenant;
use App\Models\TenantOrder;
use App\Support\Tenancy\TenantContext;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TenantIsolationTest extends TestCase
{
    use RefreshDatabase;

    public function test_tenant_context_limits_tenant_order_query(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();

        app(TenantContext::class)->set($tenantA);

        TenantOrder::factory()->create([
            'tenant_id' => $tenantA->id,
        ]);

        app(TenantContext::class)->set($tenantB);

        TenantOrder::factory()->create([
            'tenant_id' => $tenantB->id,
        ]);

        app(TenantContext::class)->set($tenantA);

        $orders = TenantOrder::all();

        $this->assertCount(1, $orders);
        $this->assertEquals(
            $tenantA->id,
            $orders->first()->tenant_id
        );

        app(TenantContext::class)->clear();
    }

    public function test_tenant_context_limits_menu_query(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();

        app(TenantContext::class)->set($tenantA);

        $menuA = Menu::factory()->create([
            'tenant_id' => $tenantA->id,
        ]);

        app(TenantContext::class)->set($tenantB);

        $menuB = Menu::factory()->create([
            'tenant_id' => $tenantB->id,
        ]);

        app(TenantContext::class)->set($tenantA);

        $menus = Menu::all();

        $this->assertCount(1, $menus);

        $this->assertEquals(
            $menuA->id,
            $menus->first()->id
        );

        $this->assertNotEquals(
            $menuB->id,
            $menus->first()->id
        );

        app(TenantContext::class)->clear();
    }

    public function test_tenant_context_can_be_cleared(): void
    {
        $tenant = Tenant::factory()->create();

        app(TenantContext::class)->set($tenant);

        $this->assertTrue(
            app(TenantContext::class)->has()
        );

        app(TenantContext::class)->clear();

        $this->assertFalse(
            app(TenantContext::class)->has()
        );
    }
}
