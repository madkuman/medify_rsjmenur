<?php

namespace App\Models\Radiology;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiBmhp extends Model
{
    
    use SoftDeletes;
	use DataLogger;
    protected $connection = 'radiology';
    protected $table = 'transaksi_bmhp';
    
    public function transaksi()
    {
        return $this->hasOne('App\Models\Radiology\Transaction', 'id', 'transaksi_id');
    }
    public function item_template()
    {
        return $this->hasOne('App\Models\Farmasi\ItemTemplate', 'id', 'item_template_id');
    }
}
