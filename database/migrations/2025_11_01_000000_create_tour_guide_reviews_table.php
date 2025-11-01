<?php
// database/migrations/2025_11_01_000000_create_tour_guide_reviews_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tour_guide_reviews', function (Blueprint $t) {
            $t->id();
            $t->foreignId('tour_guide_id')->constrained('tour_guides')->onDelete('cascade');
            $t->string('user_name', 100);
            $t->unsignedTinyInteger('rating');           // 1..5
            $t->text('komentar')->nullable();
            $t->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('tour_guide_reviews');
    }
};
