@extends('layouts.print')

@section('title')
Print Psikogram Visum - {{$kasus->identitas->nama}}
@endsection

@section('css')
<style type="text/css">
    body, p {
        font-size: 12px;
        font-family: Arial, Helvetica, sans-serif;
        /*line-height: 16px;*/
    }
    
    table.bordered {
      border-collapse: collapse;
    }
    table.bordered, .bordered th, .bordered td {
      border: 1px solid black;
    }

    table.separated {
      border-collapse: separate;
      border-spacing: 10px;
    }
    .separated th, .separated td {
      border: 1px solid black;
    }
    table.no-border td {
        border: none;
    }
    .footer {
        width: 100%;
        text-align: right;
        position: fixed;
        bottom: 0px;
    }
    .pagenum:before {
        content: counter(page);
    }
</style>
@endsection

@section('content')
    {{-- <div class="footer">
        Psikogram Visumi - {{'{'.$kasus->nomor_kasus.'}'}}{{'{'.$psikogram_visum->id.'}'}} | Halaman <span class="pagenum"></span> of 1
    </div> --}}

    <table width="100%" align="center" style="border-bottom: 5px double #000;">
        <tr>
            <td width="100%" valign="top">
                <table width="100%" cellpadding="5">
                   <tr>
                        <td width="20%" align="right">
                            <img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="80">
                        </td>
                        <td width="60%" align="center">
                            <p style="font-size: 14px;"><b>PEMERINTAH PROVINSI JAWA TIMUR</b></p>
                            <p style="font-size: 22px;"><b>RUMAH SAKIT JIWA MENUR</b></p>
                            <p style="font-size: 10px;">Jln. Menur No. 120, Telp. (031) 5021635, 5021637</p>
                        </td>
                        <td width="20%" align="left">
                            <img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="80">
                        </td>
                   </tr> 
                </table>
            </td>
        </tr>
    </table>

    <table width="100%" cellpadding="5" style="margin-top: 15px;">
        <tr>
            <td width="90%"></td>
            <td width="15%" align="center" bgcolor="#000" style="border: 3px solid #d9d9d9;">
                <p style="font-size: 14px; color: #fff;"><b>rahasia</b></p>
            </td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 15px;">
        <tr>
            <td align="center"><p style="font-size: 12"><b><u>LAPORAN HASIL PEMERIKSAAN PSIKOLOGI</u></b></p></td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 10px;" cellpadding="3">
        <tr>
            <td width="25%">Nama</td>
            <td width="3%">:</td>
            <td width="72%">{{ $kasus->identitas->nama ?? "-" }}</td>
        </tr>
        <tr>
            <td>No. RM</td>
            <td>:</td>
            <td>{{ $kasus->pasien->no_rm ?? "-" }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $kasus->identitas->jenis_kelamin == 'L' ? "Laki-laki" : "Perempuan" }}</td>
        </tr>
        <tr>
            <td>Tgl.Lahir</td>
            <td>:</td>
            <td>{{ !is_null($kasus->identitas->tanggal_lahir) ? date('d/m/Y', strtotime($kasus->identitas->tanggal_lahir)) : "-" }}</td>
        </tr>
        <tr>
            <td>Pendidikan Terakhir</td>
            <td>:</td>
            <td>{{ $kasus->pasien->pendidikan->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <td>{{ $kasus->pasien->job ?? '-' }}</td>
        </tr>
        <tr>
            <td>Status Perkawinan</td>
            <td>:</td>
            <td>
            	@if($kasus->pasien->marriage == 1 ) Single
				@elseif($kasus->pasien->marriage == 2 ) Menikah
				@elseif($kasus->pasien->marriage == 3 ) Duda/Janda
				@else -
				@endif
            </td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $kasus->identitas->alamat ?? '-' }}</td>
        </tr>
        <tr>
            <td>Tanggal Pemeriksaan</td>
            <td>:</td>
            <td>{{ !is_null($psikogram_visum->tanggal_pemeriksaan) ? date('d/m/Y', strtotime($psikogram_visum->tanggal_pemeriksaan)) : "-" }}</td>
        </tr>
        <tr>
            <td>Tujuan Pemeriksaan</td>
            <td>:</td>
            <td>{{ $psikogram_visum->tujuan_pemeriksaan ?? '-' }}</td>
        </tr>
        <tr>
            <td>Rujukan dari</td>
            <td>:</td>
            <td>{{ $psikogram_visum->rujukan_dari ?? '-' }}</td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 20px;">
        <tr>
            <td><p>Berdasarkan pemeriksaan yang telah dilakukan pada hari {{ trim(indonesian_date($psikogram_visum->tanggal_pemeriksaan, 'l')) }}, tanggal {{ trim(indonesian_date($psikogram_visum->tanggal_pemeriksaan)) }}, maka dapat diketahui <b>bahwa pada saat ini :</b></p></td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 15px;">
        <tr>
            <td align="center"><p style="font-size: 13px;"><b>PSIKOGRAM</b></td>
        </tr>
    </table>

    @php 
		$checked = '<div style="font-family: ZapfDingbats, sans-serif;">4</div>' 
	@endphp

    <table width="100%" class="bordered" cellpadding="3" style="margin-top: 5px;">
        <tr>
            <th rowspan="2" colspan="2" align="center">ASPEK-ASPEK</th>
            <th colspan="6" align="center">KRITERIA</th>
        </tr>
        <tr>
            <th align="center">SR</th>
            <th align="center">R</th>
            <th align="center">HC</th>
            <th align="center">C</th>
            <th align="center">T</th>
            <th align="center">ST</th>
        </tr>
        <tr>
            <td colspan="8" align="center"><b>A. ASPEK INTELEGENSI</b></td>
        </tr>
        <tr>
            <td>a. Intelegensi Umum</td>
            <td>Kemampuan untuk memahami dan mengkaji persoalan  /  permasalahan  untuk direspon sesuai tuntutan yang ada</td>
            <td align="center">{!! $psikogram_visum->intelegensi_umum == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->intelegensi_umum == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->intelegensi_umum == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->intelegensi_umum == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->intelegensi_umum == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->intelegensi_umum == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>b. Daya Nalar</td>
            <td>Kemampuan berpikir logis dengan mengarahkan pikiran dan perhatian pada suatu persoalan serta dapat membedakan hal-hal penting dan tidak penting</td>
            <td align="center">{!! $psikogram_visum->daya_nalar == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->daya_nalar == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->daya_nalar == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->daya_nalar == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->daya_nalar == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->daya_nalar == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>c. Daya Analisa Sintesa</td>
            <td>Kemampuan menguraikan persoalan dan menangkap aspek-aspek terkait dengan memahami esensi persoalan</td>
            <td align="center">{!! $psikogram_visum->daya_analisa_sintesa == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->daya_analisa_sintesa == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->daya_analisa_sintesa == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->daya_analisa_sintesa == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->daya_analisa_sintesa == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->daya_analisa_sintesa == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>d. Fleksibilitas Berpikir</td>
            <td>Kemampuan untuk dapat menemukan berbagai alternatif pemecahan masalah dengan cepat, lancar, disertai kelincahan berpikir, agar bisa mencari jalan keluar yang efektif jika mendapat hambatan</td>
            <td align="center">{!! $psikogram_visum->fleksibilitas_berpikir == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->fleksibilitas_berpikir == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->fleksibilitas_berpikir == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->fleksibilitas_berpikir == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->fleksibilitas_berpikir == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->fleksibilitas_berpikir == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>e. Kemampuan Berkomunikasi</td>
            <td>Kemampuan untuk menangkap dan mengekspresikan gagasan, kemauan, perasaan dalam bentuk bahasa     dalam konteks ketepatan, kecermatan pengertian dan kesepakatan</td>
            <td align="center">{!! $psikogram_visum->kemampuan_berkomunikasi == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kemampuan_berkomunikasi == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kemampuan_berkomunikasi == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kemampuan_berkomunikasi == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kemampuan_berkomunikasi == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kemampuan_berkomunikasi == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>f. Kemampuan Pengambilan Keputusan</td>
            <td>Kemampuan yang bernilai baik ditetapkan berdasarkan pertimbangan matang yang secara relatif telah memperhitungkan semua aspek untuk menelaah masalah yang harus dipecahkan</td>
            <td align="center">{!! $psikogram_visum->kemampuan_pengambilan_keputusan == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kemampuan_pengambilan_keputusan == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kemampuan_pengambilan_keputusan == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kemampuan_pengambilan_keputusan == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kemampuan_pengambilan_keputusan == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kemampuan_pengambilan_keputusan == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>g. Kreativitas</td>
            <td>Kemampuan melakukan perubahan ke arah perbaikan dan pembaruan disertai kemampuan menciptakan sesuatu yang original</td>
            <td align="center">{!! $psikogram_visum->kreativitas == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kreativitas == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kreativitas == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kreativitas == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kreativitas == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kreativitas == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>

        <tr>
            <td colspan="8" align="center"><b>B. SIKAP & CARA KERJA</b></td>
        </tr>
        <tr>
            <td>a. Potensi Kerja</td>
            <td>Sumber daya kerja yang teraktualisasikan dengan mengerahkan segenap daya dan upaya mencapai target kerja yang diinginkan</td>
            <td align="center">{!! $psikogram_visum->potensi_kerja == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->potensi_kerja == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->potensi_kerja == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->potensi_kerja == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->potensi_kerja == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->potensi_kerja == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>b. Perencanaan Kerja</td>
            <td>Kemampuan menyusun langkah kerja dan menentukan prioritas penanganan untuk mencapai sasaran kerja</td>
            <td align="center">{!! $psikogram_visum->perencanaan_kerja == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->perencanaan_kerja == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->perencanaan_kerja == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->perencanaan_kerja == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->perencanaan_kerja == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->perencanaan_kerja == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>c. Daya Tahan Kerja</td>
            <td>Kemampuan mempertahankan situasi "menekan" tanpa mempengaruhi prestasi kerja</td>
            <td align="center">{!! $psikogram_visum->daya_tahan_kerja == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->daya_tahan_kerja == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->daya_tahan_kerja == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->daya_tahan_kerja == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->daya_tahan_kerja == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->daya_tahan_kerja == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>d. Inisiatif</td>
            <td>Suatu tindakan aktif dalam merespon persoalan dan mengantisipasi kemungkinan</td>
            <td align="center">{!! $psikogram_visum->inisiatif == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->inisiatif == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->inisiatif == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->inisiatif == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->inisiatif == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->inisiatif == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>e. Motivasi, Dorongan & Ambisi</td>
            <td>Dorongan atau keinginan untuk selalu mencapai prestasi yang terbaik, siap menghadapi tantangan serta mau belajar dan berusaha</td>
            <td align="center">{!! $psikogram_visum->motivasi_dorongan_ambisi == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->motivasi_dorongan_ambisi == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->motivasi_dorongan_ambisi == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->motivasi_dorongan_ambisi == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->motivasi_dorongan_ambisi == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->motivasi_dorongan_ambisi == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>f. Komitmen Pada Tugas</td>
            <td>Kesiapan menjalankan tugas dengan melibatkan diri dalam penyelesaian keseluruhan proses kerja</td>
            <td align="center">{!! $psikogram_visum->komitmen_pada_tugas == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->komitmen_pada_tugas == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->komitmen_pada_tugas == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->komitmen_pada_tugas == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->komitmen_pada_tugas == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->komitmen_pada_tugas == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>

        <tr>
            <td colspan="8" align="center"><b>C. SOSIABILITAS & EMOSI</b></td>
        </tr>
        <tr>
            <td>a. Stabilitas Emosi</td>
            <td>Suatu keadaan kematangan emosi dimana individu mampu mengendalikan perasaan-perasaannya serta tidak mudah reaktif ataupun panik dalam menghadapi tekanan</td>
            <td align="center">{!! $psikogram_visum->stabilitas_emosi == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->stabilitas_emosi == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->stabilitas_emosi == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->stabilitas_emosi == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->stabilitas_emosi == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->stabilitas_emosi == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>b. Kerjasama</td>
            <td>Kemampuan untuk menjalin hubungan kerja/sosialisasi dalam sebuah tim</td>
            <td align="center">{!! $psikogram_visum->kerja_sama == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kerja_sama == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kerja_sama == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kerja_sama == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kerja_sama == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kerja_sama == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>c. Kepekaan Sosial</td>
            <td>Kemampuan akan kepedulian dan mengenali kebutuhan dan perasaan orang lain serta menindaklanjuti respon yang ada</td>
            <td align="center">{!! $psikogram_visum->kepekaan_sosial == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kepekaan_sosial == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kepekaan_sosial == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kepekaan_sosial == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kepekaan_sosial == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $psikogram_visum->kepekaan_sosial == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
    </table>

    <table width="100%" cellpadding="3">
        <tr>
            <td><b>Keterangan</b></td>
        </tr>
        <tr>
            <td>SR: Sangat Rendah</td>
            <td>R: Rendah</td>
            <td>HC: Hampir Cukup</td>
            <td>C: Cukup</td>
            <td>T: Tinggi</td>
            <td>ST: Sangat Tinggi</td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 15px;">
        <tr>
            <td width="60%"></td>
            <td width="40%" align="center">Surabaya, {{ !is_null($psikogram_visum->created_at) ? indonesian_date($psikogram_visum->created_at) : '_____________' }}</td>
        </tr>
        <tr>
            <td></td>
            <td align="center"><b>Psikolog</b></td>
        </tr>
        <tr>
            <td></td>
            <td align="center" height="50"></td>
        </tr>
        <tr>
            <td></td>
            <td align="center">({{$psikogram_visum->creator->name ?? '.........................................'}})</td>
        </tr>
    </table>
@endsection

@section('scripts')
<script type="text/php">
    if (isset($pdf)) {
        $x = $pdf->get_width() - 265;
        $y = $pdf->get_height() - 34;
        $text = "Psikogram Visum - {{'{'.$kasus->nomor_kasus.'}'}}{{'{'.$psikogram_visum->id.'}'}} | Halaman {PAGE_NUM} of {PAGE_COUNT}";
        $font = null;
        $size = 9;
        $color = array(0,0,0);
        $word_space = 0.0;
        $char_space = 0.0;
        $angle = 0.0;
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
</script> 
@endsection