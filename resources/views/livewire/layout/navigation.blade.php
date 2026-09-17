<nav x-data="{ open: false }" class="border-b border-gray-100 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">

            <div class="flex">
                <div class="flex shrink-0 items-center">
                    <a href="{{ route('customer.home') }}">
                        <span class="text-lg font-bold text-gray-800">
                            Kantin Multi-Tenant
                        </span>
                    </a>
                </div>

                @auth
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                        @if (auth()->user()->role === 'customer')
                            <x-nav-link
                                :href="route('customer.home')"
                                :active="request()->routeIs('customer.home')"
                            >
                                {{ __('Customer') }}
                            </x-nav-link>
                        @endif

                        @if (auth()->user()->role === 'admin')
                            <x-nav-link
                                :href="route('admin.dashboard')"
                                :active="request()->routeIs('admin.dashboard')"
                            >
                                {{ __('Admin Dashboard') }}
                            </x-nav-link>
                        @endif

                        @if (auth()->user()->role === 'tenant')
                            <span class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500">
                                Tenant
                            </span>
                        @endif

                    </div>
                @endauth
            </div>

            @auth
                <div class="hidden sm:ms-6 sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">

                        <x-slot name="trigger">
                            <button
                                type="button"
                                class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                            >
                                <div>{{ auth()->user()->name }}</div>

                                <div class="ms-1">
                                    <svg
                                        class="h-4 w-4 fill-current"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <x-dropdown-link :href="route('profile')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button
                                    type="submit"
                                    class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
                                >
                                    {{ __('Log Out') }}
                                </button>
                            </form>

                        </x-slot>

                    </x-dropdown>
                </div>
            @endauth

        </div>
    </div>
</nav>