<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            if (!Schema::hasColumn('order_items', 'order_id')) {
                $table->foreignId('order_id');
            }
            if (!Schema::hasColumn('order_items', 'menu_id')) {
                $table->foreignId('menu_id');
            }
            if (!Schema::hasColumn('order_items', 'qty')) {
                $table->integer('qty');
            }
            if (!Schema::hasColumn('order_items', 'subtotal')) {
                $table->integer('subtotal');
            }
        });
    }

    public function down(): void
    {
        // aman dikosongkan
    }
};
