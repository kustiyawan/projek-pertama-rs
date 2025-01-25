<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    // public function poliklinik()
    // {
    //     return $this->belongsTo(Poliklinik::class, 'id_poliklinik', 'id_poliklinik');
    // }

    // public function dokter()
    // {
    //     return $this->belongsTo(Pegawai::class, 'id_dokter', 'id_pegawai');
    // }

    // public function pegawai()
    // {
    //     return $this->belongsTo(Pegawai::class, 'id_pegawai_admisi', 'id_pegawai');
    // }

    use HasFactory;

    protected $table = 'pendaftaran';  // Nama tabel harus sesuai dengan yang ada di database

    // Jika ada relasi antar tabel, misalnya:
    // Poliklinik, Dokter, dan Pegawai
    public function poliklinik()
    {
        return $this->belongsTo(Poliklinik::class, 'id_poliklinik');
    }

    public function dokter()
    {
        return $this->belongsTo(Pegawai::class, 'id_dokter');
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai_admisi', 'id_pegawai');
    }

}
