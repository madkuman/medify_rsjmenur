<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class KuisionerPertanyaan extends Model
{
	use DataLogger;
    use SoftDeletes;
    protected $connection = 'kepegawaian';
    protected $table = 'kuisioner_pertanyaan';
    protected $dates = ['deleted_at'];

    public function kuisioner()
    {
        return $this->belongsTo('App\Models\Kepegawaian\Kuisioner', 'kuisioner_id', 'id');
    }

    public function bagian()
    {
        return $this->belongsTo('App\Models\Kepegawaian\KuisionerBagian', 'bagian_id', 'id');
    }
}
