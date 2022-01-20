<?php

namespace Database\Factories;

use App\Models\Channel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DiscussionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(6,false);
        return [
            'user_id'=>User::pluck('id')->random(),
            'title'=>$title,
            'slug'=>Str::slug($title,'-'),
            'content'=>$this->faker->text(),
            'channel_id'=>Channel::pluck('id')->random()
        ];
    }
}
