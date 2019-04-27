@extends('layouts.app')

@section('content')
    <h1>Profile</h1>
    @include('breadcrumbs')

    <h4 class="text-xl">Profile Settings</h4>

    <update-user-form :user="{{ $user }}"></update-user-form>


@endsection
