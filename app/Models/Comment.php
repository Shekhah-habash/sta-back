<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function tourist()
    {
        return $this->belongsTo(Tourist::class);
    }
}
