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

        /** @test */
        function a_user_can_be_an_admin()
        {
            $user = create('App\User', ['email' => 'roberth.evaldsson@hotmail.com']);

            $this->assertTrue($user->isAdmin);

            $this->assertFalse(create('App\User')->isAdmin);
        }

    }
