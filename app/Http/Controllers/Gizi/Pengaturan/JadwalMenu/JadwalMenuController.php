<?php

namespace App\Http\Controllers\Gizi\Pengaturan\JadwalMenu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gizi\Menu;
use App\Models\Gizi\MenuDetail;
use App\Models\Gizi\Diet;
use App\Models\Gizi\Kelas;
use App\Models\Gizi\Resep;
use App\User;
use Auth;
use DB;
use Bugsnag;

class JadwalMenuController extends Controller
{
    public function index()
    {	
    	ini_set('max_execution_time',0);
    	$data = Menu::with('kelas_menu')->where('kelas_id','!=','0')->get();
    	$status = 'pengaturan';
    	return view('gizi.menu.index',['data'=>$data, 'status'=>$status]);
    }

    public function create()
    {
    	$diet = Diet::all();
    	$kelas = Kelas::all();
    	$resep = Resep::all();
    	$status = 'pengaturan';
    	return view('gizi.menu.create',['diet'=>$diet, 'kelas'=>$kelas, 'resep'=>$resep, 'status'=>$status]);
    }

    public function save(Request $request)
    {
    	DB::connection('gizi')->beginTransaction();

    	try
    	{
    		if($request->input('id'))
    		{	
    			$menu  = Menu::where('id',$request->input('id'))->first();
    			// dd($menu);
    			$menu->nama = $request->input('nama_menu');
		    	$menu->kelas_id = $request->input('kelas');
		    	// $menu->diet_id = $request->input('diet');
		    	$menu->tanggal_periode = $request->input('tanggal_periode');
		    	$menu->created_by = Auth::user()->id;

		    	$menu->save();

		    	if(empty($request->input('id_mp')))
		    	{
		    		$delete = MenuDetail::where('menu_id',$request->input('id'))
		    							->where('waktu_makan_id','1')
		    							->get();

		    		if(!empty($delete))
		    		{
		    			$j = count($delete);
		    			for($i=0;$i<$j;$i++)
		    			{
		    				MenuDetail::destroy($delete[$i]['id']);
		    			}
		    		}
		    		if(!empty($request->input('makan_pagi')))
		    		{
		    			$j = count($request->input('makan_pagi'));

				    	for($i=0; $i<$j; $i++)
				    	{
				    		$detail = new MenuDetail;
				    		$detail->waktu_makan_id = 1;
				    		$detail->resep_id = $request->input('makan_pagi.'.$i.'');
				    		$detail->menu_id = $menu->id;
				    		$detail->jumlah = $request->input('jumlah_mp.'.$i.'');
				    		$detail->created_by = Auth::user()->id;

				    		$detail->save();
				    	}

		    		}
		    	}
		    	else
		    	{
		    		$z = count($request->input('id_mp'));
		    		$x = count($request->input('makan_pagi'));

		    		for($i=0;$i<$z;$i++)
		    		{
		    			$edit = MenuDetail::where('id',$request->input('id_mp.'.$i.''))->first();
		    			$edit->waktu_makan_id = 1;
		    			$edit->resep_id = $request->input('makan_pagi.'.$i.'');
		    			$edit->menu_id = $menu->id;
		    			$edit->jumlah = $request->input('jumlah_mp.'.$i.'');
		    			$edit->created_by = Auth::user()->id;

		    			$edit->save();
		    		}
		    		for($i=$x-1;$i>=$z;$i--)
		    		{
		    			$detail = new MenuDetail;
			    		$detail->waktu_makan_id = 1;
			    		$detail->resep_id = $request->input('makan_pagi.'.$i.'');
			    		$detail->menu_id = $menu->id;
			    		$detail->jumlah = $request->input('jumlah_mp.'.$i.'');
			    		$detail->created_by = Auth::user()->id;

			    		$detail->save();
		    		}
		    	}

		    	if(empty($request->input('id_sp')))
		    	{
		    		$delete = MenuDetail::where('menu_id',$request->input('id'))
		    							->where('waktu_makan_id','4')
		    							->get();

		    		if(!empty($delete))
		    		{
		    			$j = count($delete);
		    			for($i=0;$i<$j;$i++)
		    			{
		    				MenuDetail::destroy($delete[$i]['id']);
		    			}
		    		}
		    		if(!empty($request->input('snack_pagi')))
		    		{
		    			$j = count($request->input('snack_pagi'));

				    	for($i=0; $i<$j; $i++)
				    	{
				    		$detail = new MenuDetail;
				    		$detail->waktu_makan_id = 4;
				    		$detail->resep_id = $request->input('snack_pagi.'.$i.'');
				    		$detail->menu_id = $menu->id;
				    		$detail->jumlah = $request->input('jumlah_sp.'.$i.'');
				    		$detail->created_by = Auth::user()->id;

				    		$detail->save();
				    	}

		    		}
		    	}
		    	else
		    	{
		    		$z = count($request->input('id_sp'));
		    		$x = count($request->input('snack_pagi'));

		    		for($i=0;$i<$z;$i++)
		    		{
		    			$edit = MenuDetail::where('id',$request->input('id_sp.'.$i.''))->first();
		    			$edit->waktu_makan_id = 4;
		    			$edit->resep_id = $request->input('snack_pagi.'.$i.'');
		    			$edit->menu_id = $menu->id;
		    			$edit->jumlah = $request->input('jumlah_sp.'.$i.'');
		    			$edit->created_by = Auth::user()->id;

		    			$edit->save();
		    		}
		    		for($i=$x-1;$i>=$z;$i--)
		    		{
		    			$detail = new MenuDetail;
			    		$detail->waktu_makan_id = 4;
			    		$detail->resep_id = $request->input('snack_pagi.'.$i.'');
			    		$detail->menu_id = $menu->id;
			    		$detail->jumlah = $request->input('jumlah_sp.'.$i.'');
			    		$detail->created_by = Auth::user()->id;

			    		$detail->save();
		    		}
		    	}

		    	if(empty($request->input('id_ms')))
		    	{
		    		$delete = MenuDetail::where('menu_id',$request->input('id'))
		    							->where('waktu_makan_id','2')
		    							->get();

		    		if(!empty($delete))
		    		{
		    			$j = count($delete);
		    			for($i=0;$i<$j;$i++)
		    			{
		    				MenuDetail::destroy($delete[$i]['id']);
		    			}
		    		}
		    		if(!empty($request->input('makan_siang')))
		    		{
		    			$j = count($request->input('makan_siang'));

				    	for($i=0; $i<$j; $i++)
				    	{
				    		$detail = new MenuDetail;
				    		$detail->waktu_makan_id = 2;
				    		$detail->resep_id = $request->input('makan_siang.'.$i.'');
				    		$detail->menu_id = $menu->id;
				    		$detail->jumlah = $request->input('jumlah_ms.'.$i.'');
				    		$detail->created_by = Auth::user()->id;

				    		$detail->save();
				    	}

		    		}
		    	}
		    	else
		    	{
		    		$z = count($request->input('id_ms'));
		    		$x = count($request->input('makan_siang'));

		    		for($i=0;$i<$z;$i++)
		    		{
		    			$edit = MenuDetail::where('id',$request->input('id_ms.'.$i.''))->first();
		    			$edit->waktu_makan_id = 2;
		    			$edit->resep_id = $request->input('makan_siang.'.$i.'');
		    			$edit->menu_id = $menu->id;
		    			$edit->jumlah = $request->input('jumlah_ms.'.$i.'');
		    			$edit->created_by = Auth::user()->id;

		    			$edit->save();
		    		}
		    		for($i=$x-1;$i>=$z;$i--)
		    		{
		    			$detail = new MenuDetail;
			    		$detail->waktu_makan_id = 2;
			    		$detail->resep_id = $request->input('makan_siang.'.$i.'');
			    		$detail->menu_id = $menu->id;
			    		$detail->jumlah = $request->input('jumlah_ms.'.$i.'');
			    		$detail->created_by = Auth::user()->id;

			    		$detail->save();
		    		}
		    	}

		    	if(empty($request->input('id_msr')))
		    	{
		    		$delete = MenuDetail::where('menu_id',$request->input('id'))
		    							->where('waktu_makan_id','3')
		    							->get();

		    		if(!empty($delete))
		    		{
		    			$j = count($delete);
		    			for($i=0;$i<$j;$i++)
		    			{
		    				MenuDetail::destroy($delete[$i]['id']);
		    			}
		    		}
		    		if(!empty($request->input('makan_sore')))
		    		{
		    			$j = count($request->input('makan_sore'));

				    	for($i=0; $i<$j; $i++)
				    	{
				    		$detail = new MenuDetail;
				    		$detail->waktu_makan_id = 3;
				    		$detail->resep_id = $request->input('makan_sore.'.$i.'');
				    		$detail->menu_id = $menu->id;
				    		$detail->jumlah = $request->input('jumlah_msr.'.$i.'');
				    		$detail->created_by = Auth::user()->id;

				    		$detail->save();
				    	}

		    		}
		    	}
		    	else
		    	{
		    		$z = count($request->input('id_msr'));
		    		$x = count($request->input('makan_sore'));

		    		for($i=0;$i<$z;$i++)
		    		{
		    			$edit = MenuDetail::where('id',$request->input('id_msr.'.$i.''))->first();
		    			$edit->waktu_makan_id = 3;
		    			$edit->resep_id = $request->input('makan_sore.'.$i.'');
		    			$edit->menu_id = $menu->id;
		    			$edit->jumlah = $request->input('jumlah_msr.'.$i.'');
		    			$edit->created_by = Auth::user()->id;

		    			$edit->save();
		    		}
		    		for($i=$x-1;$i>=$z;$i--)
		    		{
		    			$detail = new MenuDetail;
			    		$detail->waktu_makan_id = 3;
			    		$detail->resep_id = $request->input('makan_sore.'.$i.'');
			    		$detail->menu_id = $menu->id;
			    		$detail->jumlah = $request->input('jumlah_msr.'.$i.'');
			    		$detail->created_by = Auth::user()->id;

			    		$detail->save();
		    		}
		    	}

		    	if(empty($request->input('id_ss')))
		    	{
		    		$delete = MenuDetail::where('menu_id',$request->input('id'))
		    							->where('waktu_makan_id','5')
		    							->get();

		    		if(!empty($delete))
		    		{
		    			$j = count($delete);
		    			for($i=0;$i<$j;$i++)
		    			{
		    				MenuDetail::destroy($delete[$i]['id']);
		    			}
		    		}
		    		if(!empty($request->input('snack_sore')))
		    		{
		    			$j = count($request->input('snack_sore'));

				    	for($i=0; $i<$j; $i++)
				    	{
				    		$detail = new MenuDetail;
				    		$detail->waktu_makan_id = 5;
				    		$detail->resep_id = $request->input('snack_sore.'.$i.'');
				    		$detail->menu_id = $menu->id;
				    		$detail->jumlah = $request->input('jumlah_ss.'.$i.'');
				    		$detail->created_by = Auth::user()->id;

				    		$detail->save();
				    	}

		    		}
		    	}
		    	else
		    	{
		    		$z = count($request->input('id_ss'));
		    		$x = count($request->input('snack_sore'));

		    		for($i=0;$i<$z;$i++)
		    		{
		    			$edit = MenuDetail::where('id',$request->input('id_ss.'.$i.''))->first();
		    			$edit->waktu_makan_id = 5;
		    			$edit->resep_id = $request->input('snack_sore.'.$i.'');
		    			$edit->menu_id = $menu->id;
		    			$edit->jumlah = $request->input('jumlah_ss.'.$i.'');
		    			$edit->created_by = Auth::user()->id;

		    			$edit->save();
		    		}
		    		for($i=$x-1;$i>=$z;$i--)
		    		{
		    			$detail = new MenuDetail;
			    		$detail->waktu_makan_id = 5;
			    		$detail->resep_id = $request->input('snack_sore.'.$i.'');
			    		$detail->menu_id = $menu->id;
			    		$detail->jumlah = $request->input('jumlah_ss.'.$i.'');
			    		$detail->created_by = Auth::user()->id;

			    		$detail->save();
		    		}
		    	}

		    	DB::connection('gizi')->commit();

		    	return redirect('/gizi/menu')
		    			->with('message','Menu berhasil diubah')
		    			->with('status', 1)
		    			->with('title', 'Sukses');	
    		}

    		else
    		{
    			$menu =  new Menu;
		    	$menu->nama = $request->input('nama_menu');
		    	$menu->kelas_id = $request->input('kelas');
		    	$menu->tanggal_periode = $request->input('tanggal_periode');
		    	$menu->created_by = Auth::user()->id;

		    	if(!empty($request->input('menu_tambahan')))
		    	{
		    		$menu->tambahan = 1;
		    	}

		    	$menu->save();

		    	if($request->input('makan_pagi.0') != 0 && !empty($request->input('makan_pagi')))
		    	{
		    		$j = count($request->input('makan_pagi'));

			    	for($i=0; $i<$j; $i++)
			    	{
			    		$detail = new MenuDetail;
			    		$detail->waktu_makan_id = 1;
			    		$detail->resep_id = $request->input('makan_pagi.'.$i.'');
			    		$detail->menu_id = $menu->id;
			    		$detail->jumlah = $request->input('jumlah_mp.'.$i.'');
			    		$detail->created_by = Auth::user()->id;

			    		$detail->save();
			    	}	
		    	}
		    	
		    	if($request->input('snack_pagi.0') != 0 && !empty($request->input('snack_pagi')))
		    	{
		    		$j = count($request->input('snack_pagi'));

			    	for($i=0; $i<$j; $i++)
			    	{
			    		$detail = new MenuDetail;
			    		$detail->waktu_makan_id = 4;
			    		$detail->resep_id = $request->input('snack_pagi.'.$i.'');
			    		$detail->menu_id = $menu->id;
			    		$detail->jumlah = $request->input('jumlah_sp.'.$i.'');
			    		$detail->created_by = Auth::user()->id;

			    		$detail->save();
			    	}	
		    	}

		    	if($request->input('makan_siang.0') != 0 && !empty($request->input('makan_siang')))
		    	{
		    		$j = count($request->input('makan_siang'));

			    	for($i=0; $i<$j; $i++)
			    	{
			    		$detail = new MenuDetail;
			    		$detail->waktu_makan_id = 2;
			    		$detail->resep_id = $request->input('makan_siang.'.$i.'');
			    		$detail->menu_id = $menu->id;
			    		$detail->jumlah = $request->input('jumlah_ms.'.$i.'');
			    		$detail->created_by = Auth::user()->id;

			    		$detail->save();
			    	}	
		    	}

		    	if($request->input('makan_sore') != 0 && !empty($request->input('makan_sore')))
		    	{
		    		$j = count($request->input('makan_sore'));

			    	for($i=0; $i<$j; $i++)
			    	{
			    		$detail = new MenuDetail;
			    		$detail->waktu_makan_id = 3;
			    		$detail->resep_id = $request->input('makan_sore.'.$i.'');
			    		$detail->menu_id = $menu->id;
			    		$detail->jumlah = $request->input('jumlah_msr.'.$i.'');
			    		$detail->created_by = Auth::user()->id;

			    		$detail->save();
			    	}	
		    	}

		    	if($request->input('snack_sore') != 0 && !empty($request->input('snack_sore')))
		    	{
		    		$j = count($request->input('snack_sore'));

			    	for($i=0; $i<$j; $i++)
			    	{
			    		$detail = new MenuDetail;
			    		$detail->waktu_makan_id = 5;
			    		$detail->resep_id = $request->input('snack_sore.'.$i.'');
			    		$detail->menu_id = $menu->id;
			    		$detail->jumlah = $request->input('jumlah_ss.'.$i.'');
			    		$detail->created_by = Auth::user()->id;

			    		$detail->save();
			    	}
		    	}
		    	
		    	DB::connection('gizi')->commit();

		    	return redirect('/gizi/menu')
		    			->with('message','Menu berhasil ditambahkan')
		    			->with('status', 1)
		    			->with('title', 'Sukses');	
	    	}
    			
    	}

    	catch(\Exception $e)
    	{
    		app('App\Http\Controllers\Error\Handler')->bugsnag($e);
    		DB::connection('gizi')->rollback();
    	}
    	
    }

