<?php

namespace App\Http\Controllers\Gudang\StokOpname;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\StokOpname;
use App\Models\Gudang\ItemsTemplate;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Carbon\Carbon;
use DateTime, stdClass;

class ReadController extends Controller
{
    public function getAll()
    {
        $stokopname = StokOpname::orderBy('created_at','desc')->get();

    	// $transaction = Transaction::orderBy($order_by, 'desc')->get();
    	return $stokopname;
    }

    public function getPerPage($limit, $offset)
    {
        $stokopname = StokOpname::orderBy('created_at','desc')->limit($limit)->offset($offset)->get();
        return $stokopname;
    }

    public function filteredData($limit, $offset, $tgl_awal, $tgl_akhir)
    {  

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
        
        $stokopname = StokOpname::whereBetween('created_at', [$min_date, $max_date]);

        $count = $stokopname->get()->count();
        $stokopname = $stokopname->limit($limit)->offset($offset)->get();
        $stokopname->count = $count;

        return $stokopname;
    }

    public function get($slug)
    {
        $stokopname = StokOpname::with(['opname_detail.detail_item', 'opname_detail.created_by_detail', 'distribusi.log.detail_item.detail_item', 'penghapusan.log.detail_item.detail_item'])->where('slug',$slug)->first();

        //if(!$stokopname->status) return $stokopname;

        $detail = array();
        $i=0;
        foreach ($stokopname->opname_detail as $opname) {
            $flag=0;
            for($j=0;$j<$i;$j++)
            {
                if($opname->item_id == $detail[$j]->item_id && date('Y-m-d', strtotime($opname->kadaluarsa)) == date('Y-m-d', strtotime($detail[$j]->kadaluarsa))) {
                    $opname->harga = ($opname->harga == 0) ? $detail[$j]->harga : $opname->harga;
                    array_push($detail[$j]->sub, $opname);

                    $detail[$j]->jumlah += $opname->jumlah;
                    $detail[$j]->harga = ($opname->harga == 0) ? $detail[$j]->harga : $opname->harga;
                    $detail[$j]->keterangan .= ", ".$opname->keterangan;
                    $flag++;
                    break;
                }
            }
            if(!$flag)
            {
                $obj = new stdClass();
                $obj->item_id =  $opname->item_id;
                $obj->nama =  $opname->detail_item->nama;
                $obj->satuan =  $opname->detail_item->satuan;
                $obj->jumlah =  $opname->jumlah;
                $obj->kadaluarsa =  $opname->kadaluarsa;
                $obj->harga = ($opname->harga == 0) ? $opname->detail_item->harga :$opname->harga;
                $obj->keterangan = $opname->keterangan;

                $sub = array();

                $opname->harga = ($opname->harga == 0) ? $opname->detail_item->harga : $opname->harga;
                array_push($sub, $opname);

                $obj->sub = $sub;
                array_push($detail, $obj);
                $i++;
            }
        }
        usort($detail,array($this,'cmp'));
        $stokopname->detail = $detail;

        return $stokopname;
    }

    public function getPerbedaan($slug)
    {
        $stokopname = $this->get($slug);
        $items = app('App\Http\Controllers\Gudang\Items\ReadController')->getAllItems();

        $barang = array();
        $detail = $stokopname->detail;
        // dd($items,$detail);
        $i=0;
        foreach ($items as $item) 
        {
            $flag=0;
            foreach($detail as $det)
            {
            // dd($item, $det);
                if($item->item_template_id == $det->item_id && date('Y-m-d', strtotime($item->kadaluarsa)) == date('Y-m-d', strtotime($det->kadaluarsa)) && !isset($det->flag)) 
                {                   
                    $barang[$i]['nama'] = $det->nama;
                    $barang[$i]['kadaluarsa'] = $det->kadaluarsa;
                    $barang[$i]['tercatat'] = $item->jumlah;
                    $barang[$i]['sebenarnya'] = $det->jumlah;
                    $barang[$i]['beda'] = $det->jumlah - $item->jumlah;
                    $barang[$i]['item_id'] = $det->item_id;
                    $barang[$i]['log_id'] = $item->id;
                    $barang[$i]['satuan'] = $item->detail_item->satuan;
                    $barang[$i]['harga'] = $det->harga;
                    $barang[$i]['keterangan'] = $det->keterangan;
                    $i++;
                    $flag++;
                    $det->flag = 1;
                    break;
                }
            }
            if(!$flag)
            {
                $barang[$i]['nama'] = $item->detail_item->nama;
                $barang[$i]['kadaluarsa'] = $item->kadaluarsa;
                $barang[$i]['tercatat'] = $item->jumlah;
                $barang[$i]['sebenarnya'] = 0;
                $barang[$i]['beda'] = 0 - $item->jumlah;
                $barang[$i]['item_id'] = $item->item_template_id;
                $barang[$i]['log_id'] = $item->id;
                $barang[$i]['harga'] = $item->harga_saat_itu;
                $barang[$i]['satuan'] = $item->detail_item->satuan;
                $barang[$i]['keterangan'] = $item->keterangan;
                $i++;
            }
        }
        // dd($barang);
        foreach ($detail as $row) {
            if(isset($row->flag)) continue;
            $barang[$i]['nama'] = $row->nama;
            $barang[$i]['kadaluarsa'] = $row->kadaluarsa;
            $barang[$i]['tercatat'] = 0;
            $barang[$i]['sebenarnya'] = $row->jumlah;
            $barang[$i]['beda'] = $row->jumlah;
            $barang[$i]['item_id'] = $row->item_id;
            $barang[$i]['harga'] = $row->harga;
            $barang[$i]['keterangan'] = $row->keterangan;
            $barang[$i]['satuan'] = $row->satuan;
            $i++;
        }
        // dd($barang);
        // dd('abc');
        usort($barang,array($this,'cmp2'));
        return $barang;
    }

