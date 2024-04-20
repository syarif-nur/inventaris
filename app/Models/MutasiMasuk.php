<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiMasuk extends Model
{
    use HasFactory;
    protected $table = "mutasi_masuk";
    protected $fillable = ['id_barang', 'tanggal_masuk', 'jumlah_masuk', 'active'];

    public function barang()
    {
        return $this->hasOne(Barang::class, 'id', 'id_barang');
    }

}
