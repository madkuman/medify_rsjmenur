<?php

namespace App\Http\Controllers\Remunerasi\Laporan;

use App\Models\Kepegawaian\MasterGolongan;
use App\Models\Remunerasi\Laporan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Kepegawaian\Pegawai;
use App\Models\Remunerasi\Absensi;
use App\Models\Remunerasi\Keuangan;
use App\Models\Remunerasi\Denda;
use App\Models\Remunerasi\Dana;
use App\Models\Remunerasi\Pajak;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;
use DOMPDF;

class ReadController extends Controller
{
    // DATATABLES
    function remunerasi(Request $request){
      
        $limit = $request->length;
        $start = $request->start;
        $cari   = $request->input('search.value');
        $tanggal =  Carbon::createFromFormat('d-m-Y', $request->bulan_tahun)->format('Y-m-d');
        $bulan_tahun = substr($request->bulan_tahun,3);
        $kategori_pegawai_id = $request->kategori;
        $total_record = count(Laporan::where('tanggal',$bulan_tahun)->get());
        $total_filter = $total_record;

        $laporan = Laporan::where('tanggal',$bulan_tahun)->offset($start)->limit($limit);

        if(!empty($cari)){
            $cari = preg_replace("/[^[:alnum:][:space:]]/u", ' ', $cari);
            $pegawai_ids = Pegawai::search($cari)->take(50)->get()->pluck('id')->toArray();
            if(!empty($pegawai_ids)){
                $pegawai_ids_implode = implode(',', $pegawai_ids);
                $laporan = $laporan->whereIn('pegawai_id', $pegawai_ids)->orderByRaw("FIELD(pegawai_id, $pegawai_ids_implode)");
            }
            $total_record = count(with(clone $laporan)->get());
            $total_filter = $total_record;
        }

        if($kategori_pegawai_id != 'all'){
            $laporan = $laporan->where('kategori_pegawai_id',$kategori_pegawai_id);
            $total_record = count(with(clone $laporan)->get());
            $total_filter = $total_record;
        }
            $laporan = $laporan->with([
                'pegawai',
                'MasterJabatan',
                'masterGolonganPegawai',
                'masterGelar',
                'masterJenisPegawai',
                'masterKategoriPegawai',
                'masterTimPembagiJasa',
                'absensi',
                'beban_kerja',
                'resiko_kerja',
                'pelayanan',
                'index_pajak',
                'masa_kerja'
            ])->get();


        $data = [];
        $no = $start+1;
        foreach ($laporan as $row) {

            // Pelayanan
            $from_keuangan  = self::keuanganPelayanan($row);
            $from_jasa      = self::jasaPelayanan($row);
            $jasa_pelayanan = $from_keuangan+$from_jasa;

            // Potongan
            $denda      = self::dendaAbsensi($row);

            // Total
            $total = $jasa_pelayanan-$denda;

            $bank = empty($row->pegawai->masterNamaBank->nama) ? '-' : $row->pegawai->masterNamaBank->nama;

            $nama_golongan      = !empty($row->masterGolonganPegawai) ? (!empty($row->masterGolonganPegawai->nama) ? $row->masterGolonganPegawai->nama : '-') : '-';
            $index_golongan     = !empty($row->masterGolonganPegawai) ? (!empty($row->masterGolonganPegawai->indek) ? $row->masterGolonganPegawai->indek : '-') : '-';
            $nama_pendidikan    = !empty($row->masterGelar) ? (!empty($row->masterGelar->nama) ? $row->masterGelar->nama : '-') : '-';
            $index_pendidikan   = !empty($row->masterGelar) ? (!empty($row->masterGelar->index) ? $row->masterGelar->index : '-') : '-';
            $nama_jabatan       = !empty($row->MasterJabatan) ? (!empty($row->masterJabatan->nama) ? $row->masterJabatan->nama : '-') : '-';
            $index_jabatan      = !empty($row->MasterJabatan) ? (!empty($row->MasterJabatan->index) ? $row->MasterJabatan->index : '-') : '-';
            $nama_status        = !empty($row->masterJenisPegawai) ? (!empty($row->masterJenisPegawai->nama) ? $row->masterJenisPegawai->nama : '-') : '-';
            $index_status       = !empty($row->masterJenisPegawai) ? (!empty($row->masterJenisPegawai->index) ? $row->masterJenisPegawai->index : '-') : '-';
            $index_beban        = !empty($row->beban_kerja) ? (!empty($row->beban_kerja->index) ? $row->beban_kerja->index : '-') : '-';
            $index_resiko       = !empty($row->resiko_kerja) ? (!empty($row->resiko_kerja->index) ? $row->resiko_kerja->index : '-') : '-';
            $nama_masa_kerja    = !empty($row->masa_kerja) ? (!empty($row->masa_kerja->nama) ? $row->masa_kerja->nama: '-') : '-';
            $index_masa_kerja   = !empty($row->masa_kerja) ? (!empty($row->masa_kerja->indek) ? $row->masa_kerja->indek : '-') : '-';
            $nama_kategori        = !empty($row->masterKategoriPegawai) ? (!empty($row->masterKategoriPegawai->nama) ? $row->masterKategoriPegawai->nama : '-') : '-';
            $index_pajak   = !empty($row->index_pajak) ? (!empty($row->index_pajak->jumlah) ? $row->index_pajak->jumlah : '-') : '-';
            $nama_tim_pembagi_jasa       = !empty($row->masterTimPembagiJasa) ? (!empty($row->masterTimPembagiJasa->nama) ? $row->masterTimPembagiJasa->nama : '-') : '-';
            $index_tim_pembagi_jasa      =!empty($row->masterTimPembagiJasa) ? (!empty($row->masterTimPembagiJasa->indek) ? $row->masterTimPembagiJasa->indek : '-') : '-';

            $value['nomer']     = '<td class="">'.$no++.'.</td>';
            $value['pegawai']   = '<td class="font-w600"> Nama: '.$row->pegawai->name.'<br> NIP: '.$row->pegawai->nrp.'</td>';
            $value['bank']      = '<td>Bank: '.$bank.'<br>
                                    Rekening: '.$row->bank_account.'</td>';

            $value['golongan']          = '<td>Nama: '.$nama_golongan.'<br> 
                                            Index: '.$index_golongan.'</td>';
            $value['pendidikan']        = '<td>Nama: '.$nama_pendidikan.' <br>
                                            Index: '.$index_pendidikan.'</td>';
            $value['status']            = '<td>Nama:'.$nama_status.' <br>
                                            Index: '.$index_status.'</td>';
            $value['jabatan']           = '<td>Nama: '.$nama_jabatan.'<br>
                                            Index: '.$index_jabatan.'</td>';
            $value['beban_kerja']       = '<td>'.$index_beban.'</td>';
            $value['resiko_kerja']      = '<td>'.$index_resiko.'</td>';
            $value['masa_kerja']      = '<td>Nama: '.$nama_masa_kerja.'<br>
                                            Index:'.$index_masa_kerja.'</td>';
            $value['tim_pembagi_jasa']          = '<td>Nama: '.$nama_tim_pembagi_jasa.'<br> 
                                            Index: '.$index_tim_pembagi_jasa.'</td>';
            $value['kategori']      = '<td>'.$nama_kategori.'</td>';
            $value['index_pajak']      = '<td>'.$index_pajak.'</td>';
            
            $value['jasa_pelayanan']        = '<t>'.$this->convertRupiah($from_jasa).'</td>';
            $value['pelayanan_tambahan']    = '<td>'.$this->convertRupiah($from_keuangan).'</td>';
            $value['potongan']              = '<td>'.$this->convertRupiah($denda).'</td>';
            $value['total']                 = '<td>'.$this->convertRupiah($total).'</td>';
            $value['cetak']                 = '<td>
                                                <a href="'.url('').'/remunerasi/laporan/personal/'.$row->id.'" target="_blank" class="btn btn-sm btn-outline-warning mr-5 mb-5 btn-laporan"><i class="fa fa-file"></i></a></td>';

            $data[] = $value;
        }

        return response()->json(array(
            "draw"              => intval($request->draw),
            "recordsTotal"      => intval($total_record),
            "recordsFiltered"   => intval($total_filter),
            "data"              => $data
        ));
    }

