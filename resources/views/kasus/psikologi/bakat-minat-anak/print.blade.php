@extends('layouts.print')

@section('title')
Print Hasil Tes Bakat Minat Anak - {{$kasus->identitas->nama}}
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
    .word-break {
        word-wrap: break-word;width:100%;
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
    /*table { page-break-inside:auto }
    tr.next-page { page-break-inside:avoid !important; }
    thead { display:table-header-group }
    tfoot { display:table-footer-group }*/
</style>
@endsection

@section('content')
    {{-- <div class="footer">
        Bakat Minat Anak - {{'{'.$kasus->nomor_kasus.'}'}}{{'{'.$bakat_minat_anak->id.'}'}} | Halaman <span class="pagenum"></span> of 2
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
            <td align="center"><p style="font-size: 14"><b><u>HASIL PEMERIKSAAN PSIKOLOGI</u></b></p></td>
        </tr>
    </table>

    <table class="" width="100%" style="margin-top: 15px;" cellpadding="3">
        <tr>
            <td width="20%">Nama</td>
            <td width="2%">:</td>
            <td width="32%"><b>{{ $kasus->identitas->nama ?? '-' }}</b></td>
            <td width="12%">Nomor</td>
            <td width="2%">:</td>
            <td width="32%">{{ $bakat_minat_anak->nomor ?? '-' }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin / Umur</td>
            <td>:</td>
            <td>
                {{ $kasus->identitas->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }} / {{ $kasus->identitas->umur ?? '-' }} Tahun
            </td>
            <td>Tujuan Tes</td>
            <td>:</td>
            <td>{{ $bakat_minat_anak->tujuan_tes ?? '-' }}</td>
        </tr>
        <tr>
            <td>Pendidikan</td>
            <td>:</td>
            <td>{{ $kasus->pasien->pendidikan->nama ?? '-' }}</td>
            <td>Tanggal Tes</td>
            <td>:</td>
            <td>{{ indonesian_date($bakat_minat_anak->tanggal_tes) ?? '-' }}</td>
        </tr>
    </table>

    <table width="50%" class="bordered" style="margin-top: 20px;">
        <tr>
            <td align="center"><p style="font-size: 13px;">Kemampuan Intelegensi : <b>{{ $bakat_minat_anak->kemampuan_intelegensi }}</b></p></td>
            <td align="center"><p style="font-size: 13px;">Kategori : <b>{{ $bakat_minat_anak->kategori }}</b></p></td>
        </tr>
    </table>

    @php 
        $checked = '<div style="font-family: ZapfDingbats, sans-serif;">4</div>';
    @endphp

    <table width="100%" class="bordered" cellpadding="5" style="margin-top: 15px; table-layout: fixed;">
        <thead>
            <tr>
                <th align="center" colspan="2">Aspek Psikologis</th>
                <th align="center">Gambaran Individu <br> (Skor Rendah)</th>
                <th align="center">SR</th>
                <th align="center">R</th>
                <th align="center">S</th>
                <th align="center">T</th>
                <th align="center">ST</th>
                <th align="center">Gambaran Individu <br> (Skor Tinggi)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="5%" rowspan="8" align="center"><p style="transform: rotate(-90deg);">Intelegensi</p></td>
                <td width="20%">Penalaran Kongkrit</td>
                <td width="25%">Kurang mampu berpikir kongkrit praktis dan realistis, sehingga sulit mengambil keputusan</td>
                <td width="5%" align="center">{!! $bakat_minat_anak->penalaran_kongkrit == 'Sangat Rendah' ? $checked : '' !!}</td>
                <td width="5%" align="center">{!! $bakat_minat_anak->penalaran_kongkrit == 'Rendah' ? $checked : '' !!}</td>
                <td width="5%" align="center">{!! $bakat_minat_anak->penalaran_kongkrit == 'Sedang' ? $checked : '' !!}</td>
                <td width="5%" align="center">{!! $bakat_minat_anak->penalaran_kongkrit == 'Tinggi' ? $checked : '' !!}</td>
                <td width="5%" align="center">{!! $bakat_minat_anak->penalaran_kongkrit == 'Sangat Tinggi' ? $checked : '' !!}</td>
                <td width="25%">Mampu mengambil keputusan berdasarkan data yang menyertai dan berpikir realistis yang kongkrit praktis</td>
            </tr>
            <tr>
                <td>Penalaran Abstrak</td>
                <td>Sulit menemukan inti persoalan</td>
                <td align="center">{!! $bakat_minat_anak->penalaran_abstrak == 'Sangat Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->penalaran_abstrak == 'Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->penalaran_abstrak == 'Sedang' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->penalaran_abstrak == 'Tinggi' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->penalaran_abstrak == 'Sangat Tinggi' ? $checked : '' !!}</td>
                <td>Mampu dalam membentuk pengertian dan menemukan inti persoalan</td>
            </tr>
            <tr>
                <td>Pemahaman Verbal</td>
                <td>Sulit memahami suatu arahan dan instruksi serta membutuhkan waktu untuk mengerti penjelasan</td>
                <td align="center">{!! $bakat_minat_anak->pemahaman_verbal == 'Sangat Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->pemahaman_verbal == 'Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->pemahaman_verbal == 'Sedang' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->pemahaman_verbal == 'Tinggi' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->pemahaman_verbal == 'Sangat Tinggi' ? $checked : '' !!}</td>
                <td>Mudah memahami dan berpikir dengan menggunakan penguasaan bahasa</td>
            </tr>
            <tr>
                <td>Kemampuan Numerik</td>
                <td>Cenderung kesulitan dalam mengerjakan soal hitungan</td>
                <td align="center">{!! $bakat_minat_anak->kemampuan_numerik == 'Sangat Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->kemampuan_numerik == 'Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->kemampuan_numerik == 'Sedang' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->kemampuan_numerik == 'Tinggi' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->kemampuan_numerik == 'Sangat Tinggi' ? $checked : '' !!}</td>
                <td>Mampu menerapkan konsep aritmatik dan berpikir logis menggunakan angka-angka</td>
            </tr>
            <tr>
                <td>Daya Analisis Sintesa</td>
                <td>Kurang mampu berpikir menyeluruh dalam menghadapi persoalan</td>
                <td align="center">{!! $bakat_minat_anak->daya_analisis_sintesa == 'Sangat Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->daya_analisis_sintesa == 'Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->daya_analisis_sintesa == 'Sedang' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->daya_analisis_sintesa == 'Tinggi' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->daya_analisis_sintesa == 'Sangat Tinggi' ? $checked : '' !!}</td>
                <td>Kemampuan berpikir menyeluruh, menangkap, dan membentuk sesuatu</td>
            </tr>
            <tr>
                <td>Daya Bayang Ruang</td>
                <td>Kurang mampu berpikir konstruktif teknis dan kurang kritis dalam berpikir</td>
                <td align="center">{!! $bakat_minat_anak->daya_bayang_ruang == 'Sangat Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->daya_bayang_ruang == 'Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->daya_bayang_ruang == 'Sedang' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->daya_bayang_ruang == 'Tinggi' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->daya_bayang_ruang == 'Sangat Tinggi' ? $checked : '' !!}</td>
                <td>Mampu berpikir konstruktif teknis, kritis dengan menggunakan komponen ruang</td>
            </tr>
            <tr>
                <td>Konsentrasi & Daya Ingat</td>
                <td>Ingatan serta konsentrasi kurang tajam dan mudah lupa sehingga sulit untuk menyelesaikan persoalan-persoalan hafalan</td>
                <td align="center">{!! $bakat_minat_anak->konsentrasi_daya_ingat == 'Sangat Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->konsentrasi_daya_ingat == 'Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->konsentrasi_daya_ingat == 'Sedang' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->konsentrasi_daya_ingat == 'Tinggi' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->konsentrasi_daya_ingat == 'Sangat Tinggi' ? $checked : '' !!}</td>
                <td>Memiliki kemampuan mengingat dan berkonsentrasi yang memadai untuk menyelesaikan persoalan-persoalan hafalan</td>
            </tr>
            <tr>
                <td>Kemampuan Skolastik</td>
                <td>Kurang mampu dalam menyelesaiakn persoalan-persoalan akademik secara umum</td>
                <td align="center">{!! $bakat_minat_anak->kemampuan_skolastik == 'Sangat Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->kemampuan_skolastik == 'Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->kemampuan_skolastik == 'Sedang' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->kemampuan_skolastik == 'Tinggi' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->kemampuan_skolastik == 'Sangat Tinggi' ? $checked : '' !!}</td>
                <td>Mampu dalam menyelesaikan persoalan-persoalan akademik secara umum</td>
            </tr>
        </tbody>
    </table>

    <div style="page-break-after: always;"></div>

    <table width="100%" class="bordered" cellpadding="5" style="margin-top: 15px; table-layout: fixed;">
        <thead>
            <tr>
                <th align="center" colspan="2">Aspek Psikologis</th>
                <th align="center">Gambaran Individu <br> (Skor Rendah)</th>
                <th align="center">SR</th>
                <th align="center">R</th>
                <th align="center">S</th>
                <th align="center">T</th>
                <th align="center">ST</th>
                <th align="center">Gambaran Individu <br> (Skor Tinggi)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="5%" rowspan="4" align="center"><div><p style="transform: rotate(-90deg);">Kepribadian</p></div></td>
                <td width="20%">Kematangan Emosi</td>
                <td width="25%">Emosional, mudah tersinggung, dan lebih dipengaruhi perasaan</td>
                <td width="5%" align="center">{!! $bakat_minat_anak->kematangan_emosi == 'Sangat Rendah' ? $checked : '' !!}</td>
                <td width="5%" align="center">{!! $bakat_minat_anak->kematangan_emosi == 'Rendah' ? $checked : '' !!}</td>
                <td width="5%" align="center">{!! $bakat_minat_anak->kematangan_emosi == 'Sedang' ? $checked : '' !!}</td>
                <td width="5%" align="center">{!! $bakat_minat_anak->kematangan_emosi == 'Tinggi' ? $checked : '' !!}</td>
                <td width="5%" align="center">{!! $bakat_minat_anak->kematangan_emosi == 'Sangat Tinggi' ? $checked : '' !!}</td>
                <td width="25%">Kemampuan mengendalikan emosi dengan baik dan tidak mudah reaktif terhadap situasi lingkungan</td>
            </tr>
            <tr>
                <td>Kemasakan Sosial</td>
                <td>Kurang memperhatikan tuntunan-tuntunan sosial</td>
                <td align="center">{!! $bakat_minat_anak->kemasakan_sosial == 'Sangat Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->kemasakan_sosial == 'Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->kemasakan_sosial == 'Sedang' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->kemasakan_sosial == 'Tinggi' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->kemasakan_sosial == 'Sangat Tinggi' ? $checked : '' !!}</td>
                <td>Peka atau tanggap terhadap perasaan dan kebutuhan orang lain di lingkungan sosial</td>
            </tr>
            <tr>
                <td>Kemampuan Adaptasi</td>
                <td>Kaku, kurang luwes, membutuhkan waktu lama untuk menyesuaikan diri</td>
                <td align="center">{!! $bakat_minat_anak->kemampuan_adaptasi == 'Sangat Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->kemampuan_adaptasi == 'Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->kemampuan_adaptasi == 'Sedang' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->kemampuan_adaptasi == 'Tinggi' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->kemampuan_adaptasi == 'Sangat Tinggi' ? $checked : '' !!}</td>
                <td>Mampu menyesuaikan diri dengan perubahan situasi</td>
            </tr>
            <tr>
                <td>Motivasi Berprestasi</td>
                <td>Mudah puas, kurang memiliki dorongan yang kuat untuk mencapai hasil atau prestasi yang lebih dari sekedarnya</td>
                <td align="center">{!! $bakat_minat_anak->motivasi_berprestasi == 'Sangat Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->motivasi_berprestasi == 'Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->motivasi_berprestasi == 'Sedang' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->motivasi_berprestasi == 'Tinggi' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->motivasi_berprestasi == 'Sangat Tinggi' ? $checked : '' !!}</td>
                <td>Memiliki dorongan untuk melakukan pekerjaan secara maksimal serta berusahan untuk mencapai hasil atau prestasi dengan sebaik mungkin</td>
            </tr>
            <tr>
                <td rowspan="4" align="center"><p style="transform: rotate(-90deg);">Sikap&nbsp;Kerja</p></td>
                <td>Kecepatan Kerja</td>
                <td>Lambat dalam mengerjakan tugas, kurang cekatan</td>
                <td align="center">{!! $bakat_minat_anak->kecepatan_kerja == 'Sangat Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->kecepatan_kerja == 'Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->kecepatan_kerja == 'Sedang' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->kecepatan_kerja == 'Tinggi' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->kecepatan_kerja == 'Sangat Tinggi' ? $checked : '' !!}</td>
                <td>Cepat dalam mengerjakan tugas dan menyesuaikan diri dengan situasi baru</td>
            </tr>
            <tr>
                <td>Ketelitian</td>
                <td>Ceroboh dan kurang hati-hati dalam mengerjakan tugas</td>
                <td align="center">{!! $bakat_minat_anak->ketelitian == 'Sangat Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->ketelitian == 'Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->ketelitian == 'Sedang' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->ketelitian == 'Tinggi' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->ketelitian == 'Sangat Tinggi' ? $checked : '' !!}</td>
                <td>Cermat dan hati-hati dalam mengerjakan tugas</td>
            </tr>
            <tr>
                <td>Ketekunan atau Keuletan</td>
                <td>Kurang tekun dan mudah bosan dengan rutinitas yang monoton</td>
                <td align="center">{!! $bakat_minat_anak->ketekunan_keuletan == 'Sangat Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->ketekunan_keuletan == 'Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->ketekunan_keuletan == 'Sedang' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->ketekunan_keuletan == 'Tinggi' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->ketekunan_keuletan == 'Sangat Tinggi' ? $checked : '' !!}</td>
                <td>Sabar dan tahan dengan tugas rutin serta tidak mudah bosan</td>
            </tr>
            <tr>
                <td>Daya Tahan Terhadap Stres</td>
                <td>Kurang mampu mengerjakan tugas dibawah tekanan</td>
                <td align="center">{!! $bakat_minat_anak->daya_tahan_terhadap_stress == 'Sangat Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->daya_tahan_terhadap_stress == 'Rendah' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->daya_tahan_terhadap_stress == 'Sedang' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->daya_tahan_terhadap_stress == 'Tinggi' ? $checked : '' !!}</td>
                <td align="center">{!! $bakat_minat_anak->daya_tahan_terhadap_stress == 'Sangat Tinggi' ? $checked : '' !!}</td>
                <td>Mampu mengerjakan tugas meskipun dalam situasi yang menekan</td>
            </tr>
            @php 
                $minat = json_decode($bakat_minat_anak->minat);
            @endphp
            <tr>
                <td rowspan="2" align="center"><p style="transform: rotate(-90deg);">Minat</p></td>
                <td>Minat ke-1</td>
                <td colspan="7">
                    <b>{{ $minat[0]->judul_minat }}</b> <br>
                    {{ $minat[0]->minat }}
                </td>
            </tr>
            <tr>
                <td>Minat ke-2</td>
                <td colspan="7">
                    <b>{{ $minat[1]->judul_minat ?? '-' }}</b> <br>
                    {{ $minat[1]->minat ?? '-' }}
                </td>
            </tr>
        </tbody>
    </table>

    <table width="100%" cellpadding="3" style="margin-top: 15px;">
        <tr>
            <td width="70%">
                <table width="100%">
                    <tr>
                        <td colspan="2"><b>Overal Rating</b></td>
                    </tr>
                    <tr>
                        <td align="center" width="7%" style="border: 1px solid #000;">
                            {!! $bakat_minat_anak->overall == 'Baik' ? $checked : '' !!}
                        </td>
                        <td width="93%">Baik</td>
                    </tr>
                    <tr>
                        <td align="center" style="border: 1px solid #000;">
                            {!! $bakat_minat_anak->overall == 'Cukup' ? $checked : '' !!}
                        </td>
                        <td>Cukup</td>
                    </tr>
                    <tr>
                        <td align="center" style="border: 1px solid #000;">
                            {!! $bakat_minat_anak->overall == 'Kurang' ? $checked : '' !!}
                        </td>
                        <td>Kurang</td>
                    </tr>
                </table>
            </td>
            <td width="30%">
                <table width="100%" style="border: 1px solid #000; border-radius: 10px;">
                    <tr>
                        <td align="center"><b>Keterangan</b></td>
                    </tr>
                    <tr>
                        <td align="center">SR - Sangat Rendah</td>
                    </tr>
                    <tr>
                        <td align="center">R - Rendah</td>
                    </tr>
                    <tr>
                        <td align="center">S - Sedang</td>
                    </tr>
                    <tr>
                        <td align="center">T - Tinggi</td>
                    </tr>
                    <tr>
                        <td align="center">ST - Sangat Tinggi</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    {{-- <div style="page-break-after: always;"></div> --}}

    <table width="100%" style="margin-top: 20px;">
        <tr>
            <td><p><b><u>Deskripsi</u></b></p></td>
        </tr>
        <tr>
            <td>
                <div class="word-break">
                    {!! nl2br(e($bakat_minat_anak->deskripsi ?? "-")) !!}
                </div>
            </td>
        </tr>
        <tr>
            <td><p style="margin-top: 20px;"><b><u>Saran Pemilihan Penjurusan</u></b></p></td>
        </tr>
        <tr>
            <td>
                <div class="word-break">
                    {!! nl2br(e($bakat_minat_anak->saran_pemilihan_penjurusan ?? "-")) !!}
                </div>
            </td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 20px;">
        <tr>
            <td width="60%"></td>
            <td width="40%" align="center">Surabaya, {{ indonesian_date($bakat_minat_anak->created_at) ?? '-' }}</td>
        </tr>
        <tr>
            <td></td>
            <td align="center"><b>Pemeriksa</b></td>
        </tr>
        @if(isset($bakat_minat_anak->creator->ttd) && !empty($bakat_minat_anak->creator->ttd))
            <tr>
                <td></td>
                <td align="center" height="50"><img src="{{{url('')}}}/{{{$bakat_minat_anak->creator->ttd}}}" height="50px"></td>
            </tr>
        @else
            <tr>
                <td></td>
                <td align="center" height="50"></td>
            </tr>
        @endif
        <tr>
            <td></td>
            <td align="center">
                <p><u>{{$bakat_minat_anak->dokterPemeriksa->name ?? '.........................................'}}</u></p>
{{--                <p>NIP. 3050103198227361</p>--}}
            </td>
        </tr>
    </table>
@endsection

@section('scripts')
<script type="text/php">
    if (isset($pdf)) {
        $x = $pdf->get_width() - 265;
        $y = $pdf->get_height() - 34;
        $text = "Bakat Minat Anak - {{'{'.$kasus->nomor_kasus.'}'}}{{'{'.$bakat_minat_anak->id.'}'}} | Halaman {PAGE_NUM} of {PAGE_COUNT}";
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