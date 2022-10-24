<?php

namespace App\Http\Controllers\Kasus\PemeriksaanLab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PembayaranPerusahaan;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Kasus\Identitas;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Tindakan;
use App\Models\Gizi\Pemesanan;
use Carbon\Carbon;
use App\User;
use App\Models\Pasien\JenisPekerjaan;

class ViewController extends Controller
{
    public function index($nomorKasus)
    {
    	$kasus = Kasus::where('nomor_kasus', $nomorKasus)->with(['lokasi','kelas'])->first();
        if(!empty($kasus->lokasi->lokasi->departemen->id))
        {
            $depart = $kasus->lokasi->lokasi->departemen->id;
        }
        else
        {
            $depart = 0;
        }
        $identitas = Identitas::where('kasus_id', $kasus->id)->first();
        $data['kasus'] = $kasus;
        $data['identitas'] = $identitas;
        $data['nomor_kasus'] = $nomorKasus;
        $data['nurses'] = User::where('profesi', '=', 2)->get();
        $data['darah'] = app('App\Http\Controllers\Kasus\PemeriksaanLab\ReadController')->getAll($kasus->id);
        $data['urine'] = app('App\Http\Controllers\Kasus\PemeriksaanLab\ReadController')->getAllUrine($kasus->id);
        $data['imun'] = app('App\Http\Controllers\Kasus\PemeriksaanLab\ReadController')->getAllImun($kasus->id);
        $data['smear'] = app('App\Http\Controllers\Kasus\PemeriksaanLab\ReadController')->getAllSmear($kasus->id);
        $data['feces'] = app('App\Http\Controllers\Kasus\PemeriksaanLab\ReadController')->getAllFeces($kasus->id);
        $data['sidebar_active'] = 'pemeriksaanlab';
        $data['lis_user'] = config('app.lis_user');
        $log = app('App\Http\Controllers\Kasus\Log\CreateController')
        ->create($kasus->id,'view','datamedis',null);
        return view(' kasus.pemeriksaanlab.index', $data);
    }
}
