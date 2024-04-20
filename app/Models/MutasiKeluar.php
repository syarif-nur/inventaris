<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiKeluar extends Model
{
    use HasFactory;

    protected $table = "mutasi_keluar";
    protected $fillable = ['id_barang', 'tanggal_keluar', 'jumlah_keluar', 'active'];

}
