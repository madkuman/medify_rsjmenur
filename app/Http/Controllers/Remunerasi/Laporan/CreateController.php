<?php

namespace App\Http\Controllers\Remunerasi\Laporan;

use App\Models\Kepegawaian\MasterMasaKerja;
use App\Models\Remunerasi\Laporan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CreateController extends Controller
{
    public function create($request)
    {
        $bulan_tahun = substr($request->bulan_tahun,3);
        $bulan = Carbon::parse($request->bulan_tahun)->format('m');
        $tahun = Carbon::parse($request->bulan_tahun)->format('Y');
        $data['status'] = 1;

        $dana = app('App\Http\Controllers\Remunerasi\Dana\ReadController')->single($bulan,$tahun);
        $denda = app('App\Http\Controllers\Remunerasi\Denda\ReadController')->single($bulan_tahun);

        if(empty($dana) || empty($denda)){
            $data['status'] = -1;
            $data['message'] = 'Data Dana / Denda belum tersedia';
        }

        if($data['status'] == 1)
        {
            $old_laporan = Laporan::where('tanggal',$bulan_tahun)->delete();
            $data['message'] = 'Data Berhasil Dimasukkan';
            $employes = app('App\Http\Controllers\Kepegawaian\Pegawai\ReadController')->getAktif($bulan,$tahun);
            foreach ($employes as $index => $employe){
                $insert[$index]['pegawai_id'] = $employe->id;
                $insert[$index]['kategori_pegawai_id'] = $employe->kategori_pegawai_id;
                $insert[$index]['jenis_pegawai_id'] = $employe->jenis_pegawai_id;
                $insert[$index]['golongan_pegawai_id'] = $employe->golongan_pegawai_id;
                $insert[$index]['pendidikan_id'] = $employe->pendidikan_gelar_id;
                $insert[$index]['jabatan_id'] = $employe->jabatan_id;
                $insert[$index]['masa_kerja_id'] = $this->masaKerja($employe);
                $insert[$index]['tim_pembagi_jasa_id'] = $employe->tim_pembagi_jasa_id;
                $insert[$index]['absensi_id'] = app('App\Http\Controllers\Remunerasi\Absensi\ReadController')->single($employe->id,$bulan,$tahun)->id ?? null;
                $insert[$index]['beban_kerja_id'] = app('App\Http\Controllers\Remunerasi\BebanKerja\ReadController')->single($employe->id,$bulan_tahun)->id ?? null;
                $insert[$index]['resiko_kerja_id'] = app('App\Http\Controllers\Remunerasi\ResikoKerja\ReadController')->single($employe->id,$bulan_tahun)->id ?? null;
                $insert[$index]['dana_id'] = $dana->id;
                $insert[$index]['keuangan_id'] = app('App\Http\Controllers\Remunerasi\Keuangan\ReadController')->single($employe->id,$bulan,$tahun)->id ?? null;
                $insert[$index]['index_pajak_id'] = app('App\Http\Controllers\Remunerasi\Pajak\ReadController')->single($employe->id,$bulan_tahun)->id ?? null;
                $insert[$index]['created_by'] = Auth::user()->id;
                $insert[$index]['tanggal'] = $bulan_tahun;
            }
        $data['data'] = Laporan::insert($insert);
        }

        return $data;

    }

    public function masaKerja($employe)
    {
        $masa_kerja = Carbon::parse($employe->tmt)->age;
        $master_masa_kerja = MasterMasaKerja::where('awal','<=', $masa_kerja)->where('akhir', '>=',$masa_kerja)->first();
        if($master_masa_kerja && isset($employe->masterJenisPegawai->nama) && $employe->masterJenisPegawai->nama != 'PNS'){
            return $master_masa_kerja->id;
        }else{
            return null;
        }
    }
}
