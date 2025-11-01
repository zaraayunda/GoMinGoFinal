<?php

namespace App\Console\Commands;

use App\Models\TempatWisata;
use Illuminate\Console\Command;

class FixTempatWisataStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tempat-wisata:fix-status {--all : Update semua status ke approved} {--status= : Status yang akan diupdate (default: pending)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perbaiki status tempat wisata yang diimport agar tampil di halaman public';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== Cek Status Tempat Wisata ===' . PHP_EOL);

        // Tampilkan distribusi status
        $statuses = TempatWisata::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        $this->info('Distribusi Status:');
        foreach ($statuses as $status) {
            $this->line("  - Status: " . ($status->status ?? 'NULL') . " | Count: " . $status->count);
        }

        $this->newLine();

        // Hitung yang tidak akan tampil
        $notVisible = TempatWisata::whereNotIn('status', ['approved', 'aktif', 'active', 'published', 'publish'])
            ->orWhereNull('status')
            ->count();

        $this->warn("Tempat wisata yang TIDAK akan tampil di halaman public: {$notVisible}");

        if ($notVisible == 0) {
            $this->info('✓ Semua tempat wisata sudah memiliki status yang benar!');
            return Command::SUCCESS;
        }

        $this->newLine();

        if ($this->option('all')) {
            // Update semua ke approved
            $updated = TempatWisata::whereNotIn('status', ['approved'])
                ->orWhereNull('status')
                ->update(['status' => 'approved']);

            $this->info("✓ Berhasil mengupdate {$updated} tempat wisata ke status 'approved'");
        } else {
            $statusToUpdate = $this->option('status') ?: 'pending';
            
            if (!$this->confirm("Apakah Anda ingin mengupdate semua tempat wisata dengan status '{$statusToUpdate}' ke 'approved'?")) {
                $this->info('Dibatalkan.');
                return Command::SUCCESS;
            }

            $updated = TempatWisata::where('status', $statusToUpdate)
                ->update(['status' => 'approved']);

            $this->info("✓ Berhasil mengupdate {$updated} tempat wisata dari status '{$statusToUpdate}' ke 'approved'");
        }

        $this->newLine();
        $this->info('Silakan refresh halaman peta (/peta) untuk melihat perubahan.');

        return Command::SUCCESS;
    }
}

