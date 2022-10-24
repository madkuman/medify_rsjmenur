<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use DateTimeInterface;
use JsonSerializable;
use Carbon\CarbonInterface;
use App\Models\Gizi\PemesananDetail;

class Pemesanan extends Model
{
	use DataLogger;
   use SoftDeletes;
   protected $connection = 'gizi';
   protected $table = 'pemesanan';
   protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'jadwal_pengantaran'
    ];

    public function lokasi()
    {
        return $this->hasOne('App\Models\Hospital\Lokasi','id','lokasi_id');
    }

    public function bangsal()
    {
        return $this->hasOne('App\Models\RawatInap\Bangsal','id','bangsal_id');
    }

    public function pasien()
    {
        return $this->hasOne('App\Models\Pasien\Pasien','id','pasien_id');
    }
    public function pasienv1()
    {
        return $this->hasOne('App\Models\Pasien\PasienV1','id','pasien_id');
    }

    public function kasus()
    {
        return $this->hasOne('App\Models\Kasus\Kasus','id','kasus_id');
    }

    public function kelas()
    {
        return $this->hasOne('App\Models\Gizi\Kelas','id','kelas_id');
    }

    public function diet()
    {
        return $this->hasOne('App\Models\Gizi\Diet','id','diet_id');
    }

    public function kode_diet()
    {
        return $this->hasOne('App\Models\Gizi\DietKode','id','kode_diet_id');
    }

    public function diet_tambahan()
    {
        return $this->hasMany('App\Models\Gizi\DietTambahanPemesanan','pemesanan_id','id');
    }

    public function bentuk_makanan()
    {
        return $this->hasOne('App\Models\Gizi\BentukMakanan','id','bentuk_makanan_id');
    }

    public function menu()
    {
        return $this->hasOne('App\Models\Gizi\Menu','id','menu_id');
    }

    public function jenis_pasien()
    {
        return $this->hasOne('App\Models\Gizi\JenisPasien','id','jenis_pasien_id');
    }

    public function pemesanan_detail()
    {
        return $this->hasMany('App\Models\Gizi\PemesananDetail','pemesanan_id','id')->orderBy('untuk_tanggal','desc')->orderBy('waktu_makan_id','desc');
    }

    public function pembayaran()
    {
        return $this->hasOne('App\Models\Pasien\PasienPembayaran','id','jenis_pasien_id')->withTrashed();
    }

    public function pembuat()
    {
        return $this->hasOne('App\User','id','created_by');
    }

    public function pembuat_mutu()
    {
        return $this->hasOne('App\User','id','mutu_created_by');
    }

    public function format_tanggal()
    {
        $date = date('d-m-Y', strtotime($this->jadwal_pengantaran));
        return $date;
    }

    public function cek_waktu_makan()
    {
        $waktu = [0,0,0,0,0];
        $tanggal = [];
        $created = date('d F Y',strtotime($this->created_at));
        foreach ($this->pemesanan_detail as $detail)
        {
            $a = $detail->waktu_makan_id;


            if($a == 1 && $waktu[0] != 1)
            {
                $waktu[0] = 1;
                $tanggal[0] = date('d F Y',strtotime($detail->untuk_tanggal));
            }
            else if($a == 2 && $waktu[1] != 2)
            {
                $waktu[1] = 2;
                $tanggal[1] = date('d F Y',strtotime($detail->untuk_tanggal));
            }
            else if($a == 3 && $waktu[2] != 3)
            {
                $waktu[2] = 3;
                $tanggal[2] = date('d F Y',strtotime($detail->untuk_tanggal));
            }
            else if($a == 4 && $waktu[3] != 4)
            {
                $waktu[3] = 4;
                $tanggal[3] = date('d F Y',strtotime($detail->untuk_tanggal));
            }
            else if($a == 5 && $waktu[4] != 5)
            {
                $waktu[4] = 5;
                $tanggal[4] = date('d F Y',strtotime($detail->untuk_tanggal));
            }
            if($waktu[0] == 1 && $waktu[1] == 2 && $waktu[2] == 3 && $waktu[3] == 4 && $waktu[4] == 5)
            {
                break;
            }
        }
        $data['waktu'] = $waktu;
        $data['tanggal'] = $tanggal;
        $data['created'] = $created;
        //dd($data);
        return $data;
    }

    public function get_jumlah_pesan($date,$waktu_id,$flag)
    {
        /*dd($this->pemesanan_detail);*/
        //dd($this->id);
        $today_start = Carbon::parse($date)->startOfDay();
        $today = Carbon::parse($date)->endOfDay();
        //dd($today_start,$today);
        if($waktu_id == 1 || $waktu_id == 2 || $waktu_id == 3)
        {
            $query = PemesananDetail::where('pemesanan_id',$this->id)
                ->whereBetween('untuk_tanggal',[$today_start,$today])
                ->where('waktu_makan_id',$waktu_id)
                ->where('flag_tambahan',$flag)
                ->first();
            if(!is_null($query))
            {
                //dd("1");
                return 1;
            }
            else
            {
                //dd("2");
                return 0;
            }
        }
        else
        {
            $query = PemesananDetail::where('pemesanan_id',$this->id)
                ->whereBetween('untuk_tanggal',[$today_start,$today])
                ->where('flag_tambahan',$flag)
                ->first();
            if(!is_null($query))
            {
                //dd("1");
                return 1;
            }
            else
            {
                //dd("2");
                return 0;
            }
        }

    }

    public function cek_waktu_pesan()
    {
        Carbon::setlocale('id');
        $start = Carbon::parse($this->created_at);
        $finish = Carbon::now();
        $interval = $finish->diffForHumans($start);
        $temp = explode(" ",$interval);
        unset($temp[2]);
        $interval = implode(" ",$temp);

        return $interval;
    }

    public function diet_kode()
    {
        return $this->hasOne('App\Models\Gizi\DietKode','id','kode_diet_id');
    }

    public function makan_pagi()
    {
        return $this->hasOne('App\Models\Gizi\PemesananDetail','pemesanan_id','id')->where('waktu_makan_id','=',1);
    }

    public function makan_siang()
    {
        return $this->hasOne('App\Models\Gizi\PemesananDetail','pemesanan_id','id')->where('waktu_makan_id','=',2);
    }

    public function makan_sore()
    {
        return $this->hasOne('App\Models\Gizi\PemesananDetail','pemesanan_id','id')->where('waktu_makan_id','=',3);
    }

    public function pemesanan_waktu_makan()
    {
        return $this->hasMany('App\Models\Gizi\PemesananDetail','pemesanan_id','id')->distinct('waktu_makan_id');
    }
}

