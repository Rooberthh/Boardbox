<?php

namespace Tests\Unit;

use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_task_belongs_to_a_project()
    {
        $task = create('App\Task');

        $this->assertInstanceOf(Project::class, $task->project);
    }

    /** @test */
    function a_task_can_be_marked_as_completed()
    {
        $task = create('App\Task');

        $this->assertFalse($task->completed);

        $task->complete();

        $this->assertTrue($task->fresh()->completed);
    }

    /** @test */
    function a_task_can_be_marked_as_incomplete()
    {
        $task = create('App\Task', ['completed' => true]);

        $task->incomplete();

        $this->assertFalse($task->fresh()->completed);
    }
}
