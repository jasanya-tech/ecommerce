<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $guarded = ['id'];

    public function image()
    {
        return $this->hasMany(ImageProduct::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['stock_filter'] ?? false, function ($query, $filters) {
            if ($filters === "available") {
                $query->where('stock', '>', 0);
            } elseif ($filters === "unavailable") {
                $query->where('stock', '<=', 0);
            }
        })->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        })->when(
            $filters['sort_option'] ?? false,
            function ($query, $sortOption) {
                switch ($sortOption) {
                    case 'name_asc':
                        $query->orderBy('name', 'asc');
                        break;
                    case 'name_desc':
                        $query->orderBy('name', 'desc');
                        break;
                    case 'price_asc':
                        $query->orderBy('price', 'asc');
                        break;
                    case 'price_desc':
                        $query->orderBy('price', 'desc');
                        break;
                    case 'stock_asc':
                        $query->orderBy('stock', 'asc');
                        break;
                    case 'stock_desc':
                        $query->orderBy('stock', 'desc');
                        break;
                }
            }
        );
    }
}
