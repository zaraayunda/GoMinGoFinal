<?php
// database/migrations/2025_11_01_000002_create_event_registrations_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('event_registrations', function (Blueprint $t) {
            $t->id();
            $t->foreignId('event_id')->constrained()->cascadeOnDelete();
            $t->foreignId('tour_guide_id')->constrained('tour_guides')->cascadeOnDelete();
            $t->enum('status', ['pending','approved','rejected'])->default('pending');
            $t->string('catatan')->nullable();
            $t->timestamps();
            $t->unique(['event_id','tour_guide_id']); // satu pendaftaran per TG per event
        });
    }
    public function down(): void { Schema::dropIfExists('event_registrations'); }
};
