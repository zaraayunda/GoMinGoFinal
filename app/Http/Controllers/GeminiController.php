<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\TempatWisata;

class GeminiController extends Controller
{
    public function askAI(Request $request)
    {
        try {
            $question = $request->input('question');

            // Validasi input
            if (empty($question)) {
                return response()->json([
                    'error' => 'Pertanyaan tidak boleh kosong'
                ], 400);
            }

            // Ambil data dari database (menggunakan Model Eloquent)
            $wisataList = TempatWisata::select('nama_tempat', 'alamat', 'deskripsi')
                ->where('status', 'approved') // Hanya ambil yang sudah di-approve
                ->get();

            // Buat konteks data dari database
            $context = "Berikut adalah database tempat wisata di Sumatera Barat:\n";
            foreach ($wisataList as $w) {
                $lokasi = $w->alamat ?? 'Lokasi tidak tersedia';
                $context .= "- {$w->nama_tempat} di {$lokasi}: {$w->deskripsi}\n";
            }

            // Buat prompt yang lebih natural dan informatif
            $prompt = "Anda adalah asisten AI yang sangat berpengalaman tentang wisata Sumatera Barat. 
            
Data referensi tempat wisata yang terdaftar di sistem:
{$context}

Instruksi:
1. Jawablah pertanyaan pengguna secara langsung dan natural sebagai ahli wisata Sumatera Barat
2. Gunakan data di atas sebagai referensi utama, tetapi JANGAN menyebutkan 'berdasarkan data yang Anda berikan' atau frasa serupa
3. Jawablah seolah-olah Anda memiliki pengetahuan mendalam tentang Sumatera Barat
4. Jika data lokasi kurang jelas, gunakan pengetahuan umum Anda tentang geografi Sumatera Barat untuk melengkapi
5. Untuk wisatawan mancanegara, berikan estimasi biaya dalam USD dan tips perjalanan praktis
6. Sertakan informasi tambahan yang relevan seperti akses transportasi, waktu terbaik berkunjung, atau aktivitas unik di tempat tersebut
7. Gunakan bahasa yang ramah, informatif, dan mudah dipahami
8. Jika ada informasi yang tidak tersedia di database, gunakan pengetahuan umum tentang Sumatera Barat

Pertanyaan: {$question}

Jawablah dengan format yang jelas dan informatif:";

            // Ambil API key dari environment
            $apiKey = env('GEMINI_API_KEY');
            
            if (empty($apiKey)) {
                return response()->json([
                    'error' => 'API Key Gemini tidak dikonfigurasi. Silakan set GEMINI_API_KEY di file .env'
                ], 500);
            }

            // Kirim ke Gemini AI (menggunakan query parameter untuk API key)
            // Untuk development di Laragon, disable SSL verification sementara
            $httpClient = Http::timeout(30);
            
            // Hanya disable SSL verification jika environment development/local
            if (config('app.env') === 'local' || config('app.debug')) {
                $httpClient = $httpClient->withoutVerifying();
            }
            
            // Gunakan model yang lebih stabil dan tersedia
            $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . $apiKey;

            
            $response = $httpClient->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'topK' => 40,
                    'topP' => 0.95,
                    'maxOutputTokens' => 1024,
                ],
            ]);

            if ($response->failed()) {
                $errorBody = $response->body();
                return response()->json([
                    'error' => 'Gagal menghubungi Gemini API: ' . $errorBody
                ], $response->status());
            }

            $responseData = $response->json();

            // Debug: log response untuk troubleshooting
            Log::info('Gemini API Response', ['response' => $responseData]);

            // Ekstrak teks jawaban dari response dengan berbagai format
            $answer = 'Tidak ada jawaban yang ditemukan.';
            
            if (isset($responseData['candidates']) && is_array($responseData['candidates']) && count($responseData['candidates']) > 0) {
                $candidate = $responseData['candidates'][0];
                if (isset($candidate['content']['parts'][0]['text'])) {
                    $answer = $candidate['content']['parts'][0]['text'];
                }
            } elseif (isset($responseData['error'])) {
                // Jika ada error dari API
                $answer = 'Error dari Gemini API: ' . ($responseData['error']['message'] ?? 'Unknown error');
            }

            // Jika masih tidak ada jawaban, return error
            if ($answer === 'Tidak ada jawaban yang ditemukan.') {
                return response()->json([
                    'error' => 'Tidak dapat memproses response dari Gemini API. Response: ' . json_encode($responseData)
                ], 500);
            }

            return response()->json([
                'success' => true,
                'answer' => $answer
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
