<?php

namespace App\Models\ThirdPartySatuSehat;

use Illuminate\Database\Eloquent\Model;

class Encounter extends Model
{
    protected $connection = 'satusehat';
    protected $table = 'encounter';

    public function getBundleEntryAttribute()
    {
        $entryData = (new \App\Http\Controllers\ThirdParty\SatuSehat\Encounter\ReadController)->entryDataBundle($this);
        return $entryData;
    }
}
