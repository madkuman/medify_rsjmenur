<?php

namespace App\Http\Controllers\Gizi\Import;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gizi\BahanMakanan;
use App\Models\Gizi\BahanMakananLog;
use App\Models\Gizi\Belanja;
use App\Models\Gizi\BelanjaDetail;
use App\Models\Gizi\BentukMakanan;
use App\Models\Gizi\BentukMakananPemesanan;
use App\Models\Gizi\Diet;
use App\Models\Gizi\DietKode;
use App\Models\Gizi\DietProduksi;
use App\Models\Gizi\DietTambahan;
use App\Models\Gizi\DietTambahanPemesanan;
use App\Models\Gizi\JenisBahan;
use App\Models\Gizi\JenisMakanan;
use App\Models\Gizi\JenisPasien;
use App\Models\Gizi\KategoriMakanan;
use App\Models\Gizi\Kelas;
use App\Models\Gizi\Menu;
use App\Models\Gizi\MenuDetail;
use App\Models\Gizi\Pemesanan;
use App\Models\Gizi\PemesananDetail;
use App\Models\Gizi\Produksi;
use App\Models\Gizi\ProduksiBahan;
use App\Models\Gizi\Resep;
use App\Models\Gizi\ResepDetail;
use App\Models\Gizi\ProduksiDetail;
use App\Models\Gizi\ProduksiMakanan;
use App\Models\Gizi\PivotDiet;
use Carbon\Carbon;
use DB;
use Auth;
class ImportController extends Controller
{
    public function importMenu() //lauk
    {   
        ini_set('max_execution_time', 0);
        $i = 7;
        while($i<=61)
        {   
            $file = fopen("laporan_diet_new.csv","r");
            while(!feof($file))
            {   
                $data = fgetcsv($file);
                if($data[4] != 10)
                    continue;
                if($data[3] == 'Lauk')
                {
                    $kelas = [];
                    $nama = [];
                    if($i==7)
                    {
                        $nama_kelas = 'NB';
                    }
                    else if($i==12)
                    {   
                        $nama_kelas = 'LB';
                        //dd($nama_kelas,$i);
                    }
                    else if($i==17)
                    {
                        $nama_kelas = 'RG';
                    }
                    else if($i==22)
                    {
                        $nama_kelas = 'RP';
                    }
                    else if($i==27)
                    {
                        $nama_kelas = 'BT';
                    }
                    else if($i==32)
                    {
                        $nama_kelas = 'LC';
                    }
                    else if($i==37)
                    {
                        $nama_kelas = 'Pantang LC';
                    }
                    else if($i==42)
                    {
                        $nama_kelas = 'Pantang';
                    }
                    else if($i==47)
                    {
                        $nama_kelas = 'Bursum';
                    }
                    else if($i==52)
                    {
                        $nama_kelas = 'Burcap';
                    }
                    else if($i==57)
                    {
                        $nama_kelas = 'Nasi Tim Saring';
                    }
                    $nama[1] = 'Lauk '.$nama_kelas.' - Kelas 1';
                    $nama[2] = 'Lauk '.$nama_kelas.' - Kelas 2';
                    $nama[3] = 'Lauk '.$nama_kelas.' - Kelas 3';
                    $nama[4] = 'Lauk '.$nama_kelas.' - Kelas 1 Utama';
                    $nama[5] = 'Lauk '.$nama_kelas.' - Kelas VIP';

                    if($data[$i] == 1)
                    {
                        $kelas[5] = 1;
                    }
                    else
                    {
                        $kelas[5] = 0;
                    }
                    if($data[$i+1] == 1)
                    {
                        $kelas[4] = 1;
                    }
                    else
                    {
                        $kelas[4] = 0;
                    }
                    if($data[$i+2] == 1)
                    {
                        $kelas[3] = 1;
                    }
                    else
                    {
                        $kelas[3] = 0;
                    }
                    if($data[$i+3] == 1)
                    {
                        $kelas[2] = 1;
                    }
                    else
                    {
                        $kelas[2] = 0;
                    }
                    if($data[$i+4] == 1)
                    {
                        $kelas[1] = 1;
                    }
                    else
                    {
                        $kelas[1] = 0;
                    }
                    //dd($kelas);
                    for($j=1;$j<=5;$j++)
                    {
                        if($kelas[$j] == 1)
                        {   
                            $menu_sebelum = Menu::where('nama',$nama[$j])->where('kelas_id',$j)
                                            ->where('tanggal_periode',$data[4])->first();   
                            if(!empty($menu_sebelum))
                            {
                                continue;
                            }
                            else
                            {
                                $menu = new Menu;
                                $menu->nama = $nama[$j];
                                $menu->kelas_id = $j;
                                $menu->tanggal_periode = $data[4];
                                $menu->tambahan = $data[6];
                                $menu->save();
                            }
                        }
                    }
                }
                else
                {
                    continue;
                }
            }
            fclose($file);
            $i += 5;
        }
    	return json_encode('succes');
    }

    public function hapusMenuDetail() //hapus menu detail dari periode tertentu
    {
        DB::connection('gizi')->beginTransaction();
        ini_set('max_execution_time', 0);
        try {

            $menu = Menu::where('tanggal_periode',10)->pluck('id')->toArray();
            $detail = MenuDetail::whereIn('menu_id',$menu)->get();
            foreach ($detail as $item) 
            {
                $item->delete();
            }
            DB::connection('gizi')->commit();
            return json_encode('done');            
        } catch (Exception $e) {
            DB::connection('gizi')->rollBack();
            dd($e);
        }
        // dd($detail);
        

    }