    public function detail($id)
    {
    	$menu = Menu::where('id',$id)->first();
    	$mp = MenuDetail::where('menu_id',$id)
    				->where('waktu_makan_id','1')
    				->get();
    	$ms = MenuDetail::where('menu_id',$id)
    				->where('waktu_makan_id','2')
    				->get();
    	$msr = MenuDetail::where('menu_id',$id)
    				->where('waktu_makan_id','3')
    				->get();
    	$sp = MenuDetail::where('menu_id',$id)
    				->where('waktu_makan_id','4')
    				->get();
    	$ss = MenuDetail::where('menu_id',$id)
    				->where('waktu_makan_id','5')
    				->get();
    	$status = 'pengaturan';
    	return view('gizi.menu.single',['menu'=>$menu, 'mp'=>$mp, 'ms'=>$ms, 'msr'=>$msr, 'sp'=>$sp, 'ss'=>$ss, 'status'=>$status]);
    }

    public function edit($id)
    {
    	$menu = Menu::where('id',$id)->first();
    	$mp = MenuDetail::where('menu_id',$id)
    				->where('waktu_makan_id','1')
    				->get();
    	$ms = MenuDetail::where('menu_id',$id)
    				->where('waktu_makan_id','2')
    				->get();
    	$msr = MenuDetail::where('menu_id',$id)
    				->where('waktu_makan_id','3')
    				->get();
    	$sp = MenuDetail::where('menu_id',$id)
    				->where('waktu_makan_id','4')
    				->get();
    	$ss = MenuDetail::where('menu_id',$id)
    				->where('waktu_makan_id','5')
    				->get();
    	$resep = Resep::all();
    	$diet = Diet::all();
    	$kelas = Kelas::all();
    	$status = 'pengaturan';		
    	return view('gizi.menu.edit',['menu'=>$menu, 'mp'=>$mp, 'ms'=>$ms, 'msr'=>$msr, 'sp'=>$sp, 'ss'=>$ss, 
    		'resep'=>$resep, 'diet'=>$diet, 'kelas'=>$kelas, 'status'=>$status]);
    }

