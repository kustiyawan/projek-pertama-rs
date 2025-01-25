<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoginPemakaiRSI extends Model
{
    //
    use HasFactory;
    protected $table = 'loginpemakai_k';

    public function petugasrsi() {
        return $this->belongsTo(PegawaiRSI::class, 'pegawai_id', 'pegawai_id');
    }
}
