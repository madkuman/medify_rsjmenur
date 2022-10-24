<?php

namespace App\Models\Hospital;

use App\Models\Esakip\Kategori;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class UserGroup extends Model
{
	use DataLogger;
    protected $connection = 'mysql';
	protected $table = 'group_member';

	public function user(){
		return $this->belongsTo('App\User', 'users_id', 'id');
	}

	public function grup(){
		return $this->belongsTo('App\Models\Hospital\Grup', 'group_id', 'id');
	}

	public function creator() {
		return $this->belongsTo('App\User', 'created_by');
	}

    public function getEsakipKategoriAttribute()
    {
        $nama = [];
        $kategori = json_decode($this->e_sakip) ?? [];
        foreach ($kategori as $value) {
            $kategori_nama = Kategori::find($value)->nama;
            array_push($nama, $kategori_nama);
        }
        if (empty($nama)) $nama[] = null;
        return json_encode($nama);
    }
}
