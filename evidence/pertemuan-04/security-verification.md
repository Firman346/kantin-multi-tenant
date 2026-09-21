# Security Verification — Pertemuan 04

## Tenant Isolation

Implementasi tenant isolation dilakukan menggunakan beberapa lapisan keamanan:

1. `TenantContext` digunakan untuk menyimpan tenant aktif selama request.
2. Middleware `SetTenantContext` menentukan tenant berdasarkan `{tenant:slug}`.
3. Model tenant-owned menggunakan trait `BelongsToTenant`.
4. Global scope membatasi query berdasarkan `tenant_id`.
5. Event `creating` mengisi `tenant_id` secara otomatis dari `TenantContext`.
6. Policy digunakan untuk memastikan objek hanya dapat diakses oleh tenant yang sesuai.
7. Public catalog menggunakan `PublicCatalogQuery` sebagai bypass terkontrol terhadap global scope.

## Verification Result

### Tenant Context

`TenantContext` berhasil di-resolve melalui Laravel container dan menggunakan scoped binding sehingga context tidak dibagikan antar-request.

### Middleware

Route tenant menggunakan middleware:

- `auth`
- `verified`
- `role:tenant`
- `tenant.context`

Tenant ditentukan melalui route parameter `{tenant:slug}`.

### Global Scope

Trait `BelongsToTenant` menerapkan global scope berdasarkan `tenant_id`.

Contoh:

```php
$builder->where(
    $builder->getModel()->qualifyColumn('tenant_id'),
    $context->id()
);