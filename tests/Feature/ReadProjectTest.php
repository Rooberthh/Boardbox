<?php

namespace Tests\Feature;

use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadProjectTest extends TestCase
{
    use RefreshDatabase;

    protected $project;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    function a_project_is_viewable()
    {
        $project = create('App\Project');

        $this->get(route('projects.show', ['category' => $project->category->name, 'project' => $project]))
            ->assertStatus(200)
            ->assertSee($project->title);
    }

    /** @test */
    function a_project_is_deleted_when_its_category_is_removed ()
    {
        $project = create('App\Project');

        $this->assertCount(1, Project::all());

        $project->category->delete();

        $this->assertCount(0, Project::all());
    }

}
