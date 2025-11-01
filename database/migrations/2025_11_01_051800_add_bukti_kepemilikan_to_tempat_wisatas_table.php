<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tempat_wisatas', function (Blueprint $table) {
            $table->string('bukti_kepemilikan')->nullable()->after('jam_buka');
            $table->string('tipe_bukti')->nullable()->after('bukti_kepemilikan'); // 'sertifikat', 'surat_izin', 'akta', 'lainnya'
        });
    }

    public function down(): void
    {
        Schema::table('tempat_wisatas', function (Blueprint $table) {
            $table->dropColumn(['bukti_kepemilikan', 'tipe_bukti']);
        });
    }
};
