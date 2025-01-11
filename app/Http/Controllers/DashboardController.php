<?php

namespace App\Http\Controllers;


class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole("landlord")) {
            return redirect()->intended(route('landlord.dashboard', absolute: false));
        }
        if (auth()->user()->hasRole('tenant')) {
            return redirect()->intended(route('tenant.dashboard', absolute: false));
        }

        return view('shared.welcome.index');
    }
}