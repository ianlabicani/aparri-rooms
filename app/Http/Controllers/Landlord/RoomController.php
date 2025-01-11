<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function all(Room $room)
    {
        $rooms = Room::with('images')->orderBy('created_at', 'desc')->paginate(10);
        return view("landlord.rooms.index", compact("rooms"));
    }

    public function index()
    {
        // TODO: have an option to show all rooms
        $rooms = auth()->user()->rooms()->with('images')->orderBy('created_at', 'desc')->paginate(10);
        return view('landlord.rooms.index', compact('rooms'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('landlord.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'capacity' => 'required|integer',
            'description' => 'nullable|string',
            'amenities' => 'nullable|string',
            'status' => 'required|boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image
        ]);

        // Create new room record
        $room = new Room();
        $room->user_id = auth()->id();
        $room->name = $validated['name'];
        $room->price = $validated['price'];
        $room->capacity = $validated['capacity'];
        $room->description = $validated['description'];
        $room->amenities = $validated['amenities'] ? array_map('trim', explode(',', $validated['amenities'])) : null;
        $room->status = $validated['status'];
        $room->save();

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('room_images', 'public'); // Store each image

                // Save image information to the RoomImage table
                $roomImage = new RoomImage();
                $roomImage->room_id = $room->id;
                $roomImage->path = $imagePath;
                $roomImage->save();
            }
        }

        return redirect()->route('landlord.rooms.index')->with('success', 'Room added successfully.');
    }





    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $room = Room::findOrFail($id);
        return view('landlord.rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        if ($room->user_id !== auth()->id()) {
            return redirect()->route('landlord.rooms.index')->with('error', 'You are not authorized to update this room.');
        }


        return view('landlord.rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {

        if ($room->user_id !== auth()->id()) {
            return redirect()->route('landlord.rooms.index')->with('error', 'You are not authorized to update this room.');
        }


        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'capacity' => 'required|integer',
            'description' => 'nullable|string',
            'amenities' => 'nullable|string',
            'status' => 'required|boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update Room Details
        $room->name = $validated['name'];
        $room->price = $validated['price'];
        $room->capacity = $validated['capacity'];
        $room->description = $validated['description'];
        $room->amenities = $validated['amenities'] ? array_map('trim', explode(',', $validated['amenities'])) : null;
        $room->status = $validated['status'];
        $room->save();

        // Handle Image Uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Store each image in the "public/room_images" directory
                $path = $image->store('room_images', 'public');

                // Create a new RoomImage record
                $room->images()->create([
                    'path' => $path,
                ]);
            }
        }

        return redirect()
            ->route('landlord.rooms.show', $room->id)
            ->with('success', 'Room updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('landlord.rooms.index')->with('success', 'Room deleted successfully!');
    }
}
