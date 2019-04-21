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

        if(auth()->user()){
            $user_projects = auth()->user()->projects->take(3);
        } else {
            $user_projects = null;
        }

        return View('projects.index', [
            'projects' => $projects,
            'user_projects' => $user_projects
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

        if(request()->wantsJson()){
            return response($project, 200);
        }

        return redirect(route('projects.index'));
    }

    public function destroy($category, Project $project)
    {
        $this->authorize('update', $project);

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
        return View('projects.create', [
            'categories' => Category::all()
        ]);
    }

    public function show($category, Project $project)
    {
        return view('projects.show', ['project' => $project]);
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
