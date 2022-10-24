<?php

namespace App\Http\Controllers\Eusulan\Usulan;

use App\Models\Eusulan\Dokumen;
use App\Models\Eusulan\LogUsulan;
use App\Models\Eusulan\Usulan;
use App\Models\Hospital\Grup;
use App\Models\Kepegawaian\MasterJabatan;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Exports\Eusulan\LaporanEusulanSingle;
use Auth;

class ViewController extends Controller
{
    public function index()
    {
        $data['sidebar_active'] = 'usulan';
        $data['unit'] = app('App\Http\Controllers\Eusulan\Pengaturan\Unit\ReadController')->get();
        return view('eusulan.usulan.index',$data);
    }

    public function baru($id = null)
    {
        $data['sidebar_active'] = 'usulan';
        if(!empty($id)) $data['usulan'] = app('App\Http\Controllers\Eusulan\Usulan\ReadController')->single($id);
        $data['unit'] = app('App\Http\Controllers\Eusulan\Pengaturan\Unit\ReadController')->get();
        $data['barang'] = app('App\Http\Controllers\Eusulan\Pengaturan\Barang\ReadController')->get();
        $data['akun_rekening'] = app('App\Http\Controllers\Eusulan\Pengaturan\AkunRekening\ReadController')->get();
        return view('eusulan.usulan.components.create',$data);
    }

    public function detail($id)
    {
        $data['sidebar_active'] = 'usulan';
        $data['usulan'] = app('App\Http\Controllers\Eusulan\Usulan\ReadController')->single($id);
        $dokumen_ids = json_decode($data['usulan']->dokumen_ids) ?? [];
        $data['file_pendukung'] = Dokumen::whereIn('id',$dokumen_ids)->get();
        $data['user'] = User::where('fake_account',0)->get();
        $data['jabatan'] = MasterJabatan::all();
        $dokumen_ids = json_decode($data['usulan']->dokumen_ids) ?? [];
        $data['file_pendukung'] = Dokumen::whereIn('id',$dokumen_ids)->get();
        $data['allow_limit_date'] = app('App\Http\Controllers\Eusulan\Pengaturan\UbahUsulan\ReadController')->allowLimitDate($data['usulan']->created_at);
        $data['admin'] = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserAdminInGroup(Grup::where('slug','e-usulan')->first()->id,Auth::user()->id);
        return view('eusulan.usulan.detail',$data);
    }

    public function edit($id)
    {
        $data['sidebar_active'] = 'usulan';
        $data['usulan'] = app('App\Http\Controllers\Eusulan\Usulan\ReadController')->single($id);
        $data['unit'] = app('App\Http\Controllers\Eusulan\Pengaturan\Unit\ReadController')->get();
        $data['barang'] = app('App\Http\Controllers\Eusulan\Pengaturan\Barang\ReadController')->get();
        $data['akun_rekening'] = app('App\Http\Controllers\Eusulan\Pengaturan\AkunRekening\ReadController')->get();
        return view('eusulan.usulan.components.edit',$data);
    }

    public function print(Request $request,$id)
    {
        $data['usulan'] = app('App\Http\Controllers\Eusulan\Usulan\ReadController')->single($id);
        $data['akun_rekening'] = LogUsulan::Select('akun_rekening_id','kegiatan',DB::raw("sum(jumlah*harga) as total"))->where('usulan_id',$id)->where('status',1)->with('barang','akun_rekening')->orderBy('akun_rekening_id')->groupBy('akun_rekening_id')->get()->groupBy('akun_rekening_id');
        $data['kegiatan'] = LogUsulan::Select('akun_rekening_id','kegiatan',DB::raw("sum(jumlah*harga) as total"))->where('usulan_id',$id)->where('status',1)->with('barang','akun_rekening')->orderBy('akun_rekening_id')->groupBy('akun_rekening_id')->groupby('kegiatan')->get();
        $data['barang'] = LogUsulan::where('usulan_id',$id)->where('status',1)->with('barang','akun_rekening')->orderBy('akun_rekening_id')->get();
        $data['jabatan_1_toogle'] = $request->jabatan_1_toogle ?? null;
        $data['jabatan_1'] = $request->jabatan_1;
        $data['jabatan_1_nama'] = $request->jabatan_1_nama;
        $data['jabatan_2_toogle'] = $request->jabatan_2_toogle ?? null;
        $data['jabatan_2'] = $request->jabatan_2;
        $data['jabatan_2_nama'] = $request->jabatan_2_nama;
        $data['jabatan_3_toogle'] = $request->jabatan_3_toogle ?? null;
        $data['jabatan_3'] = $request->jabatan_3;
        $data['jabatan_3_nama'] = $request->jabatan_3_nama;
        return (new LaporanEusulanSingle($data))->download('usulan_'.$data['usulan']->id.'.xlsx');
    }

    public function downloadContoh()
    {
        $file= public_path(). "/assets/contoh-format-file/contoh-import-usulan.xlsx";

        return response()->download($file);
    }
}