    public function importMenuDetail() //import menu detail lauk
    {   
        ini_set('max_execution_time', 0);
    	$menu = Menu::where('tanggal_periode',11)->where('nama','like','Lauk%')->get();
        // dd($menu);
        $resep_kosong = [];
    	$count = 0;
        foreach ($menu as $item) 
    	{   
            // dd($item);
            $count++;
            $temp_nama = explode(' ',$item->nama);
            // dd($temp_nama);
            if($temp_nama[1] == 'NB')
            {
                $num = 7;
            }
            else if($temp_nama[1] == 'LB')
            {
                $num = 12;
            }
            else if($temp_nama[1] == 'RG')
            {
                $num = 17;
            }
            else if($temp_nama[1] == 'RP')
            {
                $num = 22;
            }
            else if($temp_nama[1] == 'BT')
            {
                $num = 27;
            }
            else if($temp_nama[1] == 'LC')
            {
                $num = 32;
            }
            else if($temp_nama[1] == 'Pantang' && $temp_nama[2] == 'LC')
            {
                $num = 37;
            }
            else if($temp_nama[1] == 'Pantang')
            {
                $num = 42;
            }
            else if($temp_nama[1] == 'Bursum')
            {
                $num = 47;
            }
            else if($temp_nama[1] == 'Burcap')
            {
                $num = 52;
            }
            else if($temp_nama[1] == 'Nasi')
            {
                $num = 57;
            }
            $file = fopen("laporan_diet_new.csv","r");
    		while(!feof($file))
    		{	
    			$data = fgetcsv($file);
    			$kelas = [];
    			if($data[$num] == 1)
	    		{
	    			$kelas[5] = 1;
	    		}
	    		else
	    		{
	    			$kelas[5] = 0;
	    		}
	    		if($data[$num+1] == 1)
	    		{
	    			$kelas[4] = 1;
	    		}
	    		else
	    		{
	    			$kelas[4] = 0;
	    		}
	    		if($data[$num+2] == 1)
	    		{
	    			$kelas[3] = 1;
	    		}
	    		else
	    		{
	    			$kelas[3] = 0;
	    		}
	    		if($data[$num+3] == 1)
	    		{
	    			$kelas[2] = 1;
	    		}
	    		else
	    		{
	    			$kelas[2] = 0;
	    		}
	    		if($data[$num+4] == 1)
	    		{
	    			$kelas[1] = 1;
	    		}
	    		else
	    		{
	    			$kelas[1] = 0;
	    		}
                // dd($data[4]);
    			if($data[4] == $item->tanggal_periode)
    			{
    				if($kelas[$item->kelas_id] == 1)
    				{   
                        // dd($data[1]);
    					$menuDetail = new MenuDetail;
                        if($data[1] == 'Pembuka Pagi' || $data[1] == 'Pembuka pagi')
                        {
                            $waktu = 1;
                            //dd($waktu);
                        }
                        else if($data[1] == 'Pembuka Siang' || $data[1] == 'Pembuka siang')
                        {
                            $waktu = 2;
                        }
                        else if($data[1] == 'Pembuka Malam' || $data[1] == 'Pembuka malan') 
                        {
                            $waktu = 3;
                        }
                        else if($data[1] == 'Snack Pagi' || $data[1] == 'Snack pagi')
                        {
                            $waktu = 4;
                        }

                        else if($data[1] == 'Snack Sore' || $data[1] == 'Snack sore')
                        {
                            $waktu = 5;
                        }
    					$menuDetail->waktu_makan_id = $waktu;
    					$menuDetail->menu_id = $item->id;
    					$menuDetail->jumlah = 1;
    					$resep = Resep::where('nama',$data[2])->first();
                        if(empty($resep))
                        {
                            $menuDetail->resep_id = null;
                            $resep_kosong[$data[2]] = 'kosong';
                        }
                        else
                        {
                            $menuDetail->resep_id = $resep->id;
                        }
                        // dd($menuDetail);
    					$menuDetail->save();
    				}
    			}
    		}
            fclose($file);
    	}
        dd($resep_kosong,$count);
    	return json_encode('succes');
    }

    public function gantiNama()
    {
        $menu = Menu::where('tanggal_periode',10)->get();
        foreach ($menu as $key => $value) 
        {
            $nama = $value->nama;
            $temp = explode('Menu ',$nama);
            // dd($temp);
            $nama_baru = 'Lauk '.$temp[1];
            // dd($nama_baru);
            $value->nama = $nama_baru;
            $value->save();
        }
        dd('success');
    }
    // hapus makanan pokok
    public function hapusPokok()
    {   
        DB::connection('gizi')->beginTransaction();
        try {
            $file = fopen("menu_terbaru_22_mei.csv","r");
            while(!feof($file))
            {
                $data = fgetcsv($file);
                if($data[3] == "Makanan Pokok")
                {
                    $nama_resep = $data[2];
                    // dd($nama_resep);
                    $menu = Menu::where('tanggal_periode',10)->pluck('id')->toArray();
                    $resep = Resep::where('nama',$nama_resep)->first();
                    // dd($resep);
                    $detail = MenuDetail::where('resep_id',$resep->id)->whereIn('menu_id',$menu)->get();
                    dd($detail);
                    foreach ($detail as $item) 
                    {
                        $item->delete();
                    }
                }   
            }
            fclose($file);
            DB::connection('gizi')->commit();
            dd('success');   
        } catch (Exception $e) {
            DB::connection('gizi')->rollBack();
            dd($e);
        }
    }

