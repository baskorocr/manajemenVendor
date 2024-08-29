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
        Schema::create('assets', function (Blueprint $table) {
            $table->integer('no_assets')->primary()->unsigned(); // Primary key auto-increment
            $table->foreignId('vendor_id')->constrained('vendors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('asset_type_id')->constrained('asset_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('proses_id')->constrained('proses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('pemiliks_id')->constrained('pemiliks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('photo_id')->constrained('photos')->onDelete('cascade')->onUpdate('cascade');
            $table->string('idPart');

            $table->integer('jumlah')->nullable();
            $table->timestamps();

            // Define foreign key relationship
            $table->foreign('idPart')->references('idPart')->on('parts')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};