<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    protected $table = 'hasil';
    protected $guarded = ['id'];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'kode_alternatif', 'kode_alternatif');
    }
}
