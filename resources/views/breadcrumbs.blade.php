<div class="text-sm text-grey-dark my-8">
    <ul class="flex list-reset">
        @if (Route::is('projects.show'))
            <li>
                <a class="no-underline text-grey-dark" href="{{ route('projects.index') }}">Projects</a>
            </li>

            <span class="mx-1">/</span>
            <li>
                <a class="no-underline text-grey-dark" href="{{ route('category.index', ['category' => $project->category]) }}">{{ $project->category->name }}</a>
            </li>

            <span class="mx-1">/</span>
            <li>
                {{ $project->title }}
            </li>
        @endif

        @if (Route::is('profile.show'))
            <li>
                <a class="no-underline text-grey-dark" href="{{ route('home') }}">Home</a>
            </li>

            <span class="mx-1">/</span>

            <li>
                Profile
            </li>
        @endif
    </ul>
</div>
