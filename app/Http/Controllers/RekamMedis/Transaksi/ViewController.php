<?php

namespace App\Http\Controllers\RekamMedis\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RekamMedis\Transaksi;
use App\Models\RekamMedis\TransaksiTujuan;
use App\Models\Pasien\Pasien;
use App\Models\Hospital\Grup;
use Auth;
use Carbon\Carbon;

class ViewController extends Controller
{
    public function permintaan(Request $request)
    {
        $group_id_selected = $request->get('group_ids');
        $date_start = $request->get('date_start');
        $date_end = $request->get('date_end');
        $print = $request->get('print');
        $tolak_batch = $request->get('tolak_batch');
        $status = $request->get('status');
        $status_print = $request->get('status_print');
        $lokasi_rak = $request->get('lokasi_rak');

        $date_start_default = Carbon::today()->format('d-m-Y');
        $date_end_default = Carbon::today()->format('d-m-Y');

        if(empty($date_end) && empty($date_start) && empty($group_id_selected) && empty($status) && empty($status_print) && empty($lokasi_rak)) 
            return redirect('rekammedis/permintaan?group_ids%5B%5D=0&date_start='.$date_start_default.'&date_end='.$date_end_default.'&status=0&status_print=0&lokasi_rak=0');

        if(empty($group_id_selected)) $group_id_selected = [0]; 

        if($status == 2) $array_status = [-2,-1,0,1,2];
        else if($status == 1) $array_status = [1,2];
        else if($status == 0) $array_status = [0];
        else if($status == -1) $array_status = [-2,-1];
        else $array_status = [-1,0,1];

        if($status_print == 0) $array_status_print = [0];
        else if($status_print == 1) $array_status_print = [1];
        else if($status_print == 2) $array_status_print = [0,1];
        else $array_status_print = [1];

        if($lokasi_rak == 0){
            $rm_index_min = 0;
            $rm_index_max = 99;
        }
        else if($lokasi_rak == 1){
            $rm_index_min = 56;
            $rm_index_max = 99;
        }
        else if($lokasi_rak == 2){
            $rm_index_min = 0;
            $rm_index_max = 55;
        }

        $date_start_format = Carbon::createFromFormat('d-m-Y', $date_start)->startOfDay();
        $date_end_format = Carbon::createFromFormat('d-m-Y', $date_end)->endOfDay();


        if(in_array(0, $group_id_selected)) {
            $transaksi = Transaksi::where('jenis',1)->whereBetween('created_at',[$date_start_format,$date_end_format])
            ->whereIn('status',$array_status)->whereIn('status_print',$array_status_print)
            ->with('pasien.rm_transaksi.holder_user',
                'pasien.rm_transaksi.holder_group',
                'pasien.rm_transaksi.sender',
                'holder_user','holder_group')
            ->get();
        }
        else $transaksi = Transaksi::where('jenis',1)->where('holder_type',2)->whereIn('holder_group_id',$group_id_selected)->whereBetween('created_at',[$date_start_format,$date_end_format])->whereIn('status',$array_status)->whereIn('status_print',$array_status_print)->with('pasien.rm_transaksi.holder_user',
                'pasien.rm_transaksi.holder_group',
                'pasien.rm_transaksi.sender',
                'holder_user','holder_group')->get();

        if($tolak_batch == 1){
            $tolak_message = app('App\Http\Controllers\RekamMedis\Transaksi\PostController')->tolakPengirimanBatch($transaksi);
        }

        $data['group_selected'] = $group_id_selected;
        $data['groups'] = Grup::all();
        $data['permintaan'] = $transaksi;
        $data['date_start'] = $date_start;
        $data['date_end'] = $date_end;
        $data['status'] = $status;
        $data['status_print'] = $status_print;
        $data['lokasi_rak'] = $lokasi_rak;
        $data['rm_index_min'] = $rm_index_min;
        $data['rm_index_max'] = $rm_index_max;

        if($print == 1) {
            $print_status = app('App\Http\Controllers\RekamMedis\Transaksi\EditController')->editStatusPrint($transaksi);
            return view('rekammedis.permintaan.print',$data);
        }
        elseif($tolak_batch == 1){
            return redirect('rekammedis/permintaan?group_ids%5B%5D='.implode(',', $group_id_selected).'&date_start='.$date_start.'&date_end='.$date_end)
            ->with('message', $tolak_message['message'])
            ->with('title',$tolak_message['title'])
            ->with('status', $tolak_message['status']);
        }
        else return view('rekammedis.permintaan.index',$data);
    }

