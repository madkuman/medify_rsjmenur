<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Carbon\Carbon;
use DB;
use Schema;
use Illuminate\Database\Eloquent\SoftDeletes;

class AsesmenAwal extends Model
{
	use DataLogger;
    protected $connection = 'kasus';
    protected $table = 'asesmen_awal';
    use SoftDeletes;

    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
