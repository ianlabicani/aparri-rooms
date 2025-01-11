<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function welcome()
    {
        // Fetch only the first 5 rooms
        $rooms = Room::limit(5)->get();
        return view('shared.welcome.index', compact('rooms'));
    }

}
