@extends('layouts.app')
@section('content')

    @include('breadcrumbs')
    <project-view :project="{{ $project }}" inline-template>
        <div class="lg:flex -m-3">
            <div class="lg:w-3/4 px-3">
                <div class="mb-8">
                    <h3 class="text-xl text-grey-darker font-normal mb-3">Tasks</h3>
                    <tasks></tasks>
                </div>
            </div>

            <div class="lg:w-1/4 px-3">
                <div class="w-full mt-8">
                    <div class="bg-white rounded shadow p-5 min-h-400">
                        <a href="{{ $project->path() }}" class="text-grey-darkest no-underline">
                            <h3 class="font-normal py-4 text-xl border-l-4 border-red -ml-5 pl-4">
                                {{ $project->title }}
                            </h3>
                        </a>

                        <div class="text-grey-dark">
                            <p>{{  $project->description }}</p>
                        </div>

                        @can('update', $project)
                            <div class="flex">
                                <button type="button" class="btn btn-outline">Edit</button>
                                <form method="POST" class="ml-auto" action="{{ route('projects.destroy', ['category' => $project->category, 'project' => $project]) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn text-grey-darkest">Delete</button>
                                </form>
                            </div>
                        @endcan

                    </div>
                </div>
            </div>
        </div>
    </project-view>
@endsection
