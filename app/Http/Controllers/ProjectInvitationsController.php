<?php

namespace App\Http\Controllers;

use App\Category;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectInvitationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Category $category, Project $project)
    {
        $this->authorize('update', $project);

        request()->validate([
            'email' => [
                'required',
                Rule::exists('users', 'email')
            ]
        ]);

        $user = User::where('email', request('email'))->first();

        if($project->hasMember($user)){
            return response()->json([
                'message' => 'User is already a part of the project'
            ], 422);
        }

        $project->invite($user);

        return redirect($project->path());
    }

}
