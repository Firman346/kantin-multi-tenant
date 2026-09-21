# ADR 0008 — Tenant Isolation

## Status

Accepted

## Context

Aplikasi menggunakan arsitektur multi-tenant sehingga data yang dimiliki oleh satu tenant tidak boleh dapat diakses atau dimodifikasi oleh tenant lain.

Tenant aktif ditentukan melalui `TenantContext` dan diterapkan pada request melalui middleware `SetTenantContext`.

Model yang memiliki data tenant menggunakan trait `BelongsToTenant` untuk menerapkan pembatasan query berdasarkan `tenant_id`.

## Decision

Tenant isolation diterapkan menggunakan beberapa lapisan:

1. `TenantContext` menyimpan tenant aktif selama request.
2. `SetTenantContext` menentukan tenant berdasarkan route parameter `{tenant:slug}`.
3. Model tenant-owned menggunakan trait `BelongsToTenant`.
4. Global scope membatasi query berdasarkan `tenant_id`.
5. Data baru mendapatkan `tenant_id` dari `TenantContext`.
6. Policy digunakan untuk memvalidasi akses terhadap resource tenant.
7. Nested route menggunakan `scopeBindings()` untuk membantu mencegah cross-tenant route binding.
8. Bypass global scope hanya diperbolehkan pada kebutuhan yang memang membutuhkan akses lintas tenant.
9. Public catalog menggunakan `PublicCatalogQuery` sebagai lokasi bypass yang terkontrol.

## Tenant-Scoped Models

Model yang menggunakan tenant isolation antara lain:

- `TenantOrder`
- `Menu`
- `MenuCategory`
- `ModifierGroup`
- `Withdrawal`
- `TenantBankAccount`
- `LedgerEntry`
- `CommissionSchema`
- `AuditLog`
- `MenuModifierGroup`
- `TenantBalance`
- `TenantOperatingHour`

Model yang tidak memiliki `tenant_id` secara langsung mengikuti relasi parent atau struktur data yang telah ditentukan.

## Controlled Bypass

Penggunaan `withoutGlobalScopes()` dibatasi pada:

```text
app/Modules/Catalog/Services/PublicCatalogQuery.php