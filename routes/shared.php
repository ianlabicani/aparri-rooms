<?php
use App\Http\Controllers\Shared\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RoomController::class, 'welcome'])->name('welcome');
