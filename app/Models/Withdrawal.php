<?php

namespace App\Models;

use App\Support\Tenancy\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use BelongsToTenant, HasFactory;

    protected $fillable = [
        'tenant_bank_account_id',
        'verified_by',
        'idempotency_key',
        'amount',
        'status',
        'transfer_reference',
        'bank_account_snapshot',
        'processed_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'processed_at' => 'datetime',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function tenantBankAccount()
    {
        return $this->belongsTo(TenantBankAccount::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function ledgerEntries()
    {
        return $this->hasMany(LedgerEntry::class);
    }
}