    // FUNC PERHITUNGAN
    function totalIndex($id){
       
        $index_beban = DB::connection('kepegawaian')->table('pegawai')->select('beban_kerja')->where('id', $id)->first();
        $index_resiko = DB::connection('kepegawaian')->table('pegawai as p')->select('a.index as a')->where('p.id', $id)->join('master_resiko_kerja as a', 'p.resiko_kerja_id','=','a.id')->first();
        $index_jenis = DB::connection('kepegawaian')->table('pegawai as p')->select('a.index as a')->where('p.id', $id)->join('master_jenis_pegawai as a', 'p.jenis_pegawai_id','=','a.id')->first();
        $index_tim_pembagi_jasa = DB::connection('kepegawaian')->table('pegawai as p')->select('a.index as a')->where('p.id', $id)->join('tim_pembagi_jasa as a', 'p.tim_pembagi_jasa_id','=','a.id')->first();
        $index_gelar = DB::connection('kepegawaian')->table('pegawai as p')->select('a.index as a')->where('p.id', $id)->join('pendidikan_gelar as a', 'p.pendidikan_gelar_id','=','a.id')->first();
        $index_jabatan = DB::connection('kepegawaian')->table('pegawai as p')->select('a.index as a')->where('p.id', $id)->join('master_jabatan as a', 'p.jabatan_id','=','a.id')->first();
       
        $a = $index_beban != null ? $index_beban->beban_kerja : 0;
        $b = $index_resiko != null ? $index_resiko->a : 0;
        $c = $index_jenis != null ? $index_jenis->a : 0;
        $d = $index_tim_pembagi_jasa != null ? $index_tim_pembagi_jasa->a : 0;
        $e = $index_gelar != null ? $index_gelar->a : 0;
        $f = $index_jabatan != null ? $index_jabatan->a : 0;

        $total_index = $a+$b+$c+$d+$e+$f;

        return $total_index;
    }

