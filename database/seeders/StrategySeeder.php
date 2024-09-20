<?php

namespace Database\Seeders;

use App\Models\Strategy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StrategySeeder extends Seeder
{

     /**
     * Auto generated seed file
     *
     * php artisan db:seed --class=StrategySeeder
     *
     * @return void
     */

    public function run(){

        $strategy = [
            [
                'title' => 'Strategy 1',
                'tenant_id' => 1,
            ],
            [
                'title' => 'Strategy 2',
                'tenant_id' => 1,
            ],
            [
                'title' => 'Strategy 3',
                'tenant_id' => 1,
            ],
            [
                'title' => 'Strategy 4',
                'tenant_id' => 1,
            ],
        ];

        DB::beginTransaction();

        try {

            foreach ($strategy as $key => $value) {
                $strategy = Strategy::create($value);
            }

            \App\Models\Strategy::factory(40)->create()->each(function ($strategy) {
                $strategy->tenant_id = 1;
                $strategy->save();
            });

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }  
}
