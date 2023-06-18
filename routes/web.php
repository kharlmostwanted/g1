<?php

use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Fees\Index as FeesIndex;
use App\Http\Livewire\Households\Index;
use App\Http\Livewire\Households\Show as HouseholdsShow;
use App\Http\Livewire\Payments\Create;
use App\Http\Livewire\Payments\Index as PaymentsIndex;
use App\Http\Livewire\Payments\Show;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});

Route::name('households.')->prefix('households')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', Index::class)->name('index');
        Route::get('/{household}', HouseholdsShow::class)->name('show');
    });

Route::name('fees.')->prefix('fees')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', FeesIndex::class)->name('index');
    });

Route::name('payments.')->prefix('payments')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', PaymentsIndex::class)->name('index');
        Route::get('/create', Create::class)->name('create');
        Route::get('/{payment}', Show::class)->name('show');
    });