    function indexSemuaPegawai(){
       
        $index_beban = DB::connection('kepegawaian')->table('pegawai')->sum('beban_kerja');
        $index_resiko = DB::connection('kepegawaian')->table('pegawai as p')->join('master_resiko_kerja as a', 'p.resiko_kerja_id','=','a.id')->sum('a.index');
        $index_jenis = DB::connection('kepegawaian')->table('pegawai as p')->join('master_jenis_pegawai as a', 'p.jenis_pegawai_id','=','a.id')->sum('a.index');
        $index_tim_pembagi_jasa = DB::connection('kepegawaian')->table('pegawai as p')->select('a.index as a')->where('p.id', $id)->join('tim_pembagi_jasa as a', 'p.tim_pembagi_jasa_id','=','a.id')->first();
        $index_gelar = DB::connection('kepegawaian')->table('pegawai as p')->join('pendidikan_gelar as a', 'p.pendidikan_gelar_id','=','a.id')->sum('a.index');
        $index_jabatan = DB::connection('kepegawaian')->table('pegawai as p')->join('master_jabatan as a', 'p.jabatan_id','=','a.id')->sum('a.index');

        $a = !empty($index_beban) ? $index_beban : 0;
        $b = !empty($index_resiko) ? $index_resiko : 0;
        $c = !empty($index_jenis) ? $index_jenis : 0;
        $d = $index_tim_pembagi_jasa != null ? $index_tim_pembagi_jasa->a : 0;
        $e = !empty($index_gelar) ? $index_gelar : 0;
        $f = !empty($index_jabatan) ? $index_jabatan : 0;

        $total_index = $a+$b+$c+$d+$e+$f;
      
        return $total_index;
    }

    function pajak($id){

        $total_index = self::totalIndex($id);

        $pajak = Pajak::orderBy('created_by', 'DESC')->first();
        
        $pajak = $total_index/$pajak->jumlah*100;

        return round($pajak, 2);
    }

    function jasaPelayanan($row){
        $jaspel = 0;
        if($row->index_pajak && $row->masterKategoriPegawai){
            $index_pajak = $row->index_pajak->jumlah;
            $jumlah_index_pajak = Laporan::select(DB::Raw('sum(pajak.jumlah) AS index_pajak'))->join('pajak','pajak.id', '=','laporan.index_pajak_id')->where('laporan.tanggal',$row->tanggal)->where('kategori_pegawai_id',$row->kategori_pegawai_id)->groupby('kategori_pegawai_id')->get();
            if($jumlah_index_pajak[0]->index_pajak > 0){
                $jaspel = $index_pajak / $jumlah_index_pajak[0]->index_pajak * $row->masterKategoriPegawai->pembagian_jaspel / 100 * $row->dana->nominal;
            }
        }
      
        return $jaspel;
    }

