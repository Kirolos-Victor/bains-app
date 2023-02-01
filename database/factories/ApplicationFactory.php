<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => 'test',
            'last_name' => 'test',
            'email' => 'test@test.com',
            'phone' => '1111111111',
            'date_of_birth' => '21-6-1997',
            'job' => 'programmer',
            'previous_experience' => 1
        ];
    }
}
