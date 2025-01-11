<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{
    protected $fillable = ['room_id', 'path'];


    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
