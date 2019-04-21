<div class="text-sm text-grey-dark my-8">
    <ul class="flex list-reset">
        <li>
            <a class="no-underline text-grey-dark" href="{{ route('projects.index') }}">Projects</a>
        </li>
        @if (Route::is('projects.show'))
            <span class="mx-1">/</span>
            <li>
                <a class="no-underline text-grey-dark" href="{{ route('category.index', ['category' => $project->category]) }}">{{ $project->category->name }}</a>
            </li>

            <span class="mx-1">/</span>
            <li>
                {{ $project->title }}
            </li>
        @endif
    </ul>
</div>
