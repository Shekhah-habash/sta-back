<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'accepted',
        'user_id',
        'image_id',
        'location'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function services()
    {
        return $this->hasMany(Service::class);
    }
    
    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    
    // public function getLatAttribute()
    // {
    //     return DB::raw('ST_X(location)');
    // }

    // public function getLngAttribute()
    // {
    //     return DB::raw('ST_Y(location)');
    // }
}
