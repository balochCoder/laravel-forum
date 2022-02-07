<?php

namespace Database\Factories;

use App\Models\Discussion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::pluck('id')->random(),
            'discussion_id' => Discussion::pluck('id')->random(),
            'content' => $this->faker->text()
        ];
    }
}
