<?php

    namespace Tests\Unit;

    use Tests\TestCase;
    use Illuminate\Foundation\Testing\RefreshDatabase;

    class UserTest extends TestCase
    {
        use RefreshDatabase;

        protected $user;

        protected function setUp(): void
        {
            parent::setUp();

            $this->user = create('App\User');
        }

        /** @test */
        function a_user_can_have_projects()
        {
            $this->assertInstanceOf(
                'Illuminate\Database\Eloquent\Collection', $this->user->projects
            );
        }

    }
