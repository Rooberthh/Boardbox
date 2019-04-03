<div class="w-1/3 px-3 pb-6">
    <div class="bg-white rounded shadow p-5 max-h-200">
        <h3 class="font-normal py-4 text-xl border-l-4 border-red -ml-5 pl-4">
            {{ $project->title }}
        </h3>

        <div class="text-grey-dark">
            {{ str_limit($project->description, 300) }}
        </div>
    </div>
</div>
