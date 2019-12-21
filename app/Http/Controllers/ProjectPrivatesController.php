<?php

namespace App\Http\Controllers;

use App\Category;
use App\Project;
use Illuminate\Http\Request;

class ProjectPrivatesController extends Controller
{
    public function store(Category $category, Project $project)
    {
        $this->authorize('update', $project);

        $project->private();

        return response('Project is now private', 200);
    }

    public function destroy(Category $category, Project $project)
    {
        $this->authorize('update', $project);

        $project->public();

        return response('Project is now public', 200);
    }
}
