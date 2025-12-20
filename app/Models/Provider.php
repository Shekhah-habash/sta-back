<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    
}

