<?php

namespace App\Http\Controllers;

use App\Category;
use App\Project;
use App\Task;

class ProjectTasksController extends Controller
{
    /**
     * @param Category $category
     * @param Project $project
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Category $category, Project $project)
    {
        $this->authorize('update', $project);

        request()->validate(['body' => 'required']);

        $project->addTask(request('body'));

        return redirect($project->path());
    }

    /**
     * @param Category $category
     * @param Project $project
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Category $category, Project $project, Task $task)
    {
        $this->authorize('update', $project);

        $task->update(request()->validate(['body' => 'required']));

        request('completed') ? $task->completed() : $task->incomplete();

        return redirect($project->path());
    }
}