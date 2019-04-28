<?php

    namespace Tests\Unit;

    use App\User;
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
        function a_user_has_accessible_project()
        {
            create('App\Project', [
                'user_id' => $this->user->id
            ]);

            $this->assertCount(1, $this->user->projects);

            $sally = create('App\User');

            $project = create('App\Project', [
                'user_id' => $sally->id
            ]);

            $project->invite($this->user);

            $this->assertCount(2, $this->user->accessibleProjects());
        }

        /** @test */
        function a_user_can_be_an_admin()
        {
            $user = create('App\User', ['email' => 'roberth.evaldsson@hotmail.com']);

            $this->assertTrue($user->isAdmin);

            $this->assertFalse(create('App\User')->isAdmin);
        }
    }
