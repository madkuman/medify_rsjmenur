<?php

namespace App\Http\Controllers\Gizi\Pemesanan;

use App\Models\Gizi\WaktuMakan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gizi\Diet;
use App\Models\Gizi\Kelas;
use App\Models\Gizi\JenisPasien;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use App\Models\Gizi\JenisMakanan;
use App\Models\Gizi\KategoriMakanan;
use App\Models\Gizi\BentukMakanan;
use App\Models\RawatInap\Bangsal;
use DOMPDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    public function index(Request $request)
    {
        if($request->get('tanggal'))
        {
            $data['tanggal'] = $request->get('tanggal');
        }
        else
        {
            $data['tanggal'] = date('d-m-Y');
        }

        if($request->get('waktu_makan'))
        {
            $data['waktu_makan'] = $request->get('waktu_makan');
        }
        else
        {
            $data['waktu_makan'] = 1;
        }

        $data['rekap_pesanan']=app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getRekapPemesananWithTanggal($data);
        $data['status'] = 'pemesanan';
        $data['bangsal']=app('App\Http\Controllers\RawatInap\Bangsal\ReadController')->allBangsal();
        $data['option_waktu_makan'] =WaktuMakan::all();
        $data['diet'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getDiet();
        $data['jenis_makanan_utama'] = JenisMakanan::where('utama',JenisMakanan::UTAMA)->get();
        $data['jenis_makanan_tambahan'] = JenisMakanan::where('utama',JenisMakanan::TAMBAHAN)->get();
        $data['fitur_pemilihan_data_makan_gizi'] = 0;
        return view('gizi.pemesanan.index',$data);
    }

    public function monitoring(Request $request)
    {
        $status = 'monitoring';
        $query = "select * from bangsal b 
        left join (select r.bangsal_id, count(1) as bed_kosong from ruangan r, tempat_tidur t where t.ruangan_id = r.id and t.transaksi_id is null and t.booking_id is null and r.deleted_at is null and t.deleted_at is null group by r.bangsal_id) r1
        on r1.bangsal_id = b.id
        left join (select r.bangsal_id, count(1) as bed_total from ruangan r, tempat_tidur t where t.ruangan_id = r.id and r.deleted_at is null and t.deleted_at is null group by r.bangsal_id) r2
        on r2.bangsal_id = b.id
        left join (select r.bangsal_id, count(1) as pasien_total from ruangan r, tempat_tidur t where t.ruangan_id = r.id and t.transaksi_id is not null and r.deleted_at is null and t.deleted_at is null group by r.bangsal_id) r3
        on r3.bangsal_id = b.id where b.deleted_at is null;";
        $bangsals = DB::connection('rawatinap')->select($query);
        $data['bangsals'] = $bangsals;
        $tanggal = $request->tanggal;

        $data['kasus'] = Kasus::pemesananTanggal($tanggal)->get()->pluck('id')->toArray();
        //dd($data);
        $data['status'] = 'monitoring';
        // dd($data['pesanan']);
        return view('gizi.pemesanan.index',['data'=>$data, 'status'=>$status]);
    }

    public function new(Request $request)
    {
        $status = 'pemesanan';
        if ($request->get('kasus_id')) {
            $data['kasus'] = Kasus::find($request->get('kasus_id'));
        }
        $data['diet'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getDiet();
        $data['jenis_makanan_utama'] = JenisMakanan::where('utama',JenisMakanan::UTAMA)->get();
        $data['jenis_makanan_tambahan'] = JenisMakanan::where('utama',JenisMakanan::TAMBAHAN)->get();
        return view('gizi.pemesanan.create', ['data' => $data, 'status' => $status]);
    }

    public function edit($id)
    {
        $data['pesanan'] =  app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getPemesananEdit($id);
        $data['pasien'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getPasienEdit($id);
        $data['diet'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getDiet();
        $data['lokasi'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getLokasi();
        $data['pokok'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getMakananPokok();
        $data['kelas'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getKelas();
        $data['pokok_pagi'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getPokok($id,1); 
        $data['pokok_siang'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getPokok($id,2);
        $data['pokok_sore'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getPokok($id,3);
        $data['bentuk'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getBentuk(); 
        $jenis_makanan_pesan=JenisMakanan::where('nama',$data['pesanan']->catatan)->first();
        $data['jenis_makanan_pesan']=$data['pesanan']->kode_diet?$data['pesanan']->kode_diet->jenis_makanan : $jenis_makanan_pesan;
        $data['JenisMakanan'] = JenisMakanan::all();
        //$data['DietTambahan'] = DietTambahan::all();
        $data['BentukMakanan'] = BentukMakanan::all();
        $data['KategoriMakanan'] = KategoriMakanan::all();
        $status = 'pemesanan';
        return view('gizi.pemesanan.edit',['data'=>$data, 'status'=>$status]);
    }

    public function batal($id)
    {   
        $jumlah = 0;
        $data['pemesanan'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getPemesananEdit($id);
        $data['makan_pagi'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getPesananTiapWaktu($id,1);
        $data['makan_siang'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getPesananTiapWaktu($id,2);
        $data['makan_sore'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getPesananTiapWaktu($id,3);
        $data['snack_pagi'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getPesananTiapWaktu($id,4);
        $data['snack_sore'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getPesananTiapWaktu($id,5);
        
        $data['makan_pagi'] = count($data['makan_pagi']);
        if($data['makan_pagi'] > 0)
        {
            $jumlah++;
        }
        $data['makan_siang'] = count($data['makan_siang']);
        if($data['makan_siang'] > 0)
        {
            $jumlah++;
        }
        $data['makan_sore'] = count($data['makan_sore']);
        if($data['makan_sore'] > 0)
        {
            $jumlah++;
        }
        $data['snack_pagi'] = count($data['snack_pagi']);
        if($data['snack_pagi'] > 0)
        {
            $jumlah++;
        }
        $data['snack_sore'] = count($data['snack_sore']);
        if($data['snack_sore'] > 0)
        {
            $jumlah++;
        }
        //dd($jumlah);
        $status = 'pemesanan';
        return view('gizi.pemesanan.batal',['data'=>$data, 'status'=>$status, 'jumlah'=>$jumlah]);
    }

    public function single($id)
    {
        $data['pesanan'] =  app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getPemesananEdit($id);
        $data['pasien'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getPasienEdit($id);
        $data['makan_pagi'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getPesananTiapWaktu($id,1);
        $data['makan_siang'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getPesananTiapWaktu($id,2);
        $data['makan_sore'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getPesananTiapWaktu($id,3);
        $data['snack_pagi'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getPesananTiapWaktu($id,4);
        $data['snack_sore'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getPesananTiapWaktu($id,5);
        $data['alergi'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getAlergiPasien($id);
        $status = 'pemesanan';
        //dd($data);
        return view('gizi.pemesanan.single',['data'=>$data, 'status'=>$status]);
    }

    public function print_diet(Request $request)
    {
        $diet = Diet::all();
        $kelas = Kelas::orderBy('id','desc')->get();
        $temp = $kelas['4'];
        $kelas['4'] = $kelas['2'];
        $kelas['2'] = $temp;
        $date = $request->get('tanggal');

        foreach ($diet as $diet_item) 
        {
            $jumlah[$diet_item->nama]['normal'] = 0;
            $jumlah[$diet_item->nama]['tambahan'] = 0;
            for($i=1;$i<=3;$i++)
            {   
                $jumlah[$diet_item->nama][$i]['tambahan'] = 0;
                $jumlah[$diet_item->nama][$i]['normal'] = 0;
                foreach ($kelas as $kelas_item) 
                {   
                    $query[$diet_item->nama][$i][$kelas_item->nama] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')
                    ->getRekapDiet($diet_item->id,$kelas_item->id,$i,$date);

                    $jumlah[$diet_item->nama][$i]['normal'] += $query[$diet_item->nama][$i][$kelas_item->nama]['normal'];
                    
                    if(!empty($query[$diet_item->nama][$i][$kelas_item->nama]['tambahan']))
                    {
                        $jumlah[$diet_item->nama][$i]['tambahan'] += $query[$diet_item->nama][$i][$kelas_item->nama]['tambahan'];    
                    }                 
                }
                $jumlah[$diet_item->nama]['normal'] += $jumlah[$diet_item->nama][$i]['normal'];
                $jumlah[$diet_item->nama]['tambahan'] += $jumlah[$diet_item->nama][$i]['tambahan'];
            }

        }
        $flag = 0;
        //dd($query,$diet,$kelas);

        $status = 'pemesanan';
        return view('gizi.pemesanan.print-diet',['data'=>$query,'diet'=>$diet,'kelas'=>$kelas, 'jumlah'=>$jumlah, 'date'=>$date, 'flag'=>$flag, 'jp'=>1, 'status'=>$status]);
    }

    public function rekap_diet(Request $request)
    {
        //dd($request);
        ini_set('max_execution_time', 300);
        $diet = Diet::all();
        $kelas = Kelas::orderBy('id','desc')->get();
        $temp = $kelas['4'];
        $kelas['4'] = $kelas['2'];
        $kelas['2'] = $temp;
        if(empty($request->get('tanggal')))
        {
            $date = date('d F Y');
        }
        else if(!empty($request->get('tanggal')))
        {
            $date = $request->get('tanggal');
        }
        //dd($date);
        foreach ($diet as $diet_item) 
        {
            $jumlah[$diet_item->nama]['normal'] = 0;
            $jumlah[$diet_item->nama]['tambahan'] = 0;
            for($i=1;$i<=3;$i++)
            {   
                $jumlah[$diet_item->nama][$i]['tambahan'] = 0;
                $jumlah[$diet_item->nama][$i]['normal'] = 0;
                foreach ($kelas as $kelas_item) 
                {   
                    $query[$diet_item->nama][$i][$kelas_item->nama] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')
                    ->getRekapDiet($diet_item->id,$kelas_item->id,$i,$date);

                    $jumlah[$diet_item->nama][$i]['normal'] += $query[$diet_item->nama][$i][$kelas_item->nama]['normal'];
                    
                    if(!empty($query[$diet_item->nama][$i][$kelas_item->nama]['tambahan']))
                    {
                        $jumlah[$diet_item->nama][$i]['tambahan'] += $query[$diet_item->nama][$i][$kelas_item->nama]['tambahan'];    
                    }                 
                }
                $jumlah[$diet_item->nama]['normal'] += $jumlah[$diet_item->nama][$i]['normal'];
                $jumlah[$diet_item->nama]['tambahan'] += $jumlah[$diet_item->nama][$i]['tambahan'];
            }

        }
        //dd($jumlah);
        $flag = 0;
        //dd($query,$diet,$kelas);

        $status = 'pemesanan';
        return view('gizi.pemesanan.rekap-diet',['data'=>$query,'diet'=>$diet,'kelas'=>$kelas, 'jumlah'=>$jumlah, 'date'=>$date, 'flag'=>$flag, 'jp'=>1, 'status'=>$status]);
    }

    public function rekap_diet_v2(Request $request)
    {
        //dd($request);
        ini_set('max_execution_time', 300);
        $diet = Diet::all();
        $kelas = Kelas::orderBy('id','desc')->get();
        $temp = $kelas['4'];
        $kelas['4'] = $kelas['2'];
        $kelas['2'] = $temp;
        $jumlah = [];
        $kombinasi = [];
        if(empty($request->get('tanggal')))
        {
            $date = date('d F Y');
        }
        else if(!empty($request->get('tanggal')))
        {
            $date = $request->get('tanggal');
        }
        //dd($date);
        $pemesanan = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getPemesananOrderByDiet($date);
        //dd($pemesanan);
        foreach ($pemesanan as $item) 
        {   
            //$tambahan = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getDietTambahan($item->id);
            //dd($tambahan);   
            if(empty($tambahan))
            {   
                if(!in_array($item->diet->nama, $kombinasi))
                {
                    array_push($kombinasi, $item->diet->nama);    
                }
                if(empty($jumlah[$item->diet->nama]['normal']))
                {   
                    //array_push($kombinasi, $item->diet->nama);
                    $jumlah[$item->diet->nama]['normal'] = 0;    
                }
                if(empty($jumlah[$item->diet->nama]['tambahan']))
                {
                    $jumlah[$item->diet->nama]['tambahan'] = 0;
                }
                for($i=1;$i<=3;$i++)
                {   
                    $jumlah[$item->diet->nama][$i]['tambahan'] = 0;
                    $jumlah[$item->diet->nama][$i]['normal'] = 0;
                    foreach ($kelas as $kelas_item) 
                    {   
                        $query[$item->diet->nama][$i][$kelas_item->nama] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')
                        ->getRekapDiet($item->diet_id,$kelas_item->id,$i,$date);

                        $jumlah[$item->diet->nama][$i]['normal'] += $query[$item->diet->nama][$i][$kelas_item->nama]['normal'];
                        
                        if(!empty($query[$item->diet->nama][$i][$kelas_item->nama]['tambahan']))
                        {
                            $jumlah[$item->diet->nama][$i]['tambahan'] += $query[$item->diet->nama][$i][$kelas_item->nama]['tambahan'];    
                        }                 
                    }
                    $jumlah[$item->diet->nama]['normal'] += $jumlah[$item->diet->nama][$i]['normal'];
                    $jumlah[$item->diet->nama]['tambahan'] += $jumlah[$item->diet->nama][$i]['tambahan'];                    
                } 
            }
            else
            {   
                $nama = $item->diet->nama;
                //dd($nama);
                $nama .="-";
                $max = count($tambahan);
                $x = 1;
                foreach ($tambahan as $t) 
                {   
                    $nama .= $t->diet->nama;
                    if($x < $max)
                    {
                        $nama .= "-";
                    }
                    $x++;
                }
                if(!in_array($nama, $kombinasi))
                {
                    array_push($kombinasi, $nama);    
                }
                if(empty($jumlah[$nama]['normal']))
                {
                    $jumlah[$nama]['normal'] = 0;
                }
                if(empty($jumlah[$nama]['tambahan']))
                {
                    $jumlah[$nama]['tambahan'] = 0;
                }
                for($i=1;$i<=3;$i++)
                {   
                    $jumlah[$nama][$i]['tambahan'] = 0;
                    $jumlah[$nama][$i]['normal'] = 0;
                    foreach ($kelas as $kelas_item) 
                    {   
                        $query[$nama][$i][$kelas_item->nama] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')
                        ->getRekapDiet($item->diet_id,$kelas_item->id,$i,$date);

                        $jumlah[$nama][$i]['normal'] += $query[$nama][$i][$kelas_item->nama]['normal'];
                        
                        if(!empty($query[$nama][$i][$kelas_item->nama]['tambahan']))
                        {
                            $jumlah[$nama][$i]['tambahan'] += $query[$nama][$i][$kelas_item->nama]['tambahan'];    
                        }                 
                    }
                    $jumlah[$nama]['normal'] += $jumlah[$nama][$i]['normal'];
                    $jumlah[$nama]['tambahan'] += $jumlah[$nama][$i]['tambahan'];                    
                }
            }
        }
        //dd($jumlah);
        $flag = 3;
        //dd($query,$diet,$kelas);

        $status = 'pemesanan';
        return view('gizi.pemesanan.rekap-diet-v2',['data'=>$query,'diet'=>$diet,'kelas'=>$kelas, 'jumlah'=>$jumlah, 'date'=>$date, 'flag'=>$flag, 'jp'=>1, 'status'=>$status, 'kombinasi'=>$kombinasi]);
    }

    public function rekap_resep(Request $request)
    {
        ini_set('max_execution_time', 300);
        if(empty($request->get('tanggal')))
        {
            $date = date('Y-m-d');
        }
        else if(!empty($request->get('tanggal')))
        {
            $date = $request->get('tanggal');
        }

        $data = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getRekapResep($date);
        $tanggal = $date;
        $flag = 1;

        //dd($data[1]['nama']);
        $status = 'pemesanan';
        return view('gizi.pemesanan.rekap-resep',['data'=>$data, 'tanggal'=>$tanggal, 'flag'=>$flag, 'status'=>$status]);
    }

    public function print_jp(Request $request)
    {   
        ini_set('max_execution_time', 300);
        $diet = Diet::all();
        $kelas = Kelas::orderBy('id','desc')->get();
        $temp = $kelas['4'];
        $kelas['4'] = $kelas['2'];
        $kelas['2'] = $temp;
        $jp = JenisPasien::all();
        $kelas['1']->nama = 'I Utm';
        $kelas['2']->nama = 'I';
        $kelas['3']->nama = 'II';
        $kelas['4']->nama = 'III';
        //dd($kelas);
        if(empty($request->get('tanggal')))
        {
            $date = date('Y-m-d');
        }
        else if(!empty($request->get('tanggal')))
        {
            $date = $request->get('tanggal');
        }

        foreach ($diet as $diet_item) 
        {
            $jumlah[$diet_item->nama]['normal'] = 0;
            $jumlah[$diet_item->nama]['tambahan'] = 0;
            for($i=1;$i<=5;$i++)
            {   
                $jumlah[$diet_item->nama][$i]['tambahan'] = 0;
                $jumlah[$diet_item->nama][$i]['normal'] = 0;
                foreach ($kelas as $kelas_item) 
                {   
                    $query[$diet_item->nama][$i][$kelas_item->nama] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')
                    ->getRekapJp($diet_item->id,$kelas_item->id,$i,$date);

                    $jumlah[$diet_item->nama][$i]['normal'] += $query[$diet_item->nama][$i][$kelas_item->nama]['normal'];
                    
                    if(!empty($query[$diet_item->nama][$i][$kelas_item->nama]['tambahan']))
                    {
                        $jumlah[$diet_item->nama][$i]['tambahan'] += $query[$diet_item->nama][$i][$kelas_item->nama]['tambahan'];    
                    }                 
                }
                $jumlah[$diet_item->nama]['normal'] += $jumlah[$diet_item->nama][$i]['normal'];
                $jumlah[$diet_item->nama]['tambahan'] += $jumlah[$diet_item->nama][$i]['tambahan'];
            }
        }
        $flag = 2;
        $status = 'pemesanan';
        return view('gizi.pemesanan.print-jp',['data'=>$query,'diet'=>$diet,'kelas'=>$kelas, 'jumlah'=>$jumlah, 'date'=>$date, 'flag'=>$flag, 'jenis'=>$jp, 'status'=>$status]);
    }

    public function rekap_jp(Request $request)
    {
        ini_set('max_execution_time', 300);
        $diet = Diet::all();
        $kelas = Kelas::orderBy('id','desc')->get();
        $temp = $kelas['4'];
        $kelas['4'] = $kelas['2'];
        $kelas['2'] = $temp;
        $jp = JenisPasien::all();
        if(empty($request->get('tanggal')))
        {
            $date = date('Y-m-d');
        }
        else if(!empty($request->get('tanggal')))
        {
            $date = $request->get('tanggal');
        }

        foreach ($diet as $diet_item) 
        {
            $jumlah[$diet_item->nama]['normal'] = 0;
            $jumlah[$diet_item->nama]['tambahan'] = 0;
            for($i=1;$i<=5;$i++)
            {   
                $jumlah[$diet_item->nama][$i]['tambahan'] = 0;
                $jumlah[$diet_item->nama][$i]['normal'] = 0;
                foreach ($kelas as $kelas_item) 
                {   
                    $query[$diet_item->nama][$i][$kelas_item->nama] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')
                    ->getRekapJp($diet_item->id,$kelas_item->id,$i,$date);

                    $jumlah[$diet_item->nama][$i]['normal'] += $query[$diet_item->nama][$i][$kelas_item->nama]['normal'];
                    
                    if(!empty($query[$diet_item->nama][$i][$kelas_item->nama]['tambahan']))
                    {
                        $jumlah[$diet_item->nama][$i]['tambahan'] += $query[$diet_item->nama][$i][$kelas_item->nama]['tambahan'];    
                    }                 
                }
                $jumlah[$diet_item->nama]['normal'] += $jumlah[$diet_item->nama][$i]['normal'];
                $jumlah[$diet_item->nama]['tambahan'] += $jumlah[$diet_item->nama][$i]['tambahan'];
            }
        }
        $flag = 2;
        $status = 'pemesanan';
        return view('gizi.pemesanan.rekap-jp',['data'=>$query,'diet'=>$diet,'kelas'=>$kelas, 'jumlah'=>$jumlah, 'date'=>$date, 'flag'=>$flag, 'jenis'=>$jp, 'status'=>$status]);
    }

    public function print_label(Request $request)
    {
        ini_set("max_execution_time", "10000");
        ini_set("pcre.backtrack_limit", "5000000");
        $start = Carbon::parse($request->tanggal_print_label)->startOfDay();
        $end = Carbon::parse($request->tanggal_print_label)->endOfDay();
        $data['result'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getLabelMakanan($start,$end,$request->bangsal_id,$request->waktu_makan_id);
        $data['waktu_makan_id']=$request->waktu_makan_id;
        $data['tanggal'] = indonesian_date(strtotime($start),'d F Y');
        $data['qc']=Auth::user()->name;
        $data['status'] = 'pemesanan';
        $pdf = DOMPDF::loadView('gizi.pemesanan.print-label', $data);
        return $pdf->stream('Label Pemesanan.pdf');
    }
}
