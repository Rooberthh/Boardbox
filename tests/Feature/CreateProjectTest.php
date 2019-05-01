<?php

namespace Tests\Feature;

use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guests_may_not_create_projects()
    {
        $this->withExceptionHandling();

        $this->get(route('projects.create'))
            ->assertRedirect(route('login'));

        $this->post(route('projects.store'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    function a_user_can_create_new_projects()
    {
        $this->signIn();

        $this->publishProject(['title' => 'Some title', 'description' => 'Some desc'])
            ->assertRedirect(route('projects.index'));

        $this->assertDatabaseHas('projects', ['title' => 'Some title', 'description' => 'Some desc']);
    }

    /** @test */
    function a_project_requires_a_valid_category()
    {
        create('App\Category', [], 3);

        $this->publishProject(['category_id' => null])
            ->assertSessionHasErrors('category_id');

        $this->publishProject(['category_id' => 100])
            ->assertSessionHasErrors('category_id');
    }

    /** @test */
    function authorized_users_can_delete_projects()
    {
        $this->signIn();

        $project = create('App\Project', ['user_id' => auth()->id()]);

        $this->json('DELETE', $project->path())
            ->assertStatus(204);

        $this->assertDatabaseMissing('projects', ['title' => $project->title, 'category_id' => $project->category_id]);
    }

    /** @test */
    function a_project_creator_is_set_as_a_member_when_a_project_is_created()
    {
        $this->signIn();

        $this->publishProject();

        $this->assertTrue(Project::all()->first()->members->contains(auth()->user()));
    }

    protected function publishProject($overrides = [])
    {
        $this->withExceptionHandling()->signIn();

        $project = make('App\Project', $overrides);

        return $this->post(route('projects.store'), $project->toArray());
    }

}
