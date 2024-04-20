<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerpindahanInventaris extends Model
{
    use HasFactory;

    protected $table = "perpindahan_inventaris";
        protected $fillable = ['id_barang', 'tanggal_perpindahan', 'lokasi_asal', 'lokasi_tujuan', 'active'];

}
