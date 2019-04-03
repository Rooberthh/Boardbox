@extends('layouts.app')

@section('content')
<div class="w-full max-w-md mx-auto">
    <form method="POST" action="{{ route('login') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="mb-4">
            <label class="block text-grey-darker text-sm font-bold mb-2" for="username">
                Username
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker mb-2 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Username" name="email">
            @if ($errors->has('email'))
            <span class="text-red text-xs italic" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>
        <div class="mb-6">
            <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                Password
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker mb-2 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************" name="password">

            @if ($errors->has('password'))
            <span class="text-red text-xs italic" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Sign In
            </button>
            <a href="{{ route('password.request') }}" class="inline-block align-baseline font-bold text-sm text-blue hover:text-blue-darker">
                Forgot Password?
            </a>
        </div>
    </form>
</div>
@endsection
