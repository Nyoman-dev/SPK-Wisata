<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    protected $fillable = [
        'kode_alternatif',
        'nama_alternatif',
    ];

    public function nilais()
    {
        return $this->hasMany(Nilai::class, 'kode_alternatif', 'kode_alternatif');
    }
}