    public function insertResepDetail() // memasukan detail resep, file excel menu_terbaru_22_mei
    {   
        ini_set('max_execution_time', 0);
        $file = fopen('menu_terbaru_22_mei.csv','r');
        $resep_kosong = [];
        $bahan_kosong = [];
        $i = 1;
        while(!feof($file))
        {
            $data = fgetcsv($file);
            // dd($data[0]);
            $resep = Resep::where('nama',$data[0])->first();
            if(empty($resep))
            {
                array_push($resep_kosong,$data[0].' '.$i);
                $i++;
                continue;
            }
            $bahan_makanan = BahanMakanan::where('nama',$data[1])->first();
            if(empty($bahan_makanan))
            {
                array_push($bahan_kosong,$data[1].' '.$i);
                $i++;
                continue;
            }
            $resep_detail = new ResepDetail;
            $resep_detail->bahan_makanan_id = $bahan_makanan->id;
            $resep_detail->jumlah_bb = $data[3];
            $resep_detail->jumlah_bk = $data[4];
            $resep_detail->resep_id = $resep->id;
            $resep_detail->save();
            $i++;
            // if($i == 50)
            // {
            //     break;
            // } 
        }
        fclose($file);
        dd($bahan_kosong,$resep_kosong);
    }

    public function importMenuPokok() //import makanan pokok
    {   
        ini_set('max_execution_time', 0);
        $i = 7;
        while($i<=61)
        {   
            $file = fopen("menu_periode_10.csv","r");
            while(!feof($file))
            {
                $data = fgetcsv($file);
                if($data[3] == 'Makanan Pokok')
                {   
                    // dd('masuk');
                    $kelas = [];
                    $nama = [];
                    if($i==7)
                    {
                        $nama_kelas = 'NB';
                    }
                    else if($i==12)
                    {   
                        $nama_kelas = 'LB';
                        //dd($nama_kelas,$i);
                    }
                    else if($i==17)
                    {
                        $nama_kelas = 'RG';
                    }
                    else if($i==22)
                    {
                        $nama_kelas = 'RP';
                    }
                    else if($i==27)
                    {
                        $nama_kelas = 'BT';
                    }
                    else if($i==32)
                    {
                        $nama_kelas = 'LC';
                    }
                    else if($i==37)
                    {
                        $nama_kelas = 'Pantang LC';
                    }
                    else if($i==42)
                    {
                        $nama_kelas = 'Pantang';
                    }
                    else if($i==47)
                    {
                        $nama_kelas = 'Bursum';
                    }
                    else if($i==52)
                    {
                        $nama_kelas = 'Burcap';
                    }
                    else if($i==57)
                    {
                        $nama_kelas = 'Nasi Tim Saring';
                    }
                    $nama[1] = 'Makanan Pokok '.$nama_kelas.' - Kelas 1';
                    $nama[2] = 'Makanan Pokok '.$nama_kelas.' - Kelas 2';
                    $nama[3] = 'Makanan Pokok '.$nama_kelas.' - Kelas 3';
                    $nama[4] = 'Makanan Pokok '.$nama_kelas.' - Kelas 1 Utama';
                    $nama[5] = 'Makanan Pokok '.$nama_kelas.' - Kelas VIP';

                    if($data[$i] == 1)
                    {
                        $kelas[5] = 1;
                    }
                    else
                    {
                        $kelas[5] = 0;
                    }
                    if($data[$i+1] == 1)
                    {
                        $kelas[4] = 1;
                    }
                    else
                    {
                        $kelas[4] = 0;
                    }
                    if($data[$i+2] == 1)
                    {
                        $kelas[3] = 1;
                    }
                    else
                    {
                        $kelas[3] = 0;
                    }
                    if($data[$i+3] == 1)
                    {
                        $kelas[2] = 1;
                    }
                    else
                    {
                        $kelas[2] = 0;
                    }
                    if($data[$i+4] == 1)
                    {
                        $kelas[1] = 1;
                    }
                    else
                    {
                        $kelas[1] = 0;
                    }
                    //dd($kelas);
                    for($j=1;$j<=5;$j++)
                    {
                        if($kelas[$j] == 1)
                        {   
                            $menu_sebelum = Menu::where('nama',$nama[$j])->where('kelas_id',$j)
                                            ->where('tanggal_periode',$data[4])->first();   
                            if(!empty($menu_sebelum))
                            {   
                                // dd($menu_sebelum);
                                continue;
                            }
                            else
                            {
                                $menu = new Menu;
                                $menu->nama = $nama[$j];
                                $menu->kelas_id = $j;
                                $menu->tanggal_periode = $data[4];
                                $menu->tambahan = $data[6];
                                $menu->save();
                            }
                        }
                    }
                }
            }
            fclose($file);
            $i += 5;
        }
        dd('success');
        return json_encode('succes');
    }

