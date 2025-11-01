<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tour_guides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama', 150);
            $table->enum('spesialisasi', ['alam', 'kuliner', 'budaya', 'campuran'])->default('campuran');
            $table->text('pengalaman')->nullable();
            $table->string('bahasa', 100)->nullable();
            $table->string('kontak', 50)->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tour_guides');
    }
};
