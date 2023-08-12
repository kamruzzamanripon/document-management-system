<?php

namespace Database\Factories;

use App\Models\Document;
use App\Models\DocumentUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DocumentUser>
 */
class DocumentUserFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DocumentUser::class;
    
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Get a list of unique user IDs
        $uniqueUserIds = User::pluck('id')->toArray();

        
        return [
            'document_id' => Document::factory(),
            'user_id' => $this->faker->randomElement($uniqueUserIds),
            'last_viewed_version' => $this->faker->randomElement(['ver_0001', 'ver_0002', 'ver_0003', 'ver_0004', 'ver_0005']),
        ];
    }
}
