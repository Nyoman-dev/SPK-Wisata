<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\NilaiBobot;


class Kriteria extends Model
{
    protected $guarded = ['id'];

    public function nilaibobot()
    {
        return $this->hasMany(NilaiBobot::class, 'kode_kriteria', 'kode_kriteria');
    }
}
