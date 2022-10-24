<?php

namespace App\Http\Controllers\Users\Kasus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Kolaborator;
use App\Models\Kasus\Lokasi as LokasiKasus;
use App\Models\Hospital\Lokasi;
use Auth;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use DOMPDF;

class ViewController extends Controller
{
    public function index()
    {
        //$id = Auth::user()->id;
        //$kolab = Kolaborator::where('user_id', $id)->where('invitation',1)->pluck('kasus_id')->all();
        //$data['kasus'] = Kasus::with(['identitas','lokasi.lokasi', 'pasien'])->whereIn('id', $kolab)->get();
        $data['lokasi'] = Lokasi::whereHas('departemen', function ($q)
        {
            $q->whereIn('slug', ['igd','rawat-jalan','rawat-inap','medical-checkup']);
        })->get();
        return view('users.kasus.index', $data);
    }

    public function loadKasus(Request $request)
    {
        if ($request->keyword != NULL) {
            $keyword = preg_replace("/[^[:alnum:][:space:]]/u", '', $request->keyword);
        }
        else{
            $keyword = "";
        }
        if ($request->input('tanggal_min') != NULL) {
            $tanggal_min = $request->input('tanggal_min');
        }
        else{
            $tanggal_min = "00/00/0000";
        }
        if ($request->input('tanggal_max') != NULL) {
            $tanggal_max = $request->input('tanggal_max');
        }
        else{
            $tanggal_max = Carbon::today()->format('d/m/Y');
        }

        $id = Auth::user()->id;
        $tanggal_min = Carbon::createFromFormat('d/m/Y', $tanggal_min, 'Asia/Jakarta')->startOfDay()->toDateString();
        $tanggal_max = Carbon::createFromFormat('d/m/Y', $tanggal_max, 'Asia/Jakarta')->endOfDay()->toDateString();
        $kolab = Kolaborator::with(['lokasi.lokasi', 'identitas'])->where('user_id', $id)->where('invitation',1)->pluck('kasus_id')->all();
        if ($keyword == "") {
            $kasus = Kasus::whereIn('id', $kolab)->whereBetween('created_at', [$tanggal_min,$tanggal_max])->paginate(5);
        } else {
            // dd($tanggal_min, $tanggal_max);
            $kasus = Kasus::search($keyword)->paginate(5);
            $kasus = $kasus->whereIn('id', $kolab)->whereBetween('created_at', [$tanggal_min,$tanggal_max])->paginate(5);
            // dd($kasus->buildPayload());
        }

        $view = view('users.kasus.components.kasus-item',compact('kasus'))->render();
        return response()->json(['html'=>$view]);
    }

