<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Models\Kasus\ResepDetail;

class Resep extends Model
{
	use DataLogger;
    protected $dates = ['deleted_at'];
  	protected $connection = 'kasus';
	protected $table = 'resep';
    protected $appends = ['tanggal'];

    use SoftDeletes;

    public function kasus()
    {
        return $this->hasOne('App\Models\Kasus\Kasus','id','kasus_id');
    }

	public function resepDetail() {
	    return $this->hasMany('App\Models\Kasus\ResepDetail', 'kasus_resep_id', 'id');
    }

    public function doctor() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function doctor2() {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }

    public function getTanggalAttribute() {
        return Carbon::parse($this->attributes['created_at'])->format('d F Y H:i');
    }

    public function getTanggalUpdateAttribute() {
        return Carbon::parse($this->attributes['updated_at'])->format('d F Y H:i');
    }

    public function transaksi_farmasi() {
        return $this->hasOne('App\Models\Farmasi\TransaksiObat', 'id', 'transaksi_id');
    }

    public function getTanggalLaporanAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d m Y');   
    }

    public function resepDetailTop3() {
        $id = $this->id;
        $query = ResepDetail::where('kasus_resep_id',$id)->get();
        $detail = $query->toArray();
        if(count($detail) > 3)
        {   
            $data = [];
            array_push($data,$detail[0]);
            array_push($data,$detail[1]);
            array_push($data,$detail[2]);
            return $data; 
        }
        else
        {
            return $detail;
        }
    }
}
