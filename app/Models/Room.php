<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'price',
        'capacity',
        'description',
        'status',
        'amenities',
        'latitude',
        'longitude',
        'location_description'
    ];

    protected $casts = [
        'amenities' => 'array',
    ];

    public function landlord()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function images()
    {
        return $this->hasMany(RoomImage::class);
    }

}
