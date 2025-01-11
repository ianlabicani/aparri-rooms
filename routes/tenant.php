<?php
use App\Http\Controllers\Tenant\RoomController;
use Illuminate\Support\Facades\Route;

Route::prefix("tenant")->name('tenant.')->middleware(['auth', 'role:tenant'])->group(function () {
  Route::get('dashboard', function () {
    return view('tenant.dashboard.index');
  })->name('dashboard');

  // rooms resource
  Route::resource('rooms', RoomController::class)->only(['index', 'show']);

});
