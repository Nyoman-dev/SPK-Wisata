<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai_Bobot extends Model
{
    protected $table = 'nilai_bobot';
    protected $guarded = ['id'];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kode_kriteria', 'kode_kriteria');
    }
}