    public function importMenuSnack() // menu snack
    {   
        ini_set('max_execution_time', 0);
        $i = 7;
        while($i<=61)
        {   
            $file = fopen("menu_periode_10.csv","r");
            while(!feof($file))
            {
                $data = fgetcsv($file);
                if($data[3] == 'Snack')
                {
                    $kelas = [];
                    $nama = [];
                    if($i==7)
                    {
                        $nama_kelas = 'NB';
                    }
                    else if($i==12)
                    {   
                        $nama_kelas = 'LB';
                        //dd($nama_kelas,$i);
                    }
                    else if($i==17)
                    {
                        $nama_kelas = 'RG';
                    }
                    else if($i==22)
                    {
                        $nama_kelas = 'RP';
                    }
                    else if($i==27)
                    {
                        $nama_kelas = 'BT';
                    }
                    else if($i==32)
                    {
                        $nama_kelas = 'LC';
                    }
                    else if($i==37)
                    {
                        $nama_kelas = 'Pantang LC';
                    }
                    else if($i==42)
                    {
                        $nama_kelas = 'Pantang';
                    }
                    else if($i==47)
                    {
                        $nama_kelas = 'Bursum';
                    }
                    else if($i==52)
                    {
                        $nama_kelas = 'Burcap';
                    }
                    else if($i==57)
                    {
                        $nama_kelas = 'Nasi Tim Saring';
                    }
                    $nama[1] = 'Snack '.$nama_kelas.' - Kelas 1';
                    $nama[2] = 'Snack '.$nama_kelas.' - Kelas 2';
                    $nama[3] = 'Snack '.$nama_kelas.' - Kelas 3';
                    $nama[4] = 'Snack '.$nama_kelas.' - Kelas 1 Utama';
                    $nama[5] = 'Snack '.$nama_kelas.' - Kelas VIP';

                    if($data[$i] == 1)
                    {
                        $kelas[5] = 1;
                    }
                    else
                    {
                        $kelas[5] = 0;
                    }
                    if($data[$i+1] == 1)
                    {
                        $kelas[4] = 1;
                    }
                    else
                    {
                        $kelas[4] = 0;
                    }
                    if($data[$i+2] == 1)
                    {
                        $kelas[3] = 1;
                    }
                    else
                    {
                        $kelas[3] = 0;
                    }
                    if($data[$i+3] == 1)
                    {
                        $kelas[2] = 1;
                    }
                    else
                    {
                        $kelas[2] = 0;
                    }
                    if($data[$i+4] == 1)
                    {
                        $kelas[1] = 1;
                    }
                    else
                    {
                        $kelas[1] = 0;
                    }
                    //dd($kelas);
                    for($j=1;$j<=5;$j++)
                    {
                        if($kelas[$j] == 1)
                        {   
                            $menu_sebelum = Menu::where('nama',$nama[$j])->where('kelas_id',$j)
                                            ->where('tanggal_periode',$data[4])->first();   
                            if(!empty($menu_sebelum))
                            {
                                continue;
                            }
                            else
                            {
                                $menu = new Menu;
                                $menu->nama = $nama[$j];
                                $menu->kelas_id = $j;
                                $menu->tanggal_periode = $data[4];
                                $menu->tambahan = $data[6];
                                $menu->save();
                            }
                        }
                    }
                }
                else
                {
                    continue;
                }
            }
            fclose($file);
            $i += 5;
        }
        dd('success');
        return json_encode('succes');
    } 

    public function importMenuDetailPokok() // menu detail pokok
    {   
        ini_set('max_execution_time', 0);
        $menu = Menu::where('nama','like','Makanan Pokok%')->where('tanggal_periode',10)->get();
        // dd($menu);
        $resep_kosong = [];
        $count = 0;
        foreach ($menu as $item) 
        {   
            $count++;
            $temp_nama = explode(' ',$item->nama);
            // dd($temp_nama);
            if($temp_nama[2] == 'NB')
            {
                $num = 7;
            }
            else if($temp_nama[2] == 'LB')
            {
                $num = 12;
            }
            else if($temp_nama[2] == 'RG')
            {
                $num = 17;
            }
            else if($temp_nama[2] == 'RP')
            {
                $num = 22;
            }
            else if($temp_nama[2] == 'BT')
            {
                $num = 27;
            }
            else if($temp_nama[2] == 'LC')
            {
                $num = 32;
            }
            else if($temp_nama[2] == 'Pantang' && $temp_nama[2] == 'LC')
            {
                $num = 37;
            }
            else if($temp_nama[2] == 'Pantang')
            {
                $num = 42;
            }
            else if($temp_nama[2] == 'Bursum')
            {
                $num = 47;
            }
            else if($temp_nama[2] == 'Burcap')
            {
                $num = 52;
            }
            else if($temp_nama[2] == 'Nasi')
            {
                $num = 57;
            }
            $file = fopen("giziNoHeader.csv","r");
            while(!feof($file))
            {   
                $data = fgetcsv($file);
                if($data[3] == 'Makanan Pokok')
                {   
                    // dd($item,$data[2]);
                    $kelas = [];
                    if($data[$num] == 1)
                    {
                        $kelas[5] = 1;
                    }
                    else
                    {
                        $kelas[5] = 0;
                    }
                    if($data[$num+1] == 1)
                    {
                        $kelas[4] = 1;
                    }
                    else
                    {
                        $kelas[4] = 0;
                    }
                    if($data[$num+2] == 1)
                    {
                        $kelas[3] = 1;
                    }
                    else
                    {
                        $kelas[3] = 0;
                    }
                    if($data[$num+3] == 1)
                    {
                        $kelas[2] = 1;
                    }
                    else
                    {
                        $kelas[2] = 0;
                    }
                    if($data[$num+4] == 1)
                    {
                        $kelas[1] = 1;
                    }
                    else
                    {
                        $kelas[1] = 0;
                    }
                    if($data[4] == $item->tanggal_periode)
                    {
                        if($kelas[$item->kelas_id] == 1)
                        {   
                            //dd($data[1]);
                            $menuDetail = new MenuDetail;
                            if($data[1] == 'Pembuka Pagi' || $data[1] == 'Pembuka pagi')
                            {
                                $waktu = 1;
                                //dd($waktu);
                            }
                            else if($data[1] == 'Pembuka Siang' || $data[1] == 'Pembuka siang')
                            {
                                $waktu = 2;
                            }
                            else if($data[1] == 'Pembuka Malam' || $data[1] == 'Pembuka malan') 
                            {
                                $waktu = 3;
                            }
                            else if($data[1] == 'Snack Pagi' || $data[1] == 'Snack pagi')
                            {
                                $waktu = 4;
                            }

                            else if($data[1] == 'Snack Sore' || $data[1] == 'Snack sore')
                            {
                                $waktu = 5;
                            }
                            $menuDetail->waktu_makan_id = $waktu;
                            $menuDetail->menu_id = $item->id;
                            $menuDetail->jumlah = 1;
                            $resep = Resep::where('nama',$data[2])->first();
                            if(empty($resep))
                            {
                                $menuDetail->resep_id = null;
                                $resep_kosong[$data[2]] = 'kosong';
                            }
                            else
                            {
                                $menuDetail->resep_id = $resep->id;
                            }
                            $menuDetail->save();
                        }
                    }
                }
                
            }
            fclose($file);
        }
        dd($resep_kosong,$count);
        return json_encode('succes');
    }

