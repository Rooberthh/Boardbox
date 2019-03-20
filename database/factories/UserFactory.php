<?php

    use App\Category;
    use App\Project;
    use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'is_admin' => false
    ];
});

$factory->define(Project::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'user_id' => function(){
            return factory('App\User')->create()->id;
        },
        'description' => $faker->sentence,
        'category_id' => factory('App\Category')->create()->id
    ];
});

$factory->define(Category::class, function (Faker $faker) {
    $name = $faker->unique()->word;
    return [
        'name' => $name,
        'slug' => $name,
        'description' => $faker->sentence
    ];
});
