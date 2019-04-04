@extends('layouts.app')

@section('content')

    <div class="w-full max-w-md mx-auto">
        <form method="POST" action="{{ route('projects.store') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h1 class="text-2xl mb-4 font-normal">New Project</h1>
            @csrf
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="title">
                    Title
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker mb-2 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" placeholder="Title" name="title">
                @if ($errors->has('title'))
                    <span class="text-red text-xs italic" role="alert">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
                @endif
            </div>
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="description">
                    Description
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker mb-2 leading-tight focus:outline-none focus:shadow-outline"
                          id="description"
                          name="description"
                          rows="10">
                </textarea>

                @if ($errors->has('description'))
                    <span class="text-red text-xs italic" role="alert">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
                @endif
            </div>
            <div class="mb-4 relative">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="category_id">
                    Category
                </label>

                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker mb-2 leading-tight focus:outline-none focus:shadow-outline" name="category_id" id="category_id">
                    <option>Select a Category...</option>
                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 pt-4 text-grey-darker">
                    <svg class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>

                @if ($errors->has('category_id'))
                    <span class="text-red text-xs italic" role="alert">
                <strong>{{ $errors->first('category_id') }}</strong>
            </span>
                @endif
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Create Project
                </button>
            </div>
        </form>
    </div>

@endsection
