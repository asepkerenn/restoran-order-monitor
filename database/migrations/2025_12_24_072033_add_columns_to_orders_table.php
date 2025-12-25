<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'nama_pemesan')) {
                $table->string('nama_pemesan');
            }
            if (!Schema::hasColumn('orders', 'nomor_meja')) {
                $table->string('nomor_meja');
            }
            if (!Schema::hasColumn('orders', 'total')) {
                $table->integer('total')->default(0);
            }
        });
    }

    public function down(): void
    {
        // aman dikosongkan
    }
};
