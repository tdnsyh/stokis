<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stokis_id')->constrained()->onDelete('cascade');
            $table->year('tahun');
            $table->integer('jan')->nullable()->default(0);
            $table->integer('feb')->nullable()->default(0);
            $table->integer('mar')->nullable()->default(0);
            $table->integer('apr')->nullable()->default(0);
            $table->integer('mei')->nullable()->default(0);
            $table->integer('jun')->nullable()->default(0);
            $table->integer('jul')->nullable()->default(0);
            $table->integer('agt')->nullable()->default(0);
            $table->integer('sep')->nullable()->default(0);
            $table->integer('okt')->nullable()->default(0);
            $table->integer('nov')->nullable()->default(0);
            $table->integer('des')->nullable()->default(0);
            $table->integer('total')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
