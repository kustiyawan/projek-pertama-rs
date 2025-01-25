<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    // Nama tabel jika tidak sesuai dengan konvensi (nama tabel dalam database)
    protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';

    protected $fillable = ['id_pegawai','nama', 'jenis'];
    // Jika id_pegawai adalah primary key dan bukan 'id' default, Anda bisa menetapkannya
    


}
