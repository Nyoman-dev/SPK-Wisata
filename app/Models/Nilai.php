<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $guarded = ['id'];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'kode_alternatif', 'kode_alternatif');
    }
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kode_kriteria', 'kode_kriteria');
    }
}
