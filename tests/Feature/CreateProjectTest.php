<?php

namespace Tests\Feature;

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
            ->assertStatus(200);
    }

    protected function publishProject($overrides = [])
    {
        $this->withExceptionHandling()->signIn();

        $thread = make('App\Project', $overrides);

        return $this->post(route('projects.store'), $thread->toArray());
    }

}
