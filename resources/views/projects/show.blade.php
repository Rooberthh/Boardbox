@extends('layouts.app')
@section('content')

    @include('breadcrumbs')

    <div class="lg:flex -m-3">
        <div class="lg:w-3/4 px-3">
            <div class="mb-8">
                <h3 class="text-xl text-grey-darker font-normal mb-3">Tasks</h3>

                @forelse($project->tasks as $task)
                    <div class="bg-white rounded shadow p-4 mb-3">
                        <form method="POST" action="{{ $task->path() }}">
                            @csrf
                            @method('patch')

                            <div class="flex items-center">
                                <input type="text" value="dasdas" class="text-default w-full" name="body">

                                <input type="checkbox" {{ $task->completed ? 'checked' : '' }} name="completed" onchange="this.form.submit()">
                            </div>
                        </form>
                    </div>
                @empty
                    <p>No tasks are created for this project</p>
                @endforelse
                <div class="bg-white rounded shadow p-4 mb-3">
                    <form method="POST" action="{{ $project->path() . '/tasks' }}">
                        @csrf

                        <input type="text" placeholder="Add a new Task..." value="" class="text-default bg-card w-full" name="body">
                    </form>
                </div>
            </div>
        </div>

        <div class="lg:w-1/4 px-3">
            <div class="w-full lg:py-8">
                <div class="bg-white rounded shadow p-5 min-h-400">
                    <a href="{{ $project->path() }}" class="text-grey-darkest no-underline">
                        <h3 class="font-normal py-4 text-xl border-l-4 border-red -ml-5 pl-4">
                            {{ $project->title }}
                        </h3>
                    </a>

                    <div class="text-grey-dark">
                        <p>{{  $project->description }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
