<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTaskTest extends TestCase
{
    use RefreshDatabase;
    protected $project, $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = create('App\User');
        $this->project = create('App\Project', ['user_id' => $this->user->id]);
    }

    /** @test */
    function a_guest_cannot_create_a_task_for_a_project()
    {
        $this->signIn(create('App\User'));

        $this->post(route('projectTask.store', ['category' => $this->project->category, 'project' => $this->project, 'body' => 'New task']))
            ->assertStatus(403);
    }

    /** @test */
    function a_task_can_be_created_by_the_projects_creator()
    {
        $this->signIn($this->user);

        $this->post(route('projectTask.store', ['category' => $this->project->category, 'project' => $this->project, 'body' => 'New task']))
            ->assertRedirect($this->project->path());

        $this->assertDatabaseHas('tasks', [
            'body' => 'New task'
        ]);
    }

    /** @test */
    function a_guest_cannot_update_a_task()
    {
        $this->signIn(create('App\User'));

        $task = create('App\Task', ['project_id' => $this->project->id]);

        $this->patch($task->path(), ['body' => 'updated body', 'completed' => true])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', [
            'body' => 'updated body',
            'completed' => true
        ]);
    }

    /** @test */
    function a_task_can_be_updated_by_its_creator()
    {
        $this->signIn($this->user);

        $task = create('App\Task', ['project_id' => $this->project->id]);

        $this->patch($task->path(), ['body' => 'updated body', 'completed' => true])
            ->assertRedirect($this->project->path());

        $this->assertDatabaseHas('tasks', [
            'body' => 'updated body',
            'completed' => true
        ]);
    }
}
