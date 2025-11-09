<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function handleChat(Request $request)
    {
        $userMessage = $request->input('message'); // Ambil pesan dari frontend
        
        // --- Ambil API URL dan Key dari .env ---
        $apiUrl = env('MHCLOUD_API_URL'); 
        $apiKey = env('MHCLOUD_API_KEY');
        // ---------------------------------------

        $knowledgeBase = config('chatbot.knowledge_base'); // Ambil data dari config

        // Validasi dasar
        if (empty($userMessage)) {
            return response()->json(['reply' => 'Mohon ketikkan pertanyaan Anda.'], 400);
        }
        if (empty($apiKey)) { 
             Log::error('API Key MhCloud kosong atau belum diatur.');
             return response()->json(['reply' => 'Kesalahan konfigurasi: Kunci API AI belum diatur.'], 500);
        }

        $systemPrompt = "
            Anda adalah NJ-Bot, asisten virtual ramah dari SMK Nurul Jadid Paiton, Probolinggo.
            Tugas utama Anda adalah menjawab pertanyaan pengguna **HANYA** berdasarkan informasi yang tertera di dalam bagian `<DATA_SMKNJ>`. 
            **JANGAN** mencari informasi di luar data ini atau membuat jawaban sendiri.

            **Aturan Menjawab:**
            1.  Selalu gunakan Bahasa Indonesia yang baik, sopan, dan jelas.
            2.  Jika jawaban **ada** dalam `<DATA_SMKNJ>`, berikan jawaban yang relevan dan ringkas. Gunakan format Markdown (seperti '*' atau '-' untuk poin, '1.' '2.' untuk nomor, '**' untuk judul bagian) agar rapi, terutama untuk daftar, langkah-langkah, atau beberapa item.
            3.  Jika jawaban **tidak ditemukan** dalam `<DATA_SMKNJ>` (misalnya, detail tentang Fasilitas, Ekstrakurikuler, Prestasi, atau link pendaftaran yang belum diisi), jawab dengan sopan: 'Maaf, detail mengenai [topik yang ditanyakan] belum tersedia dalam data saya saat ini. Untuk informasi lebih lanjut, silakan kunjungi website resmi kami di www.smknj.sch.id atau hubungi kontak sekolah.'
            4.  Jangan berspekulasi atau menambahkan informasi yang tidak ada.
            5.  Fokus pada pertanyaan pengguna dan jawab secara langsung.

            <DATA_SMKNJ>
            {$knowledgeBase}
            </DATA_SMKNJ>

            Jawab pertanyaan pengguna berikut berdasarkan aturan di atas:
        ";
        
        // Prompt sistem, data, dan pertanyaan user
        $fullPrompt = $systemPrompt . "\n\n### USER:\n" . $userMessage;
        // $fullPrompt = $userMessage; // HANYA PESAN USER UNTUK TES
        
        // --- Panggilan ke API MhCloud ---
        try {
            $response = Http::timeout(60)->get($apiUrl, [
                'text' => $fullPrompt,
                'apikey' => $apiKey,
            ]);

            // --- Proses Balasan ---
            if ($response->successful()) {
                $responseData = $response->json();

                // Cek jika API mengembalikan pesan error internalnya sendiri
                if (isset($responseData['error'])) {
                    Log::warning('MhCloud API returned an error.', ['error' => $responseData['error'], 'prompt' => $userMessage]);
                    return response()->json(['reply' => 'Maaf, AI membalas dengan error: ' . $responseData['error']], 500);
                }

                // Ambil hasil dari field 'result'
                $aiAnswer = $responseData['result'] ?? null;

                if (empty($aiAnswer)) {
                    Log::warning('MhCloud API response success but result field is empty.', ['response' => $responseData]);
                    return response()->json(['reply' => 'Maaf, AI tidak memberikan jawaban yang valid.'], 500);
                }

                // Kode ini mencoba membersihkan tanda '*' yang mungkin dihasilkan AI
                $aiAnswer = preg_replace('/(\*)\s*([^\n:]+):/', '**$2**:', $aiAnswer);
                $aiAnswer = preg_replace('/^(\*)\s*(.+)$/m', ' **$2**', $aiAnswer);
                $aiAnswer = str_replace('**', '', $aiAnswer); // Hapus '**'
                $aiAnswer = preg_replace('/(\*)/', ' ', $aiAnswer); // Ganti '*' sisa dengan spasi

                return response()->json(['reply' => trim($aiAnswer)]); // Kirim jawaban bersih

            } else {
                // Jika request ke MhCloud gagal (misal: server down, API key salah)
                $statusCode = $response->status();
                $errorBody = $response->body(); 
                 try { $errorJson = $response->json(); } catch (\Exception $e) { $errorJson = null; }

                Log::error('MhCloud API request failed.', [
                    'status' => $statusCode,
                    'error' => $errorJson ?? $errorBody
                ]);
                return response()->json(['reply' => 'Maaf, terjadi masalah saat menghubungi server AI. Kode Error: ' . $statusCode], 503);
            }

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Connection to MhCloud API timed out or failed.', ['error' => $e->getMessage()]);
            return response()->json(['reply' => 'Tidak dapat terhubung ke server AI. Mungkin ada masalah jaringan atau server sedang sibuk.'], 504);
        } catch (\Exception $e) {
            Log::error('An unexpected error occurred during AI chat processing.', ['error' => $e->getMessage()]);
            return response()->json(['reply' => 'Maaf, terjadi kesalahan internal pada server.'], 500);
        }
    }
}