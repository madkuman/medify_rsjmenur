<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SuratPeringatan extends Model
{
    protected $connection = 'kepegawaian';
    protected $table = 'surat_peringatan';

    protected $appends = ['date_format', 'edit_format'];

    public function pegawai()
    {
        return $this->belongsTo('App\Models\Kepegawaian\Pegawai', 'pegawai_id')
                    ->withTrashed();
    }

    public function masterJenisSuratPeringatan()
    {
        return $this->belongsTo('App\Models\Kepegawaian\MasterJenisSuratPeringatan', 'master_surat_peringatan_id')
                    ->withTrashed();
    }

    public function getDateFormatAttribute()
    {
        $dt = new Carbon($this->tanggal_surat);
		return $dt->formatLocalized('%d %B %Y');
    }

    public function getEditFormatAttribute()
    {
        $dt = new Carbon($this->tanggal_surat);
		return $dt->formatLocalized('%Y-%m-%d');
    }
}
