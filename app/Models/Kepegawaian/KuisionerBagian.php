<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class KuisionerBagian extends Model
{
	use DataLogger;
    protected $connection = 'kepegawaian';
    protected $table = 'kuisioner_bagian';
    protected $dates = ['deleted_at'];

    public function pertanyaan()
    {
        return $this->hasMany('App\Models\Kepegawaian\KuisionerPertanyaan', 'bagian_id', 'id');
    }
}
