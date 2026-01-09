<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceFactory> */
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'category_id'
    ];

    protected $appends = ['children_recursive_count'];

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

    public function getChildrenRecursiveCountAttribute()
    {
        // If childrenRecursive relation is loaded, count in-memory (avoids extra query)
        if ($this->relationLoaded('childrenRecursive')) {
            return $this->countChildrenRecursive($this->childrenRecursive);
        }

        // Attempt a recursive CTE query (works on MySQL 8+, Postgres, SQLite3)
        try {
            $row = DB::selectOne(
                'WITH RECURSIVE cte AS (
                    SELECT id FROM categories WHERE category_id = ?
                    UNION ALL
                    SELECT c.id FROM categories c JOIN cte ON c.category_id = cte.id
                ) SELECT COUNT(*) AS cnt FROM cte',
                [$this->id]
            );
            return $row->cnt ?? 0;
        } catch (\Exception $e) {
            return 0;
        }
    }

    private function countChildrenRecursive($children)
    {
        $count = 0;
        foreach ($children as $child) {
            $count += 1;
            if ($child->relationLoaded('childrenRecursive') || $child->childrenRecursive) {
                $count += $this->countChildrenRecursive($child->childrenRecursive);
            }
        }
        return $count;
    }

    public function providers()
    {
        return $this->belongsToMany(Provider::class);
    }
}
