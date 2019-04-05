@extends('layouts.app')

@section('content')
<div class="w-full max-w-md mx-auto">
    <form method="POST" action="{{ route('register') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="mb-4">
            <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                Email
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker mb-2 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Email" name="email">
            @if ($errors->has('email'))
                <span class="text-red text-xs italic" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
            @endif
        </div>
        <div class="mb-4">
            <label class="block text-grey-darker text-sm font-bold mb-2" for="name">
                Username
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker mb-2 leading-tight focus:outline-none focus:shadow-outline"
                   id="name" type="text" placeholder="John Doe" name="name" value="{{ old('name') }}">
            @if ($errors->has('name'))
                <span class="text-red text-xs italic" role="alert">
            <strong>{{ $errors->first('name') }}</strong>
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
        <div class="mb-6">
            <label class="block text-grey-darker text-sm font-bold mb-2" for="password_confirmation">
                Password Confirm
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker mb-2 leading-tight focus:outline-none focus:shadow-outline"
                   id="password_confirmation" type="password" placeholder="******************" name="password_confirmation">
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="btn btn-blue">
                Register
            </button>
        </div>
    </form>
</div>
@endsection
