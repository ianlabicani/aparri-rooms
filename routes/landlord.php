<?php
use Illuminate\Support\Facades\Route;

Route::prefix("landlord")->group(function () {
  Route::get('dashboard', function () {
    return view('landlord.dashboard.index');
  })->name('landlord.dashboard');
});
