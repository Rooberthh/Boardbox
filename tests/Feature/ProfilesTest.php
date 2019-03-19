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
}
