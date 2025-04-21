<?php

namespace App\Models\ThirdPartySatuSehat;

use App\Models\Kasus\Diagnosis;
use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    protected $connection = 'satusehat';
    protected $table = 'observation';

    public function getBundleEntryAttribute()
    {
        $entryData = (new \App\Http\Controllers\ThirdParty\SatuSehat\Observation\ReadController)->entryDataBundle($this);
        return $entryData;
    }
}
