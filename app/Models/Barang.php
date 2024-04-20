<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table ="barang";
    protected $fillable = ['nama_barang', 'jumlah', 'active'];
    public static function status($i)
    {
        switch ($i) {
            case 1:
                return 'Active';

            case 2:
                return 'Non Active';

            default:
                return 'default';

        }
    }
}
