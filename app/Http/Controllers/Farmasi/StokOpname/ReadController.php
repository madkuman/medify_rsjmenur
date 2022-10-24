<?php

namespace App\Http\Controllers\Farmasi\StokOpname;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\StokOpname;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Carbon\Carbon;
use DateTime, stdClass;

class ReadController extends Controller
{
	public function getAll($farmasi_id)
    {
        $stokopname = StokOpname::where('farmasi_id', $farmasi_id)->orderBy('created_at','desc')->get();
    	return $stokopname;
    }

    public function getDataIndex($farmid, $request)
    {
        $tgl_awal = $request->tanggal_awal;
        $tgl_akhir = $request->tanggal_akhir;
        $flag = explode(',',$request->flag);

        $stokopname = StokOpname::where('farmasi_id', $farmid)->whereIn('flag',$flag);

        if($tgl_awal) {
            $tgl_awal = str_replace("/", "-", $tgl_awal);
            $tgl_awal = strtotime($tgl_awal);
            $tgl_awal = date('m/d/Y', $tgl_awal);

            $min_date = Carbon::parse($tgl_awal);
        } else $min_date = Carbon::minValue();

        if($tgl_akhir){
            $tgl_akhir = str_replace("/", "-", $tgl_akhir);
            $tgl_akhir = strtotime($tgl_akhir);
            $tgl_akhir = date('m/d/Y', $tgl_akhir);

            $max_date = Carbon::parse($tgl_akhir);
            $max_date = $max_date->copy()->endOfDay();
        } else $max_date = Carbon::maxValue();
        
        $stokopname = $stokopname->whereBetween('created_at', [$min_date, $max_date])->latest();

        return $stokopname;
    }

    public function get($slug)
    {
        $stokopname = StokOpname::with(['opname_detail.detail_item.item_detail', 'opname_detail.created_by_detail', 'distribusi.log.detail_item.detail_item.item_detail', 'penghapusan.log.detail_item.detail_item.item_detail'])->where('slug',$slug)->first();

        $detail = array();
        $i=0;
        foreach ($stokopname->opname_detail as $opname) {
            $flag=0;
            for($j=0;$j<$i;$j++)
            {
                if($opname->item_id == $detail[$j]->item_id && date('Y-m-d', strtotime($opname->kadaluarsa)) == date('Y-m-d', strtotime($detail[$j]->kadaluarsa))) {
                    array_push($detail[$j]->sub, $opname);

                    $detail[$j]->jumlah += $opname->jumlah;
                    $detail[$j]->keterangan .= ", ".$opname->keterangan;
                    $flag++;
                    break;
                }
            }
            if(!$flag)
            {
                $obj = new stdClass();
                $obj->item_id =  $opname->item_id;
                $obj->nama =  $opname->detail_item->item_detail->nama;
                $obj->satuan =  $opname->detail_item->item_detail->satuan;
                $obj->jumlah =  $opname->jumlah;
                $obj->kadaluarsa =  $opname->kadaluarsa;
                $obj->harga =  $opname->detail_item->harga;
                $obj->keterangan = $opname->keterangan;
                $sub = array();
                array_push($sub, $opname);

                $obj->sub = $sub;
                array_push($detail, $obj);
                $i++;
            }
        }
        $stokopname->detail = $detail;

        return $stokopname;
    }

    public function getPerbedaan($slug)
    {
        $stokopname = app('App\Http\Controllers\Farmasi\StokOpname\ReadController')->get($slug);
        $items = app('App\Http\Controllers\Farmasi\Items\ReadController')->getAllItems($stokopname->farmasi_id);

        $barang = array();
        $detail = $stokopname->detail;
        // dd($items,$detail);
        $i=0;
        $flag_items = [];
        foreach ($items as $item) 
        {
            if(!isset($flag_items[$item->item_farmasi_id.'-'.substr($item->kadaluarsa,1,10)])) {
                $flag_items[$item->item_farmasi_id . '-' . substr($item->kadaluarsa, 1, 10)] = $item;
            $flag=0;
            foreach($detail as $det)
            {
                // dd($item, $det);
                //di real ada di sistem ada
                if($item->item_farmasi_id == $det->item_id && date('Y-m-d', strtotime($item->kadaluarsa)) == date('Y-m-d', strtotime($det->kadaluarsa)) && !isset($det->flag)) 
                {                   
                    $barang[$i]['nama'] = $det->nama;
                    $barang[$i]['kadaluarsa'] = Carbon::parse($det->kadaluarsa);
                    $barang[$i]['tercatat'] = $item->jumlah;
                    $barang[$i]['sebenarnya'] = $det->jumlah;
                    $barang[$i]['beda'] = $det->jumlah - $item->jumlah;
                    $barang[$i]['item_id'] = $det->item_id;
                    $barang[$i]['log_id'] = $item->id;
                    $barang[$i]['satuan'] = $item->detail_item->item_detail->satuan;
                    $barang[$i]['harga'] = $item->detail_item->item_detail->harga;
                    $barang[$i]['keterangan'] = $det->keterangan;
                    $i++;
                    $flag++;
                    $det->flag = 1;
                    break;
                }
            }
            if(!$flag)
            {
                //di real gaada di sistem ada
                $barang[$i]['nama'] = $item->detail_item->item_detail->nama;
                $barang[$i]['kadaluarsa'] = Carbon::parse($item->kadaluarsa);
                $barang[$i]['tercatat'] = $item->jumlah;
                $barang[$i]['sebenarnya'] = 0;
                $barang[$i]['beda'] = 0 - $item->jumlah;
                $barang[$i]['item_id'] = $item->item_farmasi_id;
                $barang[$i]['log_id'] = $item->id;
                $barang[$i]['satuan'] = $item->detail_item->item_detail->satuan;
                $barang[$i]['harga'] = $item->detail_item->item_detail->harga;
                $barang[$i]['keterangan'] = $item->detail_item->keterangan;
                $i++;
            }
            }else{
                $kadaluarsa = Carbon::parse($item->kadaluarsa);
                $barang[$i]['nama'] = $item->detail_item->item_detail->nama;
                $barang[$i]['kadaluarsa'] = $kadaluarsa->format('d/m/Y');
                $barang[$i]['tercatat'] = $item->jumlah;
                $barang[$i]['sebenarnya'] = 0;
                $barang[$i]['beda'] = 0 - $item->jumlah;
                $barang[$i]['item_id'] = $item->item_farmasi_id;
                $barang[$i]['log_id'] = $item->id;
                $barang[$i]['satuan'] = $item->detail_item->item_detail->satuan;
                $barang[$i]['harga'] = $item->detail_item->item_detail->harga;
                $barang[$i]['keterangan'] = $item->detail_item->keterangan;
                $i++;
            }
        }
        // dd($barang);
        // di real ada di sistem gaada
        foreach ($detail as $row) {
            if(isset($row->flag)) continue;
            $barang[$i]['nama'] = $row->nama;
            $barang[$i]['kadaluarsa'] = Carbon::parse($row->kadaluarsa);
            $barang[$i]['tercatat'] = 0;
            $barang[$i]['sebenarnya'] = $row->jumlah;
            $barang[$i]['beda'] = $row->jumlah;
            $barang[$i]['item_id'] = $row->item_id; //item_farmasi
            $barang[$i]['satuan'] = $row->satuan;
            $barang[$i]['harga'] = $row->harga;
            $barang[$i]['keterangan'] = $row->keterangan;
            $i++;
        }
        // dd($barang);
        // dd('abc');
        usort($barang,array($this,'cmp2'));
        return $barang;
    }

