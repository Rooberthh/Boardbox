<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FilterProjectTest extends TestCase
{
    use RefreshDatabase;

    protected $project;

    protected function setUp(): void
    {
        parent::setUp();

        $this->project = create('App\Project');
    }


    /** @test */
    function a_user_can_view_all_projects()
    {

        $this->getJson(route('projects.index'))
            ->assertStatus(200);
    }

    /** @test */
    function a_user_can_filter_projects_by_category()
    {
        $category = create('App\Category');
        $threadInChannel = create('App\Project', ['category_id' => $category->id]);
        $threadNotInChannel = create('App\Project');

        $this->get($category->path())
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }
}
