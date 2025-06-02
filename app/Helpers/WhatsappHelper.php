<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsappHelper
{
    public static function kirimPesan($tujuan, $pesan)
{
    try {
        if (empty($tujuan) || empty($pesan)) {
            Log::error('FONNTE: Nomor atau pesan kosong.', [
                'target' => $tujuan,
                'message' => $pesan,
            ]);
            return ['status' => false, 'reason' => 'target atau message kosong'];
        }

        $response = Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN'),
        ])->post('https://api.fonnte.com/send', [
            'target' => $tujuan,
            'message' => $pesan,
            'delay' => 1,
            'countryCode' => '62',
        ]);

        Log::info('FONNTE Response:', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        return $response->json();
    } catch (\Exception $e) {
        Log::error('FONNTE Exception:', [
            'message' => $e->getMessage(),
        ]);
        return ['status' => false, 'error' => $e->getMessage()];
    }
}

}
