<?php

namespace App\Http\Controllers\Gizi\Pengaturan\ResepMakanan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gizi\Resep;
use App\Models\Gizi\ResepDetail;
use App\Models\Gizi\BahanMakanan;
use App\User;
use Auth;
use DB;
use Bugsnag;

class ResepController extends Controller
{
    public function index()
    {
    	$data = Resep::all();
        $status = 'pengaturan';
    	return view('gizi.resep.index',['data'=>$data, 'status'=>$status]);
    }

    public function create()
    {
    	$bahan = BahanMakanan::all();
        $status = 'pengaturan';
    	return view('gizi.resep.create',['bahan'=>$bahan, 'status'=>$status]);
    }

    public function save(Request $request)
    {
        DB::connection('gizi')->beginTransaction();

    	try
    	{
    		if($request->input('id_resep'))
            {
                $resep = Resep::where('id',$request['id_resep'])->first();
                $resep->nama = $request->input('nama_resep');
                $resep->porsi = $request->input('jumlah_porsi');
                $resep->waktu_masak = $request->input('waktu_masak');
                $resep->ukuran_tiap_porsi = $request->input('ukuran');
                $resep->nilai_e = $request->input('nilai_E');
                $resep->nilai_p = $request->input('nilai_P');
                $resep->nilai_l = $request->input('nilai_L');
                $resep->nilai_k = $request->input('nilai_K');
                $resep->prosedur = $request->input('simplemde');
                $resep->created_by = Auth::user()->id;

                $resep->save();
                // dd($request);
                // dd($request->input('id_detail'));
                if(!is_null($request->input('id_detail')))
                {
                    $j = count($request->input('id_detail'));
                    if($j > 1)
                    {
                        $delete = ResepDetail::where('resep_id',$request['id_resep'])
                                        ->whereNotIn('id',$request['id_detail'])
                                        ->select('id')
                                        ->get();
                        $y = count($delete);
                        for($w=0;$w<$y;$w++)
                        {
                            //echo $delete[$w]['id'];
                            ResepDetail::destroy($delete[$w]['id']);
                        }
                    }
                    for($i = 0; $i<$j; $i++)
                    {
                        $detail = ResepDetail::where('id', $request->input('id_detail.'.$i.''))->first();
                        $detail->bahan_makanan_id = $request->input('bahan.'.$i.'');
                        $detail->jumlah_bb = $request->input('jumlah_BB.'.$i.'');
                        $detail->jumlah_bk = $request->input('jumlah_BK.'.$i.'');
                        $detail->resep_id = $resep->id;
                        $detail->created_by = Auth::user()->id;
                        $detail->save();
                    }
                    for($k = count($request->input('bahan'))-1; $k>=$j; $k--)
                    {
                        $detail = new ResepDetail;
                        $detail->bahan_makanan_id = $request->input('bahan.'.$k.'');
                        $detail->jumlah_bb = $request->input('jumlah_BB.'.$k.'');
                        $detail->jumlah_bk = $request->input('jumlah_BK.'.$k.'');
                        $detail->resep_id = $resep->id;
                        $detail->created_by = Auth::user()->id;
                        $detail->save();
                    }    
                }
                else
                {
                    for($k = 0; $k < count($request->input('bahan')); $k++)
                    {
                        $detail = new ResepDetail;
                        $detail->bahan_makanan_id = $request->input('bahan.'.$k.'');
                        $detail->jumlah_bb = $request->input('jumlah_BB.'.$k.'');
                        $detail->jumlah_bk = $request->input('jumlah_BK.'.$k.'');
                        $detail->resep_id = $resep->id;
                        $detail->created_by = Auth::user()->id;
                        $detail->save();
                    }
                }
                /*else
                {
                    $delete = ResepDetail::where('id',$request['id_detail'])->first();
                    dd($delete);
                    $delete->delete();
                }*/
                
                DB::connection('gizi')->commit();

                return redirect('/gizi/resep')
                        ->with('message','Resep berhasil diubah')
                        ->with('status', 1)
                        ->with('title', 'Sukses');
            }
            else
            {
                $resep = new Resep;
                $resep->nama = $request->input('nama_resep');
                $resep->porsi = $request->input('jumlah_porsi');
                $resep->waktu_masak = $request->input('waktu_masak');
                $resep->ukuran_tiap_porsi = $request->input('ukuran');
                $resep->nilai_e = $request->input('nilai_E');
                $resep->nilai_p = $request->input('nilai_P');
                $resep->nilai_l = $request->input('nilai_L');
                $resep->nilai_k = $request->input('nilai_K');
                $resep->prosedur = $request->input('simplemde');
                $resep->created_by = Auth::user()->id;

                if(!empty($request->makanan_pokok))
                {
                    $resep->flag_pokok = 1;
                }

                $resep->save();

                $j = count($request->input('bahan'));
                for($i = 0; $i<$j; $i++)
                {
                    $detail = new ResepDetail;
                    $detail->bahan_makanan_id = $request->input('bahan.'.$i.'');
                    $detail->jumlah_bb = $request->input('jumlah_BB.'.$i.'');
                    $detail->jumlah_bk = $request->input('jumlah_BK.'.$i.'');
                    $detail->resep_id = $resep->id;
                    $detail->created_by = Auth::user()->id;
                    $detail->save();    
                }
            }
	    	DB::connection('gizi')->commit();

	    	return redirect('/gizi/resep')
	    			->with('message','Resep berhasil ditambahkan')
	    			->with('status', 1)
	    			->with('title', 'Sukses');
    	}

    	catch(\Exception $e)
    	{
    		app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('gizi')->rollback();
    	}	
    }

    public function detail($id)
    {	
    	$resep = Resep::where('id',$id)->first();
    	$detail = ResepDetail::where('resep_id',$id)->get();
        $status = 'pengaturan';
    	return view('gizi.resep.single',['resep'=>$resep,'detail'=>$detail, 'status'=>$status]);
    }

    public function edit($id)
    {
    	$resep = Resep::where('id',$id)->first();
    	$bahan = BahanMakanan::all();
    	$detail = ResepDetail::with('bahan_makanan')->where('resep_id',$id)->get();
        $status = 'pengaturan';
    	return view('gizi.resep.edit',['resep'=>$resep,'detail'=>$detail,'bahan'=>$bahan, 'status'=>$status]);
    }

    public function delete($id)
    {
    	DB::connection('gizi')->beginTransaction();

    	try
    	{
    		$delete = Resep::where('id',$id)->first();
//	    	$delete_d = ResepDetail::with('bahan_makanan')->where('resep_id',$id)->get();

	    	$delete->delete();
//	    	$delete_d->delete();

	    	DB::connection('gizi')->commit();
	    	return redirect('/gizi/resep')
	    			->with('message','Resep berhasil dihapus')
	    			->with('status',1)
	    			->with('title', 'Sukses');
    	}
    	catch(\Exception $e)
    	{
    		app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('gizi')->rollback();
    	}
 
    }
}
