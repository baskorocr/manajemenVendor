<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('riwayats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('no_assets');
            $table->unsignedInteger('idUser');
            $table->string('StatusAwal');
            $table->string('StatusAkhir');
            $table->string('bukti');
            $table->timestamps();
            $table->foreign('no_assets')->references('no_assets')->on('assets')->onDelete('cascade');
            $table->foreign('idUser')->references('NPK')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayats');
    }
};