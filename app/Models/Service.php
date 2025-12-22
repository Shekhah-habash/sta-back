<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Provider;
use App\Models\Booking;
use App\Models\Rating;
use App\Models\Comment;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'identifier',
        'details',
        'provider_id',
    ];

    protected $casts = [
        'details' => 'array',
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
