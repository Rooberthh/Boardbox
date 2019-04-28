<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvitationTest extends TestCase
{
    protected $user, $project;

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = create('App\User');
        $this->project = create('App\Project', [
            'user_id' => $this->user->id
        ]);
    }

    /** @test */
    function a_invited_user_must_be_member()
    {
        $this->signIn($this->user);

        $this->post($this->project->path() . '/invite', ['email' => 'testemail@hotmail.com'])
            ->assertSessionHasErrors('email');
    }

    /** @test */
    function a_user_can_be_invited()
    {
        $newUser = create('App\User');

        $this->signIn($this->user);

        $this->post($this->project->path() . '/invite', ['email' => $newUser->email])
            ->assertRedirect($this->project->path());

        $this->assertDatabaseHas('project_members', [
            'project_id' => $this->project->id,
            'user_id' => $newUser->id
        ]);
    }

    /** @test */
    function a_invited_user_can_invite_users ()
    {
        $this->signIn($this->user);

        $John = create('App\User');

        $this->post($this->project->path() . '/invite', ['email' => $John->email])
            ->assertRedirect($this->project->path());

        $Nicky = create('App\User');

        $this->signIn($John);

        $this->post($this->project->path() . '/invite', ['email' => $Nicky->email])
            ->assertRedirect($this->project->path());

        $this->assertDatabaseHas('project_members', [
            'project_id' => $this->project->id,
            'user_id' => $Nicky->id
        ]);
    }
}
