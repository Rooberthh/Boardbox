<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    protected $project;

    protected function setUp(): void
    {
        parent::setUp();

        $this->project = create('App\Project');
    }

    /** @test */
    function it_has_a_title()
    {
        $project = create('App\Project', ['title' => 'is title']);

        $this->assertEquals('is title', $project->fresh()->title);
    }

    /** @test */
    function it_has_an_owner()
    {
        $user = create('App\User');
        $project = create('App\Project', ['user_id' => $user->id]);

        $this->assertEquals($user->id, $project->owner->id);
        $this->assertInstanceOf('App\User', $this->project->owner);
    }

    /** @test */
    function it_can_consist_of_tasks()
    {
        $project = create('App\Project');
        $task = $project->addTask('New Task');

        $this->assertCount(1, $project->tasks);
        $this->assertTrue($project->tasks->contains($task));
    }
}