    function dendaAbsensi($row){
        $absensi = $row->absensi;

        if($absensi == null ){
            $total_denda = 0 ;
        } else {
         

            // Denda
            $denda_absen_ket    = $absensi->Denda->absen_ket;
            $denda_absen        = $absensi->Denda->absen;

            $denda_telat_satu   = $absensi->Denda->telat_satu;
            $denda_telat_dua    = $absensi->Denda->telat_dua;
            $denda_telat_tiga   = $absensi->Denda->telat_tiga;
            $denda_telat_empat  = $absensi->Denda->telat_empat;

            $denda_pulang_satu  = $absensi->Denda->pulang_satu;
            $denda_pulang_dua   = $absensi->Denda->pulang_dua;
            $denda_pulang_tiga  = $absensi->Denda->pulang_tiga;
            $denda_pulang_empat = $absensi->Denda->pulang_empat;

            $denda_telat_senam  = $absensi->Denda->telat_senam;
            $denda_tidak_senam  = $absensi->Denda->tidak_senam;
            $denda_lupa_absen_masuk  = $absensi->Denda->lupa_absen_masuk;
            $denda_lupa_absen_pulang = $absensi->Denda->lupa_absen_pulang;

            // Absen
            $absensi_absen_ket    = (!empty($absensi->absen_ket) ? $absensi->absen_ket : 0 );
            $absensi_absen        = (!empty($absensi->absen) ? $absensi->absen : 0 ) ;

            $absensi_telat_satu   = (!empty($absensi->telat_satu) ? $absensi->telat_satu : 0 );
            $absensi_telat_dua    = (!empty($absensi->telat_dua) ? $absensi->telat_dua: 0 );
            $absensi_telat_tiga   = (!empty($absensi->telat_tiga) ? $absensi->telat_tiga : 0 );
            $absensi_telat_empat  = (!empty($absensi->telat_empat) ? $absensi->telat_empat : 0 );

            $absensi_pulang_satu  = (!empty($absensi->pulang_satu) ? $absensi->pulang_satu : 0 );
            $absensi_pulang_dua   = (!empty($absensi->pulang_dua) ? $absensi->pulang_dua : 0 );
            $absensi_pulang_tiga  = (!empty($absensi->pulang_tiga) ? $absensi->pulang_tiga : 0 );
            $absensi_pulang_empat = (!empty($absensi->pulang_empat) ? $absensi->pulang_empat : 0 );

            $absensi_telat_senam  = (!empty($absensi->telat_senam) ? $absensi->telat_senam : 0 );
            $absensi_tidak_senam  = (!empty($absensi->tidak_senam) ? $absensi->tidak_senam : 0 );
            $absensi_lupa_absen_masuk  = (!empty($absensi->lupa_absen_masuk) ? $absensi->lupa_absen_masuk : 0 );
            $absensi_lupa_absen_pulang  = (!empty($absensi->lupa_absen_pulang) ? $absensi->lupa_absen_pulang : 0 );

            // Hitung
            $absen_ket      = $absensi_absen_ket*$denda_absen_ket;
            $absen          = $absensi_absen*$denda_absen;

            $telat_satu     = $absensi_telat_satu*$denda_telat_satu;
            $telat_dua      = $absensi_telat_dua*$denda_telat_dua;
            $telat_tiga     = $absensi_telat_tiga*$denda_telat_tiga;
            $telat_empat    = $absensi_telat_empat*$denda_telat_empat;

            $pulang_satu    = $absensi_pulang_satu*$denda_pulang_satu;
            $pulang_dua     = $absensi_pulang_dua*$denda_pulang_dua;
            $pulang_tiga    = $absensi_pulang_tiga*$denda_pulang_tiga;
            $pulang_empat   = $absensi_pulang_empat*$denda_pulang_empat;

            $telat_senam    = $absensi_telat_senam*$denda_telat_senam;
            $tidak_senam    = $absensi_tidak_senam*$denda_tidak_senam;

            $lupa_absen_masuk  = $absensi_lupa_absen_masuk*$denda_lupa_absen_masuk;
            $lupa_absen_pulang = $absensi_lupa_absen_pulang*$denda_lupa_absen_pulang;

            $total_denda = $absen_ket+$absen+$telat_satu+$telat_dua+$telat_tiga+$telat_empat+$pulang_satu+$pulang_dua+$pulang_tiga+$pulang_empat+$telat_senam+$tidak_senam+$lupa_absen_masuk+$lupa_absen_pulang;
        }

        return $total_denda;
    }

