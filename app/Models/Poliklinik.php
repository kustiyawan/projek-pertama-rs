<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poliklinik extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika berbeda dengan konvensi Laravel (jamak)
    protected $table = 'poliklinik';  // Nama tabel harus sesuai dengan yang ada di database

    protected $primaryKey = 'id_poliklinik';

    // Menentukan kolom yang bisa diisi
    // protected $fillable = ['id_poliklinik', 'nama_poliklinik'];
}
