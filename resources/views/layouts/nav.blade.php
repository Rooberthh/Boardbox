<nav class="bg-red text-white py-2">
    <div class="container mx-auto">
        <div class="flex justify-between items-center py-1">
            <a href="/" class="text-3xl text-white no-underline font-bold">
                {{ Config('app.name', 'Boardbox') }}
            </a>

            <div>
                <!-- Right Side Of Navbar -->
                <div class="flex items-center ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <a class="text-white no-underline mr-6" href="{{ route('login') }}">{{ __('Login') }}</a>

                        @if (Route::has('register'))
                            <a class="text-white no-underline" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <user-notifications></user-notifications>

                        <a class="text-white no-underline mr-6" href="{{ route('profile.show') }}">
                            {{ auth()->user()->name }}
                        </a>

                        <a class="text-white no-underline mr-6" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</nav>
