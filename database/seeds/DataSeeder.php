<?php

    use App\Category;
    use App\User;
    use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'name' => 'front-end',
                'description' => 'This category is for front-end',
                'color' => '#3c40c6'
            ],
            [
                'name' => 'back-end',
                'description' => 'This category is for backend',
                'color' => '#0fbcf9'
            ],
            [
                'name' => 'dev-ops',
                'description' => 'This category is for dev ops.',
                'color' => '#f53b57'
            ],
            [
                'name' => 'graphic-design',
                'description' => 'This category is for graphic design.',
                'color' => '#05c46b'
            ],
        ])->each(function ($category) {
            factory(Category::class)->create([
                'name' => $category['name'],
                'description' => $category['description'],
                'color' => $category['color'],
                'slug' => $category['name']
            ]);
        });

        collect([
            [
                'name' => 'johndoe',
                'email' => 'john@example.com',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Roberth',
                'email' => 'roberth.evaldsson@hotmail.com',
                'password' => bcrypt('password')
            ],
        ])->each(function ($user) {
            factory(User::class)->create(
                [
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => bcrypt('password')
                ]
            );
        });

        factory('App\Project', 10)->states('from_existing_categories_and_users')->create();
    }
}
