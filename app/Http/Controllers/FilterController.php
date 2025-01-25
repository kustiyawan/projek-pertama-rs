<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poliklinik;
use App\Models\Pegawai;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{

    // public function getFilters()
    // {
    //     // Mengambil data filter dari database
    //     $poliklinik = DB::table('poliklinik')->select('id_poliklinik AS id', 
    //                                                 'nama_poliklinik AS name')->get();
    //     $dokter = DB::table('pegawai')->where('jenis', 
    //                                         'dokter')->select('id_pegawai AS id', 
    //                                                             'nama AS name')->get();
    //     $pegawai = DB::table('pegawai')->select('id_pegawai AS id', 
    //                                                 'nama AS name')->get();

    //     // Mengembalikan data dalam format JSON
    //     return response()->json([
    //         'poliklinik' => $poliklinik,
    //         'dokter' => $dokter,
    //         'pegawai' => $pegawai
    //     ]);
    // }

    public function getFilters()
    {

        // Mengambil data filter dari database menggunakan Eloquent
        $poliklinik = Poliklinik::all();  // Mengambil semua data dari model Poliklinik
        $dokter = Pegawai::where('jenis', 'dokter')->get();  // Mengambil data pegawai dengan jenis 'dokter'
        $pegawai = Pegawai::where('jenis', 'perawat')->get();  // Mengambil semua data pegawai

        // return response()->json([
        //     'poliklinik' => Poliklinik::all(),
        //     'dokter' => Pegawai::where('jenis', 'dokter')->get(),
        //     'pegawai' => Pegawai::all()
        // ]);

        // Mengembalikan data dalam format JSON
        return response()->json([
            'poliklinik' => $poliklinik,
            'dokter' => $dokter,
            'pegawai' => $pegawai
        ]);



        

        
    }


}

?>