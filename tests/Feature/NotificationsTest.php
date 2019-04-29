<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotificationsTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = create('App\User');
    }

    /** @test */
    function a_notification_to_all_members_except_the_authenticated_user_when_adding_a_project_member()
    {
        $this->signIn($this->user);

        $John = create('App\User', [
            'name' => 'John'
        ]);

        $Nicky = create('App\User', [
            'name' => 'Nicky'
        ]);

        $project = create('App\Project', [
            'user_id' => $this->user->id
        ]);

        $project->invite($John);

        $project->invite($Nicky);

        $this->assertCount(1, $John->fresh()->notifications);

        $this->assertCount(0, auth()->user()->fresh()->notifications);
    }
}
