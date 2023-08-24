<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        do {
            $userId = rand(1, 10);
            $to = rand(1, 10);
        } while($userId === $to);
    
        return [
            'user_id' => $userId,
            'from' => $userId,
            'to' => $to,
            'subject' => fake()->sentence,
            'content' => fake()->paragraph,
            'read_at' => fake()->dateTimeBetween('-15 days', 'this week'),
            'created_at' => fake()->dateTimeBetween('-30 days', 'this week')
        ];
    }
}
