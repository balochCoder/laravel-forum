<?php

namespace Database\Seeders;

use App\Models\Channel;
use App\Models\Discussion;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create();

        Channel::factory(10)->create();
        Discussion::factory(20)->create();
        // User::factory()->count(5)->create()->each(function ($user) {

        //     Discussion::factory()->count(5)->create(['user_id' => $user->id]);
        // });
    }
}
