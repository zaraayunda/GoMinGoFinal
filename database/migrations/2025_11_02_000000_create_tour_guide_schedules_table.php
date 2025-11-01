<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tour_guide_schedules', function (Blueprint $t) {
            $t->id();
            $t->foreignId('tour_guide_id')->constrained('tour_guides')->cascadeOnDelete();
            $t->dateTime('start_at');        // mulai
            $t->dateTime('end_at');          // selesai
            $t->enum('status', ['available','booked','blocked'])->default('available');
            $t->string('title', 150)->nullable();   // opsional: “Open Trip Bukittinggi”
            $t->string('location', 150)->nullable();
            $t->text('note')->nullable();
            $t->timestamps();

            $t->index(['tour_guide_id','start_at']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('tour_guide_schedules');
    }
};
