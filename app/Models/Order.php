<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = ['nama_pemesan', 'nomor_meja', 'total'];

    // Relasi: Satu Order memiliki banyak OrderItem
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}