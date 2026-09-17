<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Kantin Multi-Tenant' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-50 text-gray-900">

    <header class="border-b bg-white">
        <div class="mx-auto flex min-h-11 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <a href="{{ route('customer.home') }}"
               class="text-lg font-bold">
                Kantin Multi-Tenant
            </a>

            <nav class="flex items-center gap-2">
                <a href="{{ route('login') }}"
                   class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-100">
                    Login
                </a>

                <a href="{{ route('register') }}"
                   class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-100">
                    Register
                </a>
            </nav>
        </div>
    </header>

    <main class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

</body>
</html>