<?php

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

// Packages

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/auth.php';

Route::get('/storage', function () {
    Artisan::call('storage:link');
});

Route::get('/', function () {
    return redirect()->route('system.dashboard');
})->name('uisheet');


//Extra Page Routs
Route::get('privacy-policy', [HomeController::class, 'privacypolicy'])->name('pages.privacy-policy');
Route::get('terms-of-use', [HomeController::class, 'termsofuse'])->name('pages.term-of-use');
Route::get('recoverpw', [HomeController::class, 'recoverpw'])->name('auth.recoverpw');


//UI Pages Routs
//Route::get('/list-components', [HomeController::class, 'uisheet'])->name('list_components');

Route::group(['middleware' => ['auth.check'], 'prefix' => 'system'], function () {
    Route::get('/dashboard', \App\Livewire\Dashboard::class)->name('system.dashboard');
    Route::get('/tenant', \App\Livewire\Tenant::class)->name('system.tenant');

    Route::get('/users', \App\Livewire\User::class)->name('system.users');
    Route::post('/get_role', [RoleController::class, 'getRole'])->name('system.get_role');
    Route::post('/get_tenant', [TenantController::class, 'getTenant'])->name('system.get_tenant');

    // Permission Module
    Route::get('/role-permission', \App\Livewire\RolePermission::class)->name('system.role_permission');
    Route::get('/create/role', \App\Livewire\RoleCreate::class)->name('system.create.role');
    Route::get('/edit/role/{roleId}', \App\Livewire\RoleEdit::class)->name('system.edit.role');

    Route::get('lockscreen', [HomeController::class, 'lockscreen'])->name('auth.lockscreen');
    Route::get('userprivacysetting', [HomeController::class, 'userprivacysetting'])->name('auth.userprivacysetting');

});


Route::group(['middleware' => ['auth.check'], 'prefix' => 'crm'], function () {
    Route::get('/strategy', \App\Livewire\Strategy::class)->name('crm.strategy');
    Route::get('/strategy-create', \App\Livewire\StrategyCreate::class)->name('crm.create.strategy');
    Route::get('/edit/strategy/{strategy_id}', \App\Livewire\StrategyEdit::class)->name('crm.edit.strategy');
    Route::get('/delete/strategy/{strategy_id}', \App\Livewire\StrategyDelete::class)->name('crm.delete.strategy');

    Route::get('/plans', \App\Livewire\Plans::class)->name('crm.plans');
    Route::get('/plans/create', \App\Livewire\PlansCreate::class)->name('crm.create.plans');
    Route::get('/plans/edit/{plans_id}', \App\Livewire\PlansEdit::class)->name('crm.edit.plans');
    Route::get('/delete/plans/{plans_id}', \App\Livewire\PlansDelete::class)->name('crm.delete.plans');

    Route::get('/regulation',\App\Livewire\Regulation::class)->name('crm.regulation');
    Route::get('/create/regulation',\App\Livewire\RegulationCreate::class)->name('crm.create.regulation');
    Route::get('/edit/regulation/{id}',\App\Livewire\RegulationEdit::class)->name('crm.edit.regulation');
    Route::get('/delete/regulation/{id}',\App\Livewire\RegulationDelete::class)->name('crm.delete.regulation');

    Route::get('/process', \App\Livewire\Process::class)->name('crm.process');
    Route::get('/create/process', \App\Livewire\ProcessCreate::class)->name('crm.create.process');
    Route::get('/edit/process/{processId}', \App\Livewire\ProcessEdit::class)->name('crm.edit.process');
    Route::get('/delete/process/{processId}', \App\Livewire\ProcessDelete::class)->name('crm.delete.process');
});

Route::group(['middleware' => ['auth.check'], 'prefix' => 'asset'], function () {
    Route::get('/intellectual-property',\App\Livewire\ConfigAssetment::class)->name('asset.config_assetment');
    Route::get('/create/intellectual-property',\App\Livewire\ConfigAssetmentCreate::class)->name('asset.create.config_assetment');
    Route::get('/edit/intellectual-property/{id}',\App\Livewire\ConfigAssetmentEdit::class)->name('asset.edit.config_assetment');
    Route::get('/delete/intellectual-property/{id}',\App\Livewire\ConfigAssetmentDelete::class)->name('asset.delete.config_assetment');
});

Route::group(['middleware' => [], 'prefix' => 'business'], function () {

});

////Error Page Route
Route::group(['prefix' => 'errors'], function () {
    Route::get('error404', [HomeController::class, 'error404'])->name('errors.error404');
    Route::get('error500', [HomeController::class, 'error500'])->name('errors.error500');
    Route::get('maintenance', [HomeController::class, 'maintenance'])->name('errors.maintenance');
});
