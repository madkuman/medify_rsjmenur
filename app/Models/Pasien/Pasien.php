<?php

namespace App\Models\Pasien;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use ScoutElastic\Searchable;
use App\Models\RekamMedis\Transaksi;

class Pasien extends Model
{
	use DataLogger;	
	use Searchable;
	use SoftDeletes;
	public $incrementing = false;
	protected $connection = 'patients';
	protected $table = 'pasien';
	protected $appends = ['detailed_long_age', 'detailed_age_short', 'age', 'no_rm_formatted', 'jenis_kelamin'];
	protected $indexConfigurator = \App\IndexConfig\Pasien::class;
	protected $searchRule = [
		\App\SearchRule\Pasien::class
	];
	// protected $dates = ['date_of_birth'];
	protected $mapping = [
        'properties' => [
            'no_rm' => [
                'type' => 'keyword'
            ],
            'name' => [
            	"type" => "text",
				"analyzer" => "partial",
				"search_analyzer" => "exact",
   				// "copy_to" => "combined_field"
            ],
            'address' => [
            	'type' => 'text',
				"analyzer" => "partial",
				"search_analyzer" => "exact",
   				"copy_to" => "combined_field"
            ],
            'no_identitas' => [
            	'type' => 'text',
				"analyzer" => "partial",
				"search_analyzer" => "exact",
   				// "copy_to" => "combined_field"
            ],
            'tni_nrp' => [
            	'type' => 'text',
				"analyzer" => "partial",
				"search_analyzer" => "exact",
   				// "copy_to" => "combined_field"
            ],
            'kota' => [
            	'type' => 'text',
   				"copy_to" => "combined_field"
            ],
            'kerabat_tni_nrp' => [
            	'type' => 'text',
   				// "copy_to" => "combined_field"
            ],
            'kecamatan' => [
            	'type' => 'text',
   				"copy_to" => "combined_field"
            ],
// //filter
            'kota_filter' => [
            	'type' => 'keyword'
            ],
            'kecamatan_filter' => [
            	'type' => 'keyword'
            ],
            'tgl_lahir' => [
            	'type' => 'keyword',
   				// "copy_to" => "combined_field"
            ],
       //      'kelamin' => [
       //      	'type' => 'keyword',
   				// // "copy_to" => "combined_field"
       //      ],
            'asuransi' => [
            	'type' => 'text',
          		"analyzer" => "partial",
          		"search_analyzer" => "exact"
            ],
            'perusahaan_tipe' => [
            	'type' => 'keyword'
            ],
            'combined_field' => [
            	'type' => 'text',
            	'analyzer' => 'partial',
            	'search_analyzer' => 'exact'
            ]
        ]
    ];

	public function toSearchableArray()
	{
		$self = $this->toArray();
		$data =  [
			//buat search
			'no_rm' => $this->no_rm,
			'name' => $this->name,
			'address' => $this->text_alamat,
			'no_identitas' => $this->no_identitas,
			'tni_nrp' => $this->tni_nrp,
			'kota' => $this->text_alamat,
			'kecamatan' => $this->text_alamat,
			'kerabat_tni_nrp' => $this->text_kerabat_nrp,

			//buat filter
			'name_filter' => $this->name,
			'address_filter' => $this->address,
			'no_identitas_filter' => $this->no_identitas,
			'kota_filter' => $this->city,
			'kecamatan_filter' => $this->district,
			'tgl_lahir' => $this->date_of_birth,
			'kelamin' => $this->gender,
			'asuransi' => $this->text_asuransi,
			'perusahaan_tipe' => $this->text_asuransi,
			'kategori_pasien' => $this->kategori_pasien
		];

		return array_merge($self, $data);
	}
	public function pasien_medis()
	{
		return $this->hasOne('App\Models\Pasien\PasienMedis', 'patients_id', 'id');
	}

	public function pasien_medis_alergi()
	{
		return $this->hasOne('App\Models\Pasien\PasienMedisAlergi', 'patients_id', 'id');
	}

	public function alamat_kota()
	{
		return $this->hasOne('App\Models\Pasien\AlamatKota', 'id', 'city');
	}

	public function alamat_kecamatan()
	{
		return $this->hasOne('App\Models\Pasien\AlamatKecamatan', 'id', 'district');
	}

	public function alamat_kelurahan()
	{
		return $this->hasOne('App\Models\Pasien\AlamatKelurahan', 'id', 'kelurahan');
	}

