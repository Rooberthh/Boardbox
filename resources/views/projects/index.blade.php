@extends('layouts.app')

@section('content')
    <div class="flex items-center mb-3">
        <a class="btn btn-blue" href="{{ route('projects.create') }}">New Project</a>
    </div>
    @if(auth()->user())
        <h2 class="text-grey-darkest mb-5 text-lg">Your currently active projects</h2>
        <div class="flex flex-wrap -mx-3">
            @foreach($user_projects as $project)
                @include('projects.card')
            @endforeach
        </div>
    @endif

    <h3 class="text-grey-darkest mb-5 text-lg">Projects</h3>

    <div class="flex flex-wrap -mx-3">
        @forelse($projects as $project)
                @include('projects.card')
        @empty
            <p>There are no projects in this category.</p>
        @endforelse
    </div>
@endsection