    function keuanganPelayanan($laporan){
        $keuangan = $laporan->pelayanan ?? null;

       
        if($keuangan == null ){
            $total_keuangan = 0;
        } else {
            $jp_dasar       = !empty($keuangan->jp_dasar) ? $keuangan->jp_dasar : 0 ;
            $visite_tetap   = !empty($keuangan->visite_tetap) ? $keuangan->visite_tetap : 0 ;
            $visite_anggrek = !empty($keuangan->visite_anggrek) ? $keuangan->visite_anggrek : 0 ;
            $jasa_pendidikan= !empty($keuangan->jasa_pendidikan) ? $keuangan->jasa_pendidikan : 0;
            $tindakan_dokter= !empty($keuangan->tindakan_dokter) ? $keuangan->tindakan_dokter : 0;
            $konsul_dokter  = !empty($keuangan->konsul_dokter) ? $keuangan->konsul_dokter : 0;
            $poli_tumbang   = !empty($keuangan->poli_tumbang) ? $keuangan->poli_tumbang : 0;
            $aps_ect        = !empty($keuangan->aps_ect) ? $keuangan->aps_ect : 0;
            $patologi_klinik= !empty($keuangan->patologi_klinik) ? $keuangan->patologi_klinik : 0;
            $ipwl           = !empty($keuangan->ipwl) ? $keuangan->ipwl : 0;

            $total_keuangan = $jp_dasar+$visite_tetap+$visite_anggrek+$jasa_pendidikan+$tindakan_dokter+$konsul_dokter+$poli_tumbang+$aps_ect+$patologi_klinik+$ipwl;
        }

        return $total_keuangan;
    }

    // LAPORAN REMUNERASI
    function laporanPersonal($id){

        \Blade::setEchoFormat('nl2br(e(%s))');

        $data['pegawai'] = Laporan::where('id', $id)
                                ->with([
                                    'pegawai',
                                    'MasterJabatan',
                                    'masterGolonganPegawai',
                                    'masterGelar',
                                    'masterJenisPegawai',
                                    'masterKategoriPegawai',
                                    'absensi',
                                    'beban_kerja',
                                    'resiko_kerja',
                                    'pelayanan',
                                    'index_pajak',
                                    'masa_kerja',
                                    'masterTimPembagiJasa'
                                ])
                                ->first();
        $data['keuangan']   = $data['pegawai']->pelayanan;
        $data['absensi']    = $data['pegawai']->absensi;
       
        // Pelayanan
        $pelayanan_tambahan         = self::keuanganPelayanan($data['pegawai']);
        $jasa_pelayanan             = self::jasaPelayanan($data['pegawai']);
        $denda                  = self::dendaAbsensi($data['pegawai']);
        $total_pelayanan            = $jasa_pelayanan+$pelayanan_tambahan-$denda;
        $data['pelayanan_tambahan'] = $pelayanan_tambahan;
        $data['jasa_pelayanan']     = $jasa_pelayanan;
        $data['total_pelayanan']    = $total_pelayanan;

        // Potongan
        $data['total_denda']    = $denda;

		$pdf = DOMPDF::loadView('remunerasi.laporan.print.personal',$data)->setPaper('tabloid', 'potrait');;
		$filename = 'Laporan_Remunerasi_Personal';
		
		return $pdf->stream($filename);
    }

    function laporanPegawai(Request $request){

        ini_set('max_execution_time', 300);
        ini_set("pcre.backtrack_limit", "5000000");
        ini_set('memory_limit', '2048M');

        $bulan_tahun = substr($request->bulan_tahun,3);
        $tanggal =  Carbon::createFromFormat('d-m-Y', $request->bulan_tahun)->format('Y-m-d');

        $pegawai = Laporan::where('tanggal',$bulan_tahun)->take(500)->with([
            'pegawai',
            'MasterJabatan',
            'masterGolonganPegawai',
            'masterGelar',
            'masterJenisPegawai',
            'masterKategoriPegawai',
            'absensi',
            'beban_kerja',
            'resiko_kerja',
            'pelayanan',
            'index_pajak',
            'masa_kerja'
        ])->get();
           
        $data = [];
        $no = 1;
        foreach ($pegawai as $row) {

            // Pelayanan
            $pelayanan_tambahan         = self::keuanganPelayanan($row);
            $jasa_pelayanan             = self::jasaPelayanan($row);
            $denda                  = self::dendaAbsensi($row);
            $total_pelayanan            = $jasa_pelayanan+$pelayanan_tambahan-$denda;

            $value['nomer']     = $no++;
            $value['pegawai']   = $row->pegawai->name;
            $value['rekening']  = $row->pegawai->bank_account;

            $value['golongan']  = !empty($row->masterGolonganPegawai) ? (!empty($row->masterGolonganPegawai->nama) ? $row->masterGolonganPegawai->nama : '-') : '-';
            $value['index_golongan'] = !empty($row->masterGolonganPegawai) ? (!empty($row->masterGolonganPegawai->indek) ? $row->masterGolonganPegawai->indek : '-') : '-';
            $value['pendidikan']  = !empty($row->masterGelar) ? (!empty($row->masterGelar->nama) ? $row->masterGelar->nama : '-') : '-';
            $value['index_pendidikan'] = !empty($row->masterGelar) ? (!empty($row->masterGelar->index) ? $row->masterGelar->index : '-') : '-';
            $value['tim_pembagi_jasa'] = !empty($row->masterTimPembagiJasa) ? (!empty($row->masterTimPembagiJasa->nama) ? $row->masterTimPembagiJasa->nama : '-') : '-';
            $value['index_tim_pembagi_jasa'] = !empty($row->masterTimPembagiJasa) ? (!empty($row->masterTimPembagiJasa->indek) ? $row->masterTimPembagiJasa->indek : '-') : '-';
            $value['status']  = !empty($row->masterJenisPegawai) ? (!empty($row->masterJenisPegawai->nama) ? $row->masterJenisPegawai->nama : '-') : '-';
            $value['index_status'] = !empty($row->masterJenisPegawai) ? (!empty($row->masterJenisPegawai->index) ? $row->masterJenisPegawai->index : '-') : '-';
            $value['jabatan']  = !empty($row->masterJabatan) ? (!empty($row->masterJabatan->nama) ? $row->masterJabatan->nama : '-') : '-';
            $value['index_jabatan'] = !empty($row->masterJabatan) ? (!empty($row->masterJabatan->index) ? $row->masterJabatan->index : '-') : '-';
            $value['beban_kerja']  = !empty($row->beban_kerja) ? (!empty($row->beban_kerja->pegawai->masterBebanKerja->nama) ? $row->beban_kerja->pegawai->masterBebanKerja->nama : '-') : '-';
            $value['index_beban'] = !empty($row->beban_kerja) ? (!empty($row->beban_kerja->index) ? $row->beban_kerja->index : '-') : '-';
            $value['resiko_kerja']  = !empty($row->resiko_kerja) ? (!empty($row->resiko_kerja->pegawai->masterResikoKerja->nama) ? $row->resiko_kerja->pegawai->masterResikoKerja->nama : '-') : '-';
            $value['index_resiko'] = !empty($row->resiko_kerja) ? (!empty($row->resiko_kerja->index) ? $row->resiko_kerja->index : '-') : '-';
            $value['masa_kerja']  = !empty($row->masa_kerja) ? (!empty($row->masa_kerja->nama) ? $row->masa_kerja->nama: '-') : '-';
            $value['index_masa_kerja'] = !empty($row->masa_kerja) ? (!empty($row->masa_kerja->indek) ? $row->masa_kerja->indek: '-') : '-';
            $value['index_pajak'] = !empty($row->index_pajak) ? (!empty($row->index_pajak->jumlah) ? $row->index_pajak->jumlah : '-') : '-';
            
            $value['jasa_pelayanan']        = $this->convertRupiah($jasa_pelayanan);
            $value['pelayanan_tambahan']    = $this->convertRupiah($pelayanan_tambahan);
            $value['potongan']              = $this->convertRupiah($denda);
            $value['total']                 = $this->convertRupiah($total_pelayanan);

            $data[] = $value;
        }

        
        $pdf = DOMPDF::loadView('remunerasi.laporan.print.pegawai',['data' => $data, 'date' => $tanggal])->setPaper('tabloid', 'landscape');
		$filename = 'Laporan_Remunerasi_Pegawai';
		
		return $pdf->stream($filename);

    }

    // LABEL RUPIAH
    function convertRupiah($n) {
        return 'Rp. ' . number_format($n,0,',','.');
    }

    public function totalIndexPajak(Request $request)
    {
        $kategori= app('App\Http\Controllers\Kepegawaian\MasterKategoriPegawai\ReadController')->getAll();
        foreach ($kategori as $item)
        {
            $laporan=Laporan::select(DB::Raw('sum(pajak.jumlah) AS index_pajak'))->join('pajak','pajak.id', '=','laporan.index_pajak_id')->where('laporan.tanggal',substr($request->tanggal,3))->where('kategori_pegawai_id',$item->id)->groupby('kategori_pegawai_id')->get();
            $item->index_pajak = $laporan[0]->index_pajak ?? 0;
        }

        return json_encode($kategori);
    }

}