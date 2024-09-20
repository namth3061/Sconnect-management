<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * php artisan migrate --path=/database/migrations/landlord/2024_07_05_095204_create_landlord_tenants_table.php
     *
     * php artisan tinker
     *
     * use App\Models\Tenant;
     *
     * $tenant1 = Tenant::create([
     * 'name' => 'Tenant 1',
     * 'domain' => 'khoi1.sconnect.local',
     * ]);
     *
     * $tenant2 = Tenant::create([
     * 'name' => 'Tenant 2',
     * 'domain' => 'khoi2.sconnect.local',
     * ]);
     *
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('domain')->unique();
            $table->string('database')->default(env('DB_DATABASE', ''));
            $table->string('guard_name')->default('web');
            $table->enum('status', ['active', 'un-active', 'completed', 'cancelled'])->default('active');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes()->nullable();

        });
    }
};