    public function importMenuDetailSnack() // menu detail snack
    {   
        ini_set('max_execution_time', 0);
        $menu = Menu::where('nama','like','Snack%')->where('tanggal_periode',10)->get();
        // dd($menu);
        $resep_kosong = [];
        $count = 0;
        foreach ($menu as $item) 
        {   
            $count++;
            $temp_nama = explode(' ',$item->nama);
            // dd($temp_nama);
            if($temp_nama[1] == 'NB')
            {
                $num = 7;
            }
            else if($temp_nama[1] == 'LB')
            {
                $num = 12;
            }
            else if($temp_nama[1] == 'RG')
            {
                $num = 17;
            }
            else if($temp_nama[1] == 'RP')
            {
                $num = 22;
            }
            else if($temp_nama[1] == 'BT')
            {
                $num = 27;
            }
            else if($temp_nama[1] == 'LC')
            {
                $num = 32;
            }
            else if($temp_nama[1] == 'Pantang' && $temp_nama[1] == 'LC')
            {
                $num = 37;
            }
            else if($temp_nama[1] == 'Pantang')
            {
                $num = 42;
            }
            else if($temp_nama[1] == 'Bursum')
            {
                $num = 47;
            }
            else if($temp_nama[1] == 'Burcap')
            {
                $num = 52;
            }
            else if($temp_nama[1] == 'Nasi')
            {
                $num = 57;
            }
            $file = fopen("giziNoHeader.csv","r");
            while(!feof($file))
            {   
                $data = fgetcsv($file);
                if($data[3] == 'Snack')
                {   
                    // dd($item,$data[2]);
                    $kelas = [];
                    if($data[$num] == 1)
                    {
                        $kelas[5] = 1;
                    }
                    else
                    {
                        $kelas[5] = 0;
                    }
                    if($data[$num+1] == 1)
                    {
                        $kelas[4] = 1;
                    }
                    else
                    {
                        $kelas[4] = 0;
                    }
                    if($data[$num+2] == 1)
                    {
                        $kelas[3] = 1;
                    }
                    else
                    {
                        $kelas[3] = 0;
                    }
                    if($data[$num+3] == 1)
                    {
                        $kelas[2] = 1;
                    }
                    else
                    {
                        $kelas[2] = 0;
                    }
                    if($data[$num+4] == 1)
                    {
                        $kelas[1] = 1;
                    }
                    else
                    {
                        $kelas[1] = 0;
                    }
                    if($data[4] == $item->tanggal_periode)
                    {
                        if($kelas[$item->kelas_id] == 1)
                        {   
                            //dd($data[1]);
                            $menuDetail = new MenuDetail;
                            if($data[1] == 'Pembuka Pagi' || $data[1] == 'Pembuka pagi')
                            {
                                $waktu = 1;
                                //dd($waktu);
                            }
                            else if($data[1] == 'Pembuka Siang' || $data[1] == 'Pembuka siang')
                            {
                                $waktu = 2;
                            }
                            else if($data[1] == 'Pembuka Malam' || $data[1] == 'Pembuka malan') 
                            {
                                $waktu = 3;
                            }
                            else if($data[1] == 'Snack Pagi' || $data[1] == 'Snack pagi')
                            {
                                $waktu = 4;
                            }

                            else if($data[1] == 'Snack Sore' || $data[1] == 'Snack sore')
                            {
                                $waktu = 5;
                            }
                            $menuDetail->waktu_makan_id = $waktu;
                            $menuDetail->menu_id = $item->id;
                            $menuDetail->jumlah = 1;
                            $resep = Resep::where('nama',$data[2])->first();
                            if(empty($resep))
                            {
                                $menuDetail->resep_id = null;
                                $resep_kosong[$data[2]] = 'kosong';
                            }
                            else
                            {
                                $menuDetail->resep_id = $resep->id;
                            }
                            $menuDetail->save();
                        }
                    }
                }
                
            }
            fclose($file);
        }
        dd($resep_kosong,$count);
        return json_encode('succes');
    }

