@extends('layouts.app')

@section('content')
    @forelse($projects as $project)
        <h3>{{ $project->title }}</h3>
        <p>{{ $project->description }}</p>
        <p>{{ $project->category->name }}</p>
    @empty
        <p>There are no projects in this category.</p>
    @endforelse
@endsection
