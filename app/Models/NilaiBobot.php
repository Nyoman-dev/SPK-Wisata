<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiBobot extends Model
{
    protected $guarded = ['id'];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kode_kriteria', 'kode_kriteria');
    }
}
