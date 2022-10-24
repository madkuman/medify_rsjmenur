<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use ScoutElastic\Searchable;

class TarifMaster extends Model
{
	use DataLogger;
	use SoftDeletes;
	use Searchable;

	protected $connection = 'keuangan';
	protected $table = 'tarif_master';
	protected $fillable = ['id'];
	protected $dates = ['deleted_at'];
	protected $indexConfigurator = \App\IndexConfig\KeuanganTarif::class;
	protected $searchRule = [
		\App\SearchRule\Tarif::class
	];

	protected $mapping = [
        'properties' => [
            'kategori_text' => [
                'type' => 'text',
          		"analyzer" => "partial",
          		"search_analyzer" => "exact"
            ],
            'deskripsi' => [
                'type' => 'text',
          		"analyzer" => "partial",
          		"search_analyzer" => "exact"
            ],
            'deskripsi_ori' => [
                'type' => 'text',
          		"analyzer" => "partial",
          		"search_analyzer" => "exact"
            ],
            'tags' => [
            	'type' => 'text',
            	'analyzer' => 'standard'
            ]
        ]
    ];



	public function toSearchableArray()
	{
		$self = $this->toArray();
		$kategori = $this->kategori;
		if(!isset($kategori)){
			$kategori_name = "";
		}else{
			$kategori_name = $kategori->name;
		}

		$data =  [
			'departemen_filter' => $this->departemen_id,
			'kategori' => $kategori_name,
			'deskripsi' => $this->deskripsi
		];
		return array_merge($self, $data);
	}

	public function tarif()
	{
		return $this->hasMany('App\Models\Keuangan\Tarif', 'tarif_master_id', 'id');
	}

	public function kategori()
	{
		return $this->hasOne('App\Models\Keuangan\TarifKategori', 'id', 'kategori_id');
	}

	public function kategori_slug()
	{
		return $this->hasOne('App\Models\Keuangan\TarifKategoriSlug', 'slug', 'slug');
	}

	public function getHarga($kelas, $tipe_id)
	{

		$tarif = Tarif::query()->where('tarif_master_id', $this->id)->whereIn('kelas_id', [$kelas, 0])->where('tipe_id', $tipe_id)->first();

		if(!empty($tarif))
			return $tarif->harga;
		return 0;
	}

	public function getTarif($kelas, $tipe_id)
	{
		return Tarif::where('tarif_master_id', $this->id)->whereIn('kelas_id', [$kelas, 0])
		->where('tipe_id', $tipe_id)->first();
	}

	public function tipe()
	{
		return $this->hasOne('App\Models\Keuangan\TarifTipe', 'tipe_id', 'id');
	}


	public function labpk_form_tarif()
	{
		return $this->hasMany('App\Models\LabPK\FormTarif', 'tarif_master_id', 'id');
	}
}
