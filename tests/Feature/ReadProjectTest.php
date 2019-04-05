<?php

namespace Tests\Feature;

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

}
