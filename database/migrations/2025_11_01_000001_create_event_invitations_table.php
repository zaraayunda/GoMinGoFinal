<?php
// database/migrations/2025_11_01_000001_create_event_invitations_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('event_invitations', function (Blueprint $t) {
            $t->id();
            $t->foreignId('event_id')->constrained()->cascadeOnDelete();
            $t->foreignId('tour_guide_id')->constrained('tour_guides')->cascadeOnDelete();
            $t->timestamp('sent_at')->nullable();
            $t->timestamps();
            $t->unique(['event_id','tour_guide_id']); // cegah duplikat undangan
        });
    }
    public function down(): void { Schema::dropIfExists('event_invitations'); }
};
