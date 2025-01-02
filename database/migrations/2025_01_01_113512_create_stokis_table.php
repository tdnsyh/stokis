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
        Schema::create('stokis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kokab_id')->constrained('kokab')->onDelete('cascade');
            $table->foreignId('kecamatan_id')->constrained('kecamatan')->onDelete('cascade');
            $table->string('nama_stokis');
            $table->string('no_hp');
            $table->string('member');
            $table->string('nama_member');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stokis');
    }
};
