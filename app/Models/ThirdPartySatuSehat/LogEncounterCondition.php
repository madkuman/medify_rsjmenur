<?php

namespace App\Models\ThirdPartySatuSehat;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogEncounterCondition extends Model
{
    use SoftDeletes;
    protected $connection = 'satusehat';
    protected $table = 'log_encounter_condition';

    public function encounter()
    {
        return $this->hasOne(Encounter::class, 'id', 'encounter_id');
    }
}
