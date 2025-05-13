<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Deskripsi extends Model
{
    use Sluggable;
    protected $fillable = [
        'judul',
        'alamat',
        'deskripsi',
        'map',
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul'
            ]
        ];
    }
}