    public function getPerbedaanSingle($item_farmasi, $req)
    {
        $items = $item_farmasi->items_all;
        $flag=[];
        $barang = array();
        $i=0;
        $flag_items = [];

        foreach ($items as  $item)
        {
            if(!isset($flag_items[$item->item_farmasi_id.'-'.substr($item->kadaluarsa,1,10)])) {
                $flag_items[$item->item_farmasi_id . '-' . substr($item->kadaluarsa, 1, 10)] = $item;
                $j = 0;
                $flag_awal = 0;
                foreach ($req['barang'] as $key => $barang_request) {

                    if (!isset($flag[$j])) $flag[$j] = 0;
                    if ($item->item_farmasi_id == $barang_request && date('Y-m-d', strtotime($item->kadaluarsa)) == date('Y-m-d', strtotime($req['kadaluarsa'][$key]))) {
                        $barang[$i]['nama'] = $item->nama;
                        $barang[$i]['kadaluarsa'] = $req['kadaluarsa'][$key];
                        $barang[$i]['tercatat'] = $item->jumlah;
                        $barang[$i]['sebenarnya'] = $req['jumlah'][$key];
                        $barang[$i]['beda'] = $req['jumlah'][$key] - $item->jumlah;
                        $barang[$i]['item_id'] = $item->item_farmasi_id;
                        $barang[$i]['log_id'] = $item->id;
                        $flag_awal = 1;
                        $flag[$j]++;
                        $i++;
                        break;
                    }
                    $j++;
                }
                if (!$flag_awal) {
                    $kadaluarsa = Carbon::parse($item->kadaluarsa);
                    $barang[$i]['nama'] = $item->detail_item->item_detail->nama;
                    $barang[$i]['kadaluarsa'] = $kadaluarsa->format('d/m/Y');
                    $barang[$i]['tercatat'] = $item->jumlah;
                    $barang[$i]['sebenarnya'] = 0;
                    $barang[$i]['beda'] = 0 - $item->jumlah;
                    $barang[$i]['item_id'] = $item->item_farmasi_id;
                    $barang[$i]['log_id'] = $item->id;
                    $i++;
                }
            }else{
                $kadaluarsa = Carbon::parse($item->kadaluarsa);
                $barang[$i]['nama'] = $item->detail_item->item_detail->nama;
                $barang[$i]['kadaluarsa'] = $kadaluarsa->format('d/m/Y');
                $barang[$i]['tercatat'] = $item->jumlah;
                $barang[$i]['sebenarnya'] = 0;
                $barang[$i]['beda'] = 0 - $item->jumlah;
                $barang[$i]['item_id'] = $item->item_farmasi_id;
                $barang[$i]['log_id'] = $item->id;
                $i++;
            }
        }
        foreach ($req['barang'] as $key => $barang_request) {
            if(isset($flag[$key])  && $flag[$key]) continue;
            $barang[$i]['nama'] = $item_farmasi->item_detail->nama;
            $barang[$i]['kadaluarsa'] =$req['kadaluarsa'][$key];
            $barang[$i]['tercatat'] = 0;
            $barang[$i]['sebenarnya'] = $req['jumlah'][$key];
            $barang[$i]['beda'] = $req['jumlah'][$key];
            $barang[$i]['item_id'] = $barang_request;
            $i++;
        }

        // dd($barang, $req, $flag);
        // dd('abc');
        return $barang;
    }
    
    public function cmp2($a,$b)
    {   
        return strcmp($a["nama"], $b["nama"]);
    }
}
