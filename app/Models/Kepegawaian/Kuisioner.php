<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kuisioner extends Model
{
	use DataLogger;
    use SoftDeletes;
    protected $connection = 'kepegawaian';
    protected $table = 'kuisioner';
    protected $dates = ['deleted_at'];

    public function pertanyaan()
    {
        return $this->hasMany('App\Models\Kepegawaian\KuisionerPertanyaan', 'kuisioner_id', 'id');
    }

    public function jawaban()
    {
        return $this->hasMany('App\Models\Kepegawaian\KuisionerJawaban', 'kuisioner_id', 'id');
    }

    public function getStatusAttribute()
    {
        if($this->status_aktif == 1)
			return 'Aktif';
		else
			return 'Nonaktif';
    }
}
