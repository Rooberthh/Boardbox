<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function store()
    {

        request()->validate([
            'title' => ['required', 'max:50'],
            'description' => ['required']
        ]);

        $project = Project::create([
            'user_id' => auth()->id(),
            'title' => request('title'),
            'description' => request('description')
        ]);

        return response($project, 200);
    }

    public function create()
    {
    }
}
