<?php

namespace App\Http\Controllers;

use App\Category;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Category $category)
    {
        $projects = $this->getProjects($category);

        if(request()->wantsJson()){
            return $projects;
        }
        return View('projects.index', [
            'projects' => $projects
        ]);
    }

    public function store()
    {
        request()->validate([
            'title' => ['required', 'max:50'],
            'description' => ['required'],
            'category_id' => [
                'required',
                Rule::exists('categories', 'id'),
            ]
        ]);

        $project = Project::create([
            'user_id' => auth()->id(),
            'category_id' => request('category_id'),
            'title' => request('title'),
            'description' => request('description')
        ]);

        return response($project, 200);
    }

    public function destroy($channel, Project $project)
    {

        $project->delete();

        return response('Project have been deleted', 204);
    }

    public function update($category, Project $project)
    {

        $this->authorize('update', $project);

        request()->validate([
            'title' => ['required'],
            'description' => ['required']
        ]);

        $project->update([
           'title' => request('title'),
           'description' => request('description')
        ]);

        return $project;
    }

    public function create()
    {
        return View('projects.create');
    }

    protected function getProjects(Category $category)
    {
        $projects = Project::latest()->with('category');

        if ($category->exists) {
            $projects->where('category_id', $category->id);
        }

        return $projects->get();
    }
}