    public function getPerbedaanSingle($items, $req)
    {
        $flag=[];
        $barang = array();
        $i=0;
        $item_template = ItemsTemplate::where('id', $req['barang'][0])->first();
        // $item_template = ItemsTemplate::get();
        foreach ($items as  $item) 
        {
            $flag[$i] = 0;
            foreach ($req['barang'] as $key => $barang_request) {
               
                if(!isset($req['added'][$key]) && $item->item_template_id == $barang_request && date('Y-m-d', strtotime($item->kadaluarsa)) == date('d/m/Y', strtotime($req['kadaluarsa'][$key]))) 
                {                   
                    $barang[$i]['nama'] = $item->detail_item->nama;
                    $barang[$i]['kadaluarsa'] = $req['kadaluarsa'][$key];
                    $barang[$i]['tercatat'] = $item->jumlah;
                    $barang[$i]['sebenarnya'] = $req['jumlah'][$key];
                    $barang[$i]['harga'] = $req['harga'][$key];
                    $barang[$i]['beda'] = $req['jumlah'][$key] - $item->jumlah;
                    $barang[$i]['item_id'] = $barang_request;
                    $barang[$i]['log_id'] = $item->id;
                    $barang[$i]['satuan'] = $item->detail_item->satuan;
                    $barang[$i]['keterangan'] = $req['keterangan'][$key];
                    $req['added'][$key] = 1;
                    
                    $flag[$i]++;
                    $i++;
                    break;
                }
            }
            if(!$flag[$i])
            {
                $barang[$i]['nama'] = $item->detail_item->nama;
                $barang[$i]['kadaluarsa'] = $item->kadaluarsa;
                $barang[$i]['tercatat'] = $item->jumlah;
                $barang[$i]['sebenarnya'] = 0;
                $barang[$i]['harga'] = $item->detail_item->harga;
                $barang[$i]['beda'] = 0 - $item->jumlah;
                $barang[$i]['item_id'] = $item->item_template_id;
                $barang[$i]['log_id'] = $item->id;
                $barang[$i]['keterangan'] = $item->keterangan;
                $barang[$i]['satuan'] = $item->detail_item->satuan;
                $i++;
            }
        }
        // dd($barang, $req);
        foreach ($req['barang'] as $key => $barang_request) {
            if(isset($req['added'][$key])  && $req['added']['key']) continue;
            // dd($barang, $i, $req['barang'][0], $flag, $item_template);
            $barang[$i]['nama'] = $item_template->nama;
            $barang[$i]['kadaluarsa'] = $req['kadaluarsa'][$key];
            $barang[$i]['harga'] = $req['harga'][$key];
            $barang[$i]['tercatat'] = 0;
            $barang[$i]['sebenarnya'] = $req['jumlah'][$key];
            $barang[$i]['beda'] = $req['jumlah'][$key];
            $barang[$i]['item_id'] = $barang_request;
            $barang[$i]['keterangan'] = $req['keterangan'][$key];
            $barang[$i]['satuan'] = $item_template->satuan;
            $i++;
        }
        usort($barang,array($this,'cmp2'));
        return $barang;
    }

    public function cmp($a,$b)
    {   
        $al = strtolower($a->nama);
        $bl = strtolower($b->nama);
        if ($al == $bl) {
            return 0;
        }
        return ($al > $bl) ? +1 : -1;
    }

    public function cmp2($a,$b)
    {   
        return strcmp($a["nama"], $b["nama"]);
    }

}
