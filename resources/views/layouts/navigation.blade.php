<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('root') }}">
                        <x-application-logo class="block  h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 logo">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            @auth
                            <div>{{ Auth::user()->name }}</div>
                            @else
                            <div>guest</div>
                            @endauth

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <!-- Authentication -->
                        @auth
                        @if (empty(Auth::user()->article))
                        <x-dropdown-link :href="route('articles.create')">
                            {{ __('Create Post') }}
                        </x-dropdown-link>
                        @endif
                        @if (!empty(Auth::user()->article))
                        <x-dropdown-link :href="route('articles.edit', Auth::user()->article)">
                            {{ __('Edit Post') }}
                        </x-dropdown-link>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                        @else
                        <x-dropdown-link :href="route('register')">
                            {{ __('Sign Up') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('login')">
                            {{ __('Log In') }}
                        </x-dropdown-link>
                        @endauth
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Authentication -->
                    <x-responsive-nav-link>
                        {{ __('Create Post') }}
                    </x-responsive-nav-link>
                    @if (!empty(Auth::user()->article))
                    <x-responsive-nav-link :href="route('articles.edit', Auth::user()->article)">
                        {{ __('Edit Post') }}
                    </x-responsive-nav-link>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                                                                                                                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
                @else
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">guest</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Sign Up') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Log In') }}
                    </x-responsive-nav-link>
                </div>
                @endauth
            </div>
        </div>

        <div class="margin-left: auto;">
            <div class="flex justify-between h-16 logo">
                <table>
                    <tr>
                        <form class="form-inline my-2 my-lg-0" mechod="GET" action="{{ route('articles.index') }}">
                            <td>
                                <select name="category">
                                    <option type="search" value="地域" selected disabled>地域</option>
                                    <option type="search" value="八幡平">八幡平</option>
                                    <option type="search" value="安比高原">安比高原</option>
                                    <option type="search" value="焼走">焼走</option>
                                </select>
                            </td>
                            <td><button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                            </td>
                        </form>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</nav>