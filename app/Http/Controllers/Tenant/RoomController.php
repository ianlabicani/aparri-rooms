<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('images')->orderBy('created_at', 'desc')->paginate(10);
        return view('tenant.rooms.index', compact('rooms'));
    }

    public function show(string $id)
    {
        $room = Room::findOrFail($id);
        return view('tenant.rooms.show', compact('room'));
    }

}
