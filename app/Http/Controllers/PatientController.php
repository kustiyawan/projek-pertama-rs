<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    // Method untuk menampilkan halaman utama
    public function index()
    {
        // Mengambil data pasien (opsional jika ingin menampilkan beberapa pasien di halaman index)
        $patients = Pendaftaran::count(); // Anda bisa menyesuaikan dengan query yang sesuai

        // Mengirim data pasien ke view index
        return view('dashboard.index', compact('patients'));
    }

    public function getPatients(Request $request)
    {
        // $query = DB::table('pendaftaran as p')
        //     ->join('pasien as pa', 'pa.id_pasien', '=', 'p.id_pasien')
        //     ->join('poliklinik as pol', 'pol.id_poliklinik', '=', 'p.id_poliklinik')
        //     ->leftJoin('pegawai as dok', 'dok.id_pegawai', '=', 'p.id_dokter')
        //     ->leftJoin('pegawai as peg', 'peg.id_pegawai', '=', 'p.id_pegawai_admisi')
        //     ->select(
        //         'p.no_pendaftaran',
        //         'p.tanggal',
        //         'pa.nama as nama_pasien',
        //         'pol.nama_poliklinik',
        //         'dok.nama as nama_dokter',
        //         DB::raw("IF(p.pendaftaran_via = 'admisi', peg.nama, 'APM') as pendaftaran_via")
        //     );

        // if ($request->tanggal) {
        //     $query->where('p.tanggal', $request->tanggal);
        // }
        // if ($request->poliklinik) {
        //     $query->where('p.id_poliklinik', $request->poliklinik);
        // }
        // if ($request->dokter) {
        //     $query->where('p.id_dokter', $request->dokter);
        // }
        // if ($request->pegawai) {
        //     $query->where('p.id_pegawai_admisi', $request->pegawai);
        // }
        // if ($request->via) {
        //     $query->where('p.pendaftaran_via', $request->via);
        // }

        // $patients = $query->get();

        // return view('patients', ['patients' => $patients]);

        // $query = Pendaftaran::query()
        //     ->with(['poliklinik', 'dokter', 'pegawai']);  // Mengambil relasi Poliklinik, Dokter, dan Pegawai

        // $data = Pendaftaran::query()
        //     ->whereDate('tanggal', $request->tanggal)
        //     ->get(); // select * from pendaftarans where tanggal=blabla

        // $data = Pendaftaran::all()
        //     ->whereDate('tanggal', $request->tanggal); //select * from pendaftaran
        
        $query = Pendaftaran::query();

        if (!empty($request->tanggal)) {
            $query->whereDate('tanggal', $request->tanggal);
        }
        if (!empty($request->poliklinik)) {
            $query->where('id_poliklinik', $request->poliklinik);
        }
        if (!empty($request->dokter)) {
            $query->where('id_dokter', $request->dokter);
        }
        if (!empty($request->pegawai)) {
            $query->where('id_pegawai_admisi', $request->pegawai);
        }
        if (!empty($request->via)) {
            $query->where('pendaftaran_via', $request->via);
        }

        // Mengambil data pasien sesuai filter dan mengirimkan ke view
        // $patients = $query->get();  // Ambil data pasien

        $patients = $query
            ->with([
                'poliklinik',
                'dokter',
                'pasien',
                'pegawai'
            ])->paginate(10);  // Load related data
        // dump($patients->toSql());

        // return view('patients', compact('patients'));  // Mengirim data pasien ke view 'patients'

        // Mengirim data pasien dalam bentuk JSON
        return response()->json($patients);
    }

}