    public function delete($id)
    {	
    	DB::connection('gizi')->beginTransaction();

    	try
    	{
    		$delete = Menu::where('id',$id)->first();
    		
    		$delete->delete();

    		$delete_d = MenuDetail::where('menu_id',$id)
    							->select('id')
    							->get();
    		$j = count($delete_d);
    		for($i=0; $i<$j; $i++)
    		{
    			MenuDetail::destroy($delete_d[$i]['id']);
    		}

    		DB::connection('gizi')->commit();
	    	return redirect('/gizi/menu')
	    			->with('message','Menu berhasil dihapus')
	    			->with('status',1)
	    			->with('title', 'Sukses');
    	}	
    	
    	catch(\Exception $e)
    	{
    		app('App\Http\Controllers\Error\Handler')->bugsnag($e);
    		DB::connection('gizi')->rollback();
    	}

    	
    }

    // public function getAjax()
    // {
    // 	try {
    // 		$data = Menu::where('kelas_id','!=','0')->get();
    // 		return Datatables::of($history)
    //              ->editColumn('patient_id', function($history){
    //                 if($history->pasien){
    //                     $pasien_name = $history->pasien->name;
    //                     $age = $history->pasien->age;
    //                     if($history->pasien->gender == 1)
    //                         $gender = "Laki-laki";
    //                     else
    //                         $gender = "Perempuan";
    //                     // return $pasien_name;
    //                     return '<td>                            
    //                             <h5 class="py-0 my-0">'.$pasien_name.'</h5>
    //                             <div class="font-w400 font-size-sm text-muted">
    //                                  '.$gender.', 
    //                                 '.$age.' tahun</div>
    //                         </td>';
    //                 }
    //                 return '-';
    //              })
    //              ->addColumn('pasien_rm', function($history){
    //                 if($history->pasien)
    //                     return $history->pasien->no_rm;
    //                 return '-';
    //              })
    //              ->editColumn('kasus_id', function($history){
    //                 return $history->pembayaran['perusahaan']['tipe']['nama'];
    //              })
    //              ->editColumn('result_created_at', function($history){
    //                 if($history->status == -1)
    //                     $content = "Batal - ${history['alasan_batal']}";
    //                 $content = is_null($history->result_created_at) ? '-' : date('d F Y, H:i', strtotime($history->result_created_at));
    //                 $order = date('YmdHi', strtotime($history->result_created_at));
    //                 return '<td data-order="'.$order.'">'.$content.'</td>';
    //              })
    //              ->editColumn('created_at', function($history){
    //                 $content = date('d F Y, H:i', strtotime($history->created_at));
    //                 $order = date('YmdHi', strtotime($history->created_at));
    //                 return '<td data-order="'.$order.'">'.$content.'</td>';
    //              })
    //              ->editColumn('lokasi_id', function($history){
    //                 return $history->asal['nama'];
    //              })
    //              ->addColumn('layanan', function($history){
    //                 $rowText = $history->detail->reduce( function($description, $item) {
    //                     $deskripsi = (!is_null($item->tarif)) ? $item->tarif->deskripsi : ' ';
    //                     return $description .= '<li>'.$deskripsi.'</li>';
    //                 }, '<ul>');
    //                 return $rowText.'</ul>';
    //              })
    //              ->addColumn('action', function($history){
    //                 return '<a href="'.url('/labpa/transaksi/hasil/'.$history->slug).'" class="btn btn-info">Lihat Hasil</a>
    //                     ';
    //              })->escapeColumns([])
    //              ->make(true);
    // 	} catch (Exception $e) {
    		
    // 	}
    // }

}
