<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_category_consists_of_projects()
    {
        $category = create('App\Category');
        $project = create('App\Project', ['category_id' => $category->id]);

        $this->assertTrue($category->projects->contains($project));
    }
}
