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
        Schema::create('detail_tour_guides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_guide_id')->constrained('tour_guides')->onDelete('cascade');
            $table->string('bahasa')->nullable();
            $table->string('sertifikat')->nullable();
            $table->string('sertifikat_nama')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_tour_guides');
    }
};