	public function wali()
	{
		return $this->hasOne('App\Models\Pasien\PasienWali', 'id', 'relatives_id');
	}

	public function jenis_hubungan_keluarga()
	{
		return $this->hasOne('App\Models\Pasien\JenisHubunganKeluarga', 'id', 'relatives_type');
	}

	public function getAgeAttribute()
	{
		return Carbon::parse($this->attributes['date_of_birth'])->age;
	}

	public function getDetailedLongAgeAttribute()
	{
		$dt = new Carbon($this->date_of_birth);
		$created_at = Carbon::now();
		$diff = $dt->diff($created_at);
		if($diff->format('%y') < 1 && $diff->format('%m') < 1) return $diff->format('%d Hari');
		elseif ($diff->format('%y') < 1) return $diff->format('%m Bulan %d Hari');
		else return $diff->format('%y Tahun');
	}

	public function getDetailedAgeAttribute() {
        $dt = new Carbon($this->date_of_birth);
        $created_at = Carbon::now();
        $diff = $dt->diff($created_at);
        $day = $diff->format('%d');
        $month = $diff->format('%m');
        $year = $diff->format('%y');
        if($year == 0 && $month == 0)
        {
            $date = new Carbon($this->date_of_birth);
            return $date->diff($created_at)->format('%d Hari');
        }
        elseif($year == 0)
        {
            $date = new Carbon($this->date_of_birth);
            return $date->diff($created_at)->format('%m Bulan');
        }
        else
        {
            $date = new Carbon($this->date_of_birth);
            return $date->diff($created_at)->format('%y Tahun');
        }
    }

	public function getDetailedAgeShortAttribute() {
        $dt = new Carbon($this->date_of_birth);
        $created_at = Carbon::now();
        $diff = $dt->diff($created_at);
        $day = $diff->format('%d');
        $month = $diff->format('%m');
        $year = $diff->format('%y');
        if($year == 0 && $month == 0)
        {
            $date = new Carbon($this->date_of_birth);
            return $date->diff($created_at)->format('%d Hr');
        }
        elseif($year == 0)
        {
            $date = new Carbon($this->date_of_birth);
            return $date->diff($created_at)->format('%m Bln');
        }
        else
        {
            $date = new Carbon($this->date_of_birth);
            return $date->diff($created_at)->format('%y Th');
        }
    }

	public function getAgeYear($pembanding = null)
	{
		$dt = new Carbon($this->date_of_birth);
		$created_at = $pembanding ?? Carbon::now();
		$diff = $dt->diff($created_at);
		return $diff->format('%y');
	}

	public function jenis_identitas()
	{
		return $this->hasOne('App\Models\Pasien\JenisKartuIdentitas', 'id', 'jenis_kartu_identitas_id');
	}

	public function agama()
	{
		return $this->hasOne('App\Models\Pasien\JenisAgama', 'id', 'agama_id');
	}

	public function pendidikan()
	{
		return $this->hasOne('App\Models\Pasien\JenisPendidikan', 'id', 'pendidikan_id');
	}

	public function pernikahan()
	{
		return $this->hasOne('App\Models\Pasien\JenisPernikahan', 'id', 'marriage');
	}


	public function tni_keanggotaan()
	{
		return $this->hasOne('App\Models\Pasien\TNIKeanggotaan', 'id', 'tni_keanggotaan_id');
	}

	public function tni_kotama()
	{
		return $this->hasOne('App\Models\Pasien\TNIKotama', 'id', 'tni_kotama_id');
	}

	public function tni_pangkat()
	{
		return $this->hasOne('App\Models\Pasien\TNIPangkat', 'id', 'tni_pangkat_id');
	}

	public function tni_satker()
	{
		return $this->hasOne('App\Models\Pasien\TNISatker', 'id', 'tni_satker_id');
	}

	public function tni_korps()
	{
		return $this->hasOne('App\Models\Pasien\TNIKorps', 'id', 'tni_korps_id');
	}

	public function pembayaran()
	{
		return $this->hasMany('App\Models\Pasien\PasienPembayaran', 'pasien_id');
	}

	public function pembayaranUtama()
	{
		return $this->hasOne('App\Models\Pasien\PasienPembayaran', 'pasien_id')->where('utama', 1);
	}

	public function getAgeDayAttribute($date) {
        $date = Carbon::parse($date);
        $tgl_lahir = new Carbon($this->date_of_birth);
        return $tgl_lahir->diffInDays($date);
    }


