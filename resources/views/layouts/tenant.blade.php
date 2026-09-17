<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Tenant - Kantin Multi-Tenant' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100 text-gray-900">

    <div x-data="{ sidebarOpen: true }" class="min-h-screen">

        <!-- Sidebar -->
        <aside
            class="fixed inset-y-0 left-0 z-40 w-64 border-r bg-white transition-transform duration-300"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        >
            <div class="flex h-16 items-center justify-between border-b px-4">
                <span class="text-lg font-bold">
                    Kantin
                </span>

                <button
                    type="button"
                    @click="sidebarOpen = false"
                    class="rounded-md px-3 py-2 text-sm hover:bg-gray-100"
                >
                    ✕
                </button>
            </div>

            <nav class="space-y-1 p-4">
                <a href="#"
                   class="block rounded-md px-3 py-2 text-sm hover:bg-gray-100">
                    Dashboard
                </a>

                <a href="#"
                   class="block rounded-md px-3 py-2 text-sm hover:bg-gray-100">
                    Menu
                </a>

                <a href="#"
                   class="block rounded-md px-3 py-2 text-sm hover:bg-gray-100">
                    Pesanan
                </a>

                <a href="#"
                   class="block rounded-md px-3 py-2 text-sm hover:bg-gray-100">
                    Laporan
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div
            class="min-h-screen transition-all duration-300"
            :class="sidebarOpen ? 'md:pl-64' : 'pl-0'"
        >

            <!-- Header -->
            <header class="flex h-16 items-center border-b bg-white px-4">
                <button
                    type="button"
                    @click="sidebarOpen = true"
                    class="rounded-md px-3 py-2 text-sm hover:bg-gray-100"
                >
                    ☰
                </button>

                <div class="ml-4">
                    <h1 class="font-semibold">
                        Dashboard Tenant
                    </h1>
                </div>
            </header>

            <!-- Content -->
            <main class="p-4 sm:p-6">
                {{ $slot ?? '' }}
                @yield('content')
            </main>

        </div>

    </div>

</body>
</html>