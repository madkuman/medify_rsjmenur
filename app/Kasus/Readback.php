<?php

namespace App\Kasus;

use App\Models\Kasus\CPPT;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Readback extends Model
{
    protected $guarded = ['id'];
    protected $connection = 'kasus';
    protected $table = 'readback';

    public function user()
    {
         return $this->belongsTo(User::class, 'dokter_id');
    }

    public function cppt()
    {
        return $this->belongsTo(CPPT::class, 'cppt_id');
    }
}
