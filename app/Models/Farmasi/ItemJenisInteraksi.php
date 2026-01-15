<?php

namespace App\Models\Farmasi;

use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\Model;

class ItemJenisInteraksi extends Model
{
    use DataLogger;
    protected $connection = 'farmasi';
    protected $table = 'item_jenis_interaksi';

    public function item_template()
    {
        return $this->hasOne('App\Models\Farmasi\ItemsTemplate','id', 'item_template_id');
    }

    public function jenis_interaksi()
    {
        return $this->hasOne('App\Models\Farmasi\MasterJenisInteraksi','id', 'master_jenis_interaksi_id');
    }

    public function kategori()
    {
        return $this->hasOne('App\Models\Farmasi\Kategori','id', 'item_kategori_id');
    }

    public function item_template_interaksi()
    {
        return $this->hasOne('App\Models\Farmasi\ItemsTemplate','id', 'item_template_id_interaksi_id');
    }
}
