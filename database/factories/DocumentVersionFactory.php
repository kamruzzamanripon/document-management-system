<?php

namespace Database\Factories;

use App\Models\Document;
use App\Models\DocumentVersion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DocumentVersion>
 */
class DocumentVersionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DocumentVersion::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'document_id' =>  Document::factory(),
            'version' => $this->faker->randomElement(['ver_0001', 'ver_0002', 'ver_0003', 'ver_0004', 'ver_0005']),
            'body_content' => $this->faker->paragraphs(3, true),
            'tags_content' =>  $this->faker->sentence ,
        ];
    }
}
