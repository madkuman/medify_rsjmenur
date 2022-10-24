<?php

namespace App\Models\Remunerasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laporan extends Model
{
    use DataLogger;
    protected $connection = 'remunerasi';
    protected $table = 'laporan';

    use SoftDeletes;

    public function pegawai()
    {
        return $this->hasOne('App\Models\Kepegawaian\Pegawai', 'id', 'pegawai_id')->withTrashed();
    }

    public function MasterJabatan() {
        return $this->belongsTo('App\Models\Kepegawaian\MasterJabatan','jabatan_id')
            ->withTrashed();
    }

    public function masterPangkat() {
        return $this->belongsTo('App\Models\Kepegawaian\MasterPangkat', 'pangkat_id');
    }

    public function masterGolonganPegawai()
    {
        return $this->belongsTo('App\Models\Kepegawaian\MasterGolongan', 'golongan_pegawai_id')
            ->withTrashed();
    }

    public function masterGelar()
    {
        return $this->hasOne('App\Models\Kepegawaian\MasterGelarPendidikan','id','pendidikan_id')->withTrashed();
    }

    public function masterJenisPegawai()
    {
        return $this->belongsTo('App\Models\Kepegawaian\MasterJenisPegawai', 'jenis_pegawai_id')
            ->withTrashed();
    }

    public function masterKategoriPegawai()
    {
        return $this->belongsTo('App\Models\Kepegawaian\MasterKategoriPegawai', 'kategori_pegawai_id')
            ->withTrashed();
    }

    public function masterTimPembagiJasa()
    {
        return $this->belongsTo('App\Models\Kepegawaian\MasterTimPembagiJasa', 'tim_pembagi_jasa_id')
            ->withTrashed();
    }

    public function absensi()
    {
        return $this->belongsTo('App\Models\Remunerasi\Absensi', 'absensi_id')
            ->withTrashed();
    }

    public function beban_kerja()
    {
        return $this->belongsTo('App\Models\Remunerasi\BebanKerja', 'beban_kerja_id')
            ->withTrashed();
    }

    public function resiko_kerja()
    {
        return $this->belongsTo('App\Models\Remunerasi\ResikoKerja', 'resiko_kerja_id')
            ->withTrashed();
    }

    public function pelayanan()
    {
        return $this->belongsTo('App\Models\Remunerasi\Keuangan', 'keuangan_id')
            ->withTrashed();
    }

    public function masa_kerja()
    {
        return $this->belongsTo('App\Models\Kepegawaian\MasterMasaKerja', 'masa_kerja_id')
            ->withTrashed();
    }

    public function index_pajak()
    {
        return $this->belongsTo('App\Models\Remunerasi\Pajak', 'index_pajak_id')
            ->withTrashed();
    }

    public function dana()
    {
        return $this->belongsTo('App\Models\Remunerasi\Dana', 'dana_id')
            ->withTrashed();
    }
}