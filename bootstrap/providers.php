<?php

use App\Providers\AdminServiceProvider;
use App\Providers\AppServiceProvider;
use App\Providers\CatalogServiceProvider;
use App\Providers\KitchenServiceProvider;
use App\Providers\ModuleServiceProvider;
use App\Providers\OrderingServiceProvider;
use App\Providers\PaymentsServiceProvider;
use App\Providers\ReportingServiceProvider;
use App\Providers\VoltServiceProvider;

return [
    AdminServiceProvider::class,
    AppServiceProvider::class,
    CatalogServiceProvider::class,
    KitchenServiceProvider::class,
    ModuleServiceProvider::class,
    OrderingServiceProvider::class,
    PaymentsServiceProvider::class,
    ReportingServiceProvider::class,
    VoltServiceProvider::class,
];
