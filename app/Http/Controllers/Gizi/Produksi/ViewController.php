<?php

namespace App\Http\Controllers\Gizi\Produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ViewController extends Controller
{
    public function newTanggal(Request $request)
    {   
        $auto = 0;
        $date = 0;
        $flag = [];
        if(!empty($request->get('auto')))
        {
            $auto = 1;
            $date = Carbon::today()->format('d-m-Y');    
        }
        $status = 'produksi';
        return view('gizi.produksi.create-tanggal',['auto'=>$auto,'date'=>$date,'flag'=>$flag, 'status'=>$status]);
    }

    public function index(Request $request)
    {
    	ini_set('max_execution_time', 300);        
        
    	if(empty($request->get('tanggal')))
    	{
    		$date = Carbon::now();
    	}
    	else
    	{
    		$date = $request->get('tanggal');
    	}
    	$show = app('App\Http\Controllers\Gizi\Produksi\ReadController')->getProduksi($date);
    	$data = app('App\Http\Controllers\Gizi\Produksi\ReadController')->getRekapResepIndex($date);
        $tanggal['hari_ini'] = Carbon::parse($date)->format('d F Y');
        $tanggal['besok'] = Carbon::tomorrow()->format('d F Y');
        $flag = 1;

        //dd($data[1]['nama']);
        $status = 'produksi';
        return view('gizi.produksi.index',['data'=>$data, 'tanggal'=>$tanggal, 'flag'=>$flag, 'status'=>$status, 'show'=>$show]);
    }

    public function new(Request $request)
    {   
        //dd($request);
        if(!empty($request->get('produksi_id')))
        {
           //dd($request->get('produksi_id'));
           app('App\Http\Controllers\Gizi\Produksi\DeleteController')->delete($request->get('produksi_id'),'edit');
        }
        /*if(empty($request->get('tanggal')))
        {   
            $date = Carbon::now();
            $data = app('App\Http\Controllers\Gizi\Produksi\ReadController')->getRekapResep($date,1,1,1);
            $tanggal['hari_ini'] = Carbon::parse($date)->format('d F Y');
            $tanggal['besok'] = Carbon::tomorrow()->format('d F Y');
            $flag['auto'] = 1;
            $flag['pagi'] = 1;
            $flag['siang'] = 1;
            $flag['sore'] = 1;
            $resep = app('App\Http\Controllers\Gizi\Produksi\ReadController')->getResep();    
        }
        else*/ if($request->get('bantuanrekap') == 1)
        {
           $date = Carbon::parse($request->get('tanggal'));
           $data = app('App\Http\Controllers\Gizi\Produksi\ReadController')->getRekapResep($date,
                    $request->get('pagi'),$request->get('siang'),$request->get('sore'));
           $resep = app('App\Http\Controllers\Gizi\Produksi\ReadController')->getResep();
           $flag['pagi'] = $request->get('pagi');
           $flag['siang'] = $request->get('siang');
           $flag['sore'] = $request->get('sore');
           $flag['auto'] = 1;
           $tanggal['hari_ini'] = Carbon::parse($date)->format('d F Y');            
        }
        else
        {
            $data = [];
            $date = Carbon::parse($request->get('tanggal'));
            $flag['pagi'] = $request->get('pagi');
            $flag['siang'] = $request->get('siang');
            $flag['sore'] = $request->get('sore');
            $flag['auto'] = 0;
            $resep = app('App\Http\Controllers\Gizi\Produksi\ReadController')->getResep();
            $tanggal['hari_ini'] = Carbon::parse($date)->format('d F Y');
        }
        $status = 'produksi';
        return view('gizi.produksi.create-makanan',['data'=>$data, 'tanggal'=>$tanggal, 'resep'=>$resep, 'flag'=>$flag, 'status'=>$status]);
    }

    public function newBahan(Request $request)
    {   
        ini_set('max_execution_time', 300);
        //dd($request);
        $flag = [];
        $auto = 0;
        if(!empty($request->input('flag')))
        {
            for($i=0;$i<3;$i++)
            {
                $flag[$i] = $request->input('flag.'.$i.'');
            }    
        }
        else if(!empty($request->input('auto')))
        {
            $auto = $request->input('auto');

        }
        $data = app('App\Http\Controllers\Gizi\Produksi\PostController')->addProduksiMakanan($request);
        $bahan = app('App\Http\Controllers\Gizi\Produksi\ReadController')->countBahan($data['produksimakanan']);
        $bahan_all = app('App\Http\Controllers\Gizi\Produksi\ReadController')->getBahan();
        $tanggal['hari_ini'] = $data['tanggal'];
        unset($data['tanggal']);
        if($auto == 1)
        {
            $tanggal['besok'] = Carbon::parse($tanggal['hari_ini'])->addDay()->format('d F Y'); 
        }
        $status = 'produksi';
        return view('gizi.produksi.create-bahan',['bahan'=>$bahan,'bahan_all'=>$bahan_all,'tanggal'=>$tanggal
            ,'produksi_id'=>$data['produksi_id'], 'flag'=>$flag, 'auto'=>$auto, 'status'=>$status]);
    }

    public function final($id)
    {
        ini_set('max_execution_time', 300); 
        $data['makanan'] = app('App\Http\Controllers\Gizi\Produksi\ReadController')->getRekapMakanan($id);
        $data['bahan'] = app('App\Http\Controllers\Gizi\Produksi\ReadController')->getRekapBahan($id);
        $data['produksi'] = app('App\Http\Controllers\Gizi\Produksi\ReadController')->getRekap($id);
        $data['detail'] = app('App\Http\Controllers\Gizi\Produksi\ReadController')->getRekapDetail($id);
        $tanggal = Carbon::parse($data['produksi']->tanggal_produksi)->format('d F Y');
        //dd($data['produksi'],$tanggal);
        $status = 'produksi';
        return view('gizi.produksi.single',['data'=>$data,'tanggal'=>$tanggal, 'status'=>$status]);
    }

    public function edit($id)
    {   
        $auto = 0;
        $flag = [];
        $data['produksi'] = app('App\Http\Controllers\Gizi\Produksi\ReadController')->getRekap($id);
        $data['detail'] = app('App\Http\Controllers\Gizi\Produksi\ReadController')->getRekapDetail($id);
        $date = Carbon::parse($data['produksi']->tanggal_produksi)->format('d-m-Y');
        $id = $data['produksi']->id;
        $num = count($data['detail']);
        if(count($data['detail']) != 3)
        {      
            for($i=0;$i<$num;$i++)
            {
                $flag[$i] = $data['detail'][$i]->waktu_makan_id;
            }    
        }
        else
        {
            $auto = 1;
        }

        $status = 'produksi';
        return view('gizi.produksi.create-tanggal',['auto'=>$auto,'date'=>$date,'flag'=>$flag,'id'=>$id, 'status'=>$status]);
    }

    public function histori()
    {
        $data = app('App\Http\Controllers\Gizi\Produksi\ReadController')->getAllRekap();
        $status = 'produksi';
        return view('gizi.produksi.histori',['data'=>$data, 'status'=>$status]);
    }
}
