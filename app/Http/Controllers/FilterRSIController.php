<?php

namespace App\Http\Controllers;

use App\Models\FilterPoliklinikRSI;
use App\Models\PegawaiRSI;
use Illuminate\Http\Request;
use App\Models\PoliklinikRSI;

class FilterRSIController extends Controller
{
    //
    public function ambilDataFilter() {
        $poliklinik = PoliklinikRSI::query()
            ->where('ruangan_nama', 'like', 'Klinik %')
            ->get();
            // ->pluck('ruangan_nama');

        $dokter = PegawaiRSI::query()
            ->whereIn('unitkerja_id', [5, 12])
            ->get(['pegawai_id', 'nama_pegawai']);
            // nama_pegawai ada pada tabel pegawai_m
            // unitkerja_id juga pada tabel pegawai_m, untuk mengetahui mana yang profesi dokter 
                            // saya melihatnya dari tabel unitkerja_m
            // ->pluck('nama_pegawai');

        $petugasPendaftaran = PegawaiRSI::query()
            ->whereIn('unitkerja_id', [18])
            ->get(['pegawai_id', 'nama_pegawai']);
            // ->pluck('nama_pegawai');
        

        return response()->json([
            'poliklinik' => $poliklinik,
            'dokter' => $dokter,
            'petugas_pendaftaran' => $petugasPendaftaran
        ]);

    }
}
