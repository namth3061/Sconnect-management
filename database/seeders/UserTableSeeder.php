<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserAsset;
use App\Models\UserBusiness;
use App\Models\UserCRM;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * php artisan db:seed --class=UserTableSeeder
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'first_name' => 'System',
                'last_name' => 'Admin',
                'username' => 'systemadmin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'phone_number' => '+12398190255',
                'email_verified_at' => now(),
                'user_type' => 'super_admin',
                'status' => 'active',
                'tenant_id' => 1,
            ],
            [
                'first_name' => 'Demo',
                'last_name' => 'Admin',
                'username' => 'admin_asset',
                'email' => 'demo@example.com',
                'status' => 'active',
                'password' => bcrypt('password'),
                'phone_number' => '+12398190255',
                'email_verified_at' => now(),
                'user_type' => 'admin',
                'tenant_id' => 2,
            ],
            [
                'first_name' => 'John',
                'last_name' => 'User',
                'username' => 'admin_crm',
                'email' => 'user@example.com',
                'password' => bcrypt('password'),
                'phone_number' => '+12398190255',
                'email_verified_at' => now(),
                'user_type' => 'admin',
                'status' => 'active',
                'tenant_id' => 4,
            ],
            [
                'first_name' => 'Admin',
                'last_name' => 'Business',
                'username' => 'admin_business',
                'email' => 'business@example.com',
                'password' => bcrypt('password'),
                'phone_number' => '+12398190255',
                'email_verified_at' => now(),
                'user_type' => 'admin',
                'status' => 'active',
                'tenant_id' => 3,
            ]
        ];

        DB::beginTransaction();
        try {

            foreach ($users as $key => $value) {
                $user = User::create($value);
                $user->assignRole($value['user_type']);
            }

            \App\Models\User::factory(40)->create()->each(function ($user) {
                $user->tenant_id = 2;
                $user->save();
                $user->assignRole('user');
            });
            \App\Models\UserProfile::factory(43)->create();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }
}
