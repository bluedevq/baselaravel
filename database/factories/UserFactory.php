<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $item = [
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('admin123'),
            'avatar' => null,
        ];

        $deletedFlag = getConfig('model_field.deleted.flag');
        if (!empty($deletedFlag)) $item[$deletedFlag] = 0;

        return $item;
    }
}
