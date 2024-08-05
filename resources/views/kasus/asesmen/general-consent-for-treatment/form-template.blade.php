<style>
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
        margin-bottom: 0 !important;
    }

    .p-0 {
        padding: 0 !important;
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

    .text-bold {
        font-weight: 500;
    }

    table {
        border-collapse: collapse;
    }

    table tr td,
    table tr td {
        padding: 2px 3px;
        height: 25px;
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
        border-bottom: 1.8px dotted #000;
        word-break: break-word;
        display: inline-block;
    }

    .kop-img {
        object-fit: contain;
    }

    .vertical-align-middle {
        vertical-align: middle;
    }

    .medify-form-genv4-input-container {
        width: 100%;
    }

    input.custom-checkbox {
        display: none;
    }

    label {
        font-weight: 400;
    }

    input.custom-checkbox+label {
        position: relative;
        display: inline-block;
        width: 20px;
        height: 20px;
        cursor: pointer;
    }

    input.custom-checkbox+label::before {
        content: "☐";
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 12px;
        height: 12px;
    }

    input.custom-checkbox:checked+label::before {
        content: "✔";
    }

    .list-unstyled {
        list-style: none;
        list-style-type: none;
    }

    table.v-align-top tr th,
    table.v-align-top tr td {
        vertical-align: top;
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
<table style="width:100%" class="marks">
    <tr>
        <td style="width: 85%"></td>
        <td class=" position-relative bordered text-center" colspan="1" rowspan="1">
            RM. 18.K.6
        </td>
    </tr>
    <tr>
        <td></td>
        <td class=" position-relative bordered text-center" colspan="1" rowspan="1">
            Halaman
        </td>
    </tr>
</table>
<table style="width:100%">
    <tr>
        <td width = "60%" class=" position-relative kop" colspan="1" rowspan="5">
            <img src="{{ url('') }}/{{ config('app.kop_lg') }}" style="height: 103px;">
        </td>
    </tr>
    <tr>
        <td width = "14%" class=" position-relative" colspan="1" rowspan="1">
            <span>No. Rekam Medis</span>
        </td>
        <td width = "1%" class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td width = "25%" class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $pasien->no_rm ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td width = "14%" class=" position-relative" colspan="1" rowspan="1">
            <span>Nama</span>
        </td>
        <td width = "1%" class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td width = "15%" class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $pasien->name ?? '' }}</span>
            <input type="hidden" class="form-control" name="pasien_id" value="{{ $pasien->id }}">
        </td>
    </tr>
    <tr>
        <td width = "14%" class=" position-relative" colspan="1" rowspan="1">
            <span>Tanggal lahir/Umur</span>
        </td>
        <td width = "1%" class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td width = "15%" class=" position-relative" colspan="1" rowspan="1">
            <span>{{ date('d F Y', strtotime($kasus->identitas->tanggal_lahir ?? $pasien->date_of_birth)) }}</span>
            <span>/</span>
            <span>{{ $kasus->identitas->age ?? ($pasien->age ?? '') }}</span>
        </td>
    </tr>
    <tr>
        <td width = "14%" class=" position-relative" colspan="1" rowspan="1">
            <span>Jenis Kelamin</span>
        </td>
        <td width = "1%" class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td width = "15%" class=" position-relative" colspan="1" rowspan="1">
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
<table style="width:100%;">
    <tr>
        <td class=" position-relative" colspan="3" rowspan="1">
            <h5>PERSETUJUAN UMUM UNTUK PENGOBATAN (GENERAL CONSENT FOR TREATMENT)</h5>
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
            <span>HAK, KEWAJIBAN dan TANGGUNGJAWAB PASIEN</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <ol class="custom-ol">
                <li>Memperoleh informasi mengenai tata tertib dan peraturan yang berlaku di Rumah Sakit.</li>
                <li>Memperoleh informasi tentang hak dan kewajiban Pasien.</li>
                <li>Memperoleh layanan yang manusiawi, adil, jujur, dan tanpa diskriminasi.</li>
                <li>Memperoleh layanan kesehatan yang bermutu sesuai dengan standar profesi dan standar prosedur
                    operasional.</li>
                <li>Memperoleh layanan yang efektif dan efisien sehingga pasien terhindar dari kerugian fisik dan
                    materi;</li>
                <li>Mengajukan pengaduan atas kualitas pelayanan yang didapatkan.</li>
                <li>Memilih dokter, dokter gigi, dan kelas perawatan sesuai dengan keinginannya dan peraturan yang
                    berlaku di Rumah Sakit.</li>
                <li>Meminta konsultasi tentang penyakit yang dideritanya kepada dokter lain yang mempunyai Surat Izin
                    Praktik (SIP) baik di dalam maupun di luar Rumah Sakit.</li>
                <li>Mendapatkan privasi dan kerahasiaan penyakit yang diderita termasuk data medisnya.</li>
                <li>Mendapat informasi yang meliputi diagnosis dan tata cara tindakan medis, tujuan tindakan medis,
                    alternatif tindakan, risiko dan komplikasi yang mungkin terjadi, dan prognosis terhadap tindakan
                    yang dilakukan serta perkiraan biaya pengobatan.</li>
                <li>Memberikan persetujuan atau menolak atas tindakan yang akan dilakukan oleh Tenaga Kesehatan terhadap
                    penyakit yang dideritanya </li>
                <li>Didampingi keluarganya dalam keadaan kritis.</li>
                <li>Menjalankan ibadah sesuai agama atau kepercayaan yang dianutnya selama hal itu tidak mengganggu
                    pasien lainnya.</li>
                <li>Memperoleh keamanan dan keselamatan dirinya selama dalam perawatan di Rumah Sakit.</li>
                <li>Mengajukan usul, saran, perbaikan atas perlakuan Rumah Sakit terhadap dirinya.</li>
                <li>Menolak pelayanan bimbingan rohani yang tidak sesuai dengan agama dan kepercayaan yang dianutnya.
                </li>
                <li>Menggugat dan/atau menuntut Rumah Sakit apabila Rumah Sakit diduga memberikan pelayanan yang tidak
                    sesuai dengan standar baik secara perdata ataupun pidana.</li>
                <li>Mengeluhkan pelayanan Rumah Sakit yang tidak sesuai dengan standar pelayanan melalui media cetak dan
                    elektronik sesuai dengan ketentuan peraturan perundang-undangan.</li>
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
                <table style="width:100%" class="no-border">
                    <tr>
                        <td style="width: 2%" class=" position-relative" colspan="1" rowspan="1">1.</td>
                        <td style="width: 30%" class=" position-relative" colspan="1" rowspan="1">
                            @if ($action != null)
                                <input type="text" class="form-control" name="privasi[nama][]"
                                    value="{{ $hasil_data->privasi['nama'][0] ?? '' }}">
                            @else
                                <span class="medify-form-genv4-view-container">
                                    {{ $hasil_data->privasi['nama'][0] ?? '' }}</span>
                            @endif
                        </td>
                        <td style="width: 10%" class=" position-relative" colspan="1" rowspan="1">sebagai</td>
                        <td style="width: 24%" class=" position-relative" colspan="1" rowspan="1">
                            @if ($action != null)
                                <input type="text" class="form-control" name="privasi[sebagai][]"
                                    value="{{ $hasil_data->privasi['sebagai'][0] ?? '' }}">
                            @else
                                <span class="medify-form-genv4-view-container">
                                    {{ $hasil_data->privasi['sebagai'][0] ?? '' }}</span>
                            @endif
                        </td>
                        <td style="width: 10%" class=" position-relative" colspan="1" rowspan="1">telepon</td>
                        <td style="width: 24%" class=" position-relative" colspan="1" rowspan="1">
                            @if ($action != null)
                                <input type="text" class="form-control" name="privasi[telepon][]"
                                    value="{{ $hasil_data->privasi['telepon'][0] ?? '' }}">
                            @else
                                <span class="medify-form-genv4-view-container">
                                    {{ $hasil_data->privasi['telepon'][0] ?? '' }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%" class=" position-relative" colspan="1" rowspan="1">2.</td>
                        <td style="width: 30%" class=" position-relative" colspan="1" rowspan="1">
                            @if ($action != null)
                                <input type="text" class="form-control" name="privasi[nama][]"
                                    value="{{ $hasil_data->privasi['nama'][1] ?? '' }}">
                            @else
                                <span class="medify-form-genv4-view-container">
                                    {{ $hasil_data->privasi['nama'][1] ?? '' }}</span>
                            @endif
                        </td>
                        <td style="width: 10%" class=" position-relative" colspan="1" rowspan="1">sebagai</td>
                        <td style="width: 24%" class=" position-relative" colspan="1" rowspan="1">
                            @if ($action != null)
                                <input type="text" class="form-control" name="privasi[sebagai][]"
                                    value="{{ $hasil_data->privasi['sebagai'][1] ?? '' }}">
                            @else
                                <span class="medify-form-genv4-view-container">
                                    {{ $hasil_data->privasi['sebagai'][1] ?? '' }}</span>
                            @endif
                        </td>
                        <td style="width: 10%" class=" position-relative" colspan="1" rowspan="1">telepon</td>
                        <td style="width: 24%" class=" position-relative" colspan="1" rowspan="1">
                            @if ($action != null)
                                <input type="text" class="form-control" name="privasi[telepon][]"
                                    value="{{ $hasil_data->privasi['telepon'][1] ?? '' }}">
                            @else
                                <span class="medify-form-genv4-view-container">
                                    {{ $hasil_data->privasi['telepon'][1] ?? '' }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%" class=" position-relative" colspan="1" rowspan="1">3.</td>
                        <td style="width: 30%" class=" position-relative" colspan="1" rowspan="1">
                            @if ($action != null)
                                <input type="text" class="form-control" name="privasi[nama][]"
                                    value="{{ $hasil_data->privasi['nama'][2] ?? '' }}">
                            @else
                                <span class="medify-form-genv4-view-container">
                                    {{ $hasil_data->privasi['nama'][2] ?? '' }}</span>
                            @endif
                        </td>
                        <td style="width: 10%" class=" position-relative" colspan="1" rowspan="1">sebagai</td>
                        <td style="width: 24%" class=" position-relative" colspan="1" rowspan="1">
                            @if ($action != null)
                                <input type="text" class="form-control" name="privasi[sebagai][]"
                                    value="{{ $hasil_data->privasi['sebagai'][2] ?? '' }}">
                            @else
                                <span class="medify-form-genv4-view-container">
                                    {{ $hasil_data->privasi['sebagai'][2] ?? '' }}</span>
                            @endif
                        </td>
                        <td style="width: 10%" class=" position-relative" colspan="1" rowspan="1">telepon</td>
                        <td style="width: 24%" class=" position-relative" colspan="1" rowspan="1">
                            @if ($action != null)
                                <input type="text" class="form-control" name="privasi[telepon][]"
                                    value="{{ $hasil_data->privasi['telepon'][2] ?? '' }}">
                            @else
                                <span class="medify-form-genv4-view-container">
                                    {{ $hasil_data->privasi['telepon'][2] ?? '' }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%" class=" position-relative" colspan="1" rowspan="1">4.</td>
                        <td style="width: 30%" class=" position-relative" colspan="1" rowspan="1">
                            @if ($action != null)
                                <input type="text" class="form-control" name="privasi[nama][]"
                                    value="{{ $hasil_data->privasi['nama'][3] ?? '' }}">
                            @else
                                <span class="medify-form-genv4-view-container">
                                    {{ $hasil_data->privasi['nama'][3] ?? '' }}</span>
                            @endif
                        </td>
                        <td style="width: 10%" class=" position-relative" colspan="1" rowspan="1">sebagai</td>
                        <td style="width: 24%" class=" position-relative" colspan="1" rowspan="1">
                            @if ($action != null)
                                <input type="text" class="form-control" name="privasi[sebagai][]"
                                    value="{{ $hasil_data->privasi['sebagai'][3] ?? '' }}">
                            @else
                                <span class="medify-form-genv4-view-container">
                                    {{ $hasil_data->privasi['sebagai'][3] ?? '' }}</span>
                            @endif
                        </td>
                        <td style="width: 10%" class=" position-relative" colspan="1" rowspan="1">telepon</td>
                        <td style="width: 24%" class=" position-relative" colspan="1" rowspan="1">
                            @if ($action != null)
                                <input type="text" class="form-control" name="privasi[telepon][]"
                                    value="{{ $hasil_data->privasi['telepon'][3] ?? '' }}">
                            @else
                                <span class="medify-form-genv4-view-container">
                                    {{ $hasil_data->privasi['telepon'][3] ?? '' }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%" class=" position-relative" colspan="1" rowspan="1">5.</td>
                        <td style="width: 30%" class=" position-relative" colspan="1" rowspan="1">
                            @if ($action != null)
                                <input type="text" class="form-control" name="privasi[nama][]"
                                    value="{{ $hasil_data->privasi['nama'][4] ?? '' }}">
                            @else
                                <span class="medify-form-genv4-view-container">
                                    {{ $hasil_data->privasi['nama'][4] ?? '' }}</span>
                            @endif
                        </td>
                        <td style="width: 10%" class=" position-relative" colspan="1" rowspan="1">sebagai</td>
                        <td style="width: 24%" class=" position-relative" colspan="1" rowspan="1">
                            @if ($action != null)
                                <input type="text" class="form-control" name="privasi[sebagai][]"
                                    value="{{ $hasil_data->privasi['sebagai'][4] ?? '' }}">
                            @else
                                <span class="medify-form-genv4-view-container">
                                    {{ $hasil_data->privasi['sebagai'][4] ?? '' }}</span>
                            @endif
                        </td>
                        <td style="width: 10%" class=" position-relative" colspan="1" rowspan="1">telepon</td>
                        <td style="width: 24%" class=" position-relative" colspan="1" rowspan="1">
                            @if ($action != null)
                                <input type="text" class="form-control" name="privasi[telepon][]"
                                    value="{{ $hasil_data->privasi['telepon'][4] ?? '' }}">
                            @else
                                <span class="medify-form-genv4-view-container">
                                    {{ $hasil_data->privasi['telepon'][4] ?? '' }}</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </ol>
        </td>
    </tr>
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
                        @if ($action != null)
                            <div class="form-check form-check-inline medify-form-genv4-input-container">
                                <input class="form-check-input" type="checkbox" name="pembiayaan[bayar_sendiri]"
                                    value="1" @if ($hasil_data_temp == '1') checked @endif>
                                <label class="form-check-label">Akan kami bayar sendiri, dengan menjadi pasien umum
                                    Rumah Sakit Jiwa Menur Provinsi Jawa Timur</label>
                            </div>
                        @else
                            <span class="medify-form-genv4-view-container">
                                @if ($hasil_data_temp == '1')
                                    <span>☑ Akan kami bayar sendiri, dengan menjadi pasien umum Rumah Sakit Jiwa Menur
                                        Provinsi Jawa Timur</span>
                                @else
                                    <span>⬜ Akan kami bayar sendiri, dengan menjadi pasien umum Rumah Sakit Jiwa Menur
                                        Provinsi Jawa Timur</span>
                                @endif
                            </span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class=" position-relative vertical-align-middle" colspan="1" rowspan="1">
                        @php $hasil_data_temp = $hasil_data->pembiayaan['ditanggung_oleh_perusahaan'] ?? '' @endphp
                        @if ($action != null)
                            <div class="form-check form-check-inline medify-form-genv4-input-container">
                                <input class="form-check-input" type="checkbox"
                                    name="pembiayaan[ditanggung_oleh_perusahaan]" value="1"
                                    @if ($hasil_data_temp == '1') checked @endif>
                                <label class="form-check-label">
                                    <div class="row">
                                        <div class="col-sm-5">Ditanggung oleh perusahaan/ Instansi/ Asuransi*) </div>
                                        <div class="col-sm-7">
                                            @if ($action != null)
                                                <input type="text" class="form-control"
                                                    name="pembiayaan[ditanggung_oleh_perusahaan_nama]"
                                                    value="{{ $hasil_data->pembiayaan['ditanggung_oleh_perusahaan_nama'] ?? '' }}">
                                            @endif
                                        </div>
                                    </div>
                                    dan kami bersedia melengkapi dan menyerahkan persyaratan administrasi pada saat akan
                                    dilakukan perawatan di Rumah Sakit Jiwa Menur Provinsi Jawa Timur.
                                </label>
                            </div>
                        @else
                            <span class="medify-form-genv4-view-container">
                                @if ($hasil_data_temp == '1')
                                    <span>☑ Ditanggung oleh perusahaan/ Instansi/ Asuransi*)
                                        {{ $hasil_data->pembiayaan['ditanggung_oleh_perusahaan_nama'] ?? '' }} dan kami
                                        bersedia melengkapi dan menyerahkan persyaratan administrasi pada saat akan
                                        dilakukan perawatan di Rumah Sakit Jiwa Menur Provinsi Jawa Timur.</span>
                                @else
                                    <span>⬜ Ditanggung oleh perusahaan/ Instansi/ Asuransi*)
                                        .............................................................. dan kami bersedia
                                        melengkapi dan menyerahkan persyaratan administrasi pada saat akan dilakukan
                                        perawatan di Rumah Sakit Jiwa Menur Provinsi Jawa Timur.</span>
                                @endif
                            </span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class=" position-relative vertical-align-middle" colspan="1" rowspan="1">
                        @php $hasil_data_temp = $hasil_data->pembiayaan['ditanggung_oleh_bpjs'] ?? '' @endphp
                        @if ($action != null)
                            <div class="form-check form-check-inline medify-form-genv4-input-container">
                                <input class="form-check-input" type="checkbox"
                                    name="pembiayaan[ditanggung_oleh_bpjs]" value="1"
                                    @if ($hasil_data_temp == '1') checked @endif>
                                <label class="form-check-label">Ditanggung oleh BPJS dan kami bersedia melengkapi dan
                                    menyerahkan persyaratan administrasi sejak penderita akan dirawat.</label>
                            </div>
                        @else
                            <span class="medify-form-genv4-view-container">
                                @if ($hasil_data_temp == '1')
                                    <span>☑ Ditanggung oleh BPJS dan kami bersedia melengkapi dan menyerahkan
                                        persyaratan administrasi sejak penderita akan dirawat.</span>
                                @else
                                    <span>⬜ Ditanggung oleh BPJS dan kami bersedia melengkapi dan menyerahkan
                                        persyaratan administrasi sejak penderita akan dirawat.</span>
                                @endif
                            </span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class=" position-relative vertical-align-middle" colspan="1" rowspan="1">
                        @php $hasil_data_temp = $hasil_data->pembiayaan['naik_kelas_perawatan'] ?? '' @endphp
                        @if ($action != null)
                            <div class="form-check form-check-inline medify-form-genv4-input-container">
                                <input class="form-check-input" type="checkbox"
                                    name="pembiayaan[naik_kelas_perawatan]" value="1"
                                    @if ($hasil_data_temp == '1') checked @endif>
                                <label class="form-check-label">Apabila menghendaki naik kelas perawatan, Kami bersedia
                                    membayar selisih biaya yang harus ditanggung.</label>
                            </div>
                        @else
                            <span class="medify-form-genv4-view-container">
                                @if ($hasil_data_temp == '1')
                                    <span>☑ Apabila menghendaki naik kelas perawatan, Kami bersedia membayar selisih
                                        biaya yang harus ditanggung.</span>
                                @else
                                    <span>⬜ Apabila menghendaki naik kelas perawatan, Kami bersedia membayar selisih
                                        biaya yang harus ditanggung.</span>
                                @endif
                            </span>
                        @endif
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
            @if ($action != null)
                <div class="form-check form-check-inline medify-form-genv4-input-container">
                    <input class="form-check-input" type="checkbox" name="sudah_membaca_menandatangani"
                        value="1" @if ($hasil_data_temp == '1') checked @endif>
                    <label class="form-check-label" style="margin-left: 20px;">“Saya menjamin bahwa pasien sudah
                        membaca dan menandatangani consent pembukaan data dari SATUSEHAT”</label>
                </div>
            @else
                <span class="medify-form-genv4-view-container">
                    @if ($hasil_data_temp == '1')
                        <span>☑<span style="margin-left: 20px;">“Saya menjamin bahwa pasien sudah membaca dan
                                menandatangani consent pembukaan data dari SATUSEHAT”</span></span>
                    @else
                        <span>⬜ <span style="margin-left: 20px;">“Saya menjamin bahwa pasien sudah membaca dan
                                menandatangani consent pembukaan data dari SATUSEHAT”</span></span>
                    @endif
                </span>
            @endif
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
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>Keluarga/Penanggung jawab pasien</span>
            @if ($action != null)
                <br><br><br><br>
                <span>(...........................................................)</span>
                <br>
                <span>Nama Jelas</span>
            @else
                <div class="medify-form-genv4-view-container">
                    @php
                        $temp_img_ttd = $hasil_data->img_ttd ?? '';
                    @endphp
                    @if ($temp_img_ttd ?? '')
                        <img src="{{ url('') }}/{{ $temp_img_ttd }}" style="width: 100px">
                    @else
                        <br><br><br><br>
                    @endif
                    <br>
                    <span>{{ $hasil_data->nama_ttd ?? '(...........................................................)' }}</span>
                </div>
            @endif
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>Saksi Keluarga/Saksi Petugas *)</span>
            @if ($action != null)
                <br><br><br><br>
                <div class="form-check form-check-inline medify-form-genv4-input-container">
                    <select name="saksi_petugas" class="form-control js-select2">
                        @foreach ($user as $val)
                            <option value="{{ $val->id }}" @if (($hasil_data->saksi_petugas ?? '') == $val->id) selected @endif>
                                {{ $val->name }}</option>
                        @endforeach
                    </select>
                </div>
            @else
                <div class="medify-form-genv4-view-container">
                    @php
                        $saksi_petugas = \App\User::find($hasil_data->saksi_petugas ?? '');
                    @endphp
                    @if ($saksi_petugas->ttd ?? '')
                        <img src="{{ url('') }}/{{ $saksi_petugas->ttd }}" style="width: 100px">
                    @else
                        <br><br><br><br>
                    @endif
                    <br>
                    <span>{{ $saksi_petugas->name ?? '(...........................................................)' }}</span>
                </div>
            @endif
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>Pemberi Penjelasan</span>
            @if ($action != null)
                <br><br><br><br>
                <div class="form-check form-check-inline medify-form-genv4-input-container">
                    <br><br><br><br>
                    <select name="pemberi_penjelasan" class="form-control js-select2">
                        @foreach ($user as $val)
                            <option value="{{ $val->id }}" @if (($hasil_data->pemberi_penjelasan ?? '') == $val->id) selected @endif>
                                {{ $val->name }}</option>
                        @endforeach
                    </select>
                </div>
            @else
                <div class="medify-form-genv4-view-container">
                    @php
                        $pemberi_penjelasan = \App\User::find($hasil_data->pemberi_penjelasan ?? '');
                    @endphp
                    @if ($pemberi_penjelasan->ttd ?? '')
                        <img src="{{ url('') }}/{{ $pemberi_penjelasan->ttd }}" style="width: 100px">
                    @else
                        <br><br><br><br>
                    @endif
                    <br>
                    <span>{{ $pemberi_penjelasan->name ?? '(...........................................................)' }}</span>
                </div>
            @endif
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="3" rowspan="1"></td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="3" rowspan="1">
            <span>⬜ : centang (√) salah satu sesuai jenis pembayaran pasien</span>
            <br>
            <span>*)&nbsp;&nbsp;&nbsp;: Coret yang tidak perlu</span>
        </td>
    </tr>
</table>
