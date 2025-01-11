<?php
use App\Http\Controllers\Landlord\RoomController;
use App\Http\Controllers\Landlord\RoomImageController;
use Illuminate\Support\Facades\Route;

Route::prefix("landlord")->name('landlord.')->middleware(['auth', 'role:landlord'])->group(function () {
  Route::get('dashboard', function () {
    return view('landlord.dashboard.index');
  })->name('dashboard');

  // rooms resource
  Route::get('rooms/all', [RoomController::class, 'all'])->name('rooms.all');
  Route::resource('rooms', RoomController::class);
  Route::resource('room-images', RoomImageController::class);

});
