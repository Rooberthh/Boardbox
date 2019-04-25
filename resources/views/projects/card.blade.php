<div class="sm:w-1/2 md:w-1/3 px-3 pb-6">
    <div class="bg-white rounded shadow p-5 max-h-200">
        <a href="{{ $project->path() }}" class="text-grey-darkest no-underline">
            <h3 class="font-normal py-4 text-xl border-l-4 border-red -ml-5 pl-4">
            {{ $project->title }}
            </h3>
        </a>

        <div class="text-grey-dark">
            {{ str_limit($project->description, 300) }}
        </div>

        <div class="mt-3 flex">
            <a href="{{ route('category.index', ['category' => $project->category]) }}"
                class="btn btn-blue"
            >
                {{ $project->category->name }}
            </a>
            @can('update', $project)
                <form method="POST" class="ml-auto" action="{{ route('projects.destroy', ['category' => $project->category, 'project' => $project]) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn text-grey-darkest">Delete</button>
                </form>
            @endcan
        </div>
    </div>
</div>
