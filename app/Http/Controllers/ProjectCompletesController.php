<?php

namespace App\Http\Controllers;

use App\Category;
use App\Project;
use Illuminate\Http\Request;

class ProjectCompletesController extends Controller
{
    public function store(Category $category, Project $project)
    {
        $project->complete();

        return response('Marked as complete', 200);
    }

    public function destroy(Category $category, Project $project)
    {
        $project->incomplete();

        return response('Marked as incomplete', 200);
    }
}
