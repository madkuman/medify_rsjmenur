<?php

namespace App\Http\Controllers\IT\Komplain;

use DataTables;
use Illuminate\Http\Request;
use App\Models\Users\UserMedify;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Lokasi;
use App\Models\IT\Komplain;
use App\Models\IT\JenisKomplain;
use App\User;
use Carbon\Carbon;

class ViewController extends Controller
{
    public function index(Request $request)
    {

        $tgl_komplain_start = !empty($request['tgl_komplain_start']) ? Carbon::parse($request['tgl_komplain_start']) : Carbon::now()->startOfMonth();
        $tgl_komplain_end = !empty($request['tgl_komplain_end']) ? Carbon::parse($request['tgl_komplain_end'])->endOfDay() :  Carbon::now()->endOfDay();
        $status = !empty($request['status']) ? $request->status : 'semua';
        $sort_by = !empty($request['sort_by']) ? $request->sort_by : 'tgl_komplain_terbaru';

        $komplain = Komplain::with(['teknisinya', 'jenisKomplain','creator'])->whereBetween('waktu_komplain',[$tgl_komplain_start,$tgl_komplain_end]);
        
        if($status == 'sudah_respon') $komplain = $komplain->whereNotNull('waktu_respon');
        else if($status == 'belum_respon') $komplain = $komplain->whereNull('waktu_respon');


        if($sort_by == 'tgl_komplain_terbaru') $komplain = $komplain->orderBy('waktu_komplain','DESC');
        else if($sort_by == 'tgl_komplain_terlama') $komplain = $komplain->orderBy('waktu_komplain','ASC');


        $data['komplains'] = $komplain->get();
        $data['lokasi']  = Lokasi::select('nama')->get();
        $data['tgl_komplain_start']  = $tgl_komplain_start;
        $data['tgl_komplain_end']  = $tgl_komplain_end;
        $data['sort_by']  = $sort_by;
        $data['status']  = $status;

        return view('it.index', $data);
    }
    public function create(Request $request)
    {
        $data['teknisi'] = User::where('profesi', '20')->get();
        $data['lokasi']  = Lokasi::orderBy('nama')->get();
        return view('it.create', $data);
    }

    public function respon($id)
    {
        $data['komplain'] = Komplain::find($id);
        $data['teknisi'] = User::where('profesi', '20')->orderBy('name')->get();
        $data['lokasi']  = Lokasi::orderBy('nama')->get();
        $data['jenis_komplain']  = JenisKomplain::orderBy('nama')->get();
        return view('it.respon', $data);
    }


    public function getJSON(Request $request)
    {
         $data = app('App\Http\Controllers\IT\Komplain\ReadController')->getEachData($request->id);

        return response()->json($data);
    }

    public function getLokasi(Request $request)
    {
        $data  = Lokasi::select('nama')->orderBy('nama','asc')->get();

        return response()->json($data);
    }

    public function getTeknisi(Request $request)
    {
        $keyword = $request->keyword;
        
        $data = UserMedify::where('profesi', '20')->where('name', 'like', '%'.$keyword.'%')->get();
        
        $teknisi = [];
        foreach($data as $each_data)
        {
            $temp['id'] = $each_data->id;
            $temp['text'] = $each_data->name;
            array_push($teknisi, $temp);
        }

        return response()->json($teknisi);    
    }

    public function getDataTable(Request $request)
    {
        $tgl_komplain_start = date('Y-m-d', strtotime($request->tgl_komplain_start));
        $tgl_komplain_end   = date('Y-m-d', strtotime($request->tgl_komplain_end));

         $request->merge([
                        'tgl_komplain_start' => $tgl_komplain_start,
                        'tgl_komplain_end'   => $tgl_komplain_end
                        ]);

        $data = app('App\Http\Controllers\IT\Komplain\ReadController')->getData($request->all());

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->editColumn('jenis_komplain.nama', function ($data) {
                            $jenis_komplain = '';

                            if (isset($data->jenis_komplain_id)) {
                                $jenis_komplain = $data->jenisKomplain->nama;
                            }

                            return $jenis_komplain;
                        })
                        ->addColumn('hari_komplain', function ($data) {
                            $tgl_komplain = indonesian_date($data->tgl_komplain, 'l');

                            return $tgl_komplain;
                        })
                        ->editColumn('tgl_komplain', function ($data) {
                            $tgl_komplain = date('d-m-Y', strtotime($data->tgl_komplain));

                            return $tgl_komplain;
                        })
                        ->editColumn('jam_komplain', function ($data) {
                            $jam_komplain = date('H:i', strtotime($data->jam_komplain));

                            return $jam_komplain;
                        })
                        ->editColumn('jam_respon', function ($data) {
                            if(isset($data->jam_respon)){
                                $jam_respon = date('H:i', strtotime($data->jam_respon));
                            }else{
                                $jam_respon = '';
                            }

                            return $jam_respon;
                        })
                        ->editColumn('teknisinya.name', function ($data) {
                            $teknisi = '';

                            if (isset($data->teknisinya)) {
                                $teknisi = $data->teknisinya->name;
                            }

                            return $teknisi;
                        })
                        ->addColumn('aksi', function ($data) {
                            if(isset($data->jam_respon)){
                                $aksi = '<div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-respon" data-toggle="tooltip" title="Respon" data-original-title="Respon" id_data="'.$data->id.'">
                                            <i class="fa fa-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-edit" data-toggle="tooltip" title="Ubah" data-original-title="Ubah" id_data="'.$data->id.'">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-delete" data-toggle="tooltip" title="Hapus" data-original-title="Hapus" id_data="'.$data->id.'">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div';
                            }else{
                                $aksi = '<div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-respon" data-toggle="tooltip" title="Respon" data-original-title="Respon" id_data="'.$data->id.'">
                                            <i class="fa fa-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-delete" data-toggle="tooltip" title="Hapus" data-original-title="Hapus" id_data="'.$data->id.'">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div';
                            }
                            return $aksi;
                        })
                        ->escapeColumns([])
                        ->make(true);
    }
}
