<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [   'start_date' ,'end_date', 'quantity','price' , 'note' , 'status' , 'evaluate','service_id','tourist_id'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
