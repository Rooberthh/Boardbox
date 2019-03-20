<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdatesProjectsTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();

        $this->withExceptionHandling();

        $this->signIn();
    }

    /** @test */
    function a_project_can_only_be_updated_by_its_owner()
    {
        $project = create('App\Project', ['user_id' => create('App\User')->id]);

        $this->patch($project->path(), [])
            ->assertStatus(403);
    }

    /** @test */
    function a_project_can_be_updated_by_its_owner()
    {
        $project = create('App\Project', ['user_id' => auth()->id()]);

        $this->patchJson($project->path(), [
            'title' => 'is changed',
            'description' => 'is changed',
        ]);

        $this->assertEquals('is changed', $project->fresh()->title);
    }

}
