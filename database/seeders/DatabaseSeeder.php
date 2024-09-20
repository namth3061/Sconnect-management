<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * php artisan cache:forget spatie.permission.cache
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionTableSeeder::class,
            RoleTableSeeder::class,
            TenantSeeder::class,
            UserTableSeeder::class,
            ProcessSeeder::class,
            RegulationSeeder::class,
            PlansSeeder::class,
            StrategySeeder::class,
            ConfigAssetmentSeeder::class,
        ]);
     }
}
