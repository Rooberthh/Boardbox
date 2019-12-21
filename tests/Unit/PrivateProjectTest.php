<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PrivateProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_can_be_marked_as_private()
    {
        $project = create('App\Project');

        $project->private();

        $this->assertTrue($project->private);
    }

    /** @test */
    function it_can_be_marked_as_public()
    {
        $project = create('App\Project', ['private' => true]);

        $project->public();

        $this->assertFalse($project->private);
    }
}
