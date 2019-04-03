<nav class="bg-red text-white py-2">
    <div class="container mx-auto">
        <div class="flex justify-between items-center py-1">
            <h1>
                {{ Config('app.name', 'Boardbox') }}
            </h1>

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
