<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlatDisewa extends Model
{
    protected $table = 'alat_disewa';
    protected $fillable = ['barang_id', 'status'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}

