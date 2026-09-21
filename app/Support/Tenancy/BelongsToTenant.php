<?php

namespace App\Support\Tenancy;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait BelongsToTenant
{
    protected static function bootBelongsToTenant(): void
    {
        static::addGlobalScope('tenant', function (Builder $builder) {
            $context = app(TenantContext::class);

            if (! $context->has()) {
                return;
            }

            $builder->where(
                $builder->getModel()->qualifyColumn('tenant_id'),
                $context->id()
            );
        });

        static::creating(function (Model $model) {
            $context = app(TenantContext::class);

            if (! $context->has()) {
                throw new \RuntimeException(
                    'Tenant context belum diisi saat membuat data tenant.'
                );
            }

            $model->tenant_id = $context->id();
        });
    }
}
