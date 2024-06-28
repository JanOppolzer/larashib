<header>

    <noscript>
        <div class="text-red-50 py-4 font-bold bg-red-700">
            <div class="flex items-center max-w-screen-xl px-4 mx-auto space-x-4">
                <div class="p-2 bg-red-900 rounded">
                    <svg class="text-red-50 w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                    </svg>
                </div>
                <p>
                    <span class="sm:hidden">{{ __('common.javascript_short') }}</span>
                    <span class="sm:inline hidden">{{ __('common.javascript_long') }}</span>
                </p>
            </div>
        </div>
    </noscript>

    <div class="md:h-16 bg-gray-200">
        <div class="md:pl-4 h-full max-w-screen-xl mx-auto">
            <nav class="md:flex-row md:items-center flex flex-col justify-between h-full">

                <div class="md:flex-row md:items-center flex flex-col">
                    <p class="flex items-center h-16">
                        <a class="inline-block px-4 py-2 text-lg font-bold" href="/">{{ config('app.name') }}</a>
                    </p>
                    <ul class="md:flex md:flex-row flex-col hidden" id="navigation">
                        <li>
                            <a class="md:inline-block md:rounded block px-4 py-2 @if (Request::segment(1) === 'organizations') bg-gray-400 text-gray-900 @else hover:bg-gray-400 hover:text-gray-900 @endif"
                                href="#">Link</a>
                        </li>
                        <li>
                            <a class="md:inline-block md:rounded block px-4 py-2 @if (Request::segment(1) === 'users' and Request::segment(2) == Auth::id()) bg-gray-400 text-gray-900 @else hover:bg-gray-400 hover:text-gray-900 @endif"
                                href="{{ route('users.show', Auth::id()) }}">{{ __('common.my_profile') }}</a>
                        </li>
                        @can('do-everything')
                            <li>
                                <a class="md:inline-block md:rounded block px-4 py-2 @if (Request::segment(1) === 'users' and Request::segment(2) != Auth::id()) bg-gray-400 text-gray-900 @else hover:bg-gray-400 hover:text-gray-900 @endif"
                                    href="{{ route('users.index') }}">{{ __('common.users') }}</a>
                            </li>
                        @endcan
                    </ul>
                </div>

                <div class="md:flex-row flex flex-col">
                    <ul class="md:pr-4 md:flex md:flex-row md:text-sm md:items-center flex-col hidden" id="profile">
                        <li>
                            @if (App::currentLocale() === 'cs')
                                <a class="md:inline-block md:rounded hover:bg-gray-400 hover:text-gray-900 block px-4 py-2"
                                    href="/language/en" title="{{ __('common.swith_to_english') }}">
                                    {{ __('common.en') }}
                                </a>
                            @else
                                <a class="md:inline-block md:rounded hover:bg-gray-400 hover:text-gray-900 block px-4 py-2"
                                    href="/language/cs" title="{{ __('common.prepnout_do_cestiny') }}">
                                    {{ __('common.cs') }}
                                </a>
                            @endif

                            <a class="md:inline-block md:rounded hover:bg-gray-400 hover:text-gray-900 whitespace-nowrap block px-4 py-2"
                                @env(['local', 'testing']) href="/fakelogout"
                                @else href="#" @endenv>
                                {{ __('common.logout') }}
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="md:hidden top-3 right-4 absolute block">
                    <button
                        onclick="document.querySelector('#navigation').classList.toggle('hidden');
                        document.querySelector('#profile').classList.toggle('hidden');
                        document.querySelector('#open-menu').classList.toggle('hidden');
                        document.querySelector('#close-menu').classList.toggle('hidden')"
                        class="hover:bg-gray-300 dark:hover:bg-gray-700 p-2 rounded-lg" id="menu">
                        <svg class="block w-6 h-6" id="open-menu" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="w-6 h-6 hidden" id="close-menu" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

            </nav>
        </div>
    </div>

    <div class="h-10 bg-gray-100">
        <div class="md:px-8 h-full max-w-screen-xl px-4 mx-auto">
            <div class="flex items-center justify-between h-full text-lg font-semibold">
                <div>
                    @yield('title')
                </div>
                <div class="flex items-center">
                    @yield('subheader')
                </div>
            </div>
        </div>
    </div>

    <hr class="hidden">

</header>