    public function importPivotMakananPokok() // import pivot 
    {   
        ini_set('max_execution_time', 0);
        
        $row = 0;
        $file = fopen("diet_kode.csv","r");
        $nama_beda = [];
        $nama_sudah = [];
        while(!feof($file))
        {
            $data = fgetcsv($file);
            // $line = count($data);
            if($row < 3)
            {
                $row++;
                continue;
            }
            for($i=1;$i<7;$i++)
            {
                if($i == 1) // nasi;
                {   
                    if($data[$i] == 1)
                    {   
                        if(!in_array($data[0],$nama_sudah))
                        {
                            $result = $this->pivotMakananPokok('nasi',$data[0],$nama_beda,'Makanan Pokok');
                            if($result != 1)
                            {
                                array_push($nama_beda,$result);
                                dd($nama_beda);
                            }
                            array_push($nama_sudah,$data[0]);    
                        }
                    }
                }
                else if($i == 2) // tim;
                {   
                    if($data[$i] == 1)
                    {   
                        if(!in_array($data[0],$nama_sudah))
                        {
                            $result = $this->pivotMakananPokok('tim',$data[0],$nama_beda,'Makanan Pokok');
                            if($result != 1)
                            {
                                array_push($nama_beda,$result);
                                dd($nama_beda);
                            }
                            array_push($nama_sudah,$data[0]);    
                        }
                    }
                }
                else if($i == 3) // bubur;
                {   
                    if($data[$i] == 1)
                    {   
                        if(!in_array($data[0],$nama_sudah))
                        {
                            $result = $this->pivotMakananPokok('bubur',$data[0],$nama_beda,'Makanan Pokok');
                            if($result != 1)
                            {
                                array_push($nama_beda,$result);
                                dd($nama_beda);
                            }
                            array_push($nama_sudah,$data[0]);    
                        }
                    }
                }
                else if($i == 4) // bubur-rg;
                {   
                    if($data[$i] == 1)
                    {   
                        if(!in_array($data[0],$nama_sudah))
                        {
                            $result = $this->pivotMakananPokok('bubur-rg',$data[0],$nama_beda,'Makanan Pokok');
                            if($result != 1)
                            {
                                array_push($nama_beda,$result);
                                dd($nama_beda);
                            }
                            array_push($nama_sudah,$data[0]);    
                        }
                    }
                }
                else if($i == 5) // BT;
                {   
                    if($data[$i] == 1)
                    {   
                        if(!in_array($data[0],$nama_sudah))
                        {
                            $result = $this->pivotMakananPokok('BT',$data[0],$nama_beda,'Makanan Pokok');
                            if($result != 1)
                            {
                                array_push($nama_beda,$result);
                                dd($nama_beda);
                            }
                            array_push($nama_sudah,$data[0]);    
                        }
                    }
                }
                else if($i == 6) // roti;
                {   
                    if($data[$i] == 1)
                    {   
                        if(!in_array($data[0],$nama_sudah))
                        {
                            $result = $this->pivotMakananPokok('roti',$data[0],$nama_beda,'Makanan Pokok');
                            if($result != 1)
                            {
                                array_push($nama_beda,$result);
                                dd($nama_beda);
                            }
                            array_push($nama_sudah,$data[0]);    
                        }
                    }
                }
            }
        }            
        fclose($file);

        // $all_produksi = PivotDiet::select('diet_kode_id','nama')->orderBY('diet_kode_id','ASC')->get()->toArray();
        // $max = 727;
        // array_splice($all_produksi,0,3);
        // // dd($all_produksi);
        // $belum_masuk = [];
        // $check = 1;
        // for($i=0;$i<count($all_produksi);$i++)
        // {   
        //     while($all_produksi[$i]['diet_kode_id'] != $check)
        //     {
        //         array_push($belum_masuk,$check);
        //         $check++;
        //     }
        //     if($all_produksi[$i]['diet_kode_id'] == $check)
        //     {
        //         $check++;
        //     }
        // }        
        // // dd($all_produksi[0]['diet_kode_id']);
        // dd($nama_beda,$belum_masuk);
        return json_encode('succes');
    }

    private function pivotMakananPokok($nama_makanan_pokok,$nama_diet_kode,$nama_beda,$jenis=null)
    {
        $diet_kode = DietKode::where('nama',$nama_diet_kode)->get();
        // dd($diet_kode,$nama_diet_kode);
        if(empty($diet_kode))
        {
            return $nama_diet_kode;
        }
        else
        {   
            foreach ($diet_kode as $item) 
            {
                $diet_produksi = DietProduksi::where('jenis',$jenis)->where('nama',$nama_makanan_pokok)->first();
                if(empty($diet_produksi)) dd($diet_produksi,$item,$nama_diet_kode,$nama_makanan_pokok);
                $new_pivot = new PivotDiet;
                $new_pivot->diet_kode_id = $item->id;
                $new_pivot->diet_produksi_id = $diet_produksi->id;
                $new_pivot->save();
            }
            return 1;
        }
    }

