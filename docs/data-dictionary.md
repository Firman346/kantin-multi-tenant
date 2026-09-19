# Data Dictionary — Kantin Multi-Tenant

## 1. Pengelompokan 30 Tabel

### A. Tenancy, Pengguna, dan Akses

| Tabel | Scope | Keterangan |
|---|---|---|
| `canteens` | Platform-scoped | Data kantin utama |
| `users` | Platform-scoped | Data pengguna aplikasi |
| `tenants` | Tenant-owned | Tenant yang berada dalam kantin |
| `user_canteen_roles` | Platform-scoped | Relasi user dengan kantin |
| `tenant_balances` | Tenant-owned | Saldo milik tenant |
| `user_tenant_roles` | Tenant-owned | Relasi user dengan tenant |
| `tenant_bank_accounts` | Tenant-owned | Rekening bank milik tenant |

### B. Meja, QR, dan Sesi Anonim

| Tabel | Scope | Keterangan |
|---|---|---|
| `dining_tables` | Tenant-owned | Data meja pada tenant |
| `table_qr_tokens` | Tenant-owned | Token QR untuk meja |
| `customer_sessions` | Tenant-owned | Sesi pelanggan anonim |

### C. Katalog dan Konfigurasi Tenant

| Tabel | Scope | Keterangan |
|---|---|---|
| `tenant_operating_hours` | Tenant-owned | Jam operasional tenant |
| `commission_schemas` | Tenant-owned | Skema komisi tenant |
| `menu_categories` | Tenant-owned | Kategori menu |
| `modifier_groups` | Tenant-owned | Kelompok modifier |
| `menus` | Tenant-owned | Data menu |
| `modifier_options` | Tenant-owned | Pilihan modifier |
| `menu_modifier_groups` | Tenant-owned | Relasi menu dengan modifier group |

### D. Order dan Snapshot

| Tabel | Scope | Keterangan |
|---|---|---|
| `orders` | Platform-scoped | Induk checkout yang dapat memuat beberapa tenant |
| `tenant_orders` | Tenant-owned | Bagian order yang dimiliki tenant |
| `order_items` | Tenant-owned | Detail item pesanan |
| `order_item_modifiers` | Tenant-owned | Modifier pada item pesanan |
| `menu_stock_movements` | Tenant-owned | Pergerakan stok menu |

### E. Pembayaran dan Keuangan

| Tabel | Scope | Keterangan |
|---|---|---|
| `payments` | Platform-scoped | Data pembayaran |
| `payment_attempts` | Platform-scoped | Percobaan pembayaran |
| `payment_events` | Platform-scoped | Event pembayaran |
| `withdrawals` | Tenant-owned | Penarikan dana tenant |
| `ledger_entries` | Tenant-owned | Catatan transaksi keuangan tenant |

### F. Integrasi Asinkron dan Audit

| Tabel | Scope | Keterangan |
|---|---|---|
| `notification_deliveries` | Platform-scoped | Pengiriman notifikasi |
| `outbox_events` | Platform-scoped | Event untuk integrasi asinkron |
| `audit_logs` | Platform-scoped | Catatan audit perubahan sistem |

---

## 2. Aturan Tenant Ownership

Tabel yang bersifat tenant-owned menggunakan `tenant_id` sebagai penanda kepemilikan data.

Tabel platform-scoped tidak menggunakan `tenant_id` karena datanya berada pada lingkup platform.

Khusus tabel `orders`, `tenant_id` tidak ditempatkan pada tabel induk karena satu checkout dapat berisi pesanan dari beberapa tenant. Kepemilikan tenant disimpan pada `tenant_orders`.

---

## 3. Arah Dependensi Utama

Urutan pembuatan tabel mengikuti hubungan parent → child.

### Tenancy

`canteens`
→ `tenants`
→ `tenant_balances`

`users`
→ `user_canteen_roles`

`users`
→ `user_tenant_roles`

`tenants`
→ `tenant_bank_accounts`

### Meja dan Sesi

`tenants`
→ `dining_tables`
→ `table_qr_tokens`
→ `customer_sessions`

### Katalog

`tenants`
→ `tenant_operating_hours`

`tenants`
→ `commission_schemas`

`tenants`
→ `menu_categories`
→ `menus`

`tenants`
→ `modifier_groups`
→ `modifier_options`

`menus`
→ `menu_modifier_groups`

### Order

`orders`
→ `tenant_orders`
→ `order_items`
→ `order_item_modifiers`

`menus`
→ `menu_stock_movements`

### Payment

`orders`
→ `payments`
→ `payment_attempts`
→ `payment_events`

### Keuangan

`tenant_orders`
→ `ledger_entries`

`tenant_orders`
→ `withdrawals`

### Integrasi dan Audit

`outbox_events`
→ `notification_deliveries`

---

## 4. Composite Unique dan Composite Foreign Key

Composite unique digunakan ketika keunikan data harus berlaku dalam lingkup tertentu, terutama berdasarkan tenant atau canteen.

Pasangan yang perlu diperhatikan dari ERD:

- `tenants`: `(canteen_id, code/slug)`
- `dining_tables`: `(canteen_id, code)`
- `tenant_operating_hours`: `(tenant_id, day)`
- `menu_categories`: `(tenant_id, name)`

Composite foreign key digunakan untuk memastikan relasi tetap berada dalam scope tenant atau canteen yang sama.

Contoh pola:

`(tenant_id, menu_id)` → `(tenant_id, id)` pada `menus`.

Dengan demikian, `menu_id` milik tenant lain tidak dapat digunakan hanya dengan mengubah nilai `tenant_id`.

---

## 5. Prinsip Urutan Migration

Migration dibuat dari tabel parent menuju child.

Foreign key hanya dibuat setelah tabel yang dirujuk tersedia.

Rollback dilakukan dengan arah kebalikan dari urutan migration.