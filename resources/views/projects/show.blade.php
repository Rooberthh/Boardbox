@extends('layouts.app')
@section('content')
    <header class="flex justify-between">
    @include('breadcrumbs')

    <div class="flex items-center">
        @foreach($project->members as $member)
            <img src="{{ gravatar_url($member->email) }}"
                 alt=" {{ $member->name }}'s avatar"
                 class="rounded-full w-8 mr-2"
            >
        @endforeach
    </div>
    </header>
    <project-view :project="{{ $project }}" inline-template v-cloak>
        <div class="lg:flex -m-3">
            <div class="lg:w-3/4 px-3">
                <div class="mb-8">
                    <h3 class="text-xl text-grey-darker font-normal mb-3">Tasks</h3>
                    <tasks></tasks>
                </div>
            </div>

            <div class="lg:w-1/4 px-3" v-if="!editing">
                <div class="flex">
                    <a class="ml-auto btn btn-blue" href="#"  @click="togglePin" v-text="completed ? 'Incomplete' : 'Complete'"></a>
                </div>
                <div class="w-full ">
                    <div class="card">
                        <a href="{{ $project->path() }}" class="text-grey-darkest no-underline">
                            <h3 class="font-normal py-4 text-xl border-l-4 border-red -ml-5 pl-4" v-text="form.title">
                            </h3>
                        </a>

                        <div class="text-grey-dark">
                            <p v-text="form.description"></p>
                        </div>

                        @can('update', $project)
                            <div class="flex">
                                <button @click="edit" type="button" class="btn btn-outline ml-auto">Edit <i class="fas fa-edit"></i> </button>
                            </div>
                        @endcan

                    </div>

                    @can('update', $project)
                        <project-invitation></project-invitation>
                    @endcan
                </div>
            </div>

            <div v-else class="lg:w-1/4 px-3">
                <div class="w-full mt-8">
                    <div class="card">
                        <input class="input focus:outline-none focus:shadow-outline"
                               v-model="form.title">

                        <div class="text-grey-dark">
                            <textarea class="input focus:outline-none focus:shadow-outline"
                                      rows="5"
                                      v-model="form.description"
                                      >
                            </textarea>
                        </div>

                        @can('update', $project)
                            <div class="flex">
                                <button @click="edit" type="button" class="btn btn-outline mr-auto">Cancel</button>
                                <button @click="update" class="btn btn-outline ml-auto">Update</button>
                            </div>
                            @can('manage', $project)
                                <form method="POST" class="mr-auto" action="{{ route('projects.destroy', ['category' => $project->category, 'project' => $project]) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn text-grey-darkest">Delete</button>
                                </form>
                            @endcan
                        @endcan

                    </div>
                </div>
            </div>
        </div>
    </project-view>
@endsection