    public function importPivotLauk()
    {   
        ini_set('max_execution_time', 0);
        try {
            DB::connection('gizi')->beginTransaction();
            $row = 0;
            $file = fopen("diet_kode.csv","r");
            $nama_beda = [];
            $nama_sudah = [];
            $nama_lauk = [];
            while(!feof($file))
            {
                $data = fgetcsv($file);
                // $line = count($data);
                if($row < 2)
                {
                    $row++;
                    continue;
                }
                if($row == 2)
                {
                    for($i=20;$i<=28;$i++)
                    {
                        $nama_lauk[$i] = $data[$i];
                    }
                    $row++;
                    continue;
                }
                for($i=20;$i<=28;$i++)
                {   
                    if($data[$i] == 1)
                    {   
                        if(!in_array($data[0],$nama_sudah))
                        {
                            $result = $this->pivotMakananPokok($nama_lauk[$i],$data[0],$nama_beda,'Lauk');
                            if($result != 1)
                            {
                                array_push($nama_beda,$result);
                            }
                            array_push($nama_sudah,$data[0]);    
                        }
                    }
                }
            }            
            fclose($file);
            // $all_produksi = PivotDiet::select('diet_kode_id')->orderBY('diet_kode_id','ASC')->get()->toArray();
            // $max = 727;
            // // array_splice($all_produksi,0,3);
            // // dd($all_produksi);
            // $belum_masuk = [];
            // $check = 1;
            // for($i=0;$i<count($all_produksi);$i++)
            // {   
            //     while($all_produksi[$i]['diet_kode_id'] != $check)
            //     {
            //         array_push($belum_masuk,$check);
            //         $check++;
            //     }
            //     if($all_produksi[$i]['diet_kode_id'] == $check)
            //     {
            //         $check++;
            //     }
            // }        
            // dd($all_produksi[0]['diet_kode_id']);
            DB::connection('gizi')->commit();
            dd($nama_beda,$belum_masuk);
            // dd($nama_beda);
            return json_encode('succes');
        } catch (Exception $e) {
            DB::connection('gizi')->rollBack();
            dd($e);
        }
        
    }

    public function importPivotKurang()
    {   
        ini_set('max_execution_time', 0);
        
        $row = 0;
        $file = fopen("kode_yang_kurang.csv","r");
        while(!feof($file))
        {
            $data = fgetcsv($file);
            // $line = count($data);
            $this->pivotDietKurang($data[0],$data[1]);
            $this->pivotDietKurang($data[0],$data[2]);
        }
        return json_encode('succes');
    }
    private function pivotDietKurang($diet_kode_id,$diet_produksi_id)
    {
        $pivot = new PivotDiet;
        $pivot->diet_kode_id = $diet_kode_id;
        $pivot->diet_produksi_id = $diet_produksi_id;
        $pivot->save();

        return;
    }

    public function mappingPivotDietMenu()//mapping dari pivot ke menu
    {
        $menu = Menu::where('nama','like','Lauk Nasi Tim%')->where('tanggal_periode',10)->get();
        $pivot = PivotDiet::where('diet_produksi_id',17)->select('id')->get()->toArray();
        $kode = '';
        foreach ($pivot as $p) 
        {   
            $kode .= $p['id'].',';
        }
        // dd($kode,$pivot);
        foreach ($menu as $item) 
        {
            $item->diet_produksi_id = $kode;
            $item->save();
        }
        return json_encode('done');
    }

    public function gantiJadiKoma() //ganti diet_produksi_id di menu jadi comma separated
    {
        $menu = Menu::all();
        $diet_produksi_id = [];
        foreach ($menu as $item) 
        {
            $diet_produksi_id = explode(';',$item->diet_produksi_id);
            // dd($diet_produksi_id);
            array_pop($diet_produksi_id);
            $diet_produksi_id = implode(',',$diet_produksi_id);
            // dd($diet_produksi_id);
            $item->diet_produksi_id = $diet_produksi_id;
            $item->save();
        }
        dd('done');
    }

    public function allTest() //testing all
    {
        ini_set('max_execution_time', 0);
        $kode_diet_double = [];
        $menu_belum_masuk = [];
        $data['pasien_id'] = 486055;
        $data['jenis_pasien_id'] = 546278;
        $data['lokasi_id'] = 56;
        $data['jadwal_pengantaran'] = Carbon::today();
        $data['waktu_pagi'] = 1;
        $data['waktu_siang'] = 1;  
        $data['waktu_sore'] = 1; 
        $data['snack_sore'] = 1;
        $data['snack_pagi'] = 1;
        $data['kasus_id'] = 35;
        $kelas = Kelas::all();
        $jenis_makanan = JenisMakanan::all();
        $kategori_makanan = KategoriMakanan::all();        
        $flag_array[0] = [0,0,0]; //rg,lc,ptg
        $flag_array[1] = [1,1,0];
        $flag_array[2] = [1,1,1];
        $flag_array[3] = [0,1,0];
        $flag_array[4] = [0,1,1];
        $flag_array[5] = [0,0,1];
        $flag_array[6] = [1,0,0];
        DB::connection('gizi')->beginTransaction();
        try
        {
            foreach ($kelas as $key2=>$k) 
            {   
                if($key2 > 0) break;
                foreach ($jenis_makanan as $jm) 
                {
                    foreach($kategori_makanan as $km)
                    {   
                        $diet = Diet::where('jenis_makanan_id',$jm->id);
                        if($km->id == 3 || $km->id == 4)
                        {
                            $diet = $diet->where('cair',$km->id)->get();
                        }
                        else
                        {
                            $diet = $diet->get();
                        }
                        // dd($diet);
                        foreach ($diet as $key=>$d) 
                        {   
                            // if($key < 9)
                            // {
                            //     continue;
                            // }
                            $bentuk_makanan = BentukMakanan::whereRaw("find_in_set(?,diet_id)",[$d->id])->get();
                            // dd($d,$bentuk_makanan,$km,$jm);
                            foreach ($bentuk_makanan as $bm) 
                            {
                                $kode = DietKode::where('bentuk_makanan_id',$bm->id)
                                    ->where('kategori_makanan_id',$km->id)
                                    ->where('diet_id',$d->id)
                                    ->where('jenis_makanan_id',$jm->id);
                                    // ->where('is_rg',0)->where('is_lc',0)->where('is_rg',0)->first();
                                // dd($kode);
                                foreach ($flag_array as $f) 
                                {   
                                    $query_result = $kode->where('is_rg',$f[0])->where('is_lc',$f[1])->where('is_rg',$f[2])->first();
                                    // if(count($query_result) > 0)
                                    // {
                                    //     dd($query_result);
                                    // }
                                    if(empty($query_result))
                                    {   
                                        continue;
                                    }
                                    // dd('bca',$query_result);
                                    // elseif(count($query_result) > 1)
                                    // {
                                    //     array_push($kode_diet_double,$query_result[0]->nama);
                                    // }
                                    else
                                    {   
                                        $data['diet_id'] = $d->id;
                                        $data['bentuk_makanan'] = $bm->id;
                                        $data['kategori_makanan'] = $km->id;
                                        $data['jenis_makanan'] = $jm->id;
                                        $data['rg'] = $f[0];
                                        $data['lc'] = $f[1];
                                        $data['ptg'] = $f[2];
                                        $data['ukuran1'] = 1;
                                        $data['ukuran2'] = 1;
                                        $data['kelas_id'] = $k->id;
                                        $data['catatan'] = null;
                                        $result = app('App\Http\Controllers\Gizi\Pemesanan\CreateController')->pemesanan($data);
                                        if($result != 'ada')
                                        {
                                            array_push($menu_belum_masuk,$result);
                                        }
                                        // else
                                        // {
                                        //     dd($result);
                                        // }
                                    }
                                }   
                            }
                        }
                    }
                }
            }
            dd($menu_belum_masuk,$result);
            DB::connection('gizi')->commit();          
        }
        catch(\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('gizi')->rollback();
        }
    }

