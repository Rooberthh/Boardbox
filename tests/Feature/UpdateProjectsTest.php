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
    function a_project_cant_be_updated_by_a_guest()
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

    /** @test */
    function a_project_can_be_updated_by_its_members()
    {
        $John = create('App\User');
        $Sally = create('App\User');

        $project = create('App\Project', ['user_id' => auth()->id()]);

        $project->invite($John);
        $project->invite($Sally);

        $this->signIn($John);

        $this->patchJson($project->path(), [
            'title' => 'is changed',
            'description' => 'is changed',
        ]);

        $this->assertEquals('is changed', $project->fresh()->title);
    }

    /** @test */
    function a_project_can_be_completed_by_its_owner()
    {
        $project = create('App\Project', ['user_id' => auth()->id()]);

        $this->postJson($project->path() . '/complete');

        $this->assertTrue($project->fresh()->completed);
    }

    /** @test */
    function a_project_owner_can_make_a_project_incomplete()
    {
        $project = create('App\Project', ['user_id' => auth()->id()]);

        $this->deleteJson($project->path() . '/complete');

        $this->assertFalse($project->fresh()->completed);
    }
}
