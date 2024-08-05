@extends('layouts.print')

@section('title')
    Checklist Keselamatan Pasien di Poli Gigi dan Mulut
@endsection

@section('css')
    <style type="text/css">
        @page {
            margin-top: 70px;
            margin-left: 40px;
            margin-bottom: 20px;
            margin-right: 40px;
            header: page-header;
        }

        @page :first {
            margin-top: 70px;
        }

        body,
        p {
            font-size: 12px;
            /* font-family: 'Times New Roman', Times, serif; */
        }

        h5 {
            font-size: 14px;
        }

        h6 {
            font-size: 12px;
        }

        p,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .bordered {
            border: 1px solid #000;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        table {
            border-collapse: collapse;
        }

        table tr td,
        table tr td {
            padding: 2px 3px;
            height: 7px;
        }

        .v-align-top {
            vertical-align: top;
        }

        table.bordered td,
        table.bordered th {
            border: 1px solid #000;
        }

        table.no-border td,
        table.no-border th {
            border: none;
        }

        td.no-border,
        th.no-border {
            border: none;
        }

        table .form-group {
            margin-bottom: 0;
        }

        table .form-control {
            border: 1px solid #0080ff;
        }

        .dots-wrap {
            width: 100%;
            display: inline-block;
            vertical-align: middle;
        }

        .dots-text {
            width: auto;
            display: inline-block;
        }

        .dots {
            border-bottom: 1.8px dotted #000 !important;
            word-break: break-word;
            display: inline-block;
        }

        .kop-img {
            object-fit: contain;
        }

        .position-relative {
            position: relative;
        }

        .page_break {
            page-break-before: always;
        }

        .p-0 {
            padding: 0 !important;
        }

        .overflow-auto {
            overflow: auto;
        }

        .border-x-none {
            border-right: none;
            border-left: none;
        }

        .page-header-content {
            position: fixed;
            right: 0;
            top: 0;
        }

        .kode {
            border: 1px solid #000;
            border-bottom: none;
        }

        .nomor-halaman {
            border: 1px solid #000;
        }

        .list-unstyled {
            list-style: none !important;
            list-style-type: none !important;
        }

        ol.custom-ol {
            list-style: none;
            counter-reset: step-counter;
            padding-inline-start: 40px;
        }

        ol.custom-ol>li {
            counter-increment: step-counter;
        }

        ol.custom-ol>li:before {
            content: counter(step-counter)")";
            display: inline-block;
            position: absolute;
            margin-left: -40px;
        }

        ol.custom-ol.step-a>li:before {
            content: counter(step-counter, lower-alpha)".";
        }
    </style>
