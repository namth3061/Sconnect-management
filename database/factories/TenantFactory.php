<?php

namespace Database\Factories;

use App\Enums\TenantStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tenant;

class TenantFactory extends Factory
{
    protected $model = Tenant::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'domain' => $this->faker->domainName(),
            'status' => TenantStatus::ACTIVE,
        ];
    }
}
