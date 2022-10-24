@foreach($kematian as $k)
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table cellspacing="0">
                        <tr class="border_bottom">
                            <td class="title" width="10%">
                                <img src="{{asset('assets/img/rumkital.png')}}" height="50" style="float: left;margin-right: 5px">
                            </td>
                            <td>
                                <h2 align="center"><b/><br>
                                {{config('app.name')}}</h2>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="informations">
                <td colspan="2">
                    <table>
                        <tr class="information">
                            <td width="20%">
                                <p align="left" style="font-size:18px; padding-top: 0px;"><b/>RAHASIA</p>
                            </td>
                            <td>
                                <h3 align="center" style="padding-bottom: 10px;"><u/>SERTIFIKAT MEDIS PENYEBAB KEMATIAN</h3>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr class="information">
                            <td width="50%">
                                <p align="left">Bulan / Tahun  {{date("m/Y")}}</p>
                            </td>
                            <td>
                                <p align="right">Kode RS : 3578020</p>
                            </td>
                        </tr>
                        <tr class="information">
                          @if(!isset($invoice['transaksi_id']))
                            <td colspan="2">
                                <p>No. Urut Pencatatan Kematian __ __ __ No. Rekam Medis {{$k['pasien']['identitas']['id']}} Ruangan :</p>
                            </td>
                          @else
                            <td colspan="2">
                                <p>No. Urut Pencatatan Kematian {{$k['invoice']['transaksi_id']}} No. Rekam Medis {{$k['pasien']['identitas']['id']}} Ruangan :</p>
                            </td>
                          @endif
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td colspan="2">
                    I. Identitas Jenazah
                </td>
            </tr>
            <tr class="detailsafterheading">
                <td>
                    1. Nama Lengkap
                </td>
                <td>
                    {{$k['pasien']['identitas']['name']}}
                </td>
            </tr>
            <tr class="details">
                <td>
                    2. Pangkat / NRP
                </td>
                <td>
                    BPJS
                </td>
            </tr>
            <tr class="details">
                <td>
                    3. No. Induk Kependudukan (NIK)
                </td>
                <td>
                    {{$k['jenazah']['nik'][0]['nik']}}
                </td>
            </tr>
            <tr class="details">
                <td>
                  4. No. Kartu Keluarga :
                </td>
                <td>
                    {{$k['jenazah']['nokk'][0]['nokk']}}
                </td>
            </tr>
            <tr class="details">
                <td>
                    5. Jenis Kelamin
                </td>
                <td>
                    @if($k['pasien']['identitas']['gender'] == 1) Laki laki
                    @else Perempuan
                    @endif
                </td>
            </tr>
            <tr class="details">
                <td>
                    6. Tempat/Tanggal Lahir/ Umur
                </td>
                <td>
                    {{$k['pasien']['identitas']['place_of_birth']}}, {{date('d F Y', strtotime($k['pasien']['identitas']['date_of_birth']))}} <b>Umur</b> {{$k['pasien']['identitas']['age']}} Th
                </td>
            </tr>
            <tr class="details">
                <td>
                    7. Agama
                </td>
                <td>
                    {{$k['pasien']['identitas']['agama']['nama']}}
                </td>
            </tr>
            <tr class="details">
                <td>
                    8. Alamat Tempat Tinggal
                </td>
                <td>
                    {{$k['pasien']['identitas']['address']}},
                    @if(!empty($k['pasien']['identitas']['alamat_kecamatan']))
                    {{$k['pasien']['identitas']['alamat_kecamatan']['name']}}, {{$k['pasien']['identitas']['alamat_kota']['name']}}
                    @endif
                </td>
            </tr>
            <tr class="details">
                <td>
                    9. Status Kependudukan
                </td>
                <td>
                    {{$k['jenazah']['status_kependudukan'][0]['status_kependudukan']}}
                </td>
            </tr>
            <tr class="details">
                <td>
                    10. Hubungan dengan Kepala Rumah Tangga
                </td>
                <td>
                    {{$k['jenazah']['hubungan_keluarga'][0]['hubungan_keluarga']}}
                </td>
            </tr>
            <tr class="details">
                <td>
                    11. Waktu Meninggal
                </td>
                <td>
                    {{$k['jenazah']['permintaan'][0]['waktu_meninggal']}}
                </td>
            </tr>
            <tr class="details">
                <td>
                    12. Tempat Meninggal
                </td>
                <td>
                    {{$k['jenazah']['tempat_kematian'][0]['nama_tempat']}} - {{$k['jenazah']['permintaan'][0]['detail_tempat']}}
                </td>
            </tr>

            <tr class="heading">
                <td colspan="2">
                    II. Keterangan Khusus Kasus Kematian di Rumah atau Lainnya (Termasuk DOA)
                </td>
            </tr>
            <tr class="detailsafterheading">
                <td>
                    1. Status Jenazah
                </td>
                <td>
                    @if($k['jenazah']['status_jenazah'][0]['status_jenazah'] == 'Belum dimakamkan')
                    Belum dimakamkan
                    @else
                    Telah dimakamkan : {{$k['jenazah']['dikubur'][0]['dikubur']}}
                    @endif
                </td>
            </tr>
            <tr class="details">
                <td>
                    2. Nama Pemeriksa Jenazah
                </td>
                <td>
                    {{$k['jenazah']['nama_pemeriksa'][0]['nama_pemeriksa']}}
                </td>
            </tr>

            <tr class="details">
                <td>
                    3. Waktu Pemeriksaan Jenazah
                </td>
                <td>
                    {{$k['created_at']}}
                </td>
            </tr>

            <tr class="heading">
                <td colspan="2">
                    III. Penyebab Kematian
                </td>
            </tr>
            <tr class="detailsafterheading">
                <td>
                    1. Dasar Diagnosis
                </td>
                <td>
                    <ul>
                        @foreach($k['jenazah']['nama_diagnosis'] as $namanya)
                        <li>{{$namanya}}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            <tr class="details">
                <td>
                    2. Kelompok Penyebab Kematian
                </td>
                <td>
                    {{$k['jenazah']['sebab_kematian'][0]['nama_sebab']}} ({{$k['jenazah']['permintaan'][0]['detail_kematian']}})
                </td>
            </tr>

        </table>
    </div>
    @if(!$loop->last)
    <div style="page-break-after: always;"></div>
    @endif
@endforeach