<?php

namespace App\Http\Controllers\Pasien\Pasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\Pasien;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Resep;
use App\Models\Kasus\Penunjang;
use App\Models\Kasus\Diagnosis;
use App\Models\Pasien\ListLaporan;
use App\Models\Kasus\PenunjangPermintaan;
use App\Models\Pasien\AlamatKecamatan;
use App\Models\Pasien\AlamatKota;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Pasien\PembayaranPerusahaan;
use App\Models\Pasien\AsalRujukan;
use App\Models\RawatJalan\PermintaanRujuk;

///transaksi
use App\Models\RawatJalan\Transaksi as TransaksiRawatJalan;
use App\Models\RawatInap\Transaksi as TransaksiRawatInap;
use App\Models\IGD\Transaksi as TransaksiIGD;

use App\Models\Hospital\TransaksiMasukDetail as TransaksiDetail;
use App\Models\Hospital\TransaksiMasuk as Transaksi;
use Carbon\Carbon;
use DB;

class ReadController extends Controller
{

    public function getStatistik(){
        $data['totalPasien'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->getTotalPasien();
        $data['pasienBaru'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->getNewPasien();
        $data['transaksi'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->getTempatTransaksi();

        return json_encode($data);
    }
    public function getAll(){
        $pasien = Pasien::get();
        return $pasien;
    }

    public function getBPJS(Request $request, $keyword)
    {

        $keyword = preg_replace("/[^[:alnum:][:space:]]/u", '', $keyword);
        $pasien = Pasien::search($keyword)
            ->with([
                'kasus' => function($q){
                    $q->selectRaw('kasus.id, kasus.pasien_id, kasus.sep_id, kasus.judul_kasus, kasus.nomor_kasus')
                        ->from(config('app.db_name').'_patients.pasien')
                        ->join(config('app.db_name').'_kasus.kasus', function($query) {
                            $query->on('kasus.pasien_id', 'pasien.id');
                        })
                        ->with(['sep:id,no_sep,no_bpjs'])
                        ->has('sep')
                        ->whereNotNull('kasus.sep_id');
                },"pembayaran" => function ($q) {
                $q->with('perusahaan')->whereHas('perusahaan', function ($query) {
                    $query->where('type', 1);
                });
            }])
            ->whereRegexp('perusahaan_tipe', '@BPJS@')
            ->rule(\App\SearchRule\Pasien::class)
            ->get();

        // $pasien = Pasien::where('name', 'LIKE', '%'.$keyword.'%')
        //         ->with('pembayaran.perusahaan')
        //         ->whereHas('pembayaran.perusahaan', function($q){
        //             $q->where('type', 1);
        //         })->get();
        return $pasien;
    }

    public function getBPJSById(Request $request, $id)
    {
        $pasien = Pasien::where('id', $id)
            ->with(["pembayaran" => function ($q) {
                $q->with('kelas:id,nama','perusahaan')->whereHas('perusahaan', function ($query) {
                    $query->where('type', 1);
                });
            }])
            ->first();
        return json_encode($pasien);
    }


	public function get(Request $request){
        $search = preg_replace("/[^[:alnum:][:space:]]/u", '', $request->keyword);
		if(!empty($search)){
            $pasiens = Pasien::search($search)->rule(\App\SearchRule\Pasien::class)
                ->with(['pembayaran.perusahaan', 'jenis_identitas', 'alamat_kota', 'alamat_kecamatan'])
                ->paginate(10);
        }
        else
			$pasiens = Pasien::with(['pembayaran.perusahaan', 'jenis_identitas', 'alamat_kota', 'alamat_kecamatan'])
                ->orderBy('no_rm', 'desc')->paginate(10);

        foreach ($pasiens as $key => $pasien) {
            $pasien->age = $pasien->age;
            $pasien->jenis_kelamin = $pasien->jenis_kelamin;

            foreach ($pasien->pembayaran as $index => $bayar) {
                if ($index>0 && !empty($pasien->all_bayar)) {
                    $pasien->all_bayar .= ", ";
                }
                $perusahaan = $bayar->perusahaan;
                if(!empty($perusahaan)){

                    if ($perusahaan->id != "80") {
                        $pasien->all_bayar .= $perusahaan->nama." - ".$bayar->no_asuransi;
                    }else{
                        $pasien->all_bayar .= $perusahaan->nama;
                    }
                }
            }

            if (empty($pasien->all_bayar)) {
                $pasien->all_bayar = "Tunai";
            }
            $identitas = $pasien->jenis_identitas;
            if(!empty($identitas)){
                $pasien->kartu = $identitas->nama;
            }else{
                $pasien->kartu = "-";
            }
            $kota = $pasien->alamat_kota;
            if(!empty($kota)){
                $pasien->kota = $kota->name;
            }else{
                $pasien->kota = '';
            }
            $kecamatan = $pasien->alamat_kecamatan;
            if(!empty($kecamatan)){
                $pasien->kecamatan = $kecamatan->name;
            }else{
                $pasien->kecamatan = '-';
            }
        }

		return json_encode($pasiens);
	}

    public function filter(Request $request)
    {
        $nama = $request->get('nama');
        $no_rm = $request->get('no_rm');
        $alamat = $request->get('alamat');
        $kota = $request->get('kota');
        $kecamatan = $request->get('kecamatan');
        $ktp = $request->get('ktp');
        $asuransi = $request->get('asuransi');
        $jenis = $request->get('jenis');
        $usia_min = $request->get('usia_min');
        $usia_max = $request->get('usia_max');
        $laki = $request->get('laki');
        $perempuan = $request->get('perempuan');
        $nrp = $request->get('nrp');



        $query = Pasien::with('pembayaranUtama.perusahaan','alamat_kota','alamat_kecamatan');

        if(!empty($nama)){
            $query = $query->where("name",'LIKE', '%'.$nama.'%');
        }

        if(!empty($no_rm)){
            $query = $query->where("no_rm",'LIKE', '%'.$no_rm.'%');
        }
        if(!empty($nrp)){
            $query = $query->where(function ($query) use ($nrp) {
                $query->where("tni_nrp",'LIKE', '%'.$nrp.'%')->orWhere("text_kerabat_nrp",'LIKE', '%'.$nrp.'%');
            });
        }
        if(!empty($alamat)){
            $query = $query->where("address",'LIKE', '%'.$alamat.'%');
        }
        if(!empty($kota)){
            $query = $query->where("city", $kota);
        }
        if(!empty($kecamatan)){
            $query = $query->where("district", $kecamatan);
        }
        if(!empty($ktp)){
            $query = $query->where("no_identitas",'LIKE', '%'.$ktp.'%');
        }
        if(!empty($asuransi)){
            $query = $query->where('text_asuransi','LIKE', '%'.$asuransi.'%');
        }
        if(!empty($usia_min) || !empty($usia_max)){
            $now = Carbon::today()->addDay(1);
            if(empty($usia_min)){
                $usia_min = 0;
            }
            if(empty($usia_max)){
                $usia_max = 300;
            }
            $dateMax = date($now->copy()->subYears($usia_max)->toDateString());
            $dateMin = date($now->copy()->subYears($usia_min)->toDateString());

            $query = $query->whereBetween('date_of_birth', [$dateMax, $dateMin]);
        }
        if($laki== 1&& $perempuan==0){
            $query=$query->where('gender', 1);
        }

        if($laki== 0&& $perempuan==1){
            $query=$query->where('gender', 2);
        }
        $pasien = $query->orderBy('no_rm', 'desc')->paginate(10);
        foreach($pasien as $item)
        {
            if($item->gender == 1) $jenis_kelamin = 'Laki Laki';
            else $jenis_kelamin = 'Perempuan';

            if(!empty($item->pembayaranUtama) && !empty($item->pembayaranUtama->perusahaan)){
                $item->pembayaran = $item->pembayaranUtama->perusahaan->tipe->nama;
            }else{
                $item->pembayaran = "-";
            }
            $item->age = Carbon::parse($item->date_of_birth)->age;
            $item->jenis_kelamin = $jenis_kelamin;

            if(!empty($item->city)){
                $kota = AlamatKota::find($item->city);
                $item->kota = $kota->name;
            }else{
                $item->kota = '';
            }
            if(!empty($item->district)){
                $kecamatan = AlamatKecamatan::find($item->district);
                $item->kecamatan = $kecamatan->name;
            }else{
                $item->kecamatan = '-';
            }
            if(!empty($item->jenis_identitas)){
                $item->kartu = $item->jenis_identitas->nama;
            }else{
                $item->kartu ='-';
            }
        }

        return $pasien;
    }



    public function profile($id, $dokter=null, $lokasi=null)
    {
        $kasus_ids = Kasus::where('pasien_id',$id)->get()->pluck('id'); 
        $data['kasus'] = Kasus::where('pasien_id',$id)->orderBy('created_at', 'DESC')->get();
        $data['transaksi_poli'] = TransaksiRawatJalan::where('pasien_id',$id)->whereNull('kasus_id')->get();
        $poli = [];
        $kunjungan = [];
        foreach($data['kasus'] as $item)
        {
            $temp = new \StdClass();
            $temp->url = url('/').'/kasus/'.$item->nomor_kasus;
            $temp->menu = 1;
            $temp->kasus = 1;
            $temp->url_menu_edit_bayar = url('/').'/kasus/'.$item->nomor_kasus.'/datamedis/identitas/pembayaran/update';
            $temp->judul_kasus = $item->judul_kasus;
            $temp->tanggal_masuk = $item->created_at;
            $temp->tanggal_keluar = $item->krs_at;
            $temp->pembayaran = $item->pembayaran->perusahaan->nama ?? '-';
            $temp->tipe_ri = $item->tipe_ri ?? '-';
            $temp->tipe_rj = $item->tipe_rj ?? '-';
            $temp->tipe_igd = $item->tipe_igd ?? '-';
            $temp->tipe_mc = $item->tipe_mc ?? '-';
            $temp->lokasi = $item->lokasi->lokasi->nama ?? '-';
            array_push($kunjungan, $temp);
        }

        foreach($data['transaksi_poli'] as $item)
        {
            $temp = new \StdClass();
            $temp->menu = 0;
            $temp->kasus = 0;
            $temp->url = url('/').'/rawatjalan/transaksi/pendaftaran/'.$item->id;
            $temp->judul_kasus = 'Rawat Jalan';
            $temp->dokter_id = $item->dokter_id;
            $temp->tanggal_masuk = $item->waktu_masuk;
            $temp->tanggal_keluar = $item->waktu_keluar;
            $temp->pembayaran = $item->pasien_pembayaran->perusahaan->nama ?? '-';
            $temp->lokasi = $item->poliklinik->name;
            array_push($kunjungan, $temp);
            array_push($poli, $item->poliklinik->name);
        }
        usort($kunjungan, function($a, $b)
        {
            return strcmp($a->tanggal_masuk, $b->tanggal_masuk);
        });

        $filter_kunjungan = $this->filterHistoryKunjungan($dokter, $lokasi, $kunjungan);
        $data['kunjungan'] = $filter_kunjungan;

        if ($dokter || $lokasi) {
            $data['filter_dokter'] = $dokter ? join(',',$dokter) : null;
            $data['filter_lokasi'] = $lokasi != "Semua" ? $lokasi : null;
            $data['tab_active'] = "tabs-kasus";
        }
        
        $data['dokter'] = TransaksiRawatJalan::select('dokter_id')->with('dokter')->has('dokter')->where('pasien_id',$id)->whereNull('kasus_id')->distinct()->get()->sortBy('dokter.name');
        sort($poli);
        $data['poli'] = array_unique($poli);

        $data['identitas'] = Pasien::with(['jenis_identitas', 'agama', 'pendidikan', 
                                            'tni_keanggotaan', 'tni_kotama', 'tni_pangkat', 'tni_satker',
                                            'wali.tni_satker', 'wali.tni_pangkat', 'wali.tni_kotama',
                                            'wali.tni_keanggotaan', 'wali.alamat_kota', 'wali.alamat_kecamatan',
                                            'pernikahan'])
                                    ->where('id', $id)->first();

        $data['resep'] = Resep::whereIn('kasus_id',$kasus_ids)->get();
        $data['pembayaran'] = PasienPembayaran::with(['perusahaan','perusahaan.tipe','kelas'])->where('pasien_id',$id)->get();

        $data['permintaan_rujuk'] = PermintaanRujuk::where('pasien_id',$id)->where('status',0)->get();
        $count_pendaftaran = PasienPembayaran::whereNotNull('kelas_id')->where('pasien_id',$id)->count();
        if($count_pendaftaran > 0) $is_pendaftaran_disabled = 0;
        else $is_pendaftaran_disabled = 1;


        $data['is_pendaftaran_disabled'] = $is_pendaftaran_disabled;

        return $data;
    }

    public function ringkasanRajal($id)
    {
        $data['kunjungan'] = Kasus::where('pasien_id',$id)
                            ->where('tipe_rj', '1')
                            ->orderBy('created_at', 'ASC')
                            ->get();
        $data['identitas'] = Pasien::find($id);
        return $data;
    }

    public function ringkasanRanap($id)
    {
        $data['kunjungan'] = Kasus::where('pasien_id',$id)
                            ->where('tipe_ri', '1')
                            ->orderBy('mrs_at', 'ASC')
                            ->get();
        $data['identitas'] = Pasien::find($id);
        return $data;
    }
     
    public function printprofile($id)
    {
        $kasus_ids = Kasus::where('pasien_id',$id)->get()->pluck('id'); 

        $data['kasus'] = Kasus::where('pasien_id',$id)->get();
        $data['kasus_last'] = Kasus::where('pasien_id',$id)->latest()->first();
        $data['identitas'] = Pasien::with(['jenis_identitas', 'agama', 'pendidikan',
                                            'tni_keanggotaan', 'tni_kotama', 'tni_pangkat', 'tni_satker',
                                            'wali.tni_satker', 'wali.tni_pangkat', 'wali.tni_kotama', 'wali.tni_keanggotaan', 'wali.alamat_kota', 'wali.alamat_kecamatan'])
                                    ->where('id', $id)->first();
        $data['penunjang'] = Penunjang::whereIn('kasus_id',$kasus_ids)->get();
        $data['penunjangpermintaan'] = PenunjangPermintaan::whereIn('kasus_id',$kasus_ids)->get();
        $data['resep'] = Resep::whereIn('kasus_id',$kasus_ids)->get();
        $data['pembayaran'] = PasienPembayaran::with(['perusahaan','perusahaan.tipe','kelas'])->where('pasien_id',$id)->get();
        return $data;
    }

    public function myRujukPoli($id)
    {
        $permintaan_rujuk = PermintaanRujuk::where('pasien_id',$id)->where('status',0)->get();
        return $permintaan_rujuk;
    }

    public function getTotalPasien()
    {
        $data = Pasien::count();
        return $data;
    }

    public function getNewPasien()
    {
        $today = Carbon::today();
        $res = Pasien::whereDate('created_at', $today)
                    ->count();

        return $res;
    }

    public function statistikKunjungan()
    {
        $begin = microtime(true);
        $day = Carbon::now();
        $jalan = TransaksiRawatJalan::whereDate('created_at', '>=', $day->copy()->startOfYear())
                    ->groupBy('month')
                    ->orderBy('month', 'ASC')
                    ->get(array(
                            DB::raw('MONTH(created_at) as month'),
                            DB::raw('COUNT(1) as "transaksi_count"')
                        ));
        $inap =TransaksiRawatInap::whereDate('created_at', '>=', $day->copy()->startOfYear())
                    ->groupBy('month')
                    ->orderBy('month', 'ASC')
                    ->get(array(
                            DB::raw('MONTH(created_at) as month'),
                            DB::raw('COUNT(1) as "transaksi_count"')
                        ));
         $igd = TransaksiIGD::whereDate('created_at', '>=', $day->copy()->startOfYear())
                    ->groupBy('month')
                    ->orderBy('month', 'ASC')
                    ->get(array(
                            DB::raw('MONTH(created_at) as month'),
                            DB::raw('COUNT(1) as "transaksi_count"')
                        ));
        $j=0; $k=0; $l=0;
        
        $data = [];
        for ($i=1; $i <= 12; $i++) {
            if($i < 10) $month = '0'.$i;
            else $month = $i;
            $temp = [
                "month" => date("Y").'-'.$month
            ];
            if(!$jalan->isEmpty() && $jalan[$j]->month == $i){
                $temp["jalan"] = $jalan[$j]->transaksi_count;
                unset($jalan[$j]);
                $j++;
            }else{
                $temp["jalan"] = 0;
            }


            if(!$inap->isEmpty() && $inap[$k]->month == $i){
                $temp["inap"] = $inap[$k]->transaksi_count;
                unset($inap[$k]);
                $k++;
            }else{
                $temp["inap"] = 0;
            }


            if(!$igd->isEmpty() && $igd[$l]->month == $i){
                $temp["igd"] = $igd[$l]->transaksi_count;
                unset($igd[$l]);
                $l++;
            }else{
                $temp["igd"] = 0;
            }
            array_push($data, $temp);
        }

        return json_encode($data);
    }

    public function statistikJenisPasien()
    {
        $begin = microtime(true);
        //$this->updateStatistikJenisPasien();
        $query = PembayaranPerusahaan::groupBy('type')->get();
        $data = [];
        foreach($query as $item){
            $temp = [];
            $temp['jenis'] = $item->tipe->nama;
            $temp['jumlah'] = $item->total_pasien_utama;
            array_push($data, $temp);
        }
        return json_encode($data);
    }

    private function updateStatistikJenisPasien()
    {

        $query = PembayaranPerusahaan::get();
        foreach($query as $item)
        {
            $current_perusahaan = PembayaranPerusahaan::find($item->id);
            $current_perusahaan->total_pasien = PasienPembayaran::where('perusahaan_id',$current_perusahaan->id)->count();
            $current_perusahaan->total_pasien_utama = PasienPembayaran::where('perusahaan_id',$current_perusahaan->id)->where('utama',1)->count();
            $current_perusahaan->save();
        }
    }

    public function getTempatTransaksi()
    {
        $day = Carbon::today();

        $jalan = TransaksiRawatJalan::whereDate('created_at', $day)
                    ->count();
        $inap = TransaksiRawatInap::whereDate('created_at', $day)
                    ->count();
        $igd = TransaksiIGD::whereDate('created_at', $day)
                    ->count();

        $data = $jalan+$inap+$igd;
        return $data;
    }

    public function getPasienTerbaru()
    {
        $data = Pasien::orderBy('created_at', 'DESC')
                    ->take(5)->get();
        foreach ($data as $pasien) {
            $pasien['age'] = Carbon::parse($pasien->attributes['birthdate'])->age;
        }
        return $data;
    }

    public function getPasienKelamin()
    {
        $data = Pasien::groupBy('gender')
                    ->whereNotNull('gender')
                    ->get(['gender', DB::raw('COUNT(*) as "gender_count"')]);
        return $data;
    }

    public function filterPasien(Request $request){

    }

    // public function statistikPasienBaru()
    // {
    //    $begin = microtime(true);
    //    $day = Carbon::now();

    //     $pasien = Pasien::whereDate('created_at', '>=', $day->copy()->startOfYear())
    //                 ->groupBy('month')
    //                 ->orderBy('month', 'ASC')
    //                 ->get(array(
    //                         DB::raw('MONTH(created_at) as month'),
    //                         DB::raw('COUNT(*) as "pasien_count"')
    //                     ));
    //     var_dump(microtime(true) - $begin);
    //     dd($pasien);
    //     $j=0;

    //     for ($i=1; $i <= 12; $i++) {
    //         if(!$pasien->isEmpty() && $pasien[$j]->month == $i){
    //             $data[$i] = $pasien[$j];
    //             unset($pasien[$j]);
    //             $j++;
    //         }else{
    //             $data[$i]['month'] = $i;
    //             $data[$i]['pasien_count'] = 0;
    //         }
    //     }


    //             $time = microtime(true)-$begin;
    //     var_dump("Statistik : ${time}");
    //     return $data;
    // }

    public function statistikPasienBaru(Request $req)
    {
       
        $start = Carbon::now()->firstOfYear();
        $end = Carbon::now()->lastOfYear();
        
        $pasien = [];

        for ($i=1; $i <= 12; $i++) {
            $temp = [];
            $temp_start = $start->copy();
            $temp_end = $start->copy()->endOfMonth();
            $temp['date'] = $start->format('m-Y');
            $temp['value'] = Pasien::whereBetween('created_at',[$temp_start,$temp_end])->count();
            $start->addMonth();
            array_push($pasien, $temp);
        }


        return json_encode($pasien);
    }

    public function pasienLamaBaru()
    {
        $begin = microtime(true);
        $day = Carbon::today();
        $pasienId = [];
        $urj = TransaksiRawatJalan::select('pasien_id')->whereDate('created_at', $day)->get();
        foreach ($urj as $value) {
            array_push($pasienId, $value->pasien_id);
        }
        //dd($pasienId);
        $igd = TransaksiIGD::select('pasien_id')->whereDate('created_at', $day)->get();                    
        foreach ($igd as $value) {
            array_push($pasienId, $value->pasien_id);
        }
        $inap = TransaksiRawatInap::select('pasien_id')->whereDate('created_at', $day)->get();                    
        foreach ($inap as $value) {
            array_push($pasienId, $value->pasien_id);
        }
        //dd($pasienId);
        if (count($pasienId)) {
            $baru = Pasien::whereIn('id', $pasienId)
                        ->whereDate('created_at', $day)->count();
            $data['baru'] = $baru;
            $data['lama'] = sizeof($pasienId) - $baru;
        }else{
            $data['baru'] = 0;
            $data['lama'] = 0;
        }
                $time = microtime(true)-$begin;
        var_dump("lamaBaru : ${time}");
        return $data;
    }

    public function statistikLamaBaru()
    {
        $igd = TransaksiIGD::select(DB::raw('is_pasien_baru, count(1) as jumlah'))->groupBy('is_pasien_baru')->get();
        $jalan = TransaksiRawatJalan::select(DB::raw('is_pasien_baru, count(1) as jumlah'))->groupBy('is_pasien_baru')->get();

        $transaksiLama = [
            [
                'jenis' => 'Departemen IGD',
                'jumlah' => $igd[0]->jumlah
            ],
            [
                'jenis' => 'Rawat Jalan',
                'jumlah' => $jalan[0]->jumlah
            ]
        ];

        $igdBaru = (!empty($igd[1])) ? $igd[1]->jumlah : 0 ;
        $jalanBaru = (!empty($jalan[1])) ? $jalan[1]->jumlah : 0 ;
        $transaksiBaru = [
            [
                'jenis' => 'Departemen IGD',
                'jumlah' => $igdBaru
            ],
            [
                'jenis' => 'Rawat Jalan',
                'jumlah' => $jalanBaru
            ]
        ];
        return json_encode([
            'lama' => $transaksiLama,
            'baru' => $transaksiBaru
        ]);
    }

    public function metode($id)
    {
        $data=PasienPembayaran::with(['perusahaan','perusahaan.tipe','kelas'])->whereNotNull('kelas_id')->where('pasien_id',$id)->get();
        return $data;
    }

    public function APIsinglePembayaran($id)
    {
        $data=PasienPembayaran::with(['perusahaan','perusahaan.tipe','kelas'])->where('id',$id)->first();
        return json_encode($data);
    }

    public function listRujukan()
    {
        $data=AsalRujukan::all();
        return $data;
    }

    public function getSingle($id)
    {
        $data = Pasien::find($id);
        return $data;
    }

    public function APIcheckNomor(Request $request)
    {
        $nomor = $request->input('no_identitas');
        $jenis = $request->input('jenis_kartu');
        $data = Pasien::with(['jenis_identitas'])
                        ->where('no_identitas',$nomor)
                        ->where('jenis_kartu_identitas_id',$jenis)
                        ->get();
        foreach ($data as $item) {
            $item->age = $item->age;
            $item->jenis_kartu_identitas = $item->jenis_identitas->nama;
            $item->no_rm_formatted = $item->no_rm_formatted;
        }
        return json_encode($data);
    }

    public function APIcheckPembayaran(Request $request)
    {
        $perusahaan = $request->perusahaan;
        $nomor =  $request->no_asuransi;
        $pasien_id =  $request->pasien_id;

        if(empty($pasien_id))
            $data = PasienPembayaran::with(['pasien', 'perusahaan'])->where('no_asuransi',$nomor)->where('perusahaan_id',$perusahaan)->get();
        else
            $data = PasienPembayaran::with(['pasien', 'perusahaan'])->where('pasien_id','!=',$pasien_id)->where('no_asuransi',$nomor)->where('perusahaan_id',$perusahaan)->get();
        foreach ($data as $item) {
            $item->perusahaan_tipe = $item->perusahaan;

            $item->data_pasien = $item->pasien;
            $item->data_pasien->age = $item->pasien->age;
            $item->data_pasien->no_rm_formatted = $item->pasien->no_rm_formatted;
        }
        return json_encode($data);
    }

    public function APIcheckNama(Request $request)
    {
        $nama=$request->input('nama');
        //dd($nomor);
        $data=Pasien::where('name',$nama)->first();
        return json_encode($data);
    }
    public function getmorbiditasrawatjalan($range1,$range2)
    {
       //$range1 = Carbon::createFromFormat('d m Y', $range1)->toDateTimeString();
              // dd($range1,$range2);
        $range1= Carbon::parse($range1)->format('Y-m-d');
        $range2= Carbon::parse($range2)->format('Y-m-d');
        $countmorbiditas = array();
        //dd($range1,$range2);
        $diagnosis1 = Diagnosis::whereBetween('created_at',[$range1,$range2])->get();
        foreach($diagnosis1 as $data1)
        {
        $diagnosis = Diagnosis::where('icd_10',$data1->icd_10)->whereBetween('created_at',[$range1,$range2])->get();
        dd($diagnosis);

        foreach($diagnosis as $data)
        {
        $ttl= Carbon::createFromFormat('Y-m-d', $data->kasus->pasien->date_of_birth);

        $interval = date_diff($data->kasus->created_at, $ttl);
        $year = $interval->format("%Y");
        $month = $interval->format("%M");
        $day = $interval->format("%d");
        if($year == 0)
        {
            if($month==0)
            {
                if($day<7)
                {

                    if(empty($countmorbiditas[$data1->icd_10->id][$data->kasus->pasien->gender]['<7hari']))
                    {
                    $countmorbiditas[$data1->icd_10->id][$data->kasus->pasien->gender]['<7hari']  =1;
                    dd($countmorbiditas);

                    }
                    else
                    {
                    $countmorbiditas[$data1->icd_10->id][$data->kasus->pasien->gender]['<7hari']  +=1;
                    dd($countmorbiditas);

                    }


                }
            }
        }
        dd($interval->format("You are  %Y Year, %M Months, %d Days, %H Hours, %i Minutes, %s Seconds Old"));
        }
    }

    }
    
    public function getsepuluhbesarrawatjalan($range1,$range2)
    {
       //$range1 = Carbon::createFromFormat('d m Y', $range1)->toDateTimeString();
              // dd($range1,$range2);
        $range1= Carbon::parse($range1)->format('Y-m-d');
        $range2= Carbon::parse($range2)->format('Y-m-d');
        $countmorbiditas = array();
        //dd($range1,$range2);
        $diagnosis1 = Diagnosis::whereBetween('created_at',[$range1,$range2])->get();
        dd($diagnosis1);
        foreach($diagnosis1 as $data1)
        {

            dd($data1);
            $diagnosis = Diagnosis::where('icd_10',$data1->icd_10)->whereBetween('created_at',[$range1,$range2])->first();

        }

    }

    public function APIGetKasus($id)
    {
        $kasus = Kasus::where('pasien_id',$id)->whereNull('krs_at')->get();
        $cases = [];
        foreach($kasus as $item)
        {
            $temp = new \StdClass();
            $temp->id = $item->id;
            $temp->judul_kasus = $item->judul_kasus;
            $temp->lokasi = $item->lokasi->lokasi->nama;
            $temp->kelas = $item->kelas->nama ?? '-';
            $temp->kelas_id = $item->kelas_id;
            $temp->tarif_kelas = $item->kelas->id ?? '-';
            $temp->active_sep = $item->active_sep->no_sep ?? '';
            $cases[] = $temp;
        }

        return json_encode($cases);
    }

    public function APIGetKasusWithKRS($id)
    {
        $kasus = Kasus::where('pasien_id',$id)->orderBy('created_at','desc')->get();
        $cases = [];
        foreach($kasus as $item)
        {
            $temp = new \StdClass();
            $temp->id = $item->id;
            $temp->nomor_kasus = $item->nomor_kasus;
            $temp->judul_kasus = $item->judul_kasus;
            $temp->lokasi = $item->lokasi->lokasi->nama;
            $temp->kelas = $item->kelas->nama;
            $temp->kelas_id = $item->kelas_id;
            $temp->created_at = $item->created_at;
            $temp->krs_at = $item->krs_at;
            $temp->waktu_create = $item->created_at->format('d/m/Y');
            $temp->status_krs = ($item->krs_at ? 1 : 0);
            $temp->status_krs_text = ($item->krs_at ? 'Telah KRS' : '');
            $cases[] = $temp;
        }

        return json_encode($cases);
    }

    public function APIGetPasien(Request $req)
    {
        app('debugbar')->disable();
        $pasien = Pasien::where('no_rm',$req['no_rm'])
                        ->where('date_of_birth',$req['tanggal_lahir'])->first();

        return json_encode($pasien);
    }

    public function APIGetPasienPembayaran(Request $req)
    {
        app('debugbar')->disable();
        $pasien = Pasien::with(['pembayaran.perusahaan.tipe', 'pembayaran.kelas'])
                        ->where('no_rm',$req['no_rm'])
                        ->where('date_of_birth',$req['tanggal_lahir'])->first();
        if($pasien){
            $rujukan = [];
            return json_encode([
                "pembayaran" => $pasien->pembayaran, 
                "rujukan" => $rujukan
            ]);
        }
        else
            return json_encode([]);
    }

    public function APIGetPembayaranUtama(Request $req)
    {
        app('debugbar')->disable();
        $pasien_id = $req->pasien_id;
        return json_encode(Pasien::with('pembayaranUtama')->find($pasien_id)->pembayaranUtama);
    }

    function getDaftarOnline(Request $request){
        $start = $request->get('start');
        $length = $request->get('length');
        $draw = $request->get('draw');

        if(empty($request->start_date)) $start_date = Carbon::now()->startOfDay();
        else $start_date = Carbon::createFromFormat('d/m/Y', $request->start_date)->startOfDay();
        if(empty($request->end_date)) $end_date = Carbon::now()->endOfDay();
        else $end_date = Carbon::createFromFormat('d/m/Y', $request->end_date)->endOfDay();

        $transaksi = TransaksiRawatJalan::with(['pasien', 'dokter', 'poliklinik', 'pasien_pembayaran.perusahaan.tipe', 'piutang_online_tunai']);

        $transaksi = $transaksi->whereBetween('ordered_at', [$start_date, $end_date])->where('is_online', 1)->where('status','!=', -1)->orderBy('ordered_at', 'desc');
        if ($request->poliklinik != 'all') {
            $transaksi = $transaksi->join('poliklinik', function ($join) use($request)
            {
                $join->on('poliklinik.id', '=', 'transaksi.poliklinik_id');
                $join->where('poliklinik.id', $request->poliklinik);
            })
                ->select(
                    'transaksi.*'
                );
        }
        if($request->dokter != 'all') {
            $transaksi = $transaksi->join('dokter', function ($join) use($request)
            {
                $join->on('dokter.id', '=', 'transaksi.dokter_id');
                $join->where('dokter.id', $request->dokter);
            })
                ->select(
                    'transaksi.*'
                );
        }

        $transaksi = $transaksi->with([
            'pasien',
            'dokter',
            'poliklinik'
        ]);

        return $transaksi;
    }

    function getDaftarOnlineBatal(Request $request){
        if(empty($request->start_date)) $start_date = Carbon::now()->startOfDay();
        else $start_date = Carbon::createFromFormat('d/m/Y', $request->start_date)->startOfDay();
        if(empty($request->end_date)) $end_date = Carbon::now()->endOfDay();
        else $end_date = Carbon::createFromFormat('d/m/Y', $request->end_date)->endOfDay();

        $transaksi = TransaksiRawatJalan::with(['pasien', 'dokter', 'poliklinik', 'pasien_pembayaran.perusahaan.tipe', 'piutang_online_tunai']);

        $transaksi = $transaksi->whereBetween('cancel_at', [$start_date, $end_date])->where('is_online', 1)->orderBy('cancel_at', 'desc');

        if ($request->poliklinik != 'all') {
            $transaksi = $transaksi->join('poliklinik', function ($join) use($request)
            {
                $join->on('poliklinik.id', '=', 'transaksi.poliklinik_id');
                $join->where('poliklinik.id', $request->poliklinik);
            })
                ->select(
                    'transaksi.*'
                );
        }
        if($request->dokter != 'all') {
            $transaksi = $transaksi->join('dokter', function ($join) use($request)
            {
                $join->on('dokter.id', '=', 'transaksi.dokter_id');
                $join->where('dokter.id', $request->dokter);
            })
                ->select(
                    'transaksi.*'
                );
        }

        $transaksi = $transaksi->with([
            'pasien',
            'dokter',
            'poliklinik'
        ]);

        return $transaksi;
    }

    public function getPasienOnline($data)
    {
        $start_date = null;
        $end_date = null;

        if ($data->start_date != Null) {
            $start_date = Carbon::createFromFormat('d/m/Y', $data->start_date)->startOfDay();
        }
        if ($data->end_date != Null) {
            $end_date = Carbon::createFromFormat('d/m/Y', $data->end_date)->endOfDay();
        }
        
        $pasien = Pasien::select('id', 'no_rm', 'name', 'no_identitas', 'is_jkn', 'is_konfirmasi', 'date_of_birth')
                ->where('is_jkn', '=', 1)
                ->whereBetween('created_at', [$start_date, $end_date]);

        return $pasien;
    }

    public function metodePembayaran($transaksi)
    {
        $data = PasienPembayaran::with(['perusahaan','perusahaan.tipe','kelas'])->whereNotNull('kelas_id')->where('pasien_id',$transaksi->pasien->id)->get();
        return $data;
    }

    public function downloadBerkas(Request $request)
    {
        $base_path = public_path('/');
        $file_name = $request->filename;
        $file_rename = $request->file_rename;
        $file_extention = explode('.', $file_name);
        $file_extention = end($file_extention);
        $file_rename = $file_rename.'.'.$file_extention;
        $path= $base_path.$file_name;
        if (file_exists($path)) {
            return response()->download($path, $file_rename);
        }
        return abort(404);
    }
    
    public function getSingleByNik($nik)
    {
        return Pasien::where('no_identitas', $nik)->first();
    }

    private function filterHistoryKunjungan($dokter, $lokasi, $kunjungan) {
        if ($dokter && $lokasi && $lokasi != "Semua") {
            $data = array_filter($kunjungan, function($item) use ($dokter, $lokasi){
                if (isset($item->dokter_id)){
                    return in_array($item->dokter_id, $dokter) && $item->lokasi == $lokasi;
                } else {
                    return 0;
                }
            });
        } else if ($dokter) {
            $data = array_filter($kunjungan, function($item) use ($dokter){
                return isset($item->dokter_id) ? in_array($item->dokter_id, $dokter) : 0;
            });
        } else if ($lokasi && $lokasi != "Semua") {
            $data = array_filter($kunjungan, function($item) use ($lokasi){
                return $item->lokasi == $lokasi;
            });
        } else {
            $data = $kunjungan;
        }

        return $data;
    }

    public function getByRmTanggalLahir($rm, $tgl_lahir)
    {
        $pasien = Pasien::where('no_rm', $rm)->where('date_of_birth', $tgl_lahir)->first();
        return $pasien;
    }
}
