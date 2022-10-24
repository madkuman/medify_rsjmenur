@extends('layouts.print')

@section('title')
Print Persetujuan Umum Tindakan Kedokteran
@endsection

@section('css')
<style type="text/css">
    body, p {
        font-size: 12px;
        font-family: sans-serif, Arial, Helvetica;
        line-height: 16px;
    }
    table.bordered {
      border-collapse: collapse;
    }
    table.bordered, .bordered th, .bordered td {
      border: 1px solid black;
    }
    .section {
        padding: 5px;
        margin-bottom: 15px;
        border: 1px solid #000;
    }
    ol li.list {
        margin-bottom:10px;
    }
    ol {
        padding-left: 15px;
    }
</style>
@endsection

@section('content')
    <header>
        <table class="bordered" align="right" cellpadding="5">
            <tr>
                <td align="center">RM. 18.K.6</td>
            </tr>
            <tr>
                <td align="center">Halaman 1/2</td>
            </tr>
        </table>
    </header>

    <table width="100%">
        <tr>
            <td width="60%" valign="top">
                <table width="100%" cellpadding="5">
                   <tr>
                        <td width="15%" align="right">
                            <img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="50">
                        </td>
                        <td width="60%" align="center">
                            <p style="font-size: 10px;">PEMERINTAH PROVINSI JAWA TIMUR <br>
                            <b>RUMAH SAKIT JIWA MENUR</b> <br>
                            Jln. Menur No. 120, Telp. (031) 5021635, 5021637 <br>
                            <b>SURABAYA</b>
                            </p>
                        </td>
                        <td width="25%" align="left">
                            <img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="50">
                        </td>
                   </tr> 
                </table>
            </td>
            <td width="40%"></td>
        </tr>
    </table>

    <table>
        <tr>
            <td>
                <h4>PERSETUJUAN UMUM TINDAKAN KEDOKTERAN</h4>        
            </td>
        </tr>
        <tr>
            <td>Yang bertanda tangan dibawah ini :</td>
        </tr>
    </table>

    <table>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>__________________________________________________________________________</td>
        </tr>
        <tr>
            <td>Umur</td>
            <td>:</td>
            <td>__________________________________________________________________________</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>__________________________________________________________________________</td>
        </tr>
    </table>

    <table>
        <tr>
            <td>Bukti Diri / KTP</td>
            <td>:</td>
            <td>__________________________________________________________________________</td>
        </tr>
        <tr>
            <td>Hubungan Kekeluargaan</td>
            <td>:</td>
            <td>__________________________________________________________________________</td>
        </tr>
        <tr>
            <td>Bertindak untuk dan atas nama</td>
            <td>:</td>
            <td>__________________________________________________________________________</td>
        </tr>
    </table>

    <p>KAMI MENYATAKAN PERSETUJUAN :</p>
    <ol>
        <li class="list"><b>PERSETUJUAN UNTUK PERAWATAN DAN PENGOBATAN</b> <br>
            <ol>
                <li>Kami mengetahui bahwa keluarga kami memiliki kondisi yang membutuhkan perawatan medis, Kami mengijinkan dokter dan profesional kesehatan lainnya untuk melakukan prosedur diagnostik dan untuk memberikan pengobatan medis seperti yang diperlukan dalam penilaian profesional mereka. Prosedur diagnostik dan perawatan medis termasuk terapi tidak terbatas pada elektrokardiogram, x-ray, tes darah, terapi fisik, dan pemberian obat.</li>

                <li>Kami sadar bahwa praktik kedokteran bukanlah ilmu pasti dan Kami mengakui bahwa tidak ada jaminan atas hasil apapun, terhadap perawatan prosedur atau pemeriksaan apapun yang dilakukan kepada keluarga kami.</li>

                <li>Kami mengerti dan memahami bahwa : <br>
                    <ol type="a">
                        <li>Kami memiliki hak untuk mengajukan pertanyaan tentang perawatan dan pengobatan yang diusulkan (termasuk identitas setiap orang yang memberikan perawatan atau mengamati pengobatan) setiap saat.</li>

                        <li>Kami mengerti dan memahami bahwa Kami memiliki hak untuk memberikan persetujuan atau menolak persetujuan, untuk setiap prosedur/terapi.</li>

                        <li>Kami mengerti bahwa terdapat dokter pada staf medis rumah sakit yang bukan karyawan tetapi telah diberikan hak mengunakan fasilitas untuk perawatan dan pengobatan pasien rumah sakit.</li>

                        <li>Jika diperlukan rumah sakit, Kami akan berpartisipasi dalam pemilihan dokter yang akan bertanggung jawab untuk perawatan keluarga kami selama dalam perawatan rumah sakit.</li>

                        <li>Kami setuju pasien harus ditunggu oleh keluarga selama dalam perawatan di ruang intensif dan ruang tenang. Sekiranya keluarga tidak menunggu dan pasien melarikan diri dari rumah sakit, maka rumah sakit tidak dapat dimintai pertanggungjawaban atas larinya pasien tersebut dengan segala akibatnya (disediakan formulir penolakan menunggu pasien).</li>

                        <li>Kami setuju bahwa keluarga harus mengunjungi pasien minimal satu kali dalam seminggu dan sewaktu-waktu diperlukan.</li>

                        <li>Kami setuju bahwa pasien harus dijemput untuk dibawa pulang oleh keluarga bila sudah dinyatakan boleh rawat jalan oleh dokter yang merawat.</li>

                        <li>Kami setuju bahwa rumah sakit dapat memulangkan pasien atau melanjutkan perawatan  dengan melimpahkan pasien ke Panti Sosial Keputih Surabaya atau Panti Sosial Pasuruan atau Panti Sosial Kediri atau Panti Sosial Sidoarjo.</li>

                        <li>Kami setuju sekiranya pasien melarikan diri dari rumah sakit maka keluarga beserta petugas rumah sakit memberitahukan ke Polsek setempat.</li>

                        <li>Kami setuju sekiranya pasien melarikan diri dari rumah sakit dan Rumah Sakit telah memberitahukan kejadian di atas, maka keluarga  juga mempunyai kewajiban untuk turut mencari pasien yang dimaksud dan memberitahukan hasil pencariannya ke Rumah Sakit.</li>

                        <li>Kami setuju dan mengijinkan bahwa pada masa perawatan di Rumah Sakit Jiwa Menur akan melibatkan mahasiswa praktek.</li>
                    </ol>
                </li>
            </ol>
        </li>

        <li class="list"><b>KEJADIAN TIDAK TERDUGA/DIHARAPKAN.</b> <br>
            Saya mengerti dan menyadari bahwa dalam tindakan kedokteran dapat terjadi adanya kejadian tidak terduga/diharapkan (unanticipated outcome) yang dapat merupakan efek samping dari tindakan kedokteran yang tidak dapat diduga sebelumnya (termasuk antara lain, namun tidak terbatas pada Syndroma Neuroleptik Maligna, Ekstrapiramidal Syndrome, Steven Johnson Syndrome dan syok anafilaktik). <br>
            Saya mengerti bahwa hasil asuhan dan pengobatan termasuk kejadian yang tidak terduga/diharapkan akan diberitahukan kepada saya dan keluarga oleh Dokter Penanggung Jawab Pasien (DPJP)

            <p style="margin-top: 20px;"><b>SAYA TELAH DIJELASKAN, MEMBACA, MEMAHAMI,</b> dan <b>SEPENUHNYA SETUJU</b> terhadap pernyataan tersebut di atas.</p>
        </li>
    </ol>

    <table width="100%" style="margin-top: 20px;">
        <tr>
            <td width="25%"></td>
            <td width="25%"></td>
            <td width="25%"></td>
            <td width="25%">Surabaya, {{Carbon\Carbon::now()->format('j F Y')}}</td>
        </tr>
        <tr>
            <td width="25%"></td>
            <td width="25%"></td>
            <td width="25%"></td>
            <td width="25%">Jam, {{Carbon\Carbon::now()->format('H:i')}}</td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 20px;">
        <tr>
            <td align="center">Keluarga / Penanggung Jawab Pasien</td>
            <td align="center">Saksi Keluarga / Saksi Petugas *)</td>
            <td align="center">Pemberi Penjelasan</td>
        </tr>
        <tr>
            <td colspan="3"><br><br><br></td>
        </tr>
        <tr>
            <td align="center">(............................................)</td>
            <td align="center">(............................................)</td>
            <td align="center">(............................................)</td>
        </tr>
        <tr>
            <td align="center">Nama Jelas</td>
            <td align="center">Nama Jelas</td>
            <td align="center">Nama Jelas</td>
        </tr>
    </table>

    <p style="margin-top: 50px;">*) Coret yang tidak perlu</p>
    <p>RSJM / Revisi 01/06.2018</p>

@endsection