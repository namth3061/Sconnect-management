<?php

namespace Database\Factories;

use App\Models\Regulation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Regulation>
 */
class RegulationFactory extends Factory
{
    protected $model = Regulation::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'description' => $this->faker->text,
            'tenant_id' => 1
        ];
    }
}
