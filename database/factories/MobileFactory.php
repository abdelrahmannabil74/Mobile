<?php

use Faker\Generator as Faker;

$factory->define(\App\Mobile::class, function (Faker $faker) {

    return [
        //
        'name' => $faker->word,
        'number' => $faker->phoneNumber,
        'user_id'=>function(){
        return factory(\App\User::class)->create()->id;
        },
    ];

});

