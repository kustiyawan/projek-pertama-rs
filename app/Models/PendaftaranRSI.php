<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranRSI extends Model
{
    //
    protected $table = 'pendaftaran_t';  // Nama tabel harus sesuai dengan yang ada di database

    public function poliklinik()
    {
        return $this->belongsTo(PoliklinikRSI::class, 'ruangan_id', 'ruangan_id');
    }

    public function dokter()
    {
        return $this->belongsTo(PegawaiRSI::class, 'pegawai_id', 'pegawai_id');
    }

    public function pasieniki()
    {
        return $this->belongsTo(PasienRSI::class, 'pasien_id', 'pasien_id');
    }

    public function pegawai()
    {
        return $this->belongsTo(LoginPemakaiRSI::class, 'create_loginpemakai_id', 'loginpemakai_id');
    }
}
