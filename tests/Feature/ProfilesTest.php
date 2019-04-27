<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfilesTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    function a_user_has_a_profile()
    {
        $this->signIn();

        $this->get(route('profile.show'))
            ->assertSee(auth()->user()->name);
    }

    /** @test */
    function a_users_profile_can_be_updated()
    {
        $user = create('App\User');
        $this->signIn($user);

        $this->patchJson('/me', ['name' => 'updatedName', 'email' => 'updated@email.com'])
            ->assertStatus(200);

        $this->assertDatabaseHas('users', $user->fresh()->toArray());
    }
}
