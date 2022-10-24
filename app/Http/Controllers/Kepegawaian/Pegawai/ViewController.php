<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeValidationRequest;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\Pelatihan;
use App\Models\Kepegawaian\Pendidikan;
use App\Models\Kepegawaian\Pangkat;
use App\Models\Kepegawaian\Jabatan;
use App\Models\Kepegawaian\Penghargaan;
use App\Models\Kepegawaian\Keluarga;
use DOMPDF;

use Auth;

class ViewController extends Controller
{
    public function baru(Request $request)
    {
        ini_set('memory_limit', '256M');

        $data = [
            'htmlheader_title' => 'Kepegawaian | Tambah Pegawai',
            'contentheader_title' => 'Tambah Pegawai Baru',
        ];

        $postdata = $request->toArray();

        if(empty($postdata)) {
            $rules = (new EmployeeValidationRequest())->rules();
            if(!empty($rules))
                $data['_rules'] = $rules;

            return self::form(null, $data);
        }
        else {
            $ret = [
                'msg' => '',
                'error' => null
            ];
        }
    }

    public function edit($id, Request $request)
    {
        ini_set('memory_limit', '-1');
        $item = app('App\Http\Controllers\Kepegawaian\Pegawai\ReadController')
            ->pegawai()->with([	'masterJenisPegawai',
                'masterStatusPegawai',
                'masterStatusRumah',
                'MasterJabatan',
                'masterFaskesAsuransi',
                'masterNamaBank',
                'masterJenisKendaraan',
                'masterSubkualifikasi',
                'agama',
                'district',
                'kelurahan',
                'masterKategoriPegawai',
                'masterGolonganPegawai',
                'masterPangkatPegawai',
                'masterBebanKerja',
                'masterResikoKerja',
                'masterTimPembagiJasa',
                'masterGelar',
                'marriages' => function($q) {
                    $q->orderBy('marriage_date', 'desc')->first();
                }
            ])->find($id);
        $marriage = app('App\Http\Controllers\Kepegawaian\Pegawai\ReadController')
            ->marriage()->where('employee_id', $item->id)->orderBy('marriage_date', 'desc')->first();
        if(empty($marriage)) $marriage = app('App\Http\Controllers\Kepegawaian\Pegawai\ReadController')
            ->marriage();

        $data = [];
        $postdata = $request->toArray();

        if(empty($postdata)) {
            if(empty($item)){
                $data['route_name'] = 'pegawai-baru';

                return self::notFound($data);
            }
            else {
                $rules = (new EmployeeValidationRequest())->rules();
                if(!empty($rules))
                    $data['_rules'] = $rules;

                $data['htmlheader_title'] = 'Kepegawaian | Edit Pegawai';
                $data['contentheader_title'] = 'Edit Pegawai, #'.$item->id;

                return self::form($item, $data);
            }
        }
        else {
            $ret = [
                'msg' => '',
                'error' => null
            ];
        }
    }