@endsection
@section('content')
    <htmlpageheader name="page-header">
        <div class="page-header-content">
            <div class="kode">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RM. 18.K.6&nbsp;&nbsp;&nbsp;</div>
            <div class="nomor-halaman">
                &nbsp;&nbsp;&nbsp;<span>Halaman&nbsp;{PAGENO}/{nb}&nbsp;&nbsp;</span>
            </div>
        </div>
    </htmlpageheader>
    <table style="width:100%">
        <tr>
            <td style="vertical-align: middle;" width = "45%" class=" position-relative kop" colspan="1" rowspan="5">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/assets/img/kop_menur.png'))) }}"
                    height="80" width="400" />
            </td>
        </tr>
        <tr>
            <td width = "24%" class=" position-relative" colspan="1" rowspan="1">
                <span>No. Rekam Medis</span>
            </td>
            <td width = "1%" class=" position-relative" colspan="1" rowspan="1">
                <span>:</span>
            </td>
            <td width = "30%" class=" position-relative" colspan="1" rowspan="1">
                <span>{{ $pasien->no_rm ?? '' }}</span>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>Nama</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>:</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>{{ $pasien->name ?? '' }}</span>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>Tanggal lahir/Umur</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>:</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>{{ date('d F Y', strtotime($identitas->tanggal_lahir ?? $pasien->date_of_birth)) }}</span>
                <span>/</span>
                <span>{{ $kasus->identitas->age ?? ($pasien->age ?? '') }}</span>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>Jenis Kelamin</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>:</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>
                    @if ($identitas->gender ?? $pasien->gender == 1)
                        Laki-laki
                    @else
                        Perempuan
                    @endif
                </span>
            </td>
        </tr>
    </table>
    <br><br>
    <table style="width:100%">
        <tr>
            <td class=" position-relative" colspan="3" rowspan="1">
                <h5>PERSETUJUAN UMUM UNTUK PENGOBATAN (GENERAL CONSENT FOR TREATMENT)/h5>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>Yang bertanda tangan di bawah ini :</span>
            </td>
        </tr>
        <tr>
            <td style="width: 20%" class=" position-relative" colspan="1" rowspan="1">
                <span>Nama</span>
            </td>
            <td style="width: 2%" class=" position-relative" colspan="1" rowspan="1">
                <span>:</span>
            </td>
            <td style="width: 78%" class=" position-relative" colspan="1" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    @if ($action != null)
                        <input type="text" class="form-control" name="nama" value="{{ $hasil_data->nama ?? '' }}">
                    @else
                        <span class="medify-form-genv4-view-container"> {{ $hasil_data->nama ?? '' }}</span>
                    @endif
                </div>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>Tanggal Lahir</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>:</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    @if ($action != null)
                        <input type="text" class="form-control" name="tanggal_lahir"
                            value="{{ $hasil_data->tanggal_lahir ?? '' }}">
                    @else
                        <span class="medify-form-genv4-view-container"> {{ $hasil_data->tanggal_lahir ?? '' }}</span>
                    @endif
                </div>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>Alamat</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>:</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    @if ($action != null)
                        <input type="text" class="form-control" name="alamat"
                            value="{{ $hasil_data->alamat ?? '' }}">
                    @else
                        <span class="medify-form-genv4-view-container"> {{ $hasil_data->alamat ?? '' }}</span>
                    @endif
                </div>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>Bukti Diri /KTP</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>:</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    @if ($action != null)
                        <input type="text" class="form-control" name="bukti_diri_ktp"
                            value="{{ $hasil_data->bukti_diri_ktp ?? '' }}">
                    @else
                        <span class="medify-form-genv4-view-container"> {{ $hasil_data->bukti_diri_ktp ?? '' }}</span>
                    @endif
                </div>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>Hubungan kekeluargaan</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>:</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    @if ($action != null)
                        <input type="text" class="form-control" name="hubungan_kekeluargaan"
                            value="{{ $hasil_data->hubungan_kekeluargaan ?? '' }}">
                    @else
                        <span class="medify-form-genv4-view-container">
                            {{ $hasil_data->hubungan_kekeluargaan ?? '' }}</span>
                    @endif
                </div>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>Bertindak atas nama pasien</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>:</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    @if ($action != null)
                        <input type="text" class="form-control" name="bertindak_atas_nama_pasien"
                            value="{{ $hasil_data->bertindak_atas_nama_pasien ?? '' }}">
                    @else
                        <span class="medify-form-genv4-view-container">
                            {{ $hasil_data->bertindak_atas_nama_pasien ?? '' }}</span>
                    @endif
                </div>
            </td>
        </tr>
    </table>
    <table style="width:100%;">
        <tr>
            <td class=" position-relative" colspan="2" rowspan="1">
                <span>KAMI MENYATAKAN PERSETUJUAN :</span>
            </td>
        </tr>
        <tr>
            <td style="width: 4%;" class=" position-relative text-bold" colspan="1" rowspan="1">1.</td>
            <td class=" position-relative text-bold" colspan="1" rowspan="1">
                <span>PERSETUJUAN UNTUK PERAWATAN DAN PENGOBATAN</span>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <ol class="custom-ol">
                    <li>Kami mengetahui bahwa keluarga kami memiliki kondisi yang membutuhkan perawatan medis.
                        Kami mengijinkan dokter dan profesional kesehatan lainnya untuk melakukan prosedur diagnostik
                        dan untuk memberikan pengobatan medis seperti yang diperlukan dalam penilaian profesional
                        mereka. Prosedur diagnostik dan perawatan medis termasuk terapi tidak terbatas pada
                        elektrokardiogram, x-ray, tes darah, terapi fisik, dan pemberian obat.</li>
                    <li>Persetujuan yang kami berikan tidak termasuk persetujuan untuk prosedur/tindakan invasif atau
                        tindakan yang mempunyai risiko tinggi. Tindakan yang mempunyai risiko tinggi akan di berikan
                        formulir persetujuan tindakan medis (Informed Consent) tersendiri.</li>
                    <li>Kami sadar bahwa praktik kedokteran bukanlah ilmu pasti dan kami mengakui bahwa tidak ada
                        jaminan atas hasil apapun, terhadap perawatan prosedur atau pemeriksaan apapun yang
                        dilakukan kepada keluarga kami.</li>
                    <li>Kami memberikan wewenang kepada rumah sakit untuk terlibat dalam pengambilan keputusan
                        mengenai perawatan pasien, data dan informasi mengenai diri pasien dan keadaan kesehatan
                        pasien termasuk dalam situasi tertentu misalnya keadaan kritis, penyakit menular dll.</li>

                </ol>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>Kewajiban Pasien (Permenkes No. 4 Tahun 2018 Tentang Kewajiban Rumah Sakit dan Kewajiban
                    Pasien)</span>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <ol class="custom-ol">
                    <li>Mematuhi peraturan yang berlaku di Rumah Sakit.</li>
                    <li>Menggunakan fasilitas Rumah Sakit secara bertanggung jawab.</li>
                    <li>Menghormati hak pasien lain, pengunjung dan hak Tenaga Kesehatan serta petugas lainnya yang bekerja
                        di Rumah Sakit.</li>
                    <li>Memberikan informasi yang jujur, lengkap dan akurat sesuai dengan kemampuan dan pengetahuannya
                        tentang masalah kesehatannya.</li>
                    <li>Memberikan informasi mengenai kemampuan finansial dan jaminan kesehatan yang dimilikinya.</li>
                    <li>Mematuhi rencana terapi yang direkomendasikan oleh Tenaga Kesehatan di Rumah Sakit dan disetujui
                        oleh pasien yang bersangkutan setelah mendapatkan penjelasan sesuai dengan ketentuan peraturan
                        perundang-undangan.</li>
                    <li>Menerima segala konsekuensi atas keputusan pribadinya untuk menolak rencana terapi yang
                        direkomendasikan oleh Tenaga Kesehatan dan/atau tidak mematuhi petunjuk yang diberikan oleh tenaga
                        kesehatan untuk penyembuhan penyakit atau masalah kesehatannya.</li>
                    <li>Memberikan imbalan jasa atas pelayanan yang diterima.</li>
                </ol>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>Tanggung Jawab Pasien</span>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <ol class="custom-ol">
                    <li>Mengajukan pertanyaan dan berpartisipasi aktif dalam diskusi dan keputusan mengenai perawatan
                        kesehatan pasien.</li>
                    <li>Memberikan informasi yang lengkap dan akurat tentang kesehatan dan riwayat kesehatan pasien termasuk
                        kondisi sekarang, penyakit masa lalu, riwayat rawat inap dan pengobatan.</li>
                    <li>Mendiskusikan masalah perawatan kesehatan, kekhawatiran, dan kebutuhan pribadi pasien dengan
                        penyedia layanan kesehatan secara jujur dan beri tahu penyedia layanan kesehatan tentang setiap
                        perubahan yang terjadi pada kesehatan pasien.</li>
                    <li>Bekerja sama dengan semua petugas kesehatan yang terlibat dalam perawatan pasien dan berperilaku
                        sopan dan saling menghormati.</li>
                    <li>Menghormati hak penyedia layanan kesehatan dan untuk bertukar informasi dengan cara yang baik dan
                        tidak melakukan kekerasan secara fisik maupun verbal saat dalam perawatan.</li>
                    <li>Mengikuti instruksi asuhan kesehatan atau beri tahu staf kami jika pasien tidak dapat atau tidak
                        bersedia mengikuti rencana asuhan.</li>
                    <li>Menerima konsekuensi karena menolak rencana asuhan atau tidak mengikuti rencana asuhan.</li>
                    <li>Menghormati hak dan privasi semua profesional pemberi asuhan, karyawan rumah sakit dan pasien lain.
                    </li>
                    <li>Memberitahu staf rumah sakit bila merubah keputusan persetujuan atas rencana asuhan yang telah
                        disetujui.</li>
                </ol>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>Kami telah mendapat informasi tentang “Hak, Kewajiban dan Tanggung Jawab Pasien" di Rumah Sakit Jiwa
                    Menur Provinsi Jawa Timur melalui leaflet dan banner yang disediakan oleh petugas.</span>
            </td>
        </tr>
    </table>
    <table style="width:100%;">
        <tr>
            <td style="width: 4%;" class=" position-relative text-bold" colspan="1" rowspan="1">2.</td>
            <td class=" position-relative text-bold" colspan="1" rowspan="1">
                <span>BARANG - BARANG MILIK PASIEN</span>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <ol class="custom-ol">
                    <li>Kami telah memahami bahwa rumah sakit telah menginformasikan agar tidak membawa barang – barang
                        berharga seperti perhiasan, uang, elektronik, dll untuk mencegah terjadinya kehilangan atau keamanan
                        selama di rumah sakit.</li>
                    <li>Kami juga mengerti bahwa kami harus memberitahu/menitipkan pada rumah sakit jika kami memiliki gigi
                        palsu, kacamata, lensa kontak, prosthetics atau barang lainnya yang kami butuhkan untuk diamankan
                        (tersedia formulir khusus).</li>
                    <li>Kami memahami bahwa kami tidak diperkenankan untuk membawa makanan basah/memerlukan penyimpanan
                        khusus/tidak berlabel/bertentangan dengan kondisi dan terapi diet pasien ketika diputuskan untuk
                        menjalani rawat inap.</li>
                </ol>
            </td>
        </tr>
    </table>
    <table style="width:100%">
        <tr>
            <td style="width: 4%;" class=" position-relative text-bold" colspan="1" rowspan="1">3.</td>
            <td class=" position-relative text-bold" colspan="1" rowspan="1">
                <span>INFORMASI RAWAT INAP</span>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <ol class="custom-ol">
                    <li>Kami telah menerima informasi tentang peraturan yang diberlakukan oleh rumah sakit dan kami beserta
                        keluarga bersedia untuk mematuhinya, termasuk akan mematuhi jam berkunjung pasien sesuai dengan
                        aturan di Rumah Sakit Jiwa Menur Provinsi Jawa Timur.</li>
                    <li>Anggota keluarga yang menunggu, bersedia untuk selalu memakai tanda pengenal khusus yang diberikan
                        oleh rumah sakit, mematuhi tata tertib selama menunggu dan demi keamanan seluruh pasien, setiap
                        keluarga dan siapapun yang akan mengunjungi pasien di luar jam berkunjung, wajib mematuhi peraturan
                        yang berlaku.</li>
                </ol>
            </td>
        </tr>
    </table>
    <table style="width:100%">
        <tr>
            <td style="width: 4%;" class=" position-relative text-bold" colspan="1" rowspan="1">4.</td>
            <td class=" position-relative text-bold" colspan="1" rowspan="1">
                <span>KEINGINAN PRIVASI</span>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <ol class="custom-ol step-a">
                    <li>Kami menginginkan / tidak menginginkan privasi khusus *) (coret salah satu, bila menginginkan
                        tersedia formulir khusus).</li>
                    <li>Yang diberi ijin menjenguk pasien adalah sebagai berikut (sebutkan nama dan hubungan
                        kekerabatannya):</li>
                </ol>
            </td>
        </tr>
    </table>
    <table style="width:100%;margin-left:30px">
        <tr>
            <td style="width: 2%" class=" position-relative" colspan="1" rowspan="1">1.</td>
            <td style="width: 30%" class=" position-relative" colspan="1" rowspan="1">
                <span class="medify-form-genv4-view-container"> {{ $hasil_data->privasi['nama'][0] ?? '' }}</span>
            </td>
            <td style="width: 10%" class=" position-relative" colspan="1" rowspan="1">sebagai</td>
            <td style="width: 24%" class=" position-relative" colspan="1" rowspan="1">
                <span class="medify-form-genv4-view-container"> {{ $hasil_data->privasi['sebagai'][0] ?? '' }}</span>
            </td>
            <td style="width: 10%" class=" position-relative" colspan="1" rowspan="1">telepon</td>
            <td style="width: 24%" class=" position-relative" colspan="1" rowspan="1">
                <span class="medify-form-genv4-view-container"> {{ $hasil_data->privasi['telepon'][0] ?? '' }}</span>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1">2.</td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span class="medify-form-genv4-view-container"> {{ $hasil_data->privasi['nama'][1] ?? '' }}</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1">sebagai</td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span class="medify-form-genv4-view-container"> {{ $hasil_data->privasi['sebagai'][1] ?? '' }}</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1">telepon</td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span class="medify-form-genv4-view-container"> {{ $hasil_data->privasi['telepon'][1] ?? '' }}</span>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1">3.</td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span class="medify-form-genv4-view-container"> {{ $hasil_data->privasi['nama'][2] ?? '' }}</span>
            </td>
            <td style="width: 10%" class=" position-relative" colspan="1" rowspan="1">sebagai</td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span class="medify-form-genv4-view-container"> {{ $hasil_data->privasi['sebagai'][2] ?? '' }}</span>
            </td>
            <td style="width: 10%" class=" position-relative" colspan="1" rowspan="1">telepon</td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span class="medify-form-genv4-view-container"> {{ $hasil_data->privasi['telepon'][2] ?? '' }}</span>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1">4.</td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span class="medify-form-genv4-view-container"> {{ $hasil_data->privasi['nama'][3] ?? '' }}</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1">sebagai</td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span class="medify-form-genv4-view-container"> {{ $hasil_data->privasi['sebagai'][3] ?? '' }}</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1">telepon</td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span class="medify-form-genv4-view-container"> {{ $hasil_data->privasi['telepon'][3] ?? '' }}</span>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1">5.</td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span class="medify-form-genv4-view-container"> {{ $hasil_data->privasi['nama'][4] ?? '' }}</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1">sebagai</td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span class="medify-form-genv4-view-container"> {{ $hasil_data->privasi['sebagai'][4] ?? '' }}</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1">telepon</td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span class="medify-form-genv4-view-container"> {{ $hasil_data->privasi['telepon'][4] ?? '' }}</span>
            </td>
        </tr>
    </table>
    <table style="width:100%">
        <tr>
            <td style="width: 4%;" class=" position-relative text-bold" colspan="1" rowspan="1">5.</td>
            <td class=" position-relative text-bold" colspan="1" rowspan="1">
                <span>PENGAJUAN KELUHAN</span>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>Kami memahami informasi tentang pengaduan dan penanganan keluhan terkait pelayanan, perawatan dan
                    pemberian pengobatan yang ada di rumah sakit bisa secara langsung melalui informasi/costumer service dan
                    tidak secara langsung melalui kotak saran yang sudah disediakan, telp. (031) 5021635/ 08113633120 atau
                    web rsjmenur.jatimprov.co.id.</span>
            </td>
        </tr>
        <tr>
            <td style="width: 4%;" class=" position-relative text-bold" colspan="1" rowspan="1">6.</td>
            <td class=" position-relative text-bold" colspan="1" rowspan="1">
                <span>PELAYANAN KEROHANIAN</span>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>Kami memahami informasi tentang pelayanan kerohanian sesuai agama dan kepercayaan dan cara bimbingan
                    kerohanian di Rumah Sakit Jiwa Menur Provinsi Jawa Timur dikondisikan sesuai dengan permintaan dari
                    pasien/keluarga/penanggung jawab.</span>
            </td>
        </tr>
    </table>
    <table style="width:100%">
        <tr>
            <td style="width: 4%;" class=" position-relative text-bold" colspan="1" rowspan="1">7.</td>
            <td class=" position-relative text-bold" colspan="1" rowspan="1">
                <span>PEMBIAYAAN</span>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>Kami menyatakan bahwa segala biaya yang timbul sehubungan dengan dirawayatnya pasien, maka :</span>
                <table style="width:100%">
                    <tr>
                        <td class=" position-relative vertical-align-middle" colspan="1" rowspan="1">
                            @php $hasil_data_temp = $hasil_data->pembiayaan['bayar_sendiri'] ?? '' @endphp
                            <span class="medify-form-genv4-view-container">
                                @if ($hasil_data_temp == '1')
                                    <span><img width="10" height="10"
                                            src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAANhQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAV/C6WgAAAEh0Uk5TAIrAebn/o7iCQJWhWHIYQ3G7CgPWDaKU+y1UfST1zQLP/Ch1kh/5675iQd5uBFYi8AkFZ+GRf40MNGraMnCgWvF8sGxMtFGdK5lu+gAAANtJREFUeJyl08cSgjAQANC1rNgFsTfsig17w67o//+REXUgmsjBPTHzZks2AcAhXG5ueAh7kRs+wgL6A8wIYsjMDrO7RsxsBxZYHI0BiGZxFvulOJ/lUCJpFk8xe6cz2R+j5TD/Y/JCsaTwWS5XqsDnGtaBz41mK0kxfbA2qu9P8XvnHewqQGVTLGEPaH4W76sDDUDD4cjG762NJ1Ny+zOY4wJY2ctVivhax43FW9zZJt8/ns9Bsfjjxo6ET8BlWUc82/g5mrWWi3G11X71/u8pOvwGBp9v7LJW3AHxNRM1OSV4EgAAAABJRU5ErkJggg==' />
                                        Akan kami bayar sendiri, dengan menjadi pasien umum Rumah Sakit Jiwa Menur Provinsi
                                        Jawa Timur</span>
                                @else
                                    <span><img width="10" height="10"
                                            src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAGBQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA+k/ojQAAACB0Uk5TAIrAebn/o7iCQD88Myo6PZWhWHIGcaJqXm8DAXCgtJ1uCE2LAAAAfklEQVR4nLWTxwrAMAxD3eHudO/5/3/ZkNJxcGJoqU6BhyxHIQCMLFsrR2IXtfIk9jEIL0VxIoRIs0iecyyUu6RTK+VmsE/iGqBRw2kMLK6wNWV35tX6P/HwvhY47/1H5/BsbazN7onAMy785t8eVIuP7G+1MN9g1eONHntrB2WPCZJdiW0LAAAAAElFTkSuQmCC' />
                                        Akan kami bayar sendiri, dengan menjadi pasien umum Rumah Sakit Jiwa Menur Provinsi
                                        Jawa Timur</span>
                                @endif
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class=" position-relative vertical-align-middle" colspan="1" rowspan="1">
                            @php $hasil_data_temp = $hasil_data->pembiayaan['ditanggung_oleh_perusahaan'] ?? '' @endphp
                            <span class="medify-form-genv4-view-container">
                                @if ($hasil_data_temp == '1')
                                    <span><img width="10" height="10"
                                            src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAANhQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAV/C6WgAAAEh0Uk5TAIrAebn/o7iCQJWhWHIYQ3G7CgPWDaKU+y1UfST1zQLP/Ch1kh/5675iQd5uBFYi8AkFZ+GRf40MNGraMnCgWvF8sGxMtFGdK5lu+gAAANtJREFUeJyl08cSgjAQANC1rNgFsTfsig17w67o//+REXUgmsjBPTHzZks2AcAhXG5ueAh7kRs+wgL6A8wIYsjMDrO7RsxsBxZYHI0BiGZxFvulOJ/lUCJpFk8xe6cz2R+j5TD/Y/JCsaTwWS5XqsDnGtaBz41mK0kxfbA2qu9P8XvnHewqQGVTLGEPaH4W76sDDUDD4cjG762NJ1Ny+zOY4wJY2ctVivhax43FW9zZJt8/ns9Bsfjjxo6ET8BlWUc82/g5mrWWi3G11X71/u8pOvwGBp9v7LJW3AHxNRM1OSV4EgAAAABJRU5ErkJggg==' />
                                        Ditanggung oleh perusahaan/ Instansi/ Asuransi*)
                                        {{ $hasil_data->pembiayaan['ditanggung_oleh_perusahaan_nama'] ?? '' }} dan kami
                                        bersedia melengkapi dan menyerahkan persyaratan administrasi pada saat akan
                                        dilakukan perawatan di Rumah Sakit Jiwa Menur Provinsi Jawa Timur.</span>
                                @else
                                    <span><img width="10" height="10"
                                            src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAGBQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA+k/ojQAAACB0Uk5TAIrAebn/o7iCQD88Myo6PZWhWHIGcaJqXm8DAXCgtJ1uCE2LAAAAfklEQVR4nLWTxwrAMAxD3eHudO/5/3/ZkNJxcGJoqU6BhyxHIQCMLFsrR2IXtfIk9jEIL0VxIoRIs0iecyyUu6RTK+VmsE/iGqBRw2kMLK6wNWV35tX6P/HwvhY47/1H5/BsbazN7onAMy785t8eVIuP7G+1MN9g1eONHntrB2WPCZJdiW0LAAAAAElFTkSuQmCC' />
                                        Ditanggung oleh perusahaan/ Instansi/ Asuransi*)
                                        .............................................................. dan kami bersedia
                                        melengkapi dan menyerahkan persyaratan administrasi pada saat akan dilakukan
                                        perawatan di Rumah Sakit Jiwa Menur Provinsi Jawa Timur.</span>
                                @endif
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class=" position-relative vertical-align-middle" colspan="1" rowspan="1">
                            @php $hasil_data_temp = $hasil_data->pembiayaan['ditanggung_oleh_bpjs'] ?? '' @endphp
                            <span class="medify-form-genv4-view-container">
                                @if ($hasil_data_temp == '1')
                                    <span><img width="10" height="10"
                                            src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAANhQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAV/C6WgAAAEh0Uk5TAIrAebn/o7iCQJWhWHIYQ3G7CgPWDaKU+y1UfST1zQLP/Ch1kh/5675iQd5uBFYi8AkFZ+GRf40MNGraMnCgWvF8sGxMtFGdK5lu+gAAANtJREFUeJyl08cSgjAQANC1rNgFsTfsig17w67o//+REXUgmsjBPTHzZks2AcAhXG5ueAh7kRs+wgL6A8wIYsjMDrO7RsxsBxZYHI0BiGZxFvulOJ/lUCJpFk8xe6cz2R+j5TD/Y/JCsaTwWS5XqsDnGtaBz41mK0kxfbA2qu9P8XvnHewqQGVTLGEPaH4W76sDDUDD4cjG762NJ1Ny+zOY4wJY2ctVivhax43FW9zZJt8/ns9Bsfjjxo6ET8BlWUc82/g5mrWWi3G11X71/u8pOvwGBp9v7LJW3AHxNRM1OSV4EgAAAABJRU5ErkJggg==' />
                                        Ditanggung oleh BPJS dan kami bersedia melengkapi dan menyerahkan persyaratan
                                        administrasi sejak penderita akan dirawat.</span>
                                @else
                                    <span><img width="10" height="10"
                                            src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAGBQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA+k/ojQAAACB0Uk5TAIrAebn/o7iCQD88Myo6PZWhWHIGcaJqXm8DAXCgtJ1uCE2LAAAAfklEQVR4nLWTxwrAMAxD3eHudO/5/3/ZkNJxcGJoqU6BhyxHIQCMLFsrR2IXtfIk9jEIL0VxIoRIs0iecyyUu6RTK+VmsE/iGqBRw2kMLK6wNWV35tX6P/HwvhY47/1H5/BsbazN7onAMy785t8eVIuP7G+1MN9g1eONHntrB2WPCZJdiW0LAAAAAElFTkSuQmCC' />
                                        Ditanggung oleh BPJS dan kami bersedia melengkapi dan menyerahkan persyaratan
                                        administrasi sejak penderita akan dirawat.</span>
                                @endif
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class=" position-relative vertical-align-middle" colspan="1" rowspan="1">
                            @php $hasil_data_temp = $hasil_data->pembiayaan['naik_kelas_perawatan'] ?? '' @endphp
                            <span class="medify-form-genv4-view-container">
                                @if ($hasil_data_temp == '1')
                                    <span><img width="10" height="10"
                                            src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAANhQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAV/C6WgAAAEh0Uk5TAIrAebn/o7iCQJWhWHIYQ3G7CgPWDaKU+y1UfST1zQLP/Ch1kh/5675iQd5uBFYi8AkFZ+GRf40MNGraMnCgWvF8sGxMtFGdK5lu+gAAANtJREFUeJyl08cSgjAQANC1rNgFsTfsig17w67o//+REXUgmsjBPTHzZks2AcAhXG5ueAh7kRs+wgL6A8wIYsjMDrO7RsxsBxZYHI0BiGZxFvulOJ/lUCJpFk8xe6cz2R+j5TD/Y/JCsaTwWS5XqsDnGtaBz41mK0kxfbA2qu9P8XvnHewqQGVTLGEPaH4W76sDDUDD4cjG762NJ1Ny+zOY4wJY2ctVivhax43FW9zZJt8/ns9Bsfjjxo6ET8BlWUc82/g5mrWWi3G11X71/u8pOvwGBp9v7LJW3AHxNRM1OSV4EgAAAABJRU5ErkJggg==' />
                                        Apabila menghendaki naik kelas perawatan, Kami bersedia membayar selisih biaya yang
                                        harus ditanggung.</span>
                                @else
                                    <span><img width="10" height="10"
                                            src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAGBQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA+k/ojQAAACB0Uk5TAIrAebn/o7iCQD88Myo6PZWhWHIGcaJqXm8DAXCgtJ1uCE2LAAAAfklEQVR4nLWTxwrAMAxD3eHudO/5/3/ZkNJxcGJoqU6BhyxHIQCMLFsrR2IXtfIk9jEIL0VxIoRIs0iecyyUu6RTK+VmsE/iGqBRw2kMLK6wNWV35tX6P/HwvhY47/1H5/BsbazN7onAMy785t8eVIuP7G+1MN9g1eONHntrB2WPCZJdiW0LAAAAAElFTkSuQmCC' />
                                        Apabila menghendaki naik kelas perawatan, Kami bersedia membayar selisih biaya yang
                                        harus ditanggung.</span>
                                @endif
                            </span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1">

            </td>
        </tr>
        <tr>
            <td style="width: 4%;" class=" position-relative text-bold" colspan="1" rowspan="1">8.</td>
            <td class=" position-relative text-bold" colspan="1" rowspan="1">
                <span>PEMBUKAAN INFORMASI UNTUK APLIKASI SATU SEHAT (KEMENKES)</span>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <ol class="custom-ol step-a" style="margin-bottom: 0;">
                    <li>Saya mengetahui dan menyetujui bahwa berdasarkan Peraturan Menteri Kesehatan Nomor 24 Tahun 2022
                        tentang Rekam Medis, fasilitas pelayanan Kesehatan wajib membuka akses dan mengirim data rekam medis
                        kepada Kementerian Kesehatan melalui Platform SATUSEHAT</li>
                    <li>Menyetujui untuk menerima dan membuka data pasien dari Fasilitas Pelayanan Kesehatan lainnya melalui
                        SATUSEHAT untuk kepentingan pelayanan Kesehatan dan/atau rujukan</li>
                </ol>
                @php $hasil_data_temp = $hasil_data->sudah_membaca_menandatangani ?? '' @endphp
                <br>
                <span class="medify-form-genv4-view-container">
                    @if ($hasil_data_temp == '1')
                        <span><img width="10" height="10"
                                src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAANhQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAV/C6WgAAAEh0Uk5TAIrAebn/o7iCQJWhWHIYQ3G7CgPWDaKU+y1UfST1zQLP/Ch1kh/5675iQd5uBFYi8AkFZ+GRf40MNGraMnCgWvF8sGxMtFGdK5lu+gAAANtJREFUeJyl08cSgjAQANC1rNgFsTfsig17w67o//+REXUgmsjBPTHzZks2AcAhXG5ueAh7kRs+wgL6A8wIYsjMDrO7RsxsBxZYHI0BiGZxFvulOJ/lUCJpFk8xe6cz2R+j5TD/Y/JCsaTwWS5XqsDnGtaBz41mK0kxfbA2qu9P8XvnHewqQGVTLGEPaH4W76sDDUDD4cjG762NJ1Ny+zOY4wJY2ctVivhax43FW9zZJt8/ns9Bsfjjxo6ET8BlWUc82/g5mrWWi3G11X71/u8pOvwGBp9v7LJW3AHxNRM1OSV4EgAAAABJRU5ErkJggg==' /><span
                                style="margin-left: 20px;">“Saya menjamin bahwa pasien sudah membaca dan menandatangani
                                consent pembukaan data dari SATUSEHAT”</span></span>
                    @else
                        <span><img width="10" height="10"
                                src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAGBQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA+k/ojQAAACB0Uk5TAIrAebn/o7iCQD88Myo6PZWhWHIGcaJqXm8DAXCgtJ1uCE2LAAAAfklEQVR4nLWTxwrAMAxD3eHudO/5/3/ZkNJxcGJoqU6BhyxHIQCMLFsrR2IXtfIk9jEIL0VxIoRIs0iecyyUu6RTK+VmsE/iGqBRw2kMLK6wNWV35tX6P/HwvhY47/1H5/BsbazN7onAMy785t8eVIuP7G+1MN9g1eONHntrB2WPCZJdiW0LAAAAAElFTkSuQmCC' />
                            <span style="margin-left: 20px;">“Saya menjamin bahwa pasien sudah membaca dan menandatangani
                                consent pembukaan data dari SATUSEHAT”</span></span>
                    @endif
                </span>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1">
                <span>Dengan tanda tangan kami atau yang mewakili dibawah ini, kami menyatakan bahwa kami telah membaca dan
                    memahami item pada Persetujuan Umum (General Consent)</span>
            </td>
        </tr>
    </table>
    <br><br>
    <table style="width: 100%">
        <tr>
            <td class=" position-relative" colspan="2" rowspan="1"></td>
            <td class=" position-relative text-right" colspan="1" rowspan="1">Surabaya,
                {{ !empty($created) ? date('d-m-Y', strtotime($created)) : '.....................................................' }}
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="2" rowspan="1"></td>
            <td class=" position-relative text-right" colspan="1" rowspan="1">Jam,
                {{ !empty($created) ? date('H:i', strtotime($created)) : '.....................................................' }}
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="3" rowspan="1"></td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="3" rowspan="1"></td>
        </tr>
        <tr>
            <td class=" position-relative text-center" colspan="1" rowspan="1">
                <span>Keluarga/Penanggung jawab pasien</span>
                <br><br>
                @if ($hasil_data->img_ttd ?? '')
                    <img src="{{ url('/' . $hasil_data->img_ttd) }}" style="width: 100px">
                @else
                    <br><br>
                @endif
                <br><br>
                <span>{{ $hasil_data->nama_ttd ?? '(...........................................................)' }}</span>
            </td>
            <td class=" position-relative text-center" colspan="1" rowspan="1">
                <span>Saksi Keluarga/Saksi Petugas *)</span>
                <br><br>
                @php
                    $saksi_petugas = \App\User::find($hasil_data->saksi_petugas ?? '');
                @endphp
                @if ($saksi_petugas->ttd ?? '')
                    <img src="{{ url('/' . $saksi_petugas->ttd) }}" alt="" width="90" height="55">
                @else
                    <br><br>
                @endif
                <br><br>
                <span>{{ $saksi_petugas->name ?? '(...........................................................)' }}</span>
            </td>
            <td class=" position-relative text-center" colspan="1" rowspan="1">
                <span>Pemberi Penjelasan</span>
                <br><br>
                @php
                    $pemberi_penjelasan = \App\User::find($hasil_data->pemberi_penjelasan ?? '');
                @endphp
                @if ($pemberi_penjelasan->ttd ?? '')
                    <img src="{{ url('/' . $pemberi_penjelasan->ttd) }}" alt="" width="90" height="55">
                @else
                    <br><br>
                @endif
                <br><br>
                <span>{{ $pemberi_penjelasan->name ?? '(...........................................................)' }}</span>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="3" rowspan="1"></td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="3" rowspan="1"></td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span><img width="10" height="10"
                        src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAGBQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA+k/ojQAAACB0Uk5TAIrAebn/o7iCQD88Myo6PZWhWHIGcaJqXm8DAXCgtJ1uCE2LAAAAfklEQVR4nLWTxwrAMAxD3eHudO/5/3/ZkNJxcGJoqU6BhyxHIQCMLFsrR2IXtfIk9jEIL0VxIoRIs0iecyyUu6RTK+VmsE/iGqBRw2kMLK6wNWV35tX6P/HwvhY47/1H5/BsbazN7onAMy785t8eVIuP7G+1MN9g1eONHntrB2WPCZJdiW0LAAAAAElFTkSuQmCC' />
                    : centang (√) salah satu sesuai jenis pembayaran pasien</span>
                <br>
                <span>*)&nbsp;&nbsp;&nbsp;: Coret yang tidak perlu</span>
            </td>
        </tr>
    </table>
@endsection
