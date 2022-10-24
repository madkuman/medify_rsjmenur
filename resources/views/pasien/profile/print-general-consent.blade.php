<!DOCTYPE html>
<html>
<head>
    <title>Print General Consent</title>
    <style type="text/css">
        body, p {
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif;
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
</head>
<body>
    <table class="" width="100%">
        <tr>
            <td width="85%"></td>
            <td width="15%" style="border: 1px solid black; text-align: center;">
                RM. 18
            </td>
        </tr>
        <tr>
            <td width="85%"></td>
            <td width="15%" style="border: 1px solid black; text-align: center;">
                Halaman 1/2
            </td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 5px;">
        <tr>
            <td width="60%">
                <table>
                    <tr>
                        <td width="20%" style="text-align: center;">
                            <img src="{{url('')}}/assets/img/pemprov-jatim.png" height="55">
                        </td>
                        <td width="60%" style="text-align: center; font-size: 10px;">
                            <b>
                                PEMERINTAH PROVINSI JAWA TIMUR<br>
                                RUMAH SAKIT JIWA MENUR<br>
                                Jln Menur No.120, Telp. (031) 5021635, 5021637<br>
                                SURABAYA
                            </b>
                        </td>
                        <td width="20%" style="text-align: center;">
                            <img src="{{url('')}}/assets/img/menur.png" height="55">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-size: 7px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
            <td width="40%">
                <div style="border: 1px solid black; padding: 5px;">
                    <table style="font-size: 11px;">
                        <tr>
                            <td>No Rekam Medis</td>
                            <td>: {{$identitas->no_rm_formatted}}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: {{$identitas->name}}</td>
                        </tr>
                        <tr>
                            <td>Tgl Lahir/Umur</td>
                            <td>: {{date('d-m-Y', strtotime($identitas->date_of_birth))}}/{{$identitas->age}} Tahun</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>: {{$identitas->gender == '1' ? 'Laki-laki' : 'Perempuan'}}</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td>
                <h4>PERSETUJUAN UMUM (GENERAL CONSENT)</h4>        
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
        <li class="list"><b>HAK DAN KEWAJIBAN PASIEN</b> <br>
        Kami memiliki hak untuk mengambil bagian dalam keputusan mengenai penyakit Kami dan dalam hal perawatan medis dan rencana pengobatan, Kami telah mendapat informasi tentang “Hak dan Kewajiban Pasien” di Rumah Sakit Jiwa Menur Provinsi Jawa Timur melalui leaflet dan banner yang disediakan oleh petugas.
        </li>

        <li class="list"><b>BARANG - BARANG MILIK PASIEN</b> <br>
            <ol>
                <li>Kami telah memahami bahwa rumah sakit tidak bertanggung jawab atas semua kehilangan barang-barang milik Kami dan Kami secara pribadi bertanggung jawab atas barang-barang berharga yang Kami miliki (uang, perhiasan, buku cek, kartu kredit, handphone atau barang lainnya). Dan apabila Kami membutuhkan maka Kami dapat menitipkan barang-barang tersebut di rumah sakit (bila menginginkan tersedia formulir khusus).</li>

                <li>Kami juga mengerti bahwa Kami harus memberitahu/menitipkan pada rumah sakit jika Kami memiliki gigi palsu, kacamata, lensa kontak, prosthetics atau barang lainnya yang Kami butuhkan untuk diamankan.</li>

                <li>Kami memahami bahwa Kami tidak diperkenankan untuk membawa makanan basah atau makanan yang mudah busuk ketika diputuskan oleh dokter untuk menjalani rawat inap.</li>
            </ol>
        </li>

        <li class="list"><b>PERSETUJUAN PELEPASAN INFORMASI</b> <br>
            <ol>
                <li>Kami memahami informasi yang ada didalam diri Kami, termasuk diagnosis, hasil laboratorium dan hasil tes diagnostik yang akan digunakan untuk perawatan medis akan dijamin kerahasiaannya oleh rumah sakit.</li>

                <li>Kami memberi wewenang kepada rumah sakit untuk memberikan informasi tentang rahasia kedokteran Kami bila diperlukan untuk memproses klaim asuransi termasuk pada BPJS, Jamkesda, asuransi kesehatan lainnya, perusahaan dan/atau lembaga pemerintah lainnya.</li>

                <li>Kami tidak memberikan / memberikan *) (coret salah satu, bila menginginkan tersedia formulir khusus) wewenang kepada rumah sakit untuk memberikan tentang data dan informasi kesehatan Kami kepada keluarga terdekat Kami, yaitu : <br>
                    <ol type="a">
                        <li>..........................................................</li>
                        <li>..........................................................</li>
                        <li>..........................................................</li>
                    </ol>
                </li>
            </ol>
        </li>

        <li class="list"><b>INFORMASI RAWAT INAP</b> <br>
            <ol>
                <li>Kami telah menerima informasi tentang peraturan yang diberlakukan oleh rumah sakit dan Kami beserta keluarga bersedia untuk mematuhinya, termasuk akan mematuhi jam berkunjung pasien sesuai dengan aturan di Rumah Sakit Jiwa Menur Provinsi Jawa Timur.</li>

                <li>Anggota keluarga yang menunggu Kami, bersedia untuk selalu memakai tanda pengenal khusus yang diberikan oleh rumah sakit, dan demi keamanan seluruh pasien setiap keluarga dan siapapun yang akan mengunjungi Kami diluar jam berkunjung, bersedia untuk dipinjam dan diperiksa identitasnya.</li>
            </ol>
        </li>

        <li class="list"><b>KEINGINAN PRIVASI</b> <br>
        Kami menginginkan / tidak menginginkan privasi khusus *) (coret salah satu, bila menginginkan tersedia formulir khusus).
        </li>

        <li class="list"><b>PENGAJUAN KELUHAN</b> <br>
        Kami memahami informasi tentang pengaduan dan penanganan keluhan terkait pelayanan, perawatan dan pemberian pengobatan yang ada di rumah sakit bisa secara langsung melalui informasi / costumer service dan tidak secara langsung melalui kotak saran yang sudah disediakan.
        </li>

        <li class="list"><b>PELAYANAN KEROHANIAN</b> <br>
        Kami memahami informasi tentang pelayanan kerohanian sesuai agama dan kepercayaan dan cara bimbingan kerohanian di Rumah Sakit Jiwa Menur Provinsi Jawa Timur dikondisikan sesuai dengan permintaan dari pasien/keluarga/penanggung jawab.
        </li>

        <li class="list"><b>PEMBIAYAAN</b> <br>
        Kami menyatakan bahwa segala biaya yang timbul sehubungan dengan dirawatnya Kami, maka : <br>
            <ol>
                <li>Akan Kami bayar sendiri, dengan menjadi pasien umum Rumah Sakit Jiwa Menur Provinsi Jawa Timur</li>
                
                <li>Ditanggung oleh perusahaan/ Instansi/ Asuransi ................................................. Dan Kami bersedia melengkapi dan menyerahkan persyaratan administrasi pada saat akan dilakukan perawatan di Rumah Sakit Jiwa Menur Provinsi Jawa Timur.</li>
                
                <li>Ditanggung oleh BPJS dan Kami bersedia melengkapi dan menyerahkan persyaratan administrasi sejak penderita akan dirawat.</li>

                <li>Apabila menghendaki naik kelas perawatan, Kami bersedia membayar selisih biaya yang harus ditanggung</li>
            </ol>
            
            <p style="margin-top: 10px;">Dengan tanda tangan Kami atau yang mewakili dibawah ini, Kami menyatakan bahwa Kami telah membaca dan memahami item pada Persetujuan Umum (General Consent).</p>
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
</body>
</html>