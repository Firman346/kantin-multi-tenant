@extends('layouts.admin')

@section('content')
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">

        <div class="rounded-lg bg-white p-6 shadow-sm">
            <p class="text-sm text-gray-500">Total Tenant</p>
            <p class="mt-2 text-2xl font-bold">
                {{ \App\Models\Tenant::count() }}
            </p>
        </div>

        <div class="rounded-lg bg-white p-6 shadow-sm">
            <p class="text-sm text-gray-500">Status Sistem</p>
            <div class="mt-2">
                <x-status-badge status="aktif" />
            </div>
        </div>

        <div class="rounded-lg bg-white p-6 shadow-sm">
            <p class="text-sm text-gray-500">Role Anda</p>
            <p class="mt-2 text-2xl font-bold">
                {{ ucfirst(auth()->user()->role) }}
            </p>
        </div>

    </div>

    <div class="mt-6">
        <x-empty-state
            title="Belum ada data tenant"
            message="Data tenant akan ditampilkan di area administrasi."
        />
    </div>
@endsection