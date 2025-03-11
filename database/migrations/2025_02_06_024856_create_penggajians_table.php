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
        Schema::create('penggajians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('komponen_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('gaji_pokok');
            $table->date('tanggal');
            $table->integer('tunjangan');
            $table->integer('potongan');
            $table->integer('pph');
            $table->integer('bpjs');
            $table->integer('gaji_bersih');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('komponen_id')->references('id')->on('komponen_gajis')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggajians');
    }
};
