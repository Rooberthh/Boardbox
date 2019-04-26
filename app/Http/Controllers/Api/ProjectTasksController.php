<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectTasksController extends Controller
{
    public function index(Category $category, Project $project)
    {
        return response($project->tasks, 200);
    }

}
