<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftaranRSI;

class PasienRSIController extends Controller
{
    //
    // Method untuk menampilkan halaman utama
    public function index()
    {
        // Mengambil data pasien (opsional jika ingin menampilkan beberapa pasien di halaman index)
        $patients = PendaftaranRSI::count(); // Anda bisa menyesuaikan dengan query yang sesuai

        // Mengirim data pasien ke view index
        return view('dashboard.patients', compact('patients'));
    }

    public function ambilDataPasien(Request $request)
    {
        
        $query = PendaftaranRSI::query();

        if (!empty($request->tanggal)) {
            $query->whereRaw("DATE(tgl_pendaftaran) = ?", [$request->tanggal]);
        }
        if (!empty($request->poliklinik)) {
            $query->where('ruangan_id', $request->poliklinik);
        }
        if (!empty($request->dokter)) {
            $query->where('pegawai_id', $request->dokter);
        }
        if (!empty($request->pegawai)) {
            // $query->where('pegawai_id', $request->pegawai);
            $query->whereHas('pegawai.petugasrsi', function ($subQuery) use ($request) {
                $subQuery->where('pegawai_id', 'like', $request->pegawai);
            });
        }
        if (!empty($request->via)) {
            // $query->where('create_loginpemakai_id', $request->via);
            if ($request->via == 1) {
                // Jika APM, pilih hanya pegawai_id = 1028
                $query->where('create_loginpemakai_id', 1);
            } elseif ($request->via == 2) {
                // Jika Petugas, pilih pegawai_id selain 1028
                $query->where('create_loginpemakai_id', '<>', 1);
            }

        }

        // Mengambil data pasien sesuai filter dan mengirimkan ke view
        // $patients = $query->get();  // Ambil data pasien

        $patients = $query
            ->with([
                'poliklinik', 
                'dokter', 
                'pasieniki',
                'pegawai.petugasrsi'
            ])->paginate(20);  // Load related data
        // dump($patients->toSql());

        // return view('patients', compact('patients'));  // Mengirim data pasien ke view 'patients'

        // Mengirim data pasien dalam bentuk JSON
        return response()->json($patients);
    }
}
