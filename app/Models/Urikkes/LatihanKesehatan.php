<?php

namespace App\Models\Urikkes;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes; // <-- This is required

class LatihanKesehatan extends Model
{
    use DataLogger;
    use SoftDeletes;

    protected $connection = 'urikkes';
    protected $table = 'latihan_kesehatan';

    protected $fillable = [
        'judul',
        'tanggal_kegiatan',
    ];

    public function photo()
    {
        return $this->hasMany('App\Models\Urikkes\Photo');
    }

}