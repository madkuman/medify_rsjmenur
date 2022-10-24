<?php

namespace App\Http\Controllers\KamarOperasi\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Transaksi;
use App\Models\KamarOperasi\Ruangan;
use App\Models\KamarOperasi\PergantianJadwal;
use App\Models\Kasus\Kasus;
use App\Models\Pasien\Pasien;
use App\Models\KamarOperasi\FotoOperasi;
use Carbon\Carbon;
use DB;
use Auth;

class PostController extends Controller
{
    public function pendaftaranOperasi($id, $kasus_id=0)
    {
        $transaksi = $this->daftarOperasi($id, $kasus_id);

        $status = 1;
        $message = 'Pasien berhasil didaftarkan';
        $title = 'Berhasil!';

        return redirect('kamaroperasi/pemesanan')
        ->with('message', $message)
        ->with('title', $title)
        ->with('status', $status);
    }

    public function daftarOperasi($pasien_id, $kasus_id)
    {
        //$transaksi_global = app('App\Http\Controllers\Hospital\Transaksi\CreateController')->create(9);

        $transaksi = new Transaksi;
        $transaksi->pasien_id = $pasien_id;
        //$transaksi->transaksi_global_id = $transaksi_global->id;
        $transaksi->kasus_id = $kasus_id;
        $transaksi->status = 0;
        $transaksi->dijadwalkan_oleh = Auth::user()->id;
        $transaksi->save();

        //$transaksi_global = app('App\Http\Controllers\Hospital\Transaksi\EditController')->edit($transaksi_global->id,$transaksi->id);

        return $transaksi;
    }

    public function daftarOperasiFromOperator(Request $request)
    {
        $tanggal = Carbon::createFromFormat('d/m/Y', $request->input('tanggal_operasi'));
        $connection = DB::connection('kamaroperasi');
        $connection->beginTransaction();

        try {
            if ($request->id)
            {
                $transaksi = Transaksi::findOrFail($request->id);
                if ($transaksi->status == 2)
                {
                    $pergantian = $transaksi->getCurrentPergantianJadwal();
                    $pergantian->status = 1;
                    $pergantian->save();
                }
            }
            else
            {
                $transaksi = new Transaksi;
            }

            $kasus = Kasus::find($request->kasus_id);
            if(!empty($kasus->diagnosisUtama->id)) 
            {
                $diagnosis_id = $kasus->diagnosisUtama->icd10->id;
                $diagnosis = $kasus->diagnosisUtama->icd10->code_icd.' - '.$kasus->diagnosisUtama->icd10->long_desc;
            }
            elseif(!empty($kasus->diagnosis)) 
            {
                $diagnosis_id = $kasus->diagnosis[0]->icd10->id;
                $diagnosis = $kasus->diagnosis[0]->icd10->code_icd.' - '.$kasus->diagnosis[0]->icd10->long_desc;
            }
            else
            {
                $status = -1;
                $message = 'Kasus pasien belum memiliki diagnosis';
                $title = 'Gagal!';

                return back()
                ->with('message', $message)
                ->with('title', $title)
                ->with('status', $status);
            }

            
            if(!empty($request->masa_tunggu))
                $masa_tunggu = Carbon::createFromFormat('d/m/Y', $request->input('masa_tunggu'));
            else
                $masa_tunggu = Carbon::today();
            // INSERT PARENT
            $transaksi->pasien_id = $request->input('pasien');
            $transaksi->kasus_id = $request->input('kasus_id');
            $transaksi->diagnosis_id = $diagnosis_id;
            $transaksi->diagnosis = $diagnosis;
            $transaksi->doctor_id = $request->input('dokter');
            $transaksi->jadwal_operasi = $tanggal;
            $transaksi->ruangan_id = $request->input('ruangan');
            $transaksi->nomor_ronde = $request->input('ronde');
            $transaksi->masa_tunggu = $masa_tunggu;
            $transaksi->judul = $request->input('judul_operasi');
            $transaksi->status = 0;
            $transaksi->dijadwalkan_oleh = Auth::user()->id;
            $transaksi->save();

            // INSERT CHILD
            if ($request->input('is_join') !== NULL) {
                if (!empty($request->input('judul_child'))) {
                    foreach ($request->input('judul_child') as $key => $value) {
                        $child = new Transaksi;
                        $child->doctor_id = $request->input('dokter');
                        $child->judul = $value;
                        $child->parent_id = $transaksi->id;
                        $child->status = 0;
                        $child->dijadwalkan_oleh = Auth::user()->id;
                        $child->save();
                    }
                }
            }

            $connection->commit();

            $status = 1;
            $message = 'Pendaftaran Pasien Operasi Berhasil!';
            $title = 'Berhasil!';

            return redirect('kamaroperasi')
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
        } catch (\Exception $e) {
            
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            $connection->rollback();

            $status = -1;
            $message = $e;
            $title = 'Error!';
            

            return redirect('kamaroperasi')
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
        }

    }

    public function submitTambahPermintaan(Request $request)
    {
        $kasus = Kasus::find($request->kasus_id);
        if(!empty($kasus->diagnosisUtama->id)) 
        {
            $diagnosis_id = $kasus->diagnosisUtama->icd10->id;
            $diagnosis = $kasus->diagnosisUtama->icd10->code_icd.' - '.$kasus->diagnosisUtama->icd10->long_desc;
        }
        elseif(count($kasus->diagnosis) != 0) 
        {
            $diagnosis_id = $kasus->diagnosis[0]->icd10->id;
            $diagnosis = $kasus->diagnosis[0]->icd10->code_icd.' - '.$kasus->diagnosis[0]->icd10->long_desc;
        }
        elseif(is_null($request->input('masa_tunggu'))){
            $status = -1;
            $message = 'Masa Tunggu Operasi belum dipilih';
            $title = 'Gagal!';

            return back()
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
        }
        else
        {
            $status = -1;
            $message = 'Kasus pasien belum memiliki diagnosis';
            $title = 'Gagal!';

            return back()
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
        }


        $transaksi = new Transaksi;
        $transaksi->pasien_id = $request->input('pasien');
        $transaksi->kasus_id = $request->input('kasus_id');
        $transaksi->jenis_spesialis_id = $request->jenis_spesialis_id;
        $transaksi->diagnosis_id = $diagnosis_id;
        $transaksi->diagnosis = $diagnosis;
        $transaksi->masa_tunggu = Carbon::createFromFormat('d/m/Y', $request->input('masa_tunggu'));
        $transaksi->status = 0;
        $transaksi->dijadwalkan_oleh = Auth::user()->id;
        $transaksi->save();
        $status = 1;
        $message = 'Permintaan Operasi Berhasil Ditambahkan!';
        $title = 'Berhasil!';

        return redirect('kamaroperasi/pemesanan')
        ->with('message', $message)
        ->with('title', $title)
        ->with('status', $status);
    }

    public function pickdate($transaksi_id)
    {
        $data['transaksi_id'] = $transaksi_id;
        $data['transaksi'] = Transaksi::find($transaksi_id);
        if ($data['transaksi']->status == 2)
        {
            $data['permintaan'] = PergantianJadwal::where('operasi_id', $transaksi_id)->latest()->first();
        }
        $data['routeFlag'] = 1;
        $data['ruangan'] = app('App\Http\Controllers\KamarOperasi\Ruangan\ReadController')->getAll();
        return view('kamaroperasi.transaksi.jadwal', $data);
    }

    public function listdokter($transaksi_id, Request $request)
    {
        $dokter = app('App\Http\Controllers\KamarOperasi\Transaksi\ReadController')->listDokter();
        $ruang = $request->input('ruang');
        $ronde = $request->input('ronde');
        $tanggal = $request->input('tanggal');
        $transaksi = Transaksi::find($transaksi_id);
        $ruang = Ruangan::find($ruang);
        $tanggal = Carbon::createFromFormat('Y-m-d', $tanggal, 'Asia/Jakarta');
        if ($transaksi->status == 2)
        {
            $permintaan = PergantianJadwal::where('operasi_id', $transaksi->id)->where('status', 0)->first();
        }

        $data['dokter'] = $dokter;
        $data['permintaan'] = $permintaan;
        $data['ruang'] = $ruang;
        $data['ronde'] = $ronde;
        $data['jadwal'] = $tanggal->format('l, j F Y');
        $data['tanggal'] = $tanggal->format('Y-m-d');
        $data['transaksi'] = $transaksi;
        $data['routeFlag'] = 1;
        return view('kamaroperasi.transaksi.dokter', $data);
    }

    public function listkamar(Request $request)
    {
        $kamar = app('App\Http\Controllers\KamarOperasi\Transaksi\ReadController')->listKamar();
        $transaksi_id = $request->input('transaksi_id');
        $date = $request->input('date');
        //dd($date);

        $formatDate = Carbon::createFromFormat('m/d/Y H:i A', $date)->toDateString();
        //dd($formatDate);
        $sisa = array();
        $count = array();

        foreach ($kamar as $ruang)
        {
            $query = app('App\Http\Controllers\KamarOperasi\Transaksi\ReadController')->RondeTersisa($ruang->id, $formatDate);
            foreach ($query as $item)
            {
                array_push($sisa, $item);
            }
            $ruang->sisa = $sisa;
            $sisa = array();
        }

        $data['kamar'] = $kamar;
        $data['sisa'] = $sisa;
        $data['count'] = $count;
        $data['transaksi_id'] = $transaksi_id;
        $data['jadwal'] = $formatDate;
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'id_ID.utf8');
        //$data['tanggal'] = Carbon::getLocale();
        $data['tanggal'] = Carbon::createFromFormat('m/d/Y H:i A', $date)->formatLocalized('%A, %d %B %Y');
        $data['routeFlag'] = 1;

        //dd($data);
        return view('kamaroperasi.transaksi.kamar', $data);
    }

    public function konfirmasiKamar($transaksi_id, Request $request)
    {
        $transaksi = Transaksi::find($transaksi_id);
        $dokter = app('App\Http\Controllers\KamarOperasi\Transaksi\ReadController')->singleDokter($request->input('dokter'));
        $kamar = app('App\Http\Controllers\KamarOperasi\Transaksi\ReadController')->singleKamar($request->input('ruang'));
        $nomor_ronde = $request->input('ronde');
        $jadwal = $request->input('tanggal');

        $tanggal = Carbon::createFromFormat('Y-m-d', $jadwal, 'Asia/Jakarta');


        $data['dokter'] = $dokter;
        $data['ruang'] = $kamar;
        $data['transaksi'] = $transaksi;
        $data['ronde'] = $nomor_ronde;
        $data['jadwal'] = $tanggal->format('l, j F Y');
        $data['tanggal'] = $tanggal->format('Y-m-d');
        $data['routeFlag'] = 1;
        return view('kamaroperasi.transaksi.konfirmasi', $data);
    }

    public function submit(Request $request)
    {
        $kamar_id = $request->input('kamar_id');

        $transaksi = Transaksi::find($request->input('transaksi_id'));

        if ($transaksi->status == 2)
        {
            $transaksi->pergantian_jadwal->status = 1;
            $transaksi->pergantian_jadwal->save();
        }

        $transaksi->doctor_id = $request->input('dokter_id');
        $transaksi->ruangan_id = $kamar_id;
        $transaksi->jadwal_operasi = $request->input('jadwal');
        $transaksi->nomor_ronde = $request->input('nomor_ronde');
        $transaksi->status = 0;
        $transaksi->dijadwalkan_oleh = Auth::user()->id;
        $transaksi->save();

        $status = 1;
        $message = 'Pemesanan kamar operasi berhasil dilakukan.';
        $title = 'Berhasil!';

        return redirect('kamaroperasi/')
        ->with('message', $message)
        ->with('title', $title)
        ->with('status', $status);
    }

    public function daftarOperasiKasus($pasien_id, $kasus_id, $diagnosis, $diagnosis_id, $dokter_id, $bayar_id, $keterangan ="",$jenis_spesialis_id,$icd_9_id)
    {
        //$transaksi_global = app('App\Http\Controllers\Hospital\Transaksi\CreateController')->create(9);

        $today = Carbon::now();
        $next_week = $today->addDay(7);

        $transaksi = new Transaksi;
        $transaksi->pasien_id = $pasien_id;
        //$transaksi->masa_tunggu = $next_week;
        //$transaksi->transaksi_global_id = $transaksi_global->id;
        $transaksi->kasus_id = $kasus_id;
        $transaksi->doctor_id = $dokter_id;
        $transaksi->jenis_spesialis_id = $jenis_spesialis_id;
        $transaksi->keterangan = $keterangan;
        $transaksi->diagnosis = $diagnosis;
        $transaksi->diagnosis_id = $diagnosis_id;
        $transaksi->icd9_id = $icd_9_id;
        $transaksi->status = 0;
        $transaksi->dijadwalkan_oleh = Auth::user()->id;
        $transaksi->save();

        //$transaksi_global = app('App\Http\Controllers\Hospital\Transaksi\EditController')->edit($transaksi_global->id,$transaksi->id);

        return $transaksi;
    }

    public function fillMasaTunggu(Request $request)
    {
        $transaksi = Transaksi::findOrFail($request->input('id'));
        $transaksi->masa_tunggu = Carbon::createFromFormat('d/m/Y', $request->input('masa_tunggu'));
        $transaksi->save();

        $status = 1;
        $message = 'Masa Tunggu berhasil diperbaharui.';
        $title = 'Berhasil!';

        return back()
        ->with('message', $message)
        ->with('title', $title)
        ->with('status', $status);
    }

    public function createTagihanKasus(Request $request)
    {
        // dd($request);
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
            $kasus = Kasus::where('id', $request->kasus_id)->first();
            $jumlah = count($request->input('desc_keperawatan'));
            for($i=0;$i<$jumlah;$i++){
                $data['kasus_id'] = $request->kasus_id;
                $data['tarif_id'] = $request->input('tarif_id.'.$i.'');
                $data['tarif_tipe_id'] = $request->input('tarif_tipe_id.'.$i.'');
                $data['tarif_kelas_id'] = $request->input('tarif_kelas.'.$i.'');
                $data['desc'] = $request->input('desc_keperawatan.'.$i.'');
                $data['unit_price'] = $request->input('price.'.$i.'');
                $data['qty'] = 1;
                $data['lokasi'] = $request->lokasi;
                $data['daftar_harga_id'] = 0;
                $data['sep_id'] = $kasus->sep_id;
                $data['kategori_id'] = $request->kategori_id;
                // $data['departemen_id'] = $request->departemen_id; -OBSOLETE-
                $data['transaksi_kamar_operasi_id'] = $request->transaksi_kamar_operasi_id;

                $createDetail = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->create($data);
            }

            $status = 1;
            $message = 'Tagihan berhasil ditambahkan';
            $title = 'Berhasil!';

            
            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return redirect('/kamaroperasi/pelaksanaan/'.$data['transaksi_kamar_operasi_id'].'#tagihan')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
    }

    public function editTagihanKasus(Request $request)
    {
        // dd($request);
        DB::connection('kasus')->beginTransaction();
        try
        {
            $data['id'] = $request->id;
            $data['kasus_id'] = $request->kasus_id;
            $data['desc'] = $request->desc;
            $data['unit_price'] = $request->unit_price;
            $data['qty'] = $request->qty;
            $data['tagihan_id'] = $request->tagihan_id;
            // $data['daftar_harga_id'] = $request->daftar_harga_id;
            $data['lokasi'] = $request->lokasi;
            $data['tarif_id'] = $request->tarif_id;
            // $data['tarif_tipe_id'] = $request->tarif_tipe_id;
            $data['tarif_kelas'] = $request->tarif_kelas;
            // $data['departemen_id'] = $request->departemen_id;
            $data['sep_id'] = $request->sep_id;

            $editDetail = app('App\Http\Controllers\Kasus\TagihanDetail\EditController')->edit($data);

            $status = 1;
            $message = 'Tagihan berhasil diubah';
            $title = 'Berhasil!';

            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return redirect('/kamaroperasi/pelaksanaan/'.$request->operasi_id.'#tagihan')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
    }

    public function uploadGambar(Request $request)
    {
        //dd($request);
        //dd($request->file('file'));
        DB::connection('kamaroperasi')->beginTransaction();
        try
        {
            $now_date = Carbon::now()->toDateString();
            $group_folder=public_path('uploads/kamaroperasi/');
            $public_folder = public_path('uploads/kamaroperasi/'.$now_date."/");
            $picturePath = 'uploads/kamaroperasi/'.$now_date.'/';
            $folder = 'kamaroperasi/temp';
            if(!file_exists($group_folder))
                mkdir($group_folder, 0777);
            if(!file_exists($public_folder))
                mkdir($public_folder, 0777);

            $image = $request->file('file');
            $extension = strtolower($image->getClientOriginalExtension());
            //$proposedName = substr($request['target'], 0, 13).time().'0'.$request['fileNumber'];
            
            $filename = $this->createFilename($request->transaksi_id,$now_date);
            //$transaction = Transaction::where('slug', $request['target'])->first();
            //dd($extension,$folder,$filename);
             //store local storage
            $upload_success = $image->storeAs($folder, $filename.".".$extension);
            // If the upload is successful, return the name of directory/filename of the upload.
            if ($upload_success) {            
                //move to public path (dest,source)
                $new_path = $request->file->move($public_folder, $upload_success);
                $photo = new FotoOperasi;
                $photo->url = $picturePath.$filename.".".$extension;
                $photo->transaksi_id = $request->transaksi_id;
    /*            $photo->hash = $request['saltPict'];
                $photo->status = 0;
                $photo->path = $picturePath.$filename.".".$extension;*/
                $photo->id_for_url = $photo->last_url;
                $photo->save();
                
                //dd($photo);
                DB::connection('kamaroperasi')->commit();
                return response()->json($photo, 200);
            }
        }
        catch(\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kamaroperasi')->rollBack();
        }
    }

    public function deleteGambar(Request $request)
    {
        //dd($request->get('id'));
        $foto = FotoOperasi::where('id',$request->get('id'))->first();
        $url = $foto->url;
        $explosion = explode("/",$url);
        $id = end($explosion);
        //dd($id);
        if($foto->delete())
        {
            return $id;
        }
        else
        {
            return 'error';
        }
    }

    public function createFilename($transaksi_id,$date)
    {
        $foto = FotoOperasi::where('transaksi_id',$transaksi_id)->orderBy('id','desc')->first();
        if(!empty($foto))
        {   
            //dd($foto->id);
            $num = $foto->id;
            $val = (int)$num;
            $val += 1;
            $nama = "Dokumentasi_operasi_".$date."_".$transaksi_id."_".$val;
        }
        else
        {
            $nama = "Dokumentasi_operasi_".$date."_".$transaksi_id."_1";   
        }
        return $nama;
    }
}
