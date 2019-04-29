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

        $John = create('App\User');
        $Nicky = create('App\User');

        $project = create('App\Project', [
            'user_id' => $this->user->id
        ]);

        $project->invite($John);
        $project->invite($Nicky);

        $this->assertCount(1, $John->fresh()->notifications);
        $this->assertCount(0, auth()->user()->fresh()->notifications);
    }

    /** @test */
    function a_user_can_fetch_their_unread_notifications()
    {
        $this->signIn($this->user);

        $John = create('App\User');
        $Nicky = create('App\User');

        $project = create('App\Project', [
            'user_id' => $this->user->id
        ]);

        $project->invite($John);
        $project->invite($Nicky);

        $this->signIn($John);

        $response = $this->getJson('/me/notifications')->json();

        $this->assertCount(1, $response);
    }

    /** @test */
    function a_user_can_mark_notifications_as_read()
    {
        $this->withExceptionHandling();

        $this->signIn($this->user);

        $John = create('App\User');
        $Nicky = create('App\User');

        $project = create('App\Project', [
            'user_id' => $this->user->id
        ]);

        $project->invite($John);
        $project->invite($Nicky);

        $this->signIn($John);

        $this->assertCount(1, $John->unreadNotifications);

        $notificationId = $John->unreadNotifications->first()->id;

        $this->deleteJson("/me/notifications/{$notificationId}");

        $this->assertCount(0, $John->fresh()->unreadNotifications);
    }
}
