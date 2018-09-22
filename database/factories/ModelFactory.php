<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(App\Models\Admin::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('password'),
        'remember_token' => str_random(10)
    ];
});

$factory->define(App\Models\Category::class, function (Faker $faker) {
    $title = $faker->sentence(2);
    return [
        'title' => $title,
        'description' => $faker->paragraph,
        'slug' => str_slug($title)
    ];
});

$factory->define(App\Models\Item::class, function (Faker $faker) {
    $title = $faker->sentence(2);
    return [
        'category_id' => function () {
            return factory('App\Models\Category')->create()->id;
        },
        'title' => $title,
        'description' => $faker->paragraph,
        'slug' => str_slug($title)
    ];
});
