<?php

namespace Database\Factories;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reply_id' => Reply::pluck('id')->random(),
            'user_id' => User::pluck('id')->random()
        ];
    }
}