	public function scopeAgedBetween($query, $start=null, $end = null)
	{
	    if (is_null($end)) {
	        $end = 400;
	    }

	    if (is_null($start)) {
	        $start = 0;
	    }

	    $now = $this->freshTimestamp()->today();
	    $start = $now->copy()->subYears($start);
	    $end = $now->copy()->subYears($end+1)->addDay(); // plus 1 year minus a day
	    return $query->whereBetween('date_of_birth', [$end, $start]);
	    // dd($query->whereBetween('date_of_birth', [$end, $start]));
	}

	public function getRmCurrentHolderAttribute()
	{
		if ( ! array_key_exists('rm_transaksi', $this->relations)) 
			$this->load('rm_transaksi');

		$transaksi = $this->getRelation('rm_transaksi');
		

		if(empty($transaksi->id))
		{
        	$rm_group = app('App\Http\Controllers\Group\Group\ReadController')->getRMGroupSlug('rekam-medis');
			$holder = $rm_group;
			$holder->type = 2;
		}
		elseif($transaksi->status == 1 || $transaksi->status == 0)
		{
			//jika belum di konfirm sama penerima
			if(!empty($transaksi->holder_user)){
				$holder = $transaksi->holder_user;
				$holder->type = 1;
			}
			elseif(!empty($transaksi->holder_group))
			{
				$holder = $transaksi->holder_group;
				$holder->type = 2;
			}
			else
			{
				$holder = new \stdClass();
				$holder->type = 0;
			}
			$holder_name = $holder->name ?? '-';
			$sender_name = $transaksi->sender->name ?? '-';
			$holder->name = $holder_name.' atau '. $sender_name;
		}
		elseif($transaksi->status == 2)
		{
			//sudah di konfirm penerima
			if(!empty($transaksi->holder_user)){
				$holder = $transaksi->holder_user;
				$holder->type = 1;

			}
			elseif(!empty($transaksi->holder_group))
			{
				$holder = $transaksi->holder_group;
				$holder->type = 2;
			}

		}
		elseif($transaksi->status == -2 || $transaksi->status == -1)
		{
			//sudah dikirim tapi yang nerima bilang gak nerima
			$holder = $transaksi->sender;
			$holder->type = 1;
		}
		return $holder;

	}

	public function rmCurrentHolder(){
		return $this->hasOne('App\Models\RekamMedis\Transaksi', 'id','rm_transaksi_id');
	}

	public function rm_transaksi()
	{
		return $this->hasOne('App\Models\RekamMedis\Transaksi', 'id','rm_transaksi_id');
	}

	public function jk()
	{
		return $this->hasOne('App\Models\Pasien\JenisKelamin', 'id','gender');
	}

	public function getJenisKelaminAttribute()
	{
		if($this->gender == 1)
			return 'Laki laki';
		else
			return 'Perempuan';
	}

	public function getJenisKelaminLpAttribute()
	{
		if($this->gender == 1)
			return 'L';
		else
			return 'P';
	}

	public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function getTanggalAttribute() {
		return Carbon::parse($this->attributes['updated_at'])->format('d F Y H:i');
	}

	public function getNoRmFormattedAttribute()
	{
		// $no_rm = str_pad($this->no_rm, 6, "0", STR_PAD_LEFT);
		$chunks = str_split($this->no_rm, 2);
		$result = implode('-', $chunks);

		return $result;
	}

	public function kasus()
	{
		return $this->hasMany('App\Models\Kasus\Kasus', 'pasien_id');
	}

	public function getKategoriAttribute()
	{
		if($this->kategori_pasien == 0)
			return 'JIWA';
		else
			return 'FISIK';
	}

	public function getAlamatDetailAttribute()
	{
		$alamat_detail = "";
		if($this->address != "") $alamat_detail .= $this->address;
		if($this->rt != "") $alamat_detail .= " RT ".$this->rt;
		if($this->rw != "") $alamat_detail .= " RW ".$this->rw;
		if($this->alamat_kelurahan != null) $alamat_detail .= ", ".$this->alamat_kelurahan->nama;
		if($this->alamat_kecamatan != null) $alamat_detail .= ", ".$this->alamat_kecamatan->nama;
		if($this->alamat_kota != null) $alamat_detail .= ", ".$this->alamat_kota->nama;
		return $alamat_detail;
	}

    public function kewarganegaraan()
    {
        return $this->hasOne('App\Models\Pasien\JenisKewarganegaraan', 'id', 'kewarganegaraan_id');
    }
}
