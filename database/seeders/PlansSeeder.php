<?php

namespace Database\Seeders;

use App\Models\Plans;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansSeeder extends Seeder
{

     /**
     * Auto generated seed file
     *
     *  artisan db:seed --class=PlansSeederphp
     *
     * @return void
     */
    public function run(){

        $plans = [
            [
                'title' => 'Plans 1',
                'tenant_id' => 1,
            ],
            [
                'title' => 'Plans 2',
                'tenant_id' => 1,
            ],
            [
                'title' => 'Plans 3',
                'tenant_id' => 1,
            ],
            [
                'title' => 'Plans 4',
                'tenant_id' => 1,
            ],
        ];

        DB::beginTransaction();

        try {

            foreach ($plans as $key => $value) {
                $plans = Plans::create($value);
            }

            \App\Models\Plans::factory(40)->create()->each(function ($plans) {
                $plans->tenant_id = 1;
                $plans->save();
            });

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }   
}
