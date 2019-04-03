@extends('layouts.app')

@section('content')
    <div class="flex items-center mb-3">
        <a class="btn btn-blue" href="{{ route('projects.create') }}">New Project</a>
    </div>
    <div class="flex flex-wrap -mx-3">
        @forelse($projects as $project)

                @include('projects.card')

        @empty
            <p>There are no projects in this category.</p>
        @endforelse
    </div>
@endsection
