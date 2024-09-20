<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tenant;

class TenantSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $tenant1 = Tenant::create([
            'name' => 'Tenant 1',
            'domain' => 'sconnect.local',
        ]);
        $tenant1 = Tenant::create([
            'name' => 'Tenant 2',
            'domain' => 'assets.sconnect.local',
        ]);
        $tenant2 = Tenant::create([
            'name' => 'Tenant 3',
            'domain' => 'business.sconnect.local',
        ]);
        $tenant3 = Tenant::create([
            'name' => 'Tenant 4',
            'domain' => 'crm.sconnect.local',
        ]);
        $tenant5 = Tenant::create([
            'name' => 'Tenant 5',
            'domain' => '172.16.67.66',
        ]);
    }
}
