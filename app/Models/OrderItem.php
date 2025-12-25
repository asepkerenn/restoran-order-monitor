<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'menu_id', 'qty', 'subtotal'];

    // Relasi: Satu item pesanan merujuk ke satu Menu
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    // Relasi: Satu item pesanan dimiliki oleh satu Order
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}