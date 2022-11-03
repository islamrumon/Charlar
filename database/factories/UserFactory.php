<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'type'=>'user',
            'avatar' => fileUpload(null,null,fake()->name()),
            'slug' => Str::slug(fake()->unique()->name),
            'phone'=>fake()->phoneNumber(),
            'bio'=>fake()->text(),
            'f_name'=>fake()->firstName(),
            'l_name'=>fake()->lastName(),
            'address' => fake()->address(),
            'designation'=>fake()->jobTitle(),
            'city'=>fake()->city(),
            'website'=>'website',
            'facebook'=>'facebook',
            'twiter'=>'twiter',
            'instragram'=>'instragram',
            'whats_app'=>'whats_app',
            'telegram'=>'telegram.com',
            'cover'=>fileUpload(null,null,fake()->name()),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