    public function getKode($kode)
    {

    }

    //1 import resep
    //2 import resep_detail
    //3 import menu
    public function importMenuCairKertas() //menu cair di kertas
    {
        ini_set('max_execution_time', 0);
        try {
            DB::connection('gizi')->beginTransaction();
            $row = 0;
            $file = fopen("menu_cair_kertas.csv","r");
            $nama_beda = [];
            $nama_sudah = [];
            $nama_lauk = [];
            $temp_nama = '';
            $bahan_kosong = [];
            $resep_kosong = [];
            $menu_kosong = [];
            $count = 0;
            while(!feof($file))
            {
                $data = fgetcsv($file);
                // $line = count($data);
                if($row < 1)
                {
                    $row++;
                    continue;
                }
                $menu = Menu::where('nama','Makanan Cair '.$data[1])->first();
                if(!empty($menu))
                {
                    for($i=1;$i<=3;$i++)
                    {
                        $detail = new MenuDetail;
                        $detail->waktu_makan_id = $i;
                        $detail->resep_id = Resep::where('nama',$menu->nama)->first();
                        $detail->menu_id = $menu->id;
                        $detail->jumlah = 1;
                        $detail->save();
                        $count++;
                    }
                }
                else
                {
                    array_push($menu_kosong,$menu);
                }
                // if(empty($menu))
                // {
                //     $menu = new Menu;
                //     $menu->nama = 'Makanan Cair '.$data[1];
                //     $menu->kelas_id = -1;
                //     $menu->tanggal_periode = -1;
                //     $menu->tambahan = 0;
                //     $menu->save();
                //     $count++;    
                // }
                // $bahan_makanan = BahanMakanan::where('nama',$data[3])->first();
                // $nama_resep = 'Makanan Cair '.$data[1];
                // $resep = Resep::where('nama',$nama_resep)->first();
                // if(empty($bahan_makanan))
                // {
                //     array_push($bahan_kosong,$data[3]);
                // }
                // elseif (empty($resep)) {
                //     // array_push($resep_kosong,$nama_resep);
                //     $resep = new Resep;
                //     $resep->nama = 'Makanan Cair '.$data[1];
                //     $resep->porsi = 1;
                //     $resep->waktu_masak = 1;
                //     $resep->ukuran_tiap_porsi = 1;
                //     $resep->nilai_p = 1;
                //     $resep->nilai_l = 1;
                //     $resep->nilai_k = 1;
                //     $resep->nilai_e = 1;
                //     $resep->prosedur = null;
                //     $resep->flag_pokok = 1;
                //     $resep->save();

                //     $nama_bahan = $data[3];
                //     $detail = new ResepDetail;
                //     $detail->resep_id = $resep->id;
                //     $detail->jumlah_bb = $data[4];
                //     $detail->jumlah_bk = $data[4];
                //     $detail->bahan_makanan_id = $bahan_makanan->id;
                //     $detail->created_by = Auth::user()->id;
                //     $detail->save();
                // }
                // else
                // {
                //     $nama_bahan = $data[3];
                //     $detail = new ResepDetail;
                //     $detail->resep_id = $resep->id;
                //     $detail->jumlah_bb = $data[4];
                //     $detail->jumlah_bk = $data[4];
                //     $detail->bahan_makanan_id = $bahan_makanan->id;
                //     $detail->created_by = Auth::user()->id;
                //     $detail->save();
                // }
                    
            }            
            fclose($file);
            DB::connection('gizi')->commit();
            dd($count,$menu_kosong);
            return json_encode('succes');
        } catch (Exception $e) {
            DB::connection('gizi')->rollBack();
            dd($e);
        }
        
    }
}
