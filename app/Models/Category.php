<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceFactory> */
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'category_id'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


    public function children()
    {
        return $this->hasMany(Category::class, 'category_id');
    }


    // تحميل الأبناء بشكل متكرر
    public function childrenRecursive()
    {
        return $this->children()->with(['childrenRecursive', 'providers']);
    }

    public function providers()
    {
        return $this->belongsToMany(Provider::class);
    }
}
