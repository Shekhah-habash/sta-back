<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tourist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'DOB',
        'gender',
        'user_id',
        'country_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function categories()
    {
        return $this->belongsToMany(Category::class , 'profiles');
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class );
    }
    public function services()
    {
        return $this->belongsToMany(Service::class  , 'ratings')->withPivot('rate');
    }
    public function comments()
    {
        return $this->belongsToMany(Service::class  , 'comments')->withPivot(['comment' , 'type']);;
    }
}
