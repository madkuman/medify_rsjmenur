<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class KuisionerJawaban extends Model
{
	use DataLogger;
    use SoftDeletes;
    protected $connection = 'kepegawaian';
    protected $table = 'kuisioner_jawaban';
    protected $dates = ['deleted_at'];

    public function kuisioner()
    {
        return $this->belongsTo('App\Models\Kepegawaian\Kuisioner', 'kuisioner_id', 'id');
    }

    public function kasus()
    {
        return $this->hasOne('App\Models\Kasus\Kasus', 'id', 'kasus_id');
    }

    public function users()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
}
