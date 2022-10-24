<?php

namespace App\Http\Controllers\Keuangan\Piutang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatInap\Bangsal;
use App\Models\Keuangan\Kategori;
use App\Models\Keuangan\Piutang;
use App\Models\Keuangan\PiutangDetail;
use App\Models\Hospital\Lokasi;
use App\Models\Hospital\LokasiDepartemen;
use App\Models\Hospital\Kelas;
use App\Models\Keuangan\Perusahaan;
use App\Models\Keuangan\Pemasukan;
use App\Models\Keuangan\PaketPenagihan;
use App\Models\Keuangan\Deposit;
use App\Models\Keuangan\TarifTipe;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\Akun;
use App\Models\Kasus\Kolaborator;
use App\Models\Kasus\BPJSSEP;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\PembayaranPerusahaanType;
use App\Models\Pasien\PembayaranPerusahaan;
use App\Models\KamarOperasi\Transaksi as OperasiTransaksi;
use App\Models\KamarOperasi\Tim as OperasiTim;
use App\Models\KamarOperasi\PeranTim as OperasiPeranTim;
use App\Models\Farmasi\Resep;
use App\Models\Farmasi\ResepDetail;
use App\Models\Keuangan\TTD;
use App\Models\Farmasi\TransaksiObat;
use App\Models\Gudang\ItemsTemplate;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\AlatBantu;
use App\Models\Kasus\Penunjang;
use App\User;
use Carbon\Carbon;
use DB;
use MPDF;
use DOMPDF;
use Auth;
use PdfMerger;

class ViewController extends Controller
{
    static protected $penunjang_radio_type = "radiologi";
    static protected $penunjang_pa_type = "labpa";
    static protected $penunjang_pk_type = "labpk";
    static protected $penunjang_pdf_type = "pdf";

    public function index()
    {
        $data['sidebar_active'] = "piutang";
        $today = Carbon::today();
        $data['today'] = $today;
        $data['piutang_num'] = Piutang::where('tanggal_transaksi','>',$today)->count();
        $data['piutang_total'] = Piutang::where('tanggal_transaksi','>',$today)->sum('total');
        $data['perusahaan'] = Perusahaan::all();
        $data['rawat_inap'] = config('const.rawat_inap');
        $data['rawat_jalan'] = config('const.rawat_jalan');
        $data['akun'] = Akun::get();

        $departemen_rj = LokasiDepartemen::whereIn('slug',['igd','rawat-jalan'])->pluck('id')->toArray();
        $departemen_ri = LokasiDepartemen::whereIn('slug',['rawat-inap'])->pluck('id')->toArray();

        $lokasi_rj = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['igd','rawat-jalan']);
        $lokasi_ri = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['rawat-inap']);

        $data['lokasi_rj'] = $lokasi_rj;
        $data['lokasi_ri'] = $lokasi_ri;

        return view('keuangan.piutang.index',$data);
    }

    public function create()
    {
        $data['kategori'] = Kategori::where('type',1)->get();
        $data['lokasi'] = Lokasi::all();
        $data['kelas'] = Kelas::all();
        $data['tipe'] = TarifTipe::all();
        $data['perusahaan'] = Perusahaan::all();
        $data['sidebar_active'] = "piutang";
        return view('keuangan.piutang.create',$data);
    }

    public function single($id)
    {
        $data['piutang'] = Piutang::with(['detail','detail.tipe','detail.kelas','sister','kasusTagihanSister','kasusTagihanSister.perusahaan','pasienPembayaran.perusahaan.tipe'])->find($id);
        $data['sidebar_active'] = "piutang";
        $data['perusahaan'] = Perusahaan::all();
        $tipe_tunai = PembayaranPerusahaanType::where('slug','tunai')->first();
        $perusahaan_pasien = PembayaranPerusahaan::where('type',$tipe_tunai->id)->first();
        $data['perusahaan_tunai'] = Perusahaan::find($perusahaan_pasien->perusahaan_keuangan_id);
        $data['pembayaran'] = PasienPembayaran::with(['perusahaan','perusahaan.tipe','kelas'])->where('pasien_id', $data['piutang']->pasien_id)->get();
        $data['deposit'] = Deposit::where('pasien_id',$data['piutang']->pasien_id)->first();
        $piutang_detail = PiutangDetail::where('piutang_id',$id)->with('tipe','kelas','creator')->orderBy('created_at','desc')->get();

        $current_time = Carbon::minValue();
        $piutang_details = [];
        $kategori_custom = app('App\Http\Controllers\Keuangan\Kategori\ReadController')->getKategoriCustom();

        foreach($piutang_detail as $item)
        {
            $key = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($item->created_at, '%d %B %Y');
            if(in_array($item->kategori_id, $kategori_custom['tindakan'])) $key2 = 'Tindakan';
            elseif(in_array($item->kategori_id, $kategori_custom['penunjang'])) $key2 = 'Penunjang';
            elseif(in_array($item->kategori_id, $kategori_custom['farmasi'])) $key2 = 'Farmasi';
            else  $key2 = 'Lain lain';

            $piutang_details[$key][$key2][] = $item;
        }

        $rekap = [];
        foreach ($kategori_custom as $key => $item) {
            $rekap[$key] = PiutangDetail::where('piutang_id',$id)
                            ->whereIn('kategori_id',$item)->sum('subtotal');
        }
        $data['rekap'] = $rekap;
        $data['piutang_details'] = $piutang_details;
        $data['inacbg'] = app('App\Http\Controllers\Keuangan\Piutang\ReadController')->getPiutangByKategoriInacbg($data['piutang']);

        return view('keuangan.piutang.single',$data);
    }

    public function printInacbg($id)
    {
        $data['piutang'] = Piutang::with(['detail','detail.tipe','detail.kelas','sister','kasusTagihanSister','kasusTagihanSister.perusahaan','pasienPembayaran.perusahaan.tipe'])->find($id);
        $data['inacbg'] = app('App\Http\Controllers\Keuangan\Piutang\ReadController')->getPiutangByKategoriInacbg($data['piutang']);
        $customPaper = array(0,0,432,792);
        $pdf = DOMPDF::loadView('keuangan.piutang.print-inacbg',$data)->setPaper($customPaper);
        return $pdf->stream('perincian-biaya.pdf');
    }

    public function printSingle($id)
    {
        $data['piutang'] = Piutang::find($id);
        $data['sidebar_active'] = "piutang";
        $data['tanggal'] = app('App\Http\Controllers\Functions\DateFormatter')->dateNow('%d %B %Y');
        $data['bulan'] = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman(Carbon::now()->format('m'));
        $data['nama_kasir'] = Auth::user()->name;
        
        $data['banyaknya_uang'] = app('App\Http\Controllers\Functions\SpellMoney')->spellMoney($data['piutang']->total);

        $customPaper = array(0,0,432,792);
        
        $piutang_details = [];
        $piutang_subtotal = [];

        $kategori_custom = app('App\Http\Controllers\Keuangan\Kategori\ReadController')->getKategoriCustom();
        foreach($data['piutang']->detail as $item)
        {
            $key = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($item->created_at, '%d %B %Y');

            if(in_array($item->kategori_id, $kategori_custom['tindakan'])) $key2 = 'Tindakan';
            elseif(in_array($item->kategori_id, $kategori_custom['penunjang'])) $key2 = 'Penunjang';
            elseif(in_array($item->kategori_id, $kategori_custom['farmasi'])) $key2 = 'Farmasi';
            else  $key2 = 'Lain lain';



            $piutang_details[$key2][$key][] = $item;
            if (empty($piutang_subtotal[$key2])) {
                $piutang_subtotal[$key2] = $item->subtotal;
            } else {
                $piutang_subtotal[$key2] += $item->subtotal;
            }
            
        }
        $data['piutang_details'] = $piutang_details;
        $data['piutang_subtotal'] = $piutang_subtotal;


        $pdf = MPDF::loadView('keuangan.piutang.print-nota-pasien',$data);


        return $pdf->stream('perincian-biaya.pdf');
    }

    public function printKlaim($id)
    {
        $data['piutang'] = Piutang::find($id);
        $data['sidebar_active'] = "piutang";
        $data['tanggal'] = app('App\Http\Controllers\Functions\DateFormatter')->dateNow('%d %B %Y');
        $data['bulan'] = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman(Carbon::now()->format('m'));
        $data['nama_kasir'] = Auth::user()->name;
        
        $data['banyaknya_uang'] = app('App\Http\Controllers\Functions\SpellMoney')->spellMoney($data['piutang']->total);

        $customPaper = array(0,0,432,792);
        
        $piutang_details = [];
        $piutang_subtotal = [];

        $kategori_custom = app('App\Http\Controllers\Keuangan\Kategori\ReadController')->getKategoriCustom();
        foreach($data['piutang']->detail as $item)
        {
            $key = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($item->created_at, '%d %B %Y');

            if(in_array($item->kategori_id, $kategori_custom['tindakan'])) $key2 = 'Tindakan';
            elseif(in_array($item->kategori_id, $kategori_custom['penunjang'])) $key2 = 'Penunjang';
            elseif(in_array($item->kategori_id, $kategori_custom['farmasi'])) $key2 = 'Farmasi';
            else  $key2 = 'Lain lain';



            $piutang_details[$key][$key2][] = $item;
            if (empty($piutang_subtotal[$key2])) {
                $piutang_subtotal[$key2] = $item->subtotal;
            } else {
                $piutang_subtotal[$key2] += $item->subtotal;
            }
            
        }
        $data['piutang_details'] = $piutang_details;
        $data['piutang_subtotal'] = $piutang_subtotal;


        $pdf = MPDF::loadView('keuangan.piutang.print-nota-klaim',$data);


        return $pdf->stream('perincian-biaya.pdf');
    }

    public function printRekap($id)
    {
        $data['piutang'] = Piutang::with(['detail.tarif.master', 'pasien', 'pasien.alamat_kecamatan', 'pasien.alamat_kota', 'kasusTagihan.kasus.lokasi.lokasi'])->find($id);
        $data['tanggal'] = app('App\Http\Controllers\Functions\DateFormatter')->dateNow('%d %B %Y');
        $data['bulan'] = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman(Carbon::now()->format('m'));
        $data['nama_kasir'] = Auth::user()->name;
        $piutang_detail = PiutangDetail::where('piutang_id',$id)->with('tipe')->orderBy('created_at','desc')->get();
        $data['banyaknya_uang'] = app('App\Http\Controllers\Functions\SpellMoney')->spellMoney($data['piutang']->total);

        $current_time = Carbon::minValue();
        $piutang_details = [];
        $piutang_subtotal = [];
        foreach($piutang_detail as $item)
        {
            if(in_array($item->kategori_id, [50,52,53,54,55,56,57,58,59,60,61,62,63,64,65,71])) $key2 = 'Tindakan';
            elseif(in_array($item->kategori_id, [66,67,68,69,70])) $key2 = 'Penunjang';
            elseif(in_array($item->kategori_id, [72,73,74,75])) $key2 = 'Farmasi';
            else  $key2 = 'Lain lain';
            $tipe = $item->tipe->nama ?? '-';
            $kelas = $item->kelas->nama ?? '-';
            $title = $item->deskripsi.'('.$tipe.'- Kelas'.$kelas.')';

            if(empty($piutang_details[$key2][$title])) $piutang_details[$key2][$title] = $item;
            else{
                $piutang_details[$key2][$title]->jumlah+= $item->jumlah;
                $piutang_details[$key2][$title]->subtotal+= $item->subtotal;
            }


            if (empty($piutang_subtotal[$key2])) {
                $piutang_subtotal[$key2] = $item->subtotal;
            } else {
                $piutang_subtotal[$key2] += $item->subtotal;
            }
            
        }
        $data['piutang_details'] = $piutang_details;
        $data['piutang_subtotal'] = $piutang_subtotal;

        $customPaper = array(0,0,432,792);
        $pdf = DOMPDF::loadView('keuangan.piutang.print-rekap',$data)->setPaper($customPaper);
        return $pdf->stream('Rekap Nota.pdf');
    }

    public function edit($id)
    {
        app('App\Http\Controllers\Keuangan\Piutang\EditController')->updateTotal($id);
        $data['kategori'] = Kategori::where('type',1)->get();
        $data['sidebar_active'] = "piutang";
        $data['piutang'] = Piutang::find($id);
        $data['kelas'] = Kelas::all();
        $data['perusahaan'] = Perusahaan::all();
        $data['tipe'] = TarifTipe::all();
        $data['pembayaran'] = PasienPembayaran::with(['perusahaan','perusahaan.tipe','kelas'])->where('pasien_id', $data['piutang']->pasien_id)->get();
        $data['lokasi'] = json_decode(app('App\Http\Controllers\Kasir\Transaksi\ReadController')->getLokasi());

        $piutang_detail = PiutangDetail::where('piutang_id',$id)->with('tipe','kelas','creator')->orderBy('created_at','asc')->get();
        $piutang_details = [];
        foreach($piutang_detail as $item)
        {
            $item->jumlah = str_replace(',', '.', $item->jumlah);
            $key = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($item->created_at, '%d %B %Y');

            $piutang_details[$key][] = $item;
        }

        $data['piutang_details'] = $piutang_details;
        
        return view('keuangan.piutang.edit',$data);
    }

    public function history()
    {
        $data['sidebar_active'] = "piutang";

        $data['perusahaan'] = Perusahaan::all();
        $data['rawat_inap'] = config('const.rawat_inap');
        $data['rawat_jalan'] = config('const.rawat_jalan');
        $data['akun'] = Akun::get();

        $departemen_rj = LokasiDepartemen::whereIn('slug',['igd','rawat-jalan'])->pluck('id')->toArray();
        $departemen_ri = LokasiDepartemen::whereIn('slug',['rawat-inap'])->pluck('id')->toArray();

        $lokasi_rj = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['igd','rawat-jalan']);
        $lokasi_ri = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['rawat-inap']);

        $data['lokasi_rj'] = $lokasi_rj;
        $data['lokasi_ri'] = $lokasi_ri;
        
        return view('keuangan.piutang.history',$data);
    }

