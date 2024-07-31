<?php

namespace App\Models\ThirdPartySatuSehat;

use App\Models\Kasus\Diagnosis;
use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    protected $connection = 'satusehat';
    protected $table = 'condition';

    public function getBundleEntryAttribute()
    {
        $entryData = (new \App\Http\Controllers\ThirdParty\SatuSehat\Condition\ReadController)->entryDataBundle($this);
        return $entryData;
    }

    public function diagnosis()
    {
        return $this->hasOne(Diagnosis::class, 'id', 'diagnosis_id');
    }
}
