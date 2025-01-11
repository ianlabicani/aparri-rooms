<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Models\RoomImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the image by its ID
        $image = RoomImage::findOrFail($id);

        // Ensure the image belongs to a room owned by the authenticated user
        if (!auth()->user()->rooms->contains($image->room_id)) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the image file from storage
        if (Storage::exists("public/{$image->path}")) {
            Storage::delete("public/{$image->path}");
        }

        // Delete the image record from the database
        $image->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
}
