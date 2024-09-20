<?php

namespace Database\Factories;

use App\Models\Process;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProcessFactory extends Factory
{
    protected $model = Process::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ftitle = $this->faker->name;
        $fdescription = $this->faker->text;
        $ftenant_id = 1;

        return [
            'title' => $ftitle,
            'description' => $fdescription,
            'tenant_id' => $ftenant_id,
        ];
    }
}
