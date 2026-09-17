<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Admin - Kantin Multi-Tenant' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100 text-gray-900">

    <!-- Header -->
    <header class="border-b bg-white">
        <div class="mx-auto flex min-h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <h1 class="text-lg font-bold">
                Admin Kantin Multi-Tenant
            </h1>

            <nav class="flex items-center gap-2">
                <a href="{{ route('admin.dashboard') }}"
                   class="rounded-md px-3 py-2 text-sm hover:bg-gray-100">
                    Dashboard
                </a>

                <a href="{{ route('customer.home') }}"
                   class="rounded-md px-3 py-2 text-sm hover:bg-gray-100">
                    Customer
                </a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

        {{ $slot ?? '' }}

        @yield('content')

        <!-- Contoh tabel responsif -->
        <section class="mt-6 rounded-lg bg-white p-4 shadow-sm">

            <h2 class="mb-4 text-base font-semibold">
                Data Pengguna
            </h2>

            <div class="w-full overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="border-b bg-gray-50">
                        <tr>
                            <th class="whitespace-nowrap px-4 py-3 font-semibold">
                                Nama
                            </th>
                            <th class="whitespace-nowrap px-4 py-3 font-semibold">
                                Email
                            </th>
                            <th class="whitespace-nowrap px-4 py-3 font-semibold">
                                Role
                            </th>
                            <th class="whitespace-nowrap px-4 py-3 font-semibold">
                                Status
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="border-b">
                            <td class="whitespace-nowrap px-4 py-3">
                                Contoh User
                            </td>

                            <td class="whitespace-nowrap px-4 py-3">
                                user@example.com
                            </td>

                            <td class="whitespace-nowrap px-4 py-3">
                                Admin
                            </td>

                            <td class="whitespace-nowrap px-4 py-3">
                                <x-status-badge status="aktif" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </section>

    </main>

</body>
</html>