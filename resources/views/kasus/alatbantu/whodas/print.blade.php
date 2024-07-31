@extends('layouts.print')

@section('title')
Print Lembar Penilaian WHODAS 2.0 - {{$kasus->identitas->nama}}
@endsection

@section('css')
<style type="text/css">
    body, p {
        font-size: 13px;
        font-family: Arial, Helvetica, sans-serif;
        /*line-height: 16px;*/
    }
    p {
        margin-bottom: 20px;
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
</style>
@endsection

@section('content')
    <table width="100%">
        <tr>
            <td width="55%" valign="top">
                <table width="100%" cellpadding="5">
                   <tr>
                        <td width="100%">
                            <img src="{{ asset('assets/img/whodas.png') }}" height="80">
                        </td>
                   </tr> 
                </table>
            </td>
            <td width="40%" valign="top">
                <table width="20%" align="right" class="bordered" cellpadding="5">
                    <tr>
                        <td width="100%" align="center">12</td>
                    </tr>
                    <tr>
                        <td width="100%" align="center">Interview</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 20px;">
        <tr>
            <th>LEMBAR PENILAIAN WHO DAS 2.0</th>
        </tr>
    </table>

    <p style="margin-top: 20px;">Versi 12 Pertanyaan, Dilakukan oleh pewawancara</p>
    <p>Pendahuluan</p>

    <p>Instrumen ini dikembangkan oleh Tim Klasifikasi, Terminologi, dan standar WHO dibawah The WHO/National Institutes of Health (NIH) Joint Project on Assesment of Classification of Disability.</p>

    <p>Sebelum menggunakan Instrumen ini pewawancara harus dilatih menggunakan manual Measuring Health and Disability. Manual untuk WHO DAS 2.0 (WHO, 2010), termasuk didalamnya petunjuk interview dan bahan training lainnya.</p>

    <p>Versi wawancara yang tersedia adalah sebagai berikut :</p>
    <ul>
        <li>36 - item - dilakukan oleh pewawancara <sup>a</sup></li>
        <li>36 - item - dilakukan oleh diri sendiri (pasien)</li>
        <li>36 - item - dilakukan oleh pihak ketiga (keluarga pasien) <sup>b</sup></li>
        <li>12 - item - dilakukan oleh pewawancara <sup>c</sup></li>
        <li>12 - item - dilakukan oleh diri sendiri (pasien)</li>
        <li>12 - item - dilakukan oleh pihak ketiga (keluarga pasien)</li>
        <li>12 + 24 - item - dilakukan oleh pewawancara</li>
    </ul>

    <table width="100%" style="margin-top: 20px;">
        <tr>
            <td><sup>a</sup></td>
            <td>Versi komputerisasai dari wawancara <b><i>(IShell) tersedia untuk wawancara yang dipandu komputer atau untuk entry data</i></b></td>
        </tr>
        <tr>
            <td><sup>b</sup></td>
            <td>Keluarga, teman, atau perawat</td>
        </tr>
        <tr>
            <td><sup>c</sup></td>
            <td>Versi 12 pertanyaan menggambarkan 81% varian dari versi 36 pertanyaan yang lebih detail</td>
        </tr>
    </table>

    <p style="margin-top: 20px;">Untuk mendapatkan versi yang lebih detail silahkan merujuk ke WHO DAS 2.0 manual Measuring Health and Disability : Manual For WHO Disability Assesment Schedule - WHO DAS 2.0 (WHO, 2010)</p>

    <p>Ijin untuk translasi Instrumen ini ke bahasa yang lain harus diberikan dari WHO, dan semua transisi harus mengacu pada The WHO translation guideline. <br> Untuk informasi lebih lanjut kunjungi <u>www.who.int/whodas</u></p>

    <div style="page-break-after: always;"></div>

    <p><b>Bagian 2. informasi tentang demografi dan latar belakang</b></p>
    <p>Wawancara ini dikembangkan oleh WHO untuk memahami dengan lebih baik tentang kesulitan yang mungkin dimiliki seseorang sehubungan dengan kondisi kesehatannya. Informasi yang anda berikan pada interview ini bersifat rahasia dan hanya akan digunakan untuk pemeriksaan. Wawancara berlangsung selama 5-10 menit.</p>

    <p>Untuk responden dari populasi umum (bukan populasi klinis) sampaikan bahwa :</p>
    <p>Bahkan jika anda sehat dan tidak mempunyai masalah kesehatan, saya ingin mengajukan pertanyaan-pertanyaan untuk  melengkapi survei.</p>

    <p>Saya akan memukai dengan pertanyaan latar belakang.</p>

    <table width="100%" class="bordered" style="margin-top: 20px;" cellpadding="5">
        <tr>
            <td width="5%" align="center">A1</td>
            <td width="70%">Mencatat jenis kelamin berdasarkan pengamatan</td>
            <td width="25%">{{ $kasus->identitas->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <td align="center">A2</td>
            <td>Berapa usia anda saat ini</td>
            <td>{{ $kasus->identitas->umur ?? '-' }} Tahun</td>
        </tr>
        <tr>
            <td align="center">A3</td>
            <td>Berapa tahun menempuh pendidikan (sejak SD sampai pendidikan terakhir)</td>
            <td>{{ $whodas->berapa_tahun_menempuh_pendidikan ?? '-' }} Tahun</td>
        </tr>
        <tr>
            <td align="center">A4</td>
            <td>Apa status perkawinan anda saat ini ?</td>
            <td>
                @if($kasus->pasien->marriage == 1 ) Single
                @elseif($kasus->pasien->marriage == 2 ) Menikah
                @elseif($kasus->pasien->marriage == 3 ) Duda/Janda
                @else -
                @endif
            </td>
        </tr>
        <tr>
            <td align="center">A4</td>
            <td>Apa pekerjaan utama anda saat ini ?</td>
            <td>{{ $kasus->pasien->job ?? '-' }}</td>
        </tr>
    </table>

    <p style="margin-top: 20px;">Kuisioner ini terdiri dari 12 pertanyaan WHO DAS 2.0 yang dilakukan pewawancara</p>
    <p><b><i>Instruksi untuk pewawancara adalah yang ditulis tebal dan miring, jangan dibacakan keras</i></b></p>

    <p><b><i>Text untuk ditanyakan kepada responden adalah yang tertulis dengan tinta biru</i></b></p>

    <p><b><i>Baca dengan jelas</i></b></p>

    <p>Bagian 1. Lembar Awal</p>

    <table width="100%" class="bordered" cellpadding="5" style="margin-top: 20px;">
        <tr>
            <td colspan="4"><b><i>Lengkapi butir F1-F5 sebelum memulai interview</i></b></td>
        </tr>
        <tr>
            <td width="7%" align="center">F1</td>
            <td width="33%">Nomor Identitas Responden</td>
            <td colspan="2">{{ $whodas->nomor_identitas_responden ?? '-' }}</td>
        </tr>
        <tr>
            <td align="center">F2</td>
            <td>Nomor Identitas Pewawancara</td>
            <td colspan="2">{{ $whodas->nomor_identitas_pewawancara ?? '-' }}</td>
        </tr>
        <tr>
            <td align="center">F3</td>
            <td>Titik Waktu Penilaian</td>
            <td colspan="2">{{ $whodas->titik_waktu_penilaian ?? '-' }}</td>
        </tr>
        <tr>
            <td align="center">F4</td>
            <td>Waktu Wawancara</td>
            <td colspan="2">{{!is_null($whodas->waktu_wawancara) ? indonesian_date($whodas->waktu_wawancara): '-'}}</td>
        </tr>

        @php 
	        $checked = '<div style="font-family: ZapfDingbats, sans-serif;">4</div>';
	    @endphp

        <tr>
            <td rowspan="3" align="center">F5</td>
            <td rowspan="3">Situasi Hidup Saat Wawancara</td>
            <td width="55%">Mandiri di komunitas</td>
            <td width="5%" align="center">{!! $whodas->situasi_hidup_saat_wawancara == 'Mandiri di komunitas' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>Hidup dengan bantuan (fisik, keuangan atau sosial)</td>
            <td align="center">{!! $whodas->situasi_hidup_saat_wawancara == 'Hidup dengan bantuan' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>Dirawat di rumah sakit</td>
            <td align="center">{!! $whodas->situasi_hidup_saat_wawancara == 'Dirawat di rumah sakit' ? $checked : '' !!}</td>
        </tr>
    </table>

    <p style="margin-top: 20px;"><b><i>Silahkan lanjut ke halaman berikutnya ......</i></b></p>

    <div style="page-break-after: always;"></div>

    <p><b>Bagian 3. Pembukaan</b></p>
    <p><b><i>Sampaikan kepada responden</i></b></p>
    <p>Wawancara ini adalah tentang kesulitan yang dialami seseorang akibat masalah kesehatannya.</p>
    <p><b><i>Tunjukkan Kartu Petunjuk Pertama kepada responden</i></b></p>

    <p>Yang dimaksud masalah kesehatan adalah penyakit atau masalah kesehatan lain yang dapat berlangsung jangka pendek atau panjang; cedera; masalah kejiwaan atau emosional; dan masalah dengan alkohol atau zat psikoaktif.</p>

    <p>Ingatlah untuk memikirkan semua masalah kesehatan saat Anda menjawab pertanyaan. Bila saya bertanya tentang kesulitan dalam melakukan aktivitas, pikirkan....</p>

    <p><b><i>Tunjuk ke Kartu Petunjuk Pertama</i></b></p>
    <ul>
        <li>perlu usaha lebih besar</li>
        <li>ketidaknyamanan atau rasa nyeri</li>
        <li>melambat</li>
        <li>perubahan dalam melakukan aktivitas</li>
    </ul>

    <p>Saat menjawab, saya minta Anda untuk memikirkan kembali dalam jangka waktu 30 hari terakhir. Saya juga minta Anda untuk menjawab pertanyaan tersebut dengan memikirkan tentang seberapa besar rata-rata kesulitan yang Anda alami saat melakukan aktivitas yang biasa Anda lakukan selama 30 hari terakhir.</p>

    <p><b><i>Tunjukkan kartu petunjuk kedua kepada responden </i></b><br> Gunakan skala ini saat menjawab</p>

    <p><b><i>Bacakan skala dengan suara jelas :</i></b><br> Tidak ada, ringan, sedang, berat, sangat berat atau tidak mampu melakukan.</p>

    <p><b><i>Pasitikan bahwa responden dapat dengan mudah melihat Kartu Petunjuk Pertama dan Kedua selama wawancara</i></b></p>

    <p style="margin-top: 20px;"><b><i>Lanjutkan ke halaman berikut......</i></b></p>

    <div style="page-break-after: always;"></div>

    <p><b>Bagian 4. Pertanyaan Inti</b></p>
    <p><b><i>Tunjukkan Kartu Pertunjuk Kedua</i></b></p>

    <table width="100%" class="bordered" cellpadding="3" style="margin-top: 20px;">
        <tr>
            <th colspan="2" align="center">Dalam 30 hari terakhir, berapa besar kesulitan yang anda alami dalam :</th>
            <th width="10%" align="center">Tidak ada</th>
            <th width="10%" align="center">Ringan</th>
            <th width="10%" align="center">Sedang</th>
            <th width="10%" align="center">Berat</th>
            <th width="25%" align="center">Sangat berat atau tidak mampu melakukan</th>
        </tr>
        <tr>
            <td width="5%" align="center">S1</td>
            <td width="30%">Berdiri untuk jangka waktu lama misalnya 30 menit?</td>
            <td align="center">{!! $whodas->berdiri_untuk_jangka_waktu_yang_lama == 'Tidak ada' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->berdiri_untuk_jangka_waktu_yang_lama == 'Ringan' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->berdiri_untuk_jangka_waktu_yang_lama == 'Sedang' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->berdiri_untuk_jangka_waktu_yang_lama == 'Berat' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->berdiri_untuk_jangka_waktu_yang_lama == 'Sangat berat' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td align="center">S2</td>
            <td>Melakukan pekerjaan rumah?</td>
            <td align="center">{!! $whodas->melakukan_pekerjaan_rumah == 'Tidak ada' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->melakukan_pekerjaan_rumah == 'Ringan' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->melakukan_pekerjaan_rumah == 'Sedang' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->melakukan_pekerjaan_rumah == 'Berat' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->melakukan_pekerjaan_rumah == 'Sangat berat' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td align="center">S3</td>
            <td>Mempelajari hal baru, misalnya pergi ke tempat baru?</td>
            <td align="center">{!! $whodas->mempelajari_hal_baru == 'Tidak ada' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->mempelajari_hal_baru == 'Ringan' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->mempelajari_hal_baru == 'Sedang' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->mempelajari_hal_baru == 'Berat' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->mempelajari_hal_baru == 'Sangat berat' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td align="center">S4</td>
            <td>Apakah anda mengalami kesulitan bergabung dalam aktivitas di masyarakat? (Contohnya kegiatan keagamaan, perayaan) seperti halnya yang dilakukan orang lain?</td>
            <td align="center">{!! $whodas->mengalami_kesulitan_bergabung == 'Tidak ada' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->mengalami_kesulitan_bergabung == 'Ringan' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->mengalami_kesulitan_bergabung == 'Sedang' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->mengalami_kesulitan_bergabung == 'Berat' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->mengalami_kesulitan_bergabung == 'Sangat berat' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td align="center">S5</td>
            <td>Sejauh mana kondisi kesehatan anda mempengaruhi anda secara emosional?</td>
            <td align="center">{!! $whodas->kondisi_kesehatan_mempengaruhi_emosional == 'Tidak ada' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->kondisi_kesehatan_mempengaruhi_emosional == 'Ringan' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->kondisi_kesehatan_mempengaruhi_emosional == 'Sedang' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->kondisi_kesehatan_mempengaruhi_emosional == 'Berat' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->kondisi_kesehatan_mempengaruhi_emosional == 'Sangat berat' ? $checked : '' !!}</td>
        </tr>
    </table>

    <table width="100%" class="bordered" cellpadding="3" style="margin-top: 20px;">
        <tr>
            <th colspan="2" align="center">Dalam 30 hari terakhir, berapa besar kesulitan yang anda alami dalam :</th>
            <th width="10%" width="%" align="center">Tidak ada</th>
            <th width="10%" width="%" align="center">Ringan</th>
            <th width="10%" width="%" align="center">Sedang</th>
            <th width="10%" width="%" align="center">Berat</th>
            <th width="25%" width="%" align="center">Sangat berat atau tidak mampu melakukan</th>
        </tr>
        <tr>
            <td width="5%" align="center">S6</td>
            <td width="30%">Berkonsentrasi dalam melakukan sesuatu selama 10 menit?</td>
            <td align="center">{!! $whodas->berkonsentrasi_dalam_melakukan_sesuatu == 'Tidak ada' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->berkonsentrasi_dalam_melakukan_sesuatu == 'Ringan' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->berkonsentrasi_dalam_melakukan_sesuatu == 'Sedang' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->berkonsentrasi_dalam_melakukan_sesuatu == 'Berat' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->berkonsentrasi_dalam_melakukan_sesuatu == 'Sangat berat' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td align="center">S7</td>
            <td>Untuk berjalan dalam jarak yang jauh, misalnya 1 kilometer?</td>
            <td align="center">{!! $whodas->berjalan_dalam_jarak_yang_jauh == 'Tidak ada' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->berjalan_dalam_jarak_yang_jauh == 'Ringan' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->berjalan_dalam_jarak_yang_jauh == 'Sedang' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->berjalan_dalam_jarak_yang_jauh == 'Berat' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->berjalan_dalam_jarak_yang_jauh == 'Sangat berat' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td align="center">S8</td>
            <td>Mandi</td>
            <td align="center">{!! $whodas->mandi == 'Tidak ada' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->mandi == 'Ringan' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->mandi == 'Sedang' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->mandi == 'Berat' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->mandi == 'Sangat berat' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td align="center">S9</td>
            <td>Berpakaian</td>
            <td align="center">{!! $whodas->berpakaian == 'Tidak ada' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->berpakaian == 'Ringan' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->berpakaian == 'Sedang' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->berpakaian == 'Berat' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->berpakaian == 'Sangat berat' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td align="center">S10</td>
            <td>Berhubungan dengan orang baru yang belum dikenal</td>
            <td align="center">{!! $whodas->berhubungan_dengan_orang_baru == 'Tidak ada' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->berhubungan_dengan_orang_baru == 'Ringan' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->berhubungan_dengan_orang_baru == 'Sedang' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->berhubungan_dengan_orang_baru == 'Berat' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->berhubungan_dengan_orang_baru == 'Sangat berat' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td align="center">S11</td>
            <td>Mempertahankan pertemanan</td>
            <td align="center">{!! $whodas->mempertahankan_pertemanan == 'Tidak ada' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->mempertahankan_pertemanan == 'Ringan' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->mempertahankan_pertemanan == 'Sedang' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->mempertahankan_pertemanan == 'Berat' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->mempertahankan_pertemanan == 'Sangat berat' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td align="center">S12</td>
            <td>Kembali bekerja atau bersekolah</td>
            <td align="center">{!! $whodas->kembali_bekerja_atau_bersekolah == 'Tidak ada' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->kembali_bekerja_atau_bersekolah == 'Ringan' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->kembali_bekerja_atau_bersekolah == 'Sedang' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->kembali_bekerja_atau_bersekolah == 'Berat' ? $checked : '' !!}</td>
            <td align="center">{!! $whodas->kembali_bekerja_atau_bersekolah == 'Sangat berat' ? $checked : '' !!}</td>
        </tr>
    </table>

    <table width="100%" class="bordered" cellpadding="3" style="margin-top: 20px;">
        <tr>
            <td width="5%" align="center">H1</td>
            <td width="75%">Secara keseluruhan dalam 30 hari ini, secara keseluruhan, ada berapa hari anda mengalami kesulitan tersebut?</td>
            <td width="20%">{{ $whodas->berapa_hari_anda_mengalami_kesulitan ?? '-' }} hari</td>
        </tr>
        <tr>
            <td align="center">H2</td>
            <td>Dalam 30 hari terakhir, selama beberapa hari anda sama sekali tidak mampu melakukan aktivitas atau pekerjaan seperti biasa karena ada masalah kesehatan?</td>
            <td>{{ $whodas->berapa_hari_sama_sekali_tidak_mampu_melakukan_aktifitas ?? '-' }} hari</td>
        </tr>
        <tr>
            <td align="center">H3</td>
            <td>Dalam 30 hari terakhir, dengan tidak memperhitungkan hari dimana anda sama sekali tidak mampu beberapa hari anda harus mengurangi aktivitas atau pekerjaan yang biasa dilakukan karena masalah kesehatan tersebut?</td>
            <td>{{ $whodas->berapa_hari_anda_harus_mengurangi_aktifitas ?? '-' }} hari</td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 20px;">
        <tr>
            <td width="60%"></td>
            <td width="40%" align="center">Surabaya, {{!is_null($whodas->created_at) ? indonesian_date($whodas->created_at) : '_____________'}}</td>
        </tr>
        <tr>
            <td></td>
            <td align="center">Dokter Penanggung Jawab</td>
        </tr>
        <tr>
            <td></td>
            <td align="center" height="50">
                @if(isset($kasus->admin->user->ttd))
                    <img src="{{ public_path($kasus->admin->user->ttd) }}" style="max-width: 90px;">
                @else
                @endif
            </td>
        </tr>
        <tr>
            <td></td>
            <td align="center">{{$kasus->admin->user->name ?? '.........................................'}}</td>
        </tr>
        <tr>
            <td></td>
            <td align="center">NIP. .........................................</td>
        </tr>
    </table>

    <div style="page-break-after: always;"></div>

    <p><b><i>Kartu Petunjuk Pertama</i></b></p>
    <p>Kondisi Kesehatan terdiri dari :</p>
    <ul>
        <li>penyakit, keluhan atau masalah kesehatan lainnya</li>
        <li>cedera</li>
        <li>masalah psikis atau emosi</li>
        <li>masalah dengan alkohol</li>
        <li>masalah dengan obat-obatan</li>
    </ul>

    <p>Kesulitan dalam melakukan aktivitas, artinya :</p>
    <ul>
        <li>perlu usaha lebih besar</li>
        <li>ketidaknyamanan atau rasa nyeri</li>
        <li>melambat</li>
        <li>perubahan dalam melakukan aktivitas</li>
    </ul>

    <p>Pikirkan hanya 30 terakhir</p>

    <hr>
    <p style="margin-top: 20px;"><b><i>Kartu Petunjuk Kedua</i></b></p>
    <img src="{{ asset('assets/img/kartu_petunjuk_kedua.png') }}" width="100%">
@endsection