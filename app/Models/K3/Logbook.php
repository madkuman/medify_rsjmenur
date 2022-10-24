<?php

namespace App\Models\K3;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Logbook extends Model
{
	use DataLogger;
    use SoftDeletes;
    protected $connection = 'k3';
    protected $table = 'logbook';
    protected $dates = ['deleted_by'];

    public function users()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

    public function employees()
    {
        return $this->belongsTo('App\Models\Kepegawaian\Pegawai', 'employee_id', 'id');
    }
}
