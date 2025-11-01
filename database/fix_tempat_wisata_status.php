<?php

/**
 * Script untuk memperbaiki status tempat wisata yang diimport
 * 
 * Jalankan dengan: php artisan tinker
 * Lalu copy-paste isi script ini atau jalankan: php database/fix_tempat_wisata_status.php
 */

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\TempatWisata;

echo "=== Cek Status Tempat Wisata ===" . PHP_EOL . PHP_EOL;

// Cek distribusi status
$statuses = TempatWisata::selectRaw('status, COUNT(*) as count')
    ->groupBy('status')
    ->get();

echo "Distribusi Status:" . PHP_EOL;
foreach ($statuses as $status) {
    echo "  - Status: " . ($status->status ?? 'NULL') . " | Count: " . $status->count . PHP_EOL;
}

echo PHP_EOL . "=== Rekomendasi Perbaikan ===" . PHP_EOL . PHP_EOL;

// Hitung yang tidak akan tampil (bukan approved/aktif/active)
$notVisible = TempatWisata::whereNotIn('status', ['approved', 'aktif', 'active', 'published', 'publish'])
    ->orWhereNull('status')
    ->count();

echo "Tempat wisata yang TIDAK akan tampil: " . $notVisible . PHP_EOL . PHP_EOL;

// Tampilkan beberapa contoh
$examples = TempatWisata::whereNotIn('status', ['approved', 'aktif', 'active', 'published', 'publish'])
    ->orWhereNull('status')
    ->take(5)
    ->get(['id', 'nama_tempat', 'status']);

if ($examples->count() > 0) {
    echo "Contoh tempat wisata yang tidak tampil:" . PHP_EOL;
    foreach ($examples as $tw) {
        echo "  - ID: {$tw->id} | Nama: {$tw->nama_tempat} | Status: " . ($tw->status ?? 'NULL') . PHP_EOL;
    }
    echo PHP_EOL;
}

echo "=== Pilihan Perbaikan ===" . PHP_EOL . PHP_EOL;
echo "Untuk memperbaiki, jalankan salah satu query berikut di database:" . PHP_EOL . PHP_EOL;
echo "1. Update semua ke 'approved':" . PHP_EOL;
echo "   UPDATE tempat_wisatas SET status = 'approved' WHERE status NOT IN ('approved') OR status IS NULL;" . PHP_EOL . PHP_EOL;

echo "2. Update hanya yang NULL atau kosong:" . PHP_EOL;
echo "   UPDATE tempat_wisatas SET status = 'approved' WHERE status IS NULL OR status = '';" . PHP_EOL . PHP_EOL;

echo "3. Update status lama ke status baru (sesuaikan sesuai kebutuhan):" . PHP_EOL;
echo "   UPDATE tempat_wisatas SET status = 'approved' WHERE status IN ('pending', 'aktif', 'active', 'published', 'publish');" . PHP_EOL . PHP_EOL;

echo "Setelah update, refresh halaman peta (/peta) untuk melihat perubahan." . PHP_EOL;

