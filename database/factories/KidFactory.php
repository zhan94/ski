<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kid>
 */
class KidFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $date = fake()->dateTimeBetween('-14 years', '-4 years');

        return [
            'firstname' => fake()->firstName(),
            'surname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'birth_date' => $date->format('d-m-Y'),
            'active' => 1,
            'note' => '',
            'parent_name' => fake()->name(),
            'parent_email' => fake()->safeEmail(),
            'parent_phone_number' => fake()->phoneNumber(),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
    }
}