    public function loadData($request)
    {
        if ($request->tanggal_krs_min != NULL) {
            $tanggal_krs_min = $request->tanggal_krs_min;
        }
        else{
            $tanggal_krs_min = "01/01/0001";
        }
        if ($request->tanggal_krs_max != NULL) {
            $tanggal_krs_max = $request->tanggal_krs_max;
        }
        else{
            $tanggal_krs_max = Carbon::maxValue()->format('d/m/Y');
        }

        if ($request->tanggal_mrs_min != NULL) {
            $tanggal_mrs_min = $request->tanggal_mrs_min;
        }
        else{
            $tanggal_mrs_min = "01/01/0001";
        }
        if ($request->tanggal_mrs_max != NULL) {
            $tanggal_mrs_max = $request->tanggal_mrs_max;
        }
        else{
            $tanggal_mrs_max = Carbon::maxValue()->format('d/m/Y');
        }

        $id = Auth::user()->id;
        $tanggal_krs_min = Carbon::createFromFormat('d/m/Y', $tanggal_krs_min, 'Asia/Jakarta')->startOfDay();
        $tanggal_krs_max = Carbon::createFromFormat('d/m/Y', $tanggal_krs_max, 'Asia/Jakarta')->endOfDay();
        $tanggal_mrs_min = Carbon::createFromFormat('d/m/Y', $tanggal_mrs_min, 'Asia/Jakarta')->startOfDay();
        $tanggal_mrs_max = Carbon::createFromFormat('d/m/Y', $tanggal_mrs_max, 'Asia/Jakarta')->endOfDay();
        $kolab = Kolaborator::where('user_id', $id)->where('invitation',1)->pluck('kasus_id')->all();

        if ($request->tanggal_krs_min != NULL || $request->tanggal_mrs_min != NULL) {
            if ($request->tanggal_krs_min == NULL) {
                $kasus = Kasus::whereIn('id', $kolab)->whereBetween('created_at', [$tanggal_mrs_min,$tanggal_mrs_max]);
            } elseif ($request->tanggal_mrs_min == NULL) {
                $kasus = Kasus::whereIn('id', $kolab)->whereBetween('krs_at', [$tanggal_krs_min,$tanggal_krs_max]);
            } else {
                $kasus = Kasus::whereIn('id', $kolab)->whereBetween('krs_at', [$tanggal_krs_min,$tanggal_krs_max])->whereBetween('created_at', [$tanggal_mrs_min,$tanggal_mrs_max]);
            }
        } else {
            $kasus = Kasus::whereIn('id', $kolab)->whereBetween('created_at', [$tanggal_krs_min,$tanggal_krs_max]);
        }
        if(!empty($request->ranap) && empty($request->igd) && empty($request->rajal) && empty($request->medical_checkup)){
            $kasus = $kasus->where('tipe_ri', $request->ranap);
        }
        else if(!empty($request->ranap) || !empty($request->igd) || !empty($request->rajal) || !empty($request->medical_checkup)){
            if (!empty($request->ranap)) {
                $kasus = $kasus->where('tipe_ri', $request->ranap);
            } else {
                $kasus = $kasus->where('tipe_ri', 0);
            }
            if (!empty($request->rajal)) {
                $kasus = $kasus->where('tipe_rj', $request->rajal);
            } else {
                $kasus = $kasus->where('tipe_rj', 0);
            }
            if (!empty($request->igd)) {
                $kasus = $kasus->where('tipe_igd', $request->igd);
            } else {
                $kasus = $kasus->where('tipe_igd', 0);
            }
            if (!empty($request->medical_checkup)) {
                $kasus = $kasus->where('tipe_mc', $request->medical_checkup);
            } else {
                $kasus = $kasus->where('tipe_mc', 0);
            }
        }
        if (!empty($request->input('lokasi'))) {
            if (!empty($request->input('tipe_lokasi'))) {
                if ($request->tipe_lokasi == 1) {
                    $kasus_ids = $kasus->with(['lokasi.lokasi'])->get()->where('lokasi.lokasi.id',$request->input('lokasi'))->pluck('id');
                    $kasus = Kasus::whereIn('id',$kasus_ids);
                } else {
                    $kasus_ids = LokasiKasus::where('lokasi_id', $request->lokasi)->pluck('kasus_id')->toArray();
                    $kasus = $kasus->whereIn('id', $kasus_ids);
                }
            } else {
                $kasus_ids = LokasiKasus::where('lokasi_id', $request->lokasi)->pluck('kasus_id')->toArray();
                $kasus = $kasus->whereIn('id', $kasus_ids);
            }
        }
        if (!empty($request->input('no_rm'))) {
            $kasus = $kasus->whereHas('pasien', function ($q) use($request)
            {
                $q->from(config('app.db_name').'_patients.pasien')->where('no_rm','like', $request->no_rm);
            });
        }
        $kasus = $kasus->with(['identitas','lokasi.lokasi', 'pasien'])->get();
        return $kasus;
    }
    public function loadTabelKasus(Request $request)
    {
        $kasus = $this->loadData($request);
        return DataTables::of($kasus)
            ->addColumn('format_krs',function ($kasus){
                $content = 'Belum Krs';
                if(!empty($kasus->krs_at)){
                    $content = date('d-m-Y',strtotime($kasus->krs_at));
                }
                return $content;
            })
            ->addColumn('kasus_detail', function($kasus){
                $content = '
                <div class="row">
                    <div class="col-2">
                        <img class="img-avatar" src="'.asset($kasus->identitas->avatar_thumb).'" alt="">
                    </div>
                    <div class="col-10">
                        <span class="text-uppercase case-title">'.$kasus->judul_kasus.'</span>
                        <div class="font-w400 font-size-s text-black patient-name">'.($kasus->identitas->nama ?? '').'</div>
                        <div class="font-w400 font-size-xs text-muted">'.$kasus->identitas->gender.', '.$kasus->identitas->age.'</div>
                        <div class="font-w400 font-size-xs text-muted">'.($kasus->lokasi->lokasi->nama ?? '').'</div>
                    </div>
                </div>
                ';
                return '<td data-search="'.$kasus->judul_kasus.' '.($kasus->identitas->nama ?? '').' '.$kasus->identitas->gender.' '.$kasus->identitas->age.' '.($kasus->lokasi->lokasi->nama ?? '').'">'.$content.'</td>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function getKasusAktif()
    {
        $id = Auth::user()->id;
        $kolab = Kolaborator::where('user_id', $id)->where('invitation',1)->pluck('kasus_id')->all();
        $kasus = Kasus::whereIn('id', $kolab)->whereNull('krs_at')->with('lokasi.lokasi.departemen','identitas')->get();
        return json_encode($kasus);
    }

    public function download(Request $req)
    {
        $data['kasus'] = $this->loadData($req);
        $data['tanggal_krs_min'] = !is_null($req->tanggal_krs_min) ? indonesian_date(Carbon::createFromFormat('d/m/Y', $req->tanggal_krs_min, 'Asia/Jakarta')->format('d F Y')) : NULL;
        $data['tanggal_krs_max'] = !is_null($req->tanggal_krs_max) ? indonesian_date(Carbon::createFromFormat('d/m/Y', $req->tanggal_krs_max, 'Asia/Jakarta')->format('d F Y')) : NULL;
        $data['tanggal_mrs_min'] = !is_null($req->tanggal_mrs_min) ? indonesian_date(Carbon::createFromFormat('d/m/Y', $req->tanggal_mrs_min, 'Asia/Jakarta')->format('d F Y')) : NULL;
        $data['tanggal_mrs_max'] = !is_null($req->tanggal_mrs_max) ? indonesian_date(Carbon::createFromFormat('d/m/Y', $req->tanggal_mrs_max, 'Asia/Jakarta')->format('d F Y')) : NULL;
        $data['ranap'] = $req->ranap ==  1 ? 'Rawat Inap' : '';
        $data['rajal'] = $req->rajal ==  1 ? 'Rawat Jalan' : '';
        $data['igd'] = $req->igd ==  1 ? 'IGD' : '';
        $data['medical_checkup'] = $req->medical_checkup ==  1 ? 'Medical Checkup' : '';
        $data['lokasi'] = '';
        if(!empty($req->lokasi)){
            $data['lokasi'] = Lokasi::find($req->lokasi)->nama;
        }
        $data['no_rm'] = $req->no_rm;
        $pdf = DOMPDF::loadView('users.kasus.download', $data);
        return $pdf->stream('Arsip_Kasus.pdf');
    }
}