public function rekapPenagihan(Request $request)
    {
        if($request->back_url == 'bpjs')
            $data['back_url'] = url('bpjs/piutang-asuransi');

        $data['sidebar_active'] = "piutang";
        $ids = $request->get('id');
        if(empty($ids)) abort(500,'ID Piutang Kosong');
        $array_id = explode(',', $ids);

        $piutang =   Piutang::whereIn('id',$array_id)
                            ->with([
                                'kasusTagihan.kasus.resume', 
                                'kasusTagihan.kasus',
                                'kasusTagihan.kasus.pembayaran.perusahaan.tipe', 
                                'kasusTagihan.detail', 
                                'kasusTagihan.detail.radiologi',
                                'kasusTagihan.detail.labpa', 
                                'kasusTagihan.detail.labpk', 
                                'kasusTagihan.permintaanJenazah.transaksi',
                                'kasusTagihan.ketKelahiran',
                                'kasusTagihan.kasus.sep',
                                'pasienPembayaran.perusahaan',
                                'kasusTagihan.kasus.alatBantu',
                            ])
                            ->get();
        $piutang = $piutang->sortBy('kasusTagihan.kasus.sep.no_sep')->values();
        // $resep = TransaksiObat::whereIn('kasus_id', $piutang->pluck('kasusTagihan.kasus.id'))->get();
        // $resep_detail =  ResepDetail::whereIn('resep_id',$resep->pluck('resep_final'))
        //                                 ->with('obat_detail')
        //                                 ->get();
        
        // $obat_fornas =  ItemsTemplate::whereIn('id',$resep_detail->pluck('obat_detail.item_template_id'))
        //                             ->whereHas('items_category.detail_kategori', function($query)       
        //                             {       
        //                                 $query->where('slug', 'fornas');       
        //                             })
        //                             ->get();

        // $resep_fornas =  $resep_detail->whereIn('obat_detail.item_template_id',$obat_fornas->pluck('id'));

        if($piutang[0]->pasienPembayaran->perusahaan->type == config('const.bpjs'))
            $bpjs = 1;
        else
            $non_bpjs = 1;

        foreach ($piutang as $each_piutang) {

            if (isset($each_piutang->kasusTagihan)) {
                $kasus_id = $each_piutang->kasusTagihan->kasus->id;

                // $resep_pasien = $resep->where('kasus_id',$kasus_id);

                // $each_piutang->obat_fornas = $resep_fornas->whereIn('resep_id',$resep_pasien->pluck('resep_final'));

            }else{
                // $each_piutang->obat_fornas = [];
            }

            //CEK APAKAH SEMUA BPJS ATAU SEMUA NON BPJS TIPE PEMBAYARANNYA
            if(isset($bpjs) && $each_piutang->pasienPembayaran->perusahaan->type != config('const.bpjs'))
                $bpjs = 0;
            else if(isset($non_bpjs) && $each_piutang->pasienPembayaran->perusahaan->type == config('const.bpjs'))
                $non_bpjs = 0;
        }

        // dd($piutang[8]->kasusTagihan->kasus->transaksiFarmasi[5]->final_detail->resep_detail);
        $perusahaan_ids = Piutang::whereIn('id',$array_id)->pluck('perusahaan_id')->toArray();
        $perusahaan = Perusahaan::whereIn('id',$perusahaan_ids)->get();

        $data['penagihan'] = PaketPenagihan::where('total_paid', 0)->get();
        $data['piutang'] = $piutang;
        $data['perusahaan'] = $perusahaan;
        $data['ids'] = $ids;
        $data['ttd'] = TTD::all();
        $data['akun'] = $request->akun;
        $data['origin'] = $request->origin;
        $data['valid_tagih'] = $bpjs ?? $non_bpjs;
        return view('keuangan.piutang.rekap-penagihan',$data);
    }

    public function printDaftarPenagihan(Request $request, $piutang = null)
    {
        $data['sidebar_active'] = "piutang";
        $ids = $request->get('id');
        if(empty($ids)) abort(500,'ID Piutang Kosong');
        $array_id = explode(',', $ids);

        $piutang = Piutang::whereIn('id',$array_id)->get();
        $perusahaan_ids = Piutang::whereIn('id',$array_id)->pluck('perusahaan_id')->toArray();
        $perusahaan = Perusahaan::whereIn('id',$perusahaan_ids)->get();

        $data['tanggal'] = app('App\Http\Controllers\Functions\DateFormatter')->dateNow('%d %B %Y');
        $data['piutang'] = $piutang;
        $data['perusahaan'] = $perusahaan;
        $data['ids'] = $ids;
        $data['ttd'] = TTD::find($request->ttd);

        $pdf = MPDF::loadView('keuangan.piutang.print-daftar-penagihan',$data);
        $filename ='print-daftar-penagihan.pdf';

        return $pdf->stream($filename);

    }

    public function printHasilUSG(Request $req, $downloadAll = null)
    {
        $ids = explode(',', $req->id);

        $tagihan_kasus_id = Piutang::select('id', 'kasus_tagihan_id')
                                    ->whereIn('id', $ids)
                                    ->with([
                                        'kasusTagihan:id,kasus_id',
                                    ])
                                    ->get()->pluck('kasusTagihan.kasus_id');
        
        $data = AlatBantu::whereIn('kasus_id', $tagihan_kasus_id)
                        ->where('type', 'permintaan-usg')
                         ->with([
                            'creator:id,name',
                            'kasus:id,pasien_id',
                            'kasus.pasien',
                            'kasus.diagnosis:id,kasus_id,icd_10',
                            'kasus.diagnosis.icd10:id,code_icd,long_desc',
                            'kasus.lokasi:id,kasus_id,lokasi_id,created_at',
                            'kasus.lokasi.lokasi:id,nama',
                          ])
                         ->get();

        $pdf = MPDF::loadView('keuangan.piutang.penagihan-print.print-hasil-usg',['data' => $data] , [], [
            'mode' => 'utf-8',
            // 'format' => 'a4-l'
        ]);
        $filename ='hasil-pemeriksaan-usg.pdf';
        if ($downloadAll != null) {
            $path = public_path("downloads/print/penagihan/");
            if(file_exists($path.$filename)) unlink($path.$filename);
            $pdf->save($path.$filename);
            return $filename;
        }
        return $pdf->stream($filename);

    }

    public function printSuratPengantar(Request $request)
    {
        $data['sidebar_active'] = "piutang";
        $ids = $request->get('id');
        if(empty($ids)) abort(500,'ID Piutang Kosong');
        $array_id = explode(',', $ids);

        $piutang = Piutang::whereIn('id',$array_id)->get();
        $perusahaan_ids = Piutang::whereIn('id',$array_id)->pluck('perusahaan_id')->toArray();
        $perusahaan = Perusahaan::whereIn('id',$perusahaan_ids)->get();

        $data['tanggal'] = app('App\Http\Controllers\Functions\DateFormatter')->dateNow('%d %B %Y');
        $data['bulan'] = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman(Carbon::now()->format('m'));
        $data['piutang'] = $piutang;
        $data['perusahaan'] = $perusahaan;
        $data['ids'] = $ids;
        $data['ttd'] = TTD::find($request->ttd);

        $pdf = MPDF::loadView('keuangan.piutang.print-surat-pengantar',$data);
        $filename ='surat-pengantar.pdf';

        return $pdf->stream($filename);

    }

    public function printPerincianBiaya(Request $request)
    {
        $data['sidebar_active'] = "piutang";
        $ids = $request->get('id');
        if(empty($ids)) abort(500,'ID Piutang Kosong');
        $array_id = explode(',', $ids);

        $piutang = Piutang::whereIn('id',$array_id)->get();
        $perusahaan_ids = Piutang::whereIn('id',$array_id)->pluck('perusahaan_id')->toArray();
        $perusahaan = Perusahaan::whereIn('id',$perusahaan_ids)->get();

        $piutang_new = [];
    
        foreach($piutang as $index => $item)
        {   
            $piutang_details = [];
            $piutang_subtotal = [];
            $kelas = $item->pasienPembayaran->kelas->id;
            $kelas_id = $kelas;
            foreach($item->detail as $detail)
            {
                if(in_array($detail->kategori_id, [50,52,53,54,55,56,57,58,59,60,61,62,63,64,65,71])) $key2 = 'Tindakan';
                elseif(in_array($detail->kategori_id, [66,67,68,69,70])) $key2 = 'Penunjang';
                elseif(in_array($detail->kategori_id, [72,73,74,75])) $key2 = 'Farmasi';
                else  $key2 = 'Lain lain';
                $title = $detail->deskripsi;

                if(empty($piutang_details[$key2][$title])) $piutang_details[$key2][$title] = $detail;
                else{
                    $piutang_details[$key2][$title]->jumlah+= $detail->jumlah;
                    $piutang_details[$key2][$title]->subtotal+= $detail->subtotal;
                }


                if (empty($piutang_subtotal[$key2])) {
                    $piutang_subtotal[$key2] = $detail->subtotal;
                } else {
                    $piutang_subtotal[$key2] += $detail->subtotal;
                }
            }
            $piutang_new[$index] = $detail;
            $piutang_new[$index]['detail'] = $piutang_details;
            $piutang_new[$index]['piutang_subtotal'] = $piutang_subtotal;

        }

        $data['tanggal'] = app('App\Http\Controllers\Functions\DateFormatter')->dateNow('%d %B %Y');
        $data['bulan'] = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman(Carbon::now()->format('m'));
        $data['piutang_new'] = $piutang_new;
        $data['perusahaan'] = $perusahaan;
        $data['ids'] = $ids;
        $data['ttd'] = TTD::find($request->ttd);

        $pdf = MPDF::loadView('keuangan.piutang.print-perincian-biaya-rekap', $data, [], [
            'mode' => 'utf-8',
            'format' => [150, 250]
        ]);
        $filename ='perincian-biaya.pdf';

        return $pdf->stream($filename);
    }


    public function printKwitansiSatuan(Request $request)
    {
        $data['sidebar_active'] = "piutang";
        $ids = $request->get('id');
        if(empty($ids)) abort(500,'ID Piutang Kosong');
        $array_id = explode(',', $ids);

        $piutang = Piutang::whereIn('id',$array_id)->get();
        $perusahaan_ids = Piutang::whereIn('id',$array_id)->pluck('perusahaan_id')->toArray();
        $perusahaan = Perusahaan::whereIn('id',$perusahaan_ids)->get();

        $data['tanggal'] = app('App\Http\Controllers\Functions\DateFormatter')->dateNow('%d %B %Y');
        $data['bulan'] = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman(Carbon::now()->format('m'));
        $data['piutang'] = $piutang;
        $data['perusahaan'] = $perusahaan;
        $data['ids'] = $ids;
        $data['ttd'] = TTD::find($request->ttd);

        $pdf = MPDF::loadView('keuangan.piutang.print-kwitansi-satuan', $data, [], [
            'mode' => 'utf-8',
            'format' => [220, 90]
        ]);
        $filename ='kwitansi-satuan.pdf';

        return $pdf->stream($filename);
    }


    public function printKwitansiTotal(Request $request)
    {
        $data['sidebar_active'] = "piutang";
        $ids = $request->get('id');
        if(empty($ids)) abort(500,'ID Piutang Kosong');
        $array_id = explode(',', $ids);

        $piutang = Piutang::whereIn('id',$array_id)->get();
        $perusahaan_ids = Piutang::whereIn('id',$array_id)->pluck('perusahaan_id')->toArray();
        $perusahaan = Perusahaan::whereIn('id',$perusahaan_ids)->get();

        $total = Piutang::whereIn('id',$array_id)->sum('total');

        $data['tanggal'] = app('App\Http\Controllers\Functions\DateFormatter')->dateNow('%d %B %Y');
        $data['bulan'] = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman(Carbon::now()->format('m'));
        $data['piutang'] = $piutang;
        $data['perusahaan'] = $perusahaan;
        $data['banyaknya_uang'] = app('App\Http\Controllers\Functions\SpellMoney')->spellMoney($total,4);
        $data['terbilang'] = $total;
        $data['ids'] = $ids;
        $data['ttd'] = TTD::find($request->ttd);

        $pdf = MPDF::loadView('keuangan.piutang.print-kwitansi-total', $data, [], [
            'mode' => 'utf-8',
            'format' => [220, 90]
        ]);
        $filename ='kwitansi-satuan.pdf';

        return $pdf->stream($filename);
    }

    public function printResumeMedis(Request $req)
    {
        \Blade::setEchoFormat('nl2br(e(%s))');
        $ids = explode(',', $req->id);
        $piutang = Piutang::whereIn('id', $ids)->with('kasusTagihan')->get();
        $tagihan = $piutang->map(function($item){
            return $item->kasusTagihan;
        });
        $result = [];
        foreach ($tagihan as $key => $val) {
            if(!is_null($val)){
                $kasus = $val->kasus;
                if(is_null($kasus->resume))
                    continue;
                $masuk = Carbon::createFromFormat('Y-m-d H:i:s', $kasus->created_at);
                if (!empty($kasus->krs_at)) {
                    $keluar = Carbon::createFromFormat('Y-m-d H:i:s', $kasus->krs_at);
                } else $keluar = null;
                $res['kasus'] = $kasus;
                $res['resume'] = $kasus->resume;
                $res['now'] = Carbon::now();
                if (empty($keluar)) {
                    $res['durasi'] = '-';
                } else $res['durasi'] = $masuk->diffInDays($keluar);
                $res['dpjp'] = Kolaborator::where('kasus_id',$kasus->id)->where('admin',1)->first();
                array_push($result, $res);
            }
        }
        $data['result'] = $result;
        $data['now'] = Carbon::now();
        $pdf = MPDF::loadView('keuangan.piutang.print-resume', $data);
        $filename = 'piutang-resume.pdf';
        return $pdf->stream($filename);
    }

    public function printLayananRanap(Request $req)
    {
        \Blade::setEchoFormat('nl2br(e(%s))');
        $ids = explode(',', $req->id);
        $piutang = Piutang::whereIn('id', $ids)->with('kasusTagihan.kasus')->get();
        $tagihan = $piutang->map(function($item){
            return $item->kasusTagihan;
        });
        $result = [];
        foreach ($tagihan as $key => $val) {
            if(!is_null($val)){
                $kasus = $val->kasus;
                $masuk = Carbon::createFromFormat('Y-m-d H:i:s', $kasus->created_at);
                if (!empty($kasus->krs_at)) {
                    $keluar = Carbon::createFromFormat('Y-m-d H:i:s', $kasus->krs_at);
                } else $keluar = null;
                $res['kasus'] = $kasus;
                array_push($result, $res);
            }
        }
        $data['kasus'] = $result;
        $data['now'] = Carbon::now();
        // return view('keuangan.piutang.penagihan-print.print-layanan-ranap', $data);
        $pdf = MPDF::loadView('keuangan.piutang.penagihan-print.print-layanan-ranap', $data);
        $filename = 'piutang-resume.pdf';
        return $pdf->stream($filename);
    }


    public function printSep(Request $req)
    {
        $ids = explode(',', $req->id);
        $piutang = Piutang::whereIn('id', $ids)->with('kasusTagihan.kasus')->get();
        $seps = $piutang->map(function($item){
            if(isset($item->kasusTagihan->kasus->active_sep))
            return $item->kasusTagihan->kasus->active_sep->no_sep;
        });

        $bpjses = BPJSSEP::whereIn('no_sep',$seps)->whereNotNull('no_sep')->where('no_sep', '!=', 0)->get();
        $bpjs_real = [];
        foreach ($bpjses as $key => $bpjs) {
            $bpjs_real[$key] = json_decode(app('App\Http\Controllers\BPJS\API\Sep\ReadController')->get($bpjs->no_sep));
            if($bpjs_real[$key]->metaData->code != 200) $bpjs_real[$key]=null;
            else $bpjs_real[$key] = $bpjs_real[$key]->response;
        }

        $customPaper = array(0,0,602,266);

        $data = [
                    'bpjses'=>$bpjses,
                    'bpjs_real' => $bpjs_real,
                ];
                // dd($data);
        $pdf = DOMPDF::loadView('keuangan.piutang.penagihan-print.print-sep',$data)->setPaper($customPaper);
        return $pdf->stream('print.pdf');
    }

    public function printOpname(Request $req)
    {

        $ids = explode(',', $req->id);
        $piutang = Piutang::whereIn('id', $ids)->with('kasusTagihan.kasus.rawat_inap_transaksi_first')->get();
        $kasus = $piutang->pluck('kasusTagihan.kasus');
        $transaksies = $kasus->pluck('rawat_inap_transaksi_first');

        $data['diagnosis'] = [];
        $data['kk'] = [];
        foreach ($transaksies as $key => $transaksi) {
            if(is_null($transaksi)){
                array_push($data['diagnosis'], '-');
                array_push($data['kk'], '-');
                continue;
            };

            $user = User::find($transaksi->created_by);

            if(!empty($transaksi->kasus->admin)) $dpjp = $transaksi->kasus->admin->user;
            else $dpjp = [];

            if($user->profesi == 1) $creator = $user;
            else $creator = [];

            array_push($data['diagnosis'], $transaksi->diagnosis);
            array_push($data['kk'], $transaksi->kepala_keluarga);
        }

        $data['kasus'] = $kasus;
        $data['dpjp'] = $dpjp;
        $data['creator'] = $creator;
        $data['transaksies'] = $transaksies;

        $filename = 'permintaan-opname.pdf';
        $pdf = DOMPDF::loadView('keuangan.piutang.penagihan-print.print-opname', $data, [])->setPaper('a4', 'portrait');
        return $pdf->stream($filename);
    }

    public function printHasilPenunjang(Request $req, $penunjang)
    {
        $ids = explode(',', $req->id);
        switch ($penunjang) {
            case 'radiologi':
                $pdf = $this->hasilRadiologi($ids);
                break;
            case 'labpa':
                $pdf = $this->hasilLabPA($ids);
                break;
            case 'labpk':
                $pdf = $this->hasilLabPK($ids);
                break;            
            default:
                # code...
                break;
        }
        $filename = 'piutang-hasil.pdf';
        if($pdf['type'] == "pdf")
            return $pdf['content']->stream($filename);    
        else
            return $pdf['content']->save($filename, "browser");
    }

    private function mergePDFPenunjang($additional_pdf, $fullpath)
    {
        $pdf_merger = PdfMerger::init();
        $pdf_merger->addPDF($fullpath, 'all');
        foreach($additional_pdf as $pdf){
            if(file_exists($pdf->file))
                $pdf_merger->addPDF($pdf->file, 'all');
        }
        $pdf_merger->merge();
        return $pdf_merger;
    }

    private function hasilRadiologi($ids)
    {
        $piutang = Piutang::whereIn('id', $ids)->with('kasusTagihan.detail.radiologi', 'kasusTagihan.kasus.identitas', 'pasien',
                    'pasien.tni_pangkat', 'pasien.tni_kotama', 'pasien.tni_satker', 
                    'kasusTagihan.detail.radiologi.transaction.pemeriksa', 'kasusTagihan.kasus')->get();
        
        $kasus_ids = [];
        $tagihan = $piutang->map(function($item) use(&$kasus_ids){
            array_push($kasus_ids, $item->kasusTagihan->kasus_id);
            return $item->kasusTagihan;
        });
        $result = [];
        foreach ($tagihan as $key => $val) {
            if(!is_null($val)){
                foreach($val->detail as $det){
                    if(!is_null($det) && !is_null($det->radiologi)){
                        $kasus = $val->kasus;
                        $data['dpjp'] = Kolaborator::where('kasus_id',$kasus->id)->where('admin',1)->first();
                        $data['transaksi'] = $det->radiologi->transaction;
                        $data['hasil'] = $det->radiologi;
                        $data['kasus'] = $kasus; 
                        array_push($result, (object)$data);
                    }
                }
            }
        }
        $data['result'] = $result;
        $data['now'] = Carbon::now();
        $additional_pdf = Penunjang::select('kasus_id', 'file')->whereIn('kasus_id', $kasus_ids)->where('type', self::$penunjang_radio_type)
                            ->where('file', 'LIKE', '%.pdf')->orderBy('kasus_id')->get();
        if(count($additional_pdf) > 0){
            $path = public_path('downloads/print/penagihan/temp/');
            if(!file_exists($path))
                    mkdir($path, 0777, true);
            $fullpath = $path."radiologi_".implode(',', $ids).".pdf";
            DOMPDF::loadView('keuangan.piutang.penagihan-print.penunjang.hasil-radiologi', $data)->save($fullpath);
            $pdf_merger = $this->mergePDFPenunjang($additional_pdf, $fullpath);
            return [
                    'content' => $pdf_merger,
                    'type' => 'merger'];
        } else {
            return [
                    'content' => DOMPDF::loadView('keuangan.piutang.penagihan-print.penunjang.hasil-radiologi', $data),
                    'type' => 'pdf'];
        }
        
    }

    private function hasilLabPA($ids)
    {
        $piutang = Piutang::whereIn('id', $ids)->with('kasusTagihan.detail.labpa', 'kasusTagihan.kasus.identitas', 'pasien',
                    'pasien.tni_pangkat', 'pasien.tni_kotama', 'pasien.tni_satker', 
                    'kasusTagihan.detail.labpa.transaction.pemeriksa', 'kasusTagihan.kasus')->get();
                $kasus_ids = [];
        $tagihan = $piutang->map(function($item) use(&$kasus_ids){
            array_push($kasus_ids, $item->kasusTagihan->kasus_id);
            return $item->kasusTagihan;
        });

        $result = [];
        // dd($tagihan);
        foreach ($tagihan as $key => $val) {
            if(!is_null($val) && !empty($val->detail)){
                foreach($val->detail as $det){
                    if(!is_null($det) && !is_null($det->labpa)){
                        $kasus = $val->kasus;
                        $data['dpjp'] = Kolaborator::where('kasus_id',$kasus->id)->where('admin',1)->first();
                        $data['transaksi'] = $det->labpa->transaction;
                        $data['hasil'] = $det->labpa;
                        $data['kasus'] = $kasus; 
                        array_push($result, (object)$data);
                    }
                }
            }
        }
        $data['result'] = $result;
        $data['now'] = Carbon::now();
        $additional_pdf = Penunjang::select('kasus_id', 'file')->whereIn('kasus_id', $kasus_ids)->where('type', self::$penunjang_pa_type)
                            ->where('file', 'LIKE', '%.pdf')->orderBy('kasus_id')->get();
        if(count($additional_pdf) > 0){
            $path = public_path('downloads/print/penagihan/temp/');
            if(!file_exists($path))
                    mkdir($path, 0777, true);
            $fullpath = $path."labpa_".implode(',', $ids).".pdf";
            DOMPDF::loadView('keuangan.piutang.penagihan-print.penunjang.hasil-labpa', $data)->save($fullpath);
            $pdf_merger = $this->mergePDFPenunjang($additional_pdf, $fullpath);
            return [
                    'content' => $pdf_merger,
                    'type' => 'merger'];
        } else {
            return [
                    'content' => DOMPDF::loadView('keuangan.piutang.penagihan-print.penunjang.hasil-labpa', $data),
                    'type' => 'pdf'];
        }
    }

    private function hasilLabPK($ids)
    {
        $piutang = Piutang::whereIn('id', $ids)->with('kasusTagihan.detail.labpk', 'kasusTagihan.kasus.identitas', 'pasien',
                    'pasien.tni_pangkat', 'pasien.tni_kotama', 'pasien.tni_satker', 
                    'kasusTagihan.detail.labpk.transaksi', 'kasusTagihan.detail.labpk.transaksi.hasil', 'kasusTagihan.kasus')->get();
                $kasus_ids = [];
        $tagihan = $piutang->map(function($item) use(&$kasus_ids){
            array_push($kasus_ids, $item->kasusTagihan->kasus_id);
            return $item->kasusTagihan;
        });

        $result = [];
        $temp_lis = [];
        $transaksi_done = [];

        foreach ($tagihan as $key => $val) {
            if(!is_null($val)){
                foreach($val->detail as $det){
                    if(!is_null($det) && !is_null($det->labpk)){
                        $kasus = $val->kasus;
                        $transaksi = $det->labpk->transaksi;
                        $temp['dpjp'] = Kolaborator::where('kasus_id',$kasus->id)->where('admin',1)->first();
                        $temp['transaksi'] = $transaksi;
                        $temp['hasil'] = $det->labpk;
                        $temp['kasus'] = $kasus;
                        if(!in_array($transaksi->id, $transaksi_done))
                        {
                            foreach($transaksi->hasil as $h)
                            {
                                $hasil['konten'] = $this->transformLISResult($h->lis_result);
                                $hasil['hasil'] = $h;
                                $hasil['transaksi'] = $transaksi;
                                array_push($temp_lis, (object)$hasil);
                            }
                            array_push($transaksi_done, $transaksi->id);
                        }
                        // if(!is_null($temp['hasil']->lis_)){
                        //     $temp['result'] = $this->transformLISResult($temp['hasil']->lis_result); 
                        // }
                        array_push($result, (object)$temp);
                    }
                }
            }
        }

        $data['lis_result'] = $temp_lis;
        $data['result'] = $result;
        $data['now'] = Carbon::now();
        $additional_pdf = Penunjang::select('kasus_id', 'file')->whereIn('kasus_id', $kasus_ids)->where('type', self::$penunjang_pk_type)
                            ->where('file', 'LIKE', '%.pdf')->orderBy('kasus_id')->get();
        if(count($additional_pdf) > 0){
            $path = public_path('downloads/print/penagihan/temp/');
            if(!file_exists($path))
                    mkdir($path, 0777, true);
            $fullpath = $path."labpk_".implode(',', $ids).".pdf";
            DOMPDF::loadView('keuangan.piutang.penagihan-print.penunjang.hasil-labpk', $data)->save($fullpath);
            $pdf_merger = $this->mergePDFPenunjang($additional_pdf, $fullpath);
            return [
                    'content' => $pdf_merger,
                    'type' => 'merger'];
        } else {
            return [
                    'content' => DOMPDF::loadView('keuangan.piutang.penagihan-print.penunjang.hasil-labpk', $data),
                    'type' => 'pdf'];
        }
    }

    public function printFormulirPenunjang(Request $req, $penunjang)
    {
        $ids = explode(',', $req->id);
        switch ($penunjang) {
            case 'radiologi':
                $pdf = $this->formulirRadiologi($ids);
                break;
            case 'labpa':
                $pdf = $this->formulirLabPA($ids);
                break;
            case 'labpk':
                $pdf = $this->formulirLabPK($ids);
                break;
            default:
                # code...
                break;
        }
        $filename = 'piutang-formulir.pdf';
        if($pdf['type'] == "pdf")
            return $pdf['content']->stream($filename);    
        else
            return $pdf['content']->save($filename, "browser");
    }

    private function formulirRadiologi($ids)
    {
        $piutang = Piutang::whereIn('id', $ids)->with('kasusTagihan.detail.radiologi', 'kasusTagihan.kasus.identitas', 'pasien',
                    'pasien.tni_pangkat', 'pasien.tni_kotama', 'pasien.tni_satker', 
                    'kasusTagihan.detail.radiologi.transaction.pemeriksa', 'kasusTagihan.kasus')->get();
        $kasus_ids = [];
        $tagihan = $piutang->map(function($item) use(&$kasus_ids){
            array_push($kasus_ids, $item->kasusTagihan->kasus_id);
            return $item->kasusTagihan;
        });
        $result = [];
        foreach ($tagihan as $key => $val) {
            if(!is_null($val)){
                foreach($val->detail as $det){
                    if(!is_null($det) && isset($det->radiologi)){
                        $trans_id = $det->radiologi->transaction->id;
                        if(isset($result[$trans_id])){
                            array_push($result[$trans_id]['detail'], $det->radiologi);
                        } else {
                            $result[$trans_id]['transaksi'] = $det->radiologi->transaction;
                            $result[$trans_id]['detail'] = [$det->radiologi];                                                        
                        }
                    }
                }
            }
        }
        $data['result'] = $result;
        $data['now'] = Carbon::now();
        $data['departemen'] = "Radiologi";
        $additional_pdf = Penunjang::select('kasus_id', 'file')->whereIn('kasus_id', $kasus_ids)->where('type', self::$penunjang_radio_type)
                            ->where('file', 'LIKE', '%.pdf')->orderBy('kasus_id')->get();
        if(count($additional_pdf) > 0){
            $path = public_path('downloads/print/penagihan/temp/');
            if(!file_exists($path))
                    mkdir($path, 0777, true);
            $fullpath = $path."radiologi_".implode(',', $ids).".pdf";
            DOMPDF::loadView('keuangan.piutang.penagihan-print.penunjang.formulir', $data)->save($fullpath);
            $pdf_merger = $this->mergePDFPenunjang($additional_pdf, $fullpath);
            return [
                    'content' => $pdf_merger,
                    'type' => 'merger'];
        } else {
            return [
                    'content' => DOMPDF::loadView('keuangan.piutang.penagihan-print.penunjang.formulir', $data),
                    'type' => 'pdf'];
        }
    }
    
    private function formulirLabPA($ids)
    {
        $piutang = Piutang::whereIn('id', $ids)->with('kasusTagihan.detail.labpa', 'kasusTagihan.kasus.identitas', 'pasien',
                    'pasien.tni_pangkat', 'pasien.tni_kotama', 'pasien.tni_satker', 
                    'kasusTagihan.detail.labpa.transaction.pemeriksa', 'kasusTagihan.kasus')->get();
        $kasus_ids = [];
        $tagihan = $piutang->map(function($item) use(&$kasus_ids){
            array_push($kasus_ids, $item->kasusTagihan->kasus_id);
            return $item->kasusTagihan;
        });
        $result = [];
        foreach ($tagihan as $key => $val) {
            if(!is_null($val)){
                foreach($val->detail as $det){
                    if(!is_null($det) && isset($det->labpa)){
                        $trans_id = $det->labpa->transaction->id;
                        if(isset($result[$trans_id])){
                            array_push($result[$trans_id]['detail'], $det->labpa);
                        } else {
                            $result[$trans_id]['transaksi'] = $det->labpa->transaction;
                            $result[$trans_id]['detail'] = [$det->labpa];                                                        
                        }
                    }
                }
            }
        }
        $data['result'] = $result;
        $data['now'] = Carbon::now();
        $data['departemen'] = "LabPA";
        $additional_pdf = Penunjang::select('kasus_id', 'file')->whereIn('kasus_id', $kasus_ids)->where('type', self::$penunjang_pa_type)
                            ->where('file', 'LIKE', '%.pdf')->orderBy('kasus_id')->get();
        if(count($additional_pdf) > 0){
            $path = public_path('downloads/print/penagihan/temp/');
            if(!file_exists($path))
                    mkdir($path, 0777, true);
            $fullpath = $path."labpa_".implode(',', $ids).".pdf";
            DOMPDF::loadView('keuangan.piutang.penagihan-print.penunjang.formulir', $data)->save($fullpath);
            $pdf_merger = $this->mergePDFPenunjang($additional_pdf, $fullpath);
            return [
                    'content' => $pdf_merger,
                    'type' => 'merger'];
        } else {
            return [
                    'content' => DOMPDF::loadView('keuangan.piutang.penagihan-print.penunjang.formulir', $data),
                    'type' => 'pdf'];
        }
    }

    private function formulirLabPK($ids)
    {
        $piutang = Piutang::whereIn('id', $ids)->with('kasusTagihan.detail.labpk', 'kasusTagihan.kasus.identitas', 'pasien',
                    'pasien.tni_pangkat', 'pasien.tni_kotama', 'pasien.tni_satker', 
                    'kasusTagihan.detail.labpk.transaksi', 'kasusTagihan.kasus')->get();
        $kasus_ids = [];
        $tagihan = $piutang->map(function($item) use(&$kasus_ids){
            array_push($kasus_ids, $item->kasusTagihan->kasus_id);
            return $item->kasusTagihan;
        });
        $result = [];
        foreach ($tagihan as $key => $val) {
            if(!is_null($val)){
                foreach($val->detail as $det){
                    if(!is_null($det) && isset($det->labpk)){
                        $trans_id = $det->labpk->transaksi->id;
                        $transaksi = $det->labpk->transaksi;
                        $result[$trans_id]['transaksi'] = $transaksi;
                        if(!is_null($transaksi->hasil)){
                            $lis_result = [];
                            foreach($transaksi->hasil as $h){
                                $temp = $this->transformLISResult($h->lis_result); 
                                $temp['hasil'] = $h;
                                array_push($lis_result, $temp);
                            }
                            $result[$trans_id]['detail'] = $lis_result;
                        }                        
                    }
                }
            }
        }

        $data['result'] = $result;
        $data['now'] = Carbon::now();
        $data['departemen'] = "LabPK";
        $additional_pdf = Penunjang::select('kasus_id', 'file')->whereIn('kasus_id', $kasus_ids)->where('type', self::$penunjang_pk_type)
                            ->where('file', 'LIKE', '%.pdf')->orderBy('kasus_id')->get();
        if(count($additional_pdf) > 0){
            $path = public_path('downloads/print/penagihan/temp/');
            if(!file_exists($path))
                    mkdir($path, 0777, true);
            $fullpath = $path."labpk_".implode(',', $ids).".pdf";
            DOMPDF::loadView('keuangan.piutang.penagihan-print.penunjang.formulir', $data)->save($fullpath);
            $pdf_merger = $this->mergePDFPenunjang($additional_pdf, $fullpath);
            return [
                    'content' => $pdf_merger,
                    'type' => 'merger'];
        } else {
            return [
                    'content' => DOMPDF::loadView('keuangan.piutang.penagihan-print.penunjang.formulir', $data),
                    'type' => 'pdf'];
        }
    }

    private function transformLISResult($lis_result)
    {
        $result = $this->transformResultJson($lis_result);

        $jumlah = count(json_decode($lis_result));
        return [
            'result' => $result,
            'jumlah' => $jumlah
        ];
    }

    private function transformResultJson($source)
    {
        $source = json_decode($source);
        // dd($source);
        $first = array_splice($source, 0, 17);
        $result = [$first];
        if(count($source)){
            $remaining = array_chunk($source, 34);
            return array_merge($result, $remaining);
        } else {
            return $result;
        }
    }


    public function printPerincianBiayaSesuaiKelas(Request $request)
    {
        $data['sidebar_active'] = "piutang";
        $ids = $request->get('id');
        if(empty($ids)) abort(500,'ID Piutang Kosong');
        $array_id = explode(',', $ids);

        $piutang = Piutang::whereIn('id',$array_id)->get();
        $perusahaan_ids = Piutang::whereIn('id',$array_id)->pluck('perusahaan_id')->toArray();
        $perusahaan = Perusahaan::whereIn('id',$perusahaan_ids)->get();
        $piutang_new = [];
    
        foreach($piutang as $index => $item)
        {   
            $piutang_details = [];
            $piutang_subtotal = [];
            $kelas = $item->pasienPembayaran->kelas->nama;
            $kelas_id = $item->pasienPembayaran->kelas_id;
            foreach($item->detail as $detail)
            {
                if(!empty($detail->tarif_id))
                {
                    $old_tarif = Tarif::find($detail->tarif_id);
                    $new_tarif = Tarif::where('tarif_master_id',$old_tarif->tarif_master_id)->where('kelas_id',$kelas_id)->where('tipe_id',$old_tarif->tipe_id)->first();

                    if(!empty($new_tarif->id)){
                        $detail->harga = $new_tarif->harga;
                        $detail->subtotal = $new_tarif->harga * $detail->jumlah;
                    }
                }
                if(in_array($detail->kategori_id, [50,52,53,54,55,56,57,58,59,60,61,62,63,64,65,71])) $key2 = 'Tindakan';
                elseif(in_array($detail->kategori_id, [66,67,68,69,70])) $key2 = 'Penunjang';
                elseif(in_array($detail->kategori_id, [72,73,74,75])) $key2 = 'Farmasi';
                else  $key2 = 'Lain lain';
                $title = $detail->deskripsi;

                if(empty($piutang_details[$key2][$title])) $piutang_details[$key2][$title] = $detail;
                else{
                    $piutang_details[$key2][$title]->jumlah+= $detail->jumlah;
                    $piutang_details[$key2][$title]->subtotal+= $detail->subtotal;
                }


                if (empty($piutang_subtotal[$key2])) {
                    $piutang_subtotal[$key2] = $detail->subtotal;
                } else {
                    $piutang_subtotal[$key2] += $detail->subtotal;
                }
            }
            $piutang_new[$index] = $detail;
            $piutang_new[$index]['detail'] = $piutang_details;
            $piutang_new[$index]['piutang_subtotal'] = $piutang_subtotal;
            $piutang_new[$index]['kelas_custom'] = $kelas;

        }

        $data['tanggal'] = app('App\Http\Controllers\Functions\DateFormatter')->dateNow('%d %B %Y');
        $data['bulan'] = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman(Carbon::now()->format('m'));
        $data['piutang_new'] = $piutang_new;
        $data['perusahaan'] = $perusahaan;
        $data['ids'] = $ids;
        $data['ttd'] = TTD::find($request->ttd);
        
        $pdf = MPDF::loadView('keuangan.piutang.print-perincian-biaya-rekap', $data, [], [
            'mode' => 'utf-8',
            'format' => [150, 250]
        ]);
        $filename ='perincian-biaya.pdf';

        return $pdf->stream($filename);
    }

    public function printOperasi(Request $req)
    {
        $ids = explode(',', $req->id);
        $piutang = Piutang::whereIn('id', $ids)->with(['kasusTagihan.detail' => function($q){
            $q->whereNotNull('transaksi_kamar_operasi_id');
        }])->get();
        $details = $piutang->pluck('kasusTagihan.detail');
        $operasi_id = [];
        foreach ($details as $key => $detail) {
            if(count($detail) > 0){
                $res = $detail->map(function($val, $key){
                    return $val->transaksi_kamar_operasi_id;
                })->toArray();
                $operasi_id = array_merge($operasi_id, $res);
            }
        }
        // dd($operasi_id);
        $data['operasi'] = OperasiTransaksi::with(['hasil', 'pemakaian'])->whereIn('id', $operasi_id)->get();
        // $tim = OperasiTim::with('detail')->where('operasi_id', $id)->get();
        // $grouped = [];
        $peran = OperasiPeranTim::all();
        foreach ($data['operasi'] as $key => $transaksi) {
            foreach($peran as $item)
            {
                $item->members = OperasiTim::with('detail')->where('operasi_id', $transaksi->id)->where('role_id',$item->id)->get();
            }
            $transaksi->peran = $peran;
        }


        $pdf = MPDF::loadView('keuangan.piutang.penagihan-print.hasil-operasi',$data, [], [
            'mode' => 'utf-8',
            // 'format' => 'a4-l'
        ]);
        $filename ='perincian-biaya.pdf';

        return $pdf->stream($filename);
    }

    public function printResep(Request $req)
    {
        $ids = explode(',', $req->id);
        $piutang = Piutang::whereIn('id', $ids)->with(['kasusTagihan.detail'])->get();
        $details = $piutang->pluck('kasusTagihan.detail');
        $detailId = [];
        foreach ($details as $detail) {
            $detailId = array_merge($detailId, $detail->pluck('id')->toArray());
        }

        $farmasiResep = ResepDetail::with(['resep_detail.transaksi_detail.final_detail.resep_detail', 'resep_detail.owner_detail'])->whereIn('kasus_tagihan_detail_id', $detailId)->whereHas('resep_detail.as_final')->get()->pluck('resep_detail.transaksi_detail', 'resep_detail.transaksi_detail.id')->unique();


        $data['reseps'] = $farmasiResep;
        // $data['farm'] = $farmasi;
        // $data['farmasi'] = $farm;
        // $data['farmer'] = $farm->nama;
        // $data['dokter'] = $transaksi->dokter_nama;
        // $data['nomor_resep'] = $request->input('nomor_resep');
        $customPaper = array(0,0,453,604);
        $pdf = DOMPDF::loadView('keuangan.piutang.penagihan-print.print-resep',$data)->setPaper($customPaper);
        return $pdf->stream('nota.pdf');
    }

    public function downloadAll(Request $request)
    {
        ini_set('memory_limit', "1024M");
        ini_set('max_execution_time', 10000);
        ini_set("pcre.backtrack_limit", "5000000");
        setlocale(LC_TIME, 'Indonesian');
        $ids = explode(',', $request->id);
        $piutangs = Piutang::with('detail', 'detail.tipe:id,nama', 'kasusTagihan.detail.radiologi', 
                    'kasusTagihan.detail.labpa', 'kasusTagihan.detail.labpk',
                    'kasusTagihan.detail.radiologi.transaction', 'kasusTagihan.detail.labpa.transaction', 'kasusTagihan.detail.labpk.transaksi',
                    'kasusTagihan.kasus.identitas', 'pasien',
                    'pasien.tni_pangkat', 'pasien.tni_kotama', 'pasien.tni_satker', 'pasien.tni_keanggotaan',
                    'kasusTagihan.detail.radiologi.transaction', 'kasusTagihan.detail.labpa.transaction', 'kasusTagihan.detail.labpk.transaksi',
                    'kasusTagihan.kasus', 'kasusTagihan.kasus.diagnosis', 'kasusTagihan.kasus.diagnosis.lokasi:id,nama', 'kasusTagihan.kasus.diagnosis.icd10:id,code_icd,long_desc',
                    'kasusTagihan.kasus.tindakan_icd9', 'kasusTagihan.kasus.tindakan_icd9.lokasi:id,nama', 'kasusTagihan.kasus.tindakan_icd9.icd9:id,code_icd,long_desc',
                    'kasusTagihan.permintaanJenazah',
                    'kasusTagihan.ketKelahiran')->whereIn('id', $ids)->get();
        $ttd = TTD::where('is_default', 1)->first();
        
        $zipname = 'Penagihan '.date('d-m-Y').'.zip';
        $zip = new \ZipArchive;
        if(file_exists($zipname))
            unlink($zipname);

        $zip->open($zipname, \ZipArchive::CREATE);
        foreach ($piutangs as $piutang) {

            $path = public_path("downloads/print/penagihan/".date('d-m-Y', strtotime($piutang->kasusTagihan->kasus->krs_at))."/");
            if(!file_exists($path))
                mkdir($path, 0777, true);

            $sep = $piutang->kasusTagihan->kasus->sep->no_sep ?? '-';

            $sep_filename = $sep.'.pdf';
            $sep_filename = preg_replace('/(\/|\\\)/', ' ', $sep_filename);
            $sep_fullname = $path.$sep_filename;
            
            if(!file_exists($sep_fullname))
                $pdf = $this->printByPiutang(collect([$piutang]), $piutang->id, $sep_fullname, $ttd);
            
            $zip->addFromString($sep_filename,  file_get_contents($sep_fullname));
        }
        $zip->close();

        return response()->download($zipname);
    }


    public function printAllByPiutang(Request $request, $id)
    {
        ini_set('max_execution_time', 350);
        ini_set("pcre.backtrack_limit", "5000000");
        setlocale(LC_TIME, 'Indonesian');
        $tipe = $request->tipe;

        $piutang = Piutang::with('detail', 'detail.tipe:id,nama', 'kasusTagihan.detail.radiologi', 
                    'kasusTagihan.detail.labpa', 'kasusTagihan.detail.labpk',
                    'kasusTagihan.detail.radiologi.transaction', 'kasusTagihan.detail.labpa.transaction', 'kasusTagihan.detail.labpk.transaksi',
                    'kasusTagihan.kasus.identitas', 'pasien',
                    'pasien.tni_pangkat', 'pasien.tni_kotama', 'pasien.tni_satker', 'pasien.tni_keanggotaan',
                    'kasusTagihan.detail.radiologi.transaction', 'kasusTagihan.detail.labpa.transaction', 'kasusTagihan.detail.labpk.transaksi',
                    'kasusTagihan.kasus', 'kasusTagihan.kasus.diagnosis', 'kasusTagihan.kasus.diagnosis.lokasi:id,nama', 'kasusTagihan.kasus.diagnosis.icd10:id,code_icd,long_desc',
                    'kasusTagihan.kasus.tindakan_icd9', 'kasusTagihan.kasus.tindakan_icd9.lokasi:id,nama', 'kasusTagihan.kasus.tindakan_icd9.icd9:id,code_icd,long_desc',
                    'kasusTagihan.permintaanJenazah',
                    'kasusTagihan.ketKelahiran')->where('id', $id)->get();

        $ttd = TTD::where('is_default', 1)->first();
        $path = public_path("downloads/print/penagihan/".date('d-m-Y', strtotime($piutang[0]->kasusTagihan->kasus->krs_at))."/");
        if(!file_exists($path))
            mkdir($path, 0777, true);

        $sep = $piutang[0]->kasusTagihan->kasus->sep->no_sep ?? '-';

        $ori_filename = $sep.' - '.$piutang[0]->pasien->name.' '.$piutang[0]->id.'.pdf';
        $ori_filename = preg_replace('/(\/|\\\)/', ' ', $ori_filename);
        $ori_fullname = $path.$ori_filename;

        $sep_filename = $sep.'.pdf';
        $sep_filename = preg_replace('/(\/|\\\)/', ' ', $sep_filename);
        $sep_fullname = $path.$sep_filename;
        

        if($tipe == "sep" && file_exists($sep_fullname)){
            return response()->download($sep_fullname, $sep_filename, [], 'inline');
        }
        else if($tipe == "ori" && file_exists($ori_fullname)){
            \File::copy($ori_fullname, $sep_fullname);
            return response()->download($ori_fullname, $ori_filename, [], 'inline');
        }
        else{
            //KALO BELOM
            $this->printByPiutang($piutang, $id, $sep_fullname, $ttd);
            \File::copy($sep_fullname, $ori_fullname);
            return response()->download($sep_fullname, $sep_filename, [], 'inline');
        }
    }

    public function printByPiutang($piutang, $id, $filename, $ttd)
    {
        $perusahaan_ids = $piutang->pluck('perusahaan_id')->toArray();
        $perusahaan = Perusahaan::whereIn('id',$perusahaan_ids)->get();
        $kategori_rugi_untung = Kategori::whereIn('slug',['selisih-biaya-untung','selisih-biaya-untung'])->pluck('id')->toArray();

        $kasus_ids = [];
        $tagihan = $piutang->map(function($item) use(&$kasus_ids){
            array_push($kasus_ids, $item->kasusTagihan->kasus_id);
            return $item->kasusTagihan;
        });

        $kasus = $piutang->pluck('kasusTagihan.kasus');
        // foreach($kasus as $item)
        // {
        //     $item->riwayat_pemberian_obat = app('App\Http\Controllers\Kasus\Farmasi\CatatanPengobatanPasien\ViewController')->getData($item);
        // }

        $transaksies = $kasus->pluck('rawat_inap_transaksi_first');
        $details = $piutang->pluck('kasusTagihan.detail');
        $piutang_new = [];
        $kategori_custom = app('App\Http\Controllers\Keuangan\Kategori\ReadController')->getKategoriCustom();

        $kelas = $piutang[0]->pasienPembayaran->kelas_id;
        $tarif_kelas_id = $kelas;

        $old_tarifs = Tarif::withTrashed()->select('id', 'tarif_master_id', 'tipe_id')->whereIn('id',$piutang[0]->detail->pluck('tarif_id'))->get();

        $new_tarifs = Tarif::withTrashed()->select('id', 'harga')->whereIn('tarif_master_id',$old_tarifs->pluck('tarif_master_id'))
                            ->where('kelas_id',$tarif_kelas_id)->whereIn('tipe_id',$old_tarifs->pluck('tipe_id'))->get()->keyBy('tarif_master_id');
        $old_tarifs = $old_tarifs->keyBy('id');
        foreach($piutang as $index => $item)
        {   
            $piutang_details = [];
            $piutang_subtotal = [];

            foreach($item->detail as $detail)
            {
                if(in_array($detail->kategori_id, $kategori_rugi_untung))
                    continue;

                if(!empty($detail->tarif_id) && !empty($detail->tarif_kelas_id))
                {
                    // $old_tarif = Tarif::withTrashed()->find($detail->tarif_id);
                    // $new_tarif = Tarif::withTrashed()->select('id', 'harga')->where('tarif_master_id',$old_tarifs[$detail->tarif_id]->tarif_master_id)
                    //         ->where('kelas_id',$tarif_kelas_id)->where('tipe_id',$old_tarifs[$detail->tarif_id]->tipe_id)->first();
                    $new_tarif = $new_tarifs[$old_tarifs[$detail->tarif_id]->tarif_master_id] ?? NULL;
                    if(isset($new_tarif->id) && $new_tarif->harga > 100){
                        $detail->harga = $new_tarif->harga;
                        $detail->subtotal = $new_tarif->harga * $detail->jumlah;
                    }
                }
                if(in_array($detail->kategori_id, $kategori_custom['tindakan'])) $key2 = 'Tindakan';
                elseif(in_array($detail->kategori_id, $kategori_custom['penunjang'])) $key2 = 'Penunjang';
                elseif(in_array($detail->kategori_id, $kategori_custom['farmasi'])) $key2 = 'Farmasi';
                else  $key2 = 'Lain lain';
                $title = $detail->deskripsi;

                if(empty($piutang_details[$key2][$title])) $piutang_details[$key2][$title] = $detail;
                else{
                    $piutang_details[$key2][$title]->jumlah+= $detail->jumlah;
                    $piutang_details[$key2][$title]->subtotal+= $detail->subtotal;
                }


                if (empty($piutang_subtotal[$key2])) {
                    $piutang_subtotal[$key2] = $detail->subtotal;
                } else {
                    $piutang_subtotal[$key2] += $detail->subtotal;
                }

                $piutang_new[$index] = $detail;
                $piutang_new[$index]['detail'] = $piutang_details;
                $piutang_new[$index]['piutang_subtotal'] = $piutang_subtotal;
                $piutang_new[$index]['kelas_custom'] = $kelas;
            }

        }

        $data['diagnosis'] = [];
        $data['kk'] = [];
        foreach ($transaksies as $key => $transaksi) {
            if(is_null($transaksi)){
                array_push($data['diagnosis'], '-');
                array_push($data['kk'], '-');
                continue;
            };

            $user = User::find($transaksi->created_by);

            if(!empty($transaksi->kasus->admin)) $dpjp = $transaksi->kasus->admin->user;
            else $dpjp = [];

            if($user->profesi == 1) $creator = $user;
            else $creator = [];

            array_push($data['diagnosis'], $transaksi->diagnosis);
            array_push($data['kk'], $transaksi->kepala_keluarga);
        }

        $detailId = [];
        foreach ($details as $detail) {
            if(isset($detail))
                $detailId = array_merge($detailId, $detail->pluck('id')->toArray());
        }

        $farmasiResep = ResepDetail::with(['resep_detail.transaksi_detail.final_detail.resep_detail', 'resep_detail.owner_detail'])->whereIn('kasus_tagihan_detail_id', $detailId)->whereHas('resep_detail.as_final')->get()->pluck('resep_detail.transaksi_detail', 'resep_detail.transaksi_detail.id')->unique();
        
        $operasi_id = [];
        foreach ($details as $key => $detail) {
            if(!empty($detail) && count($detail) > 0){
                $res = $detail->map(function($val, $key){
                    return $val->transaksi_kamar_operasi_id;
                })->toArray();
                $operasi_id = array_merge($operasi_id, $res);
            }
        }
        // dd($operasi_id);
        $data['operasi'] = OperasiTransaksi::with(['hasil', 'pemakaian'])->whereIn('id', $operasi_id)->get();
        // $tim = OperasiTim::with('detail')->where('operasi_id', $id)->get();
        // $grouped = [];
        $peran = OperasiPeranTim::all();
        foreach ($data['operasi'] as $key => $transaksi) {
            foreach($peran as $item)
            {
                $item->members = OperasiTim::with('detail')->where('operasi_id', $transaksi->id)->where('role_id',$item->id)->get();
            }
            $transaksi->peran = $peran;
        }

        $seps = $piutang->map(function($item){
            if(isset($item->kasusTagihan->kasus->active_sep))
            return $item->kasusTagihan->kasus->active_sep->no_sep;
        });
        $bpjs_real = [];
        $bpjses = BPJSSEP::whereIn('no_sep',$seps)->whereNotNull('no_sep')->where('no_sep', '!=', 0)->get();
        foreach ($bpjses as $key => $bpjs) {
            $bpjs_real[$key] = json_decode(app('App\Http\Controllers\BPJS\API\Sep\ReadController')->get($bpjs->no_sep));
            if(isset($bpjs_real[$key]) && $bpjs_real[$key]->metaData->code == 200) 
                $bpjs_real[$key] = $bpjs_real[$key]->response;
            else
                $bpjs_real[$key]=null;
        }

        $result = [];
        $resultRadiologi = [];
        $resultLabPK = [];
        $resultLabPA = [];
        $resultKematian = [];
        $resultKelahiran = [];

        foreach ($tagihan as $key => $val) {
            if(!is_null($val)){
                //RESUME
                $kasus_each = $val->kasus;
                if(is_null($kasus_each->resume))
                    continue;
                $masuk = Carbon::createFromFormat('Y-m-d H:i:s', ($kasus_each->mrs_at ?? $kasus_each->created_at));
                if (!empty($kasus_each->krs_at)) {
                    $keluar = Carbon::createFromFormat('Y-m-d H:i:s', $kasus_each->krs_at);
                } else $keluar = null;
                $res['kasus'] = $kasus_each;
                $res['resume'] = $kasus_each->resume;
                $res['now'] = Carbon::now();
                if (empty($keluar)) {
                    $res['durasi'] = '-';
                } else $res['durasi'] = $masuk->diffInDays($keluar);
                $res['dpjp'] = Kolaborator::where('kasus_id',$kasus_each->id)->where('admin',1)->first();
                array_push($result, $res);
                //EOF RESUME

                //PENUNJANG
                foreach($val->detail as $det){
                    if(!is_null($det) && isset($det->radiologi->transaction->id)){
                        $trans_id = $det->radiologi->transaction->id;
                        if(isset($resultRadiologi[$trans_id])){
                            array_push($resultRadiologi[$trans_id]['detail'], $det->radiologi);
                        } else {
                            $resultRadiologi[$trans_id]['transaksi'] = $det->radiologi->transaction;
                            $resultRadiologi[$trans_id]['detail'] = [$det->radiologi];                                                        
                        }
                    }
                    if(!is_null($det) && isset($det->labpa->transaction->id)){
                        $trans_id = $det->labpa->transaction->id;
                        if(isset($resultLabPA[$trans_id])){
                            array_push($resultLabPA[$trans_id]['detail'], $det->labpa);
                        } else {
                            $resultLabPA[$trans_id]['transaksi'] = $det->labpa->transaction;
                            $resultLabPA[$trans_id]['detail'] = [$det->labpa];                                                        
                        }
                    }
                    if(!is_null($det) && isset($det->labpk->transaksi->id)){
                        $trans_id = $det->labpk->transaksi->id;
                        $transaksi = $det->labpk->transaksi;
                        $resultLabPK[$trans_id]['transaksi'] = $transaksi;
                        if(!is_null($transaksi->hasil)){
                            $lis_result = [];
                            foreach($transaksi->hasil as $h){
                                $temp = $this->transformLISResult($h->lis_result); 
                                $temp['hasil'] = $h;
                                array_push($lis_result, $temp);
                            }
                            $resultLabPK[$trans_id]['detail'] = $lis_result;
                        }
                    }
                }
                //EOF PENUNJANG

                //SURAT KEMATIAN
                if(isset($val->permintaanJenazah))
                {
                    $temp = [];
                    $d = $val->permintaanJenazah;
                    $temp['pasien'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->profile($d->pasien_id);
                    $temp['jenazah'] = app('App\Http\Controllers\KamarJenazah\ReadController')->detilPermintaan($d->pasien_id, $d->id);
                    if ( NULL !== (\App\Models\KamarJenazah\Transaksi::where('permintaan_id',$d->id)->first())) {
                    $temp['invoice'] = app('App\Http\Controllers\KamarJenazah\ReadController')->getInvoice($d->pasien_id, $d->id);
                    }

                    $temp['jenazah']['permintaan'][0]['waktu_meninggal'] = \Carbon\Carbon::parse($temp['jenazah']['permintaan'][0]['waktu_meninggal'])->formatLocalized('%d %B %Y pukul %I:%M');
                    // dd($temp['jenazah']['permintaan'][0]['created_at']->formatLocalized('%d %B %Y pukul %I:%M'));
                    $temp['created_at'] = $temp['jenazah']['permintaan'][0]['created_at']->formatLocalized('%d %B %Y pukul %I:%M');
                    $temp['jenazah']['dikubur'][0]['dikubur'] = \Carbon\Carbon::parse($temp['jenazah']['dikubur'][0]['dikubur'])->formatLocalized('%d %B %Y pukul %I:%M');
                    array_push($resultKematian, $temp);
                }
                //EOF SURAT KEMATIAN
                //SURAT KELAHIRAN
                if(isset($val->ketKelahiran))
                {
                    foreach($val->ketKelahiran as $item)
                    {
                        $temp = [];
                        $ket = $item;
                        $kel_kasus = $item->kasus;
                        $temp['nama'] = $item->nama_ibu;
                        $temp['no_rm'] = $kel_kasus->pasien->no_rm;
                        $temp['suami'] = $item->nama_ayah;
                        $temp['ket'] = $item;
                        if($item->kelamin == 1)
                        {
                            $temp['kelamin'] = 'Laki - Laki';
                        }
                        else
                        {
                            $temp['kelamin'] = 'Perempuan';
                        }
                        $temp['usia_ibu'] = $kel_kasus->pasien->age ?? '-';
                        array_push($resultKelahiran, $temp);
                    }
                }
                //EOF SURAT KELAHIRAN
            }
        }

        $data['rs'] = config('app.name');
        $data['inacbg'] = $kasus[0]->inacbg_latest ?? NULL;
        $diagnosis =   Diagnosis::whereIn('kasus_id',$piutang->pluck('kasusTagihan.kasus.id'))
                                ->with('icd10')
                                ->get();

        $pasien = Pasien::whereIn('id',$piutang->pluck('pasien_id'))
                        ->with(['pembayaran' => function($query)       
                        {       
                            $query->whereHas('perusahaan.tipe', function($query)       
                            {       
                                $query->where('slug', 'bpjs');       
                            });       
                        }])->get();

        $resep = TransaksiObat::whereIn('kasus_id', $piutang->pluck('kasusTagihan.kasus.id'))->get();
        $resep_detail =  ResepDetail::whereIn('resep_id',$resep->pluck('resep_final'))
                                        ->with('obat_detail')
                                        ->get();
        
        // $obat_fornas =  ItemsTemplate::whereIn('id',$resep_detail->pluck('obat_detail.item_template_id'))
        //                             ->whereHas('items_category.detail_kategori', function($query)       
        //                             {       
        //                                 $query->where('slug', 'fornas');       
        //                             })
        //                             ->get();

        // $resep_fornas =  $resep_detail->whereIn('obat_detail.item_template_id',$obat_fornas->pluck('id'));

        // foreach ($pasien as $key=>$each_pasien) {
        //     $piutang_pasien = $piutang->where('pasien_id',$each_pasien->id)->first();

        //     if (isset($piutang_pasien->kasusTagihan)) {
        //         $kasus_id = $piutang_pasien->kasusTagihan->kasus->id;

        //         $resep_pasien = $resep->where('kasus_id',$kasus_id);

        //         $each_pasien->obat_fornas = $resep_fornas->whereIn('resep_id',$resep_pasien->pluck('resep_final'));

        //         if (count($each_pasien->obat_fornas) > 0) {
        //             $each_pasien->diagnosis = $diagnosis->where('kasus_id',$kasus_id);
        //         }else{
        //             $pasien->forget($key);
        //         }

        //         $each_pasien->dpjp = $piutang_pasien->kasusTagihan->kasus->dpjp;
                
        //     }else{
        //         $pasien->forget($key);
        //     }        
            
        // }


        $data['resultKematian'] = $resultKematian;
        $data['resultKelahiran'] = $resultKelahiran;
        $data['resultRadiologi'] = $resultRadiologi;
        $data['resultLabPA'] = $resultLabPA;
        $data['resultLabPK'] = $resultLabPK;

        $data['bpjses'] = $bpjses;
        $data['bpjs_real'] = $bpjs_real;

        $data['reseps'] = $farmasiResep;
        $data['result'] = $result;
        $data['now'] = Carbon::now();
        $data['tanggal'] = app('App\Http\Controllers\Functions\DateFormatter')->dateNow('%d %B %Y');
        $data['piutang'] = $piutang;
        $data['piutang_new'] = $piutang_new;
        $data['perusahaan'] = $perusahaan;
        $data['ids'] = [$id];
        $data['bulan'] = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman(Carbon::now()->format('m'));
        $data['all'] = true;
        $data['kasus'] = $kasus;
        $data['dpjp'] = $dpjp ?? [];
        $data['creator'] = $creator ?? [];
        $data['transaksies'] = $transaksies;
        $data['pasien'] = $pasien;
        $data['ttd'] = $ttd;
        $this->checkToAbort($data['ttd']);

        $additional_pdf = Penunjang::select('kasus_id', 'file')->whereIn('kasus_id', $kasus_ids)->whereIn('type', [self::$penunjang_radio_type, self::$penunjang_pa_type, self::$penunjang_pk_type])
                            ->where('file', 'LIKE', '%.pdf')->orderBy('kasus_id')->get();
        if(count($additional_pdf) > 0){
            $path = public_path('downloads/print/penagihan/temp/');
            if(!file_exists($path))
                    mkdir($path, 0777, true);
            $fullpath = $path."printall_".$piutang[0]->id.".pdf";
            MPDF::loadView('keuangan.piutang.penagihan-print.print-all', $data, [], [
                                    'mode' => 'utf-8'
                                ])->save($fullpath);
            $pdf_merger = $this->mergePDFPenunjang($additional_pdf, $fullpath);
            $pdf_merger->save($filename);
        } else {
            MPDF::loadView('keuangan.piutang.penagihan-print.print-all', $data, [], [
                    'mode' => 'utf-8'
                                ])->save($filename);
        }

        $kasus = $piutang[0]->kasusTagihan->kasus;
        $kasus->file_generated_at = Carbon::now();
        unset($kasus->riwayat_pemberian_obat);
        $kasus->save();

        $piutang[0]->file_created_at = Carbon::now();
        $piutang[0]->save();
        
        return;
    }
}