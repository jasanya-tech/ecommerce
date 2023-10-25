<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $guarded = ['id'];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function listOrder()
    {
        return $this->hasMany(ListOrder::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['status_filter'] ?? false, function ($query, $filters) {
            if ($filters === "Pesanan Diproses") {
                $query->where('status', '=', "Pesanan Diproses");
            } elseif ($filters === "Pesanan Dikirim") {
                $query->where('status', '=', "Pesanan Dikirim");
            } elseif ($filters === "Pesanan Diterima") {
                $query->where('status', '=', "Pesanan Diterima");
            } elseif ($filters === "Pesanan Dibatalkan") {
                $query->where('status', '=', "Pesanan Dibatalkan");
            }
        })->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        })->when(
            $filters['sort_option'] ?? false,
            function ($query, $sortOption) {
                switch ($sortOption) {
                    case 'created_at_asc':
                        $query->orderBy('id', 'ASC');
                        break;
                    case 'created_at_desc':
                        $query->orderBy('id', 'DESC');
                        break;
                }
            }
        );
    }
}