    public function permintaanKirim()
    {
        return view('rekammedis.permintaan.kirim');
    }

    private function printDaftarPermintaan($transaksi)
    {
        $data['transaksi'] = $transaksi;
    }

    public function permintaanBaru(Request $request)
    {
        $type = $request->get('type');
        $group_id = $request->get('group_id');
        if(!empty($group_id))
        {
            $grup = Grup::find($group_id);
            $data['group'] = $grup;
        }
        $data['type'] = $type;

        $data['tujuan'] = TransaksiTujuan::all();
        return view('rekammedis.permintaan.baru',$data);
    }

    public function pengembalian(Request $request)
    {
        $date_start = $request->get('date_start');
        $date_end = $request->get('date_end');
        $status = $request->get('status');

        $date_start_default = Carbon::today()->format('d-m-Y');
        $date_end_default = Carbon::today()->format('d-m-Y');

        if(empty($date_end) && empty($date_start) && empty($status)) 
            return redirect('rekammedis/pengembalian?date_start='.$date_start_default.'&date_end='.$date_end_default.'&status=0');

        if($status == 2) $array_status = [-2,-1,0,1,2];
        else if($status == 1) $array_status = [2];
        else if($status == 0) $array_status = [0,1];
        else if($status == -1) $array_status = [-2,-1];
        else $array_status = [1];

        $data['date_start'] = $date_start;
        $data['date_end'] = $date_end;
        $data['status'] = $status;

        $date_start_format = Carbon::createFromFormat('d-m-Y', $date_start)->startOfDay();
        $date_end_format = Carbon::createFromFormat('d-m-Y', $date_end)->endOfDay();

        $rm_group = app('App\Http\Controllers\Group\Group\ReadController')->getRMGroupSlug('rekam-medis');

        $data['transaksi'] = Transaksi::where('holder_type',2)->whereBetween('created_at',[$date_start_format,$date_end_format])->where('holder_group_id',$rm_group->id)->where('jenis',2)->whereIn('status',$array_status)->get();
        return view('rekammedis.pengembalian.index',$data);
    }

    public function pengembalianKonfirmasi()
    {
        return view('rekammedis.pengembalian.terima');
    }

    public function transferBaru($id)
    {
        $data['rm'] = Pasien::find($id);
        $data['tujuan'] = TransaksiTujuan::all();
        $data['groups'] = Grup::all();
        $is_rm_holder = app('App\Http\Controllers\RekamMedis\Transaksi\ReadController')->isRMHolder($id);
        if($is_rm_holder) return view('rekammedis.transfer.baru',$data);
        else abort(404);
    }

    public function single($id)
    {
        $transaksi = Transaksi::find($id);
        $data['transaksi'] = $transaksi;
        $rm_group = app('App\Http\Controllers\Group\Group\ReadController')->getRMGroupSlug('rekam-medis');
        $in_rm_grup = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserInGroup($rm_group->id, Auth::user()->id);

        if($in_rm_grup) $allow_konfirmasi_kirim = 1;
        else $allow_konfirmasi_kirim = 0;

        if($transaksi->holder_type == 2)
        {
            $in_trans_grup = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserInGroup($transaksi->holder_group_id, Auth::user()->id);

            if($in_trans_grup) $allow_konfirmasi_terima = 1;
            else $allow_konfirmasi_terima = 0;
        }
        else
        {
            if($transaksi->holder_user_id == Auth::user()->id) $allow_konfirmasi_terima = 1;
            else $allow_konfirmasi_terima = 0;
        }

        $data['allow_konfirmasi_terima'] = $allow_konfirmasi_terima;
        $data['allow_konfirmasi_kirim'] = $allow_konfirmasi_kirim;


        return view('rekammedis.transaksi.single',$data);
    }
}
