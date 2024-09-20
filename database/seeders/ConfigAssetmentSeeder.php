<?php

namespace Database\Seeders;

use App\Models\ConfigAssetment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigAssetmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ConfigAssetment::factory()->count(5)->create();
    }
}
