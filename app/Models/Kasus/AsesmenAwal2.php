<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class AsesmenAwal2 extends Model
{
	use DataLogger;
    protected $connection = 'kasus';
    protected $table = 'asesmen_awal_2';
    use SoftDeletes;


    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function verifikatorDokter() {
        return $this->hasOne('App\User', 'id', 'verified_dokter_by');
    }

    public function verifikatorNers() {
        return $this->hasOne('App\User', 'id', 'verified_ners_by');
    }




    public function kasus() {
        return $this->hasOne('App\Models\Kasus\Kasus', 'id', 'kasus_id');
    }
    
    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