    public function profile(Request $request){
        try {
            $id = $request->id;

            $item = app('App\Http\Controllers\Kepegawaian\Pegawai\ReadController')
                ->pegawai()
                ->with([
                    'agama',
                    'masterKualifikasi',
                    'masterSubkualifikasi',
                    'masterJenisPegawai',
                    'masterPangkat',
                    'masterBebanKerja',
                    'masterResikoKerja',
                    'masterKategoriPegawai',
                    'masterStatusPegawai',
                    'masterStatusRumah',
                    'masterNamaBank',
                    'kelurahan',
                    'masterFaskesAsuransi',
                    'masterTimPembagiJasa',
                    'masterGelar',
                    'marriages' => function ($q) {
                        $q->orderBy('created_at', 'desc')->first();
                    },
                    'religion', 'city', 'district'
                ])->find($id);


            $is_hrd_member = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserActiveInGroup(13, Auth::user()->id);

            $marriage = app('App\Http\Controllers\Kepegawaian\Pegawai\ReadController')
                ->marriage()
                ->where('employee_id', $id)->orderBy('created_at', 'desc')->first();

            $htmlheader_title = 'Kepegawaian | Profile';
            $contentheader_title = 'Data Pegawai';


            return view('kepegawaian.pegawai.profile', compact(
                'item',
                'marriage',
                'htmlheader_title',
                'contentheader_title',
                'is_hrd_member'
            ));
        }catch (Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }

    public function searchKecamatan(Request $request)
    {
        $items = app('App\Http\Controllers\Kepegawaian\Pegawai\ReadController')->searchKecamatan($request);
        return response()->json($items);
    }

    public function searchKelurahan(Request $request)
    {
        $items = app('App\Http\Controllers\Kepegawaian\Pegawai\ReadController')->searchKelurahan($request);
        return response()->json($items);
    }

    private function form($item=null, $data=array()) {
        $data = (object)$data;
        $is_edit = !empty($item);
        $rules = !empty($data->_rules) ? $data->_rules : null;
        $htmlheader_title = !empty($data->htmlheader_title) ? $data->htmlheader_title : null;
        $contentheader_title = !empty($data->contentheader_title) ? $data->contentheader_title : null;
        if(!empty($item)){
            $marriage = app('App\Http\Controllers\Kepegawaian\Pegawai\ReadController')
                ->marriage()->where('employee_id', $item->id)->orderBy('marriage_date', 'desc')->first();
        }
        else $marriage = '';

        $kualifikasi = app("App\Http\Controllers\Kepegawaian\MasterKualifikasi\ReadController")->getData()->all();
        if ($item != null) {
            $subkualifikasi = app("App\Http\Controllers\Kepegawaian\MasterSubkualifikasi\ReadController")->getData()->where('kualifikasi_id', $item->kualifikasi)->get();
        }else{
            $subkualifikasi = [];
        }
        $agama = app('App\Http\Controllers\Kepegawaian\Pegawai\ReadController')->agama()->all();
        $kota = app('App\Http\Controllers\Kepegawaian\Pegawai\ReadController')
            ->kota()->all();
        $nama_bank = app('App\Http\Controllers\Kepegawaian\MasterNamaBank\ReadController')
            ->getData()->all();
        $asuransi = app('App\Http\Controllers\Kepegawaian\MasterFaskesAsuransi\ReadController')
            ->getData()->all();
        if ($item != null) {
            $kecamatan = app('App\Http\Controllers\Kepegawaian\Pegawai\ReadController')
                ->kecamatan($item->city_id);
            $kelurahan = app('App\Http\Controllers\Kepegawaian\Pegawai\ReadController')
                ->kelurahan($item->district_id);
        }else{
            $kecamatan = [];
            $kelurahan = [];
        }
        $status_rumah =app('App\Http\Controllers\Kepegawaian\MasterStatusRumah\ReadController')
            ->getData()->all();
        $jenis_pegawai = app('App\Http\Controllers\Kepegawaian\MasterJenisPegawai\ReadController')->getData()->all();
        $kategori_pegawai = app('App\Http\Controllers\Kepegawaian\MasterKategoriPegawai\ReadController')->getAll();
        $golongan_pegawai = app('App\Http\Controllers\Kepegawaian\MasterGolongan\ReadController')->getAll();
        $beban_kerja = app('App\Http\Controllers\Kepegawaian\MasterBebanKerja\ReadController')->getAllBeban();
        $resiko_kerja = app('App\Http\Controllers\Kepegawaian\MasterResikoKerja\ReadController')->getAllResiko();
        $status_pegawai = app('App\Http\Controllers\Kepegawaian\MasterStatusPegawai\ReadController')->getData()->all();
        $jenis_kendaraan = app('App\Http\Controllers\Kepegawaian\MasterJenisKendaraan\ReadController')->getData()->all();
        $jabatan_pegawai = app('App\Http\Controllers\Kepegawaian\MasterJabatan\ReadController')->getAllJabatan();
        $pendidikan = app('App\Http\Controllers\Kepegawaian\MasterGelarPendidikan\ReadController')->getAll();
        $tim_pembagi_jasa = app('App\Http\Controllers\Kepegawaian\MasterTimPembagiJasa\ReadController')->getAll();
        $is_hrd_member = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserActiveInGroup(13,Auth::user()->id);

        return view('kepegawaian.pegawai.form', compact(
            'contentheader_title',
            'htmlheader_title',
            'marriage',
            'is_edit',
            'rules',
            'agama',
            'asuransi',
            'kualifikasi',
            'subkualifikasi',
            'item',
            'kelurahan',
            'is_hrd_member',
            'kota',
            'kecamatan',
            'nama_bank',
            'status_rumah',
            'jenis_pegawai',
            'status_pegawai',
            'jenis_kendaraan',
            'jabatan_pegawai',
            'kategori_pegawai',
            'golongan_pegawai',
            'beban_kerja',
            'resiko_kerja',
            'tim_pembagi_jasa',
            'pendidikan'
        ));
    }

    public function pelatihan(Request $request, $id) {
        $pegawai = Pegawai::find($id);

        $items = Pelatihan::where('pegawai_id', $pegawai->id)->with('master_pelatihan')->orderBy('created_at', 'desc')->paginate(10);
        $master_pelatihan = app('App\Http\Controllers\Kepegawaian\MasterPelatihan\ReadController')->getMasterPelatihan();
        $htmlheader_title = 'Kepegawaian | Pelatihan';
        $contentheader_title = 'Data Pelatihan';

        $paginationParams = [];
        $is_hrd_member = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserActiveInGroup(13,Auth::user()->id);

        return view('kepegawaian.pegawai.pelatihan.index', compact(
            'items',
            'pegawai',
            'paginationParams',
            'htmlheader_title',
            'contentheader_title',
            'is_hrd_member',
            'master_pelatihan'
        ));
    }

    public function pendidikan(Request $request, $id){
        $pegawai        = Pegawai::find($id);
        $items		    = Pendidikan::where('pegawai_id', $pegawai->id)->orderBy('tahun', 'DESC')->with('jenisPendidikan', 'strataPendidikan', 'institusiPendidikan')->paginate(5);
        $is_hrd_member 	= app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserActiveInGroup(13,Auth::user()->id);

        $master_jenis	    = app("App\Http\Controllers\Kepegawaian\MasterJenisPendidikan\ReadController")->getMasterJenisPendidikan();
        $master_strata	    = app("App\Http\Controllers\Kepegawaian\MasterStrataPendidikan\ReadController")->getMasterStrataPendidikan();
        $master_institusi	= app("App\Http\Controllers\Kepegawaian\MasterInstitusiPendidikan\ReadController")->getMasterInstitusiPendidikan();

        return view('kepegawaian.pegawai.pendidikan.index', compact(
            'items',
            'pegawai',
            'is_hrd_member',
            'master_jenis',
            'master_strata',
            'master_institusi'
        ));
    }

    public function pangkat(Request $request, $id){

        $pegawai = Pegawai::find($id);
        $items = Pangkat::where('pegawai_id', $pegawai->id)->orderBy('tmt', 'DESC')->paginate(5);

        $master_pangkat = app("App\Http\Controllers\Kepegawaian\MasterPangkat\ReadController")->getAllMasterPangkat();
        $is_hrd_member 	= app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserActiveInGroup(13,Auth::user()->id);

        return view('kepegawaian.pegawai.pangkat.index', compact(
            'master_pangkat',
            'items',
            'pegawai',
            'is_hrd_member'
        ));
    }

    public function jabatan(Request $request, $id){

        $pegawai 			= Pegawai::find($id);
        $master_departemen 	= app("App\Http\Controllers\Kepegawaian\MasterDepartemen\ReadController")->getAllDepartemen();
        $master_jabatan 	= app("App\Http\Controllers\Kepegawaian\MasterJabatan\ReadController")->getAllJabatan();
        $items				= Jabatan::where('pegawai_id', $pegawai->id)->orderBy('created_at', 'DESC')->with('jabatan', 'departemen')->paginate(5);
        $is_hrd_member 		= app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserActiveInGroup(13,Auth::user()->id);

        return view('kepegawaian.pegawai.jabatan.index', compact('master_jabatan',
            'master_departemen',
            'items',
            'pegawai',
            'is_hrd_member'
        ));
    }

    public function penghargaan(Request $request, $id){

        $pegawai = Pegawai::find($id);
        $items = Penghargaan::where('pegawai_id', $pegawai->id)->with('masterPenghargaan')->paginate(5);

        $is_hrd_member 	= app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserActiveInGroup(13,Auth::user()->id);
        $master_penghargaan = app('App\Http\Controllers\Kepegawaian\MasterPenghargaan\ReadController')->getAll();
        return view('kepegawaian.pegawai.penghargaan.index', compact(
            'items',
            'pegawai',
            'is_hrd_member',
            'master_penghargaan'));
    }

    public function keluarga(Request $request, $id) {

        $pegawai = Pegawai::find($id);

        $items = Keluarga::where('pegawai_id', $id)->orderBy('tanggal_lahir', 'asc')->paginate(5);

        $htmlheader_title = 'Kepegawaian | Keluarga';
        $contentheader_title = 'Data Keluarga';

        $paginationParams = [];
        $is_hrd_member = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserActiveInGroup(13,Auth::user()->id);

        return view('kepegawaian.pegawai.keluarga.index', compact(
            'pegawai',
            'items',
            'paginationParams',
            'htmlheader_title',
            'contentheader_title',
            'is_hrd_member'
        ));
    }

    public function legalitas(Request $request, $id) {

        $pegawai = Pegawai::find($id);
        $items = Pegawai::where('id', $id)->paginate(1);
        $data_skk       = app('App\Http\Controllers\Kepegawaian\Pegawai\Legalitas\ReadController')->getSkk($id);
        $data_str       = app('App\Http\Controllers\Kepegawaian\Pegawai\Legalitas\ReadController')->getStr($id);
        $data_sip       = app('App\Http\Controllers\Kepegawaian\Pegawai\Legalitas\ReadController')->getSip($id);
        $data_evkin     = app('App\Http\Controllers\Kepegawaian\Pegawai\Legalitas\ReadController')->getEvkin($id);
        $data_kredensial = app('App\Http\Controllers\Kepegawaian\Pegawai\Legalitas\ReadController')->getKredensial($id);

        $htmlheader_title = 'Kepegawaian | Legalitas Profesi';
        $contentheader_title = 'Data Legalitas';

        $is_hrd_member = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserActiveInGroup(13,Auth::user()->id);

        return view('kepegawaian.pegawai.legalitas.index', compact(
            'htmlheader_title',
            'contentheader_title',
            'pegawai',
            'is_hrd_member',
            'items',
            'data_skk',
            'data_str',
            'data_sip',
            'data_evkin',
            'data_kredensial'
        ));
    }

    function printProfile($id){

        // // $periode = Carbon::parse($request->periode)->startOfMonth();
        // // $start_periode = $periode->copy();

        // // $data['kop_bulan'] = app('App\Http\Controllers\Functions\DateFormatter')->dateFormat($periode,'%B %Y');
        // // $data['ttd'] = TandaTangan::find($request->ttd_id);

        // if($jenis == "str") $pegawai = $this->getExpiredSTR($start, $end);
        // if($jenis == "sip") $pegawai = $this->getExpiredSIP($start, $end);

        // $data['pegawai'] = $pegawai;
        // $data['jenis'] = $request->nama;
        // $data['tanggal'] = [$start, $end];

        $data['item'] = app('App\Http\Controllers\Kepegawaian\Pegawai\ReadController')
            ->pegawai()
            ->with([
                'agama',
                'masterKualifikasi',
                'masterSubkualifikasi',
                'masterJenisPegawai',
                'masterStatusPegawai',
                'masterStatusRumah',
                'masterNamaBank',
                'masterFaskesAsuransi',
                'marriages' => function($q){
                    $q->orderBy('created_at', 'desc')->first();
                },
                'religion', 'city', 'district'
            ])->find($id);

        // $pdf = DOMPDF::loadView('pasien.print-data', $data,[])->setPaper('a4', 'portrait');
        // $pasien = $data['identitas'];
        // $filename = $pasien->name.'-profil.pdf';
        // return $pdf->stream($filename);
        $pdf = DOMPDF::loadView('kepegawaian.pegawai.print-profile',$data, [])->setPaper('a4', 'portrait');;
        $filename = 'profile_pegawai.pdf';

        return $pdf->stream($filename);
    }



}
