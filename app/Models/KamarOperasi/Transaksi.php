<?php

namespace App\Models\KamarOperasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
class Transaksi extends Model
{
	use DataLogger;
  use SoftDeletes;
  protected $dates = ['deleted_at','jadwal_operasi'];
  protected $connection = 'kamaroperasi';
	protected $table = 'transaksi';

  public function pembuat_jadwal()
  {
    return $this->hasOne('App\User', 'id', 'dijadwalkan_oleh');
  }
  public function penolak()
  {
    return $this->hasOne('App\User', 'id', 'deleted_by');
  }

	public function pasien_detail()
  {
	  return $this->hasOne('App\Models\Pasien\Pasien', 'id', 'pasien_id');
  }

  public function jenis_spesialis()
  {
    return $this->hasOne('App\Models\KamarOperasi\JenisSpesialisOperasi', 'id', 'jenis_spesialis_id');
  }

  public function pergantian_jadwal()
  {
    return $this->hasMany('App\Models\KamarOperasi\PergantianJadwal', 'operasi_id', 'id');
  }

  public function getCurrentPergantianJadwal()
  {
    return $this->pergantian_jadwal()->where('status', 0)->latest()->first();
  }

  public function getWaktuPermintaan()
  {
    if ($this->status == 2)
      return $this->getCurrentPergantianJadwal()->created_at;
    else
      return $this->created_at;
  }

    public function waktuPermintaanHuman() //waktu permintaan
    {   
        Carbon::setLocale('id');
        if ($this->status == 2)
        return $this->getCurrentPergantianJadwal()->created_at->diffForHumans();
        else
        return $this->created_at->diffForHumans();     
    }
  public function operasi_permintaan()
  {
    return $this->hasOne('App\Models\Kasus\OperasiPermintaan', 'transaksi_id', 'id')->withTrashed()->withTrashed();
  }

  public function ruangan()
  {
  	return $this->hasOne('App\Models\KamarOperasi\Ruangan','id','ruangan_id')->withTrashed();
  }

  public function dokter()
  {
    return $this->hasOne('App\User','id','doctor_id');
  }

  public function kasus()
  {
  	return $this->hasOne('App\Models\Kasus\Kasus','id','kasus_id');
  }

  public function hasil()
  {
    return $this->hasOne('App\Models\KamarOperasi\Pasca','id','hasil_id');
  }

  public function parent()
  {
    return $this->hasOne('App\Models\KamarOperasi\Transaksi','id','parent_id');
  }

  public function child()
  {
    return $this->hasMany('App\Models\KamarOperasi\Transaksi','parent_id','id');
  }

  public function pemakaian()
  {
    return $this->hasMany('App\Models\KamarOperasi\Pemakaian','operasi_id','id');
  }

  public function itemsTemplate()
  {
    $database = $this->getConnection()->getDatabaseName();
    return $this->belongsToMany('App\Models\Gudang\ItemsTemplate', "$database.rencana", 'operasi_id', 'obat_id');
  }

  public function tim()
  {
    return $this->hasMany('App\Models\KamarOperasi\Tim', 'id', 'operasi_id');
  }

  public function itemsPasca()
  {
    $database = $this->getConnection()->getDatabaseName();
    return $this->belongsToMany('App\Models\Gudang\ItemsTemplate', "$database.obat_pasca", 'operasi_id', 'obat_id');
  }

  public function user()
  {
    $database = $this->getConnection()->getDatabaseName();
    return $this->belongsToMany('App\User', "$database.tim", 'operasi_id', 'user_id');
  }

  public function transaksi_obat()
  {
    return $this->hasOne('App\Models\Farmasi\TransaksiObat', 'id', 'transaksi_obat_id');
  }

  public function distribusi_rencana()
  {
    return $this->hasOne('App\Models\Farmasi\Distribusi', 'id', 'distribusi_rencana_id');
  }


    public function icd10() {
      return $this->hasOne('App\Models\Kasus\ICD10', 'id', 'diagnosis_id')->withTrashed();
    }

    public function icd9() {
      return $this->hasOne('App\Models\Kasus\ICD9', 'id', 'icd9_id')->withTrashed();
    }

  public function getStatusInString()
  {
    if ($this->status == 0)
      return 'Dalam Perencanaan';
    else if($this->status == 1)
      return 'Terlaksana';
    else if($this->status == 2)
      return 'Proses Penjadwalan Ulang';
  }

  public function foto()
  {
    return $this->hasMany('App\Models\KamarOperasi\FotoOperasi','transaksi_id','id')->orderBy('created_at','DESC');
  }

    public function masaTunggu()//masa tunggu human
    {   
        Carbon::setLocale('id');
        if ($this->masa_tunggu)
        {
            $masa_tunggu = Carbon::parse($this->masa_tunggu);
            $ubah_masa_tunggu = 'change_id('.$this->id.', \''.$masa_tunggu->format('d/m/Y').'\')';
            $now = Carbon::now();
            if ($now->diffInDays($masa_tunggu) < 1)
            {
                if ($masa_tunggu->isToday())
                {   
                    $masa_tunggu = 'Hari Ini';
                    $data = [];
                    array_push($data,$masa_tunggu);
                    array_push($data,$ubah_masa_tunggu);
                    return $data;
                }
                else
                {   
                    $masa_tunggu = '1 Hari dari sekarang';
                    $data = [];
                    array_push($data,$masa_tunggu);
                    array_push($data,$ubah_masa_tunggu);
                    return $data;
                }
            }
            else
            {
                $masa_tunggu = $masa_tunggu->diffForHumans();
                $data = [];
                array_push($data,$masa_tunggu);
                array_push($data,$ubah_masa_tunggu);
                return $data;
            }
        }
        else
        {   
            $masa_tunggu = '-';
            $data = [];
            $ubah_masa_tunggu = 'change_id('.$this->id.', \'\')';
            array_push($data,$masa_tunggu);
            array_push($data,$ubah_masa_tunggu);
            // dd($data);
            return $data;
        }           
    }
}
