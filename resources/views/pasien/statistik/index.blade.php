@extends('pasien.layouts.main')

@section('title')
Laporan & Statistik - Pasien
@endsection

@section('subtitle')
Laporan & Statistik
@endsection

@section('content')
<main id="main-container">
    @include('pasien.layouts.navbar')
    <div class="container">
        <h2 class="font-size-lg font-w600 mb-30">Pilih Laporan Sesuai Kebutuhan Anda</h2>
        <div class="row">

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Rawat Inap Rincian Pasien Keluar Masuk
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Rincian Pasien MRS, Pindah Ruang, dan KRS  
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_rincian_pasien_ranap">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan ICD10
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan ICD10
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_laporan_icd10">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Morbiditas
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan Morbiditas pada Pasien berdasarkan golongan umur pasien
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_morbiditas">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            10 Besar Penyakit
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Daftar 10 besar penyakit
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_10_besar_penyakit">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            10 Besar Penyakit Penyebab Meninggal
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Direkapitulasi berdasarkan pasien yang KRS dengan status Meninggal dan di rekap menurut DTD
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-10-besar-penyakit-penyebab-meninggal">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Kunjungan Rawat Jalan
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan kunjungan pada rawat jalan berdasarkan jenis pembayaran pasien per 3 bulan
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalTanggal4">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Pengunjung Rawat Jalan
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan pengunjung pada rawat jalan berdasarkan jenis pembayaran pasien per 3 bulan
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-laporan-pengunjung-rj">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Diagnosis Kasus Berdasarkan Jenis Pasien
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Diagnosis kasus berdasarkan jenis pasien pada kurung waktu tertentu
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_diagnosis_kasus">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Rekap Transaksi Rawat Jalan Berdasarkan Jenis Pembayaran Pasien
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Dibagi berdasarkan jenis pembayaran pasien
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalRekapTransaksiJenisBayarRawatJalan" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Indeks Dokter
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Riwayat pemeriksaan pasien berdasarkan dokter
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalIndeksDokter" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Indeks Penyakit
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Riwayat pemeriksaan pasien berdasarkan kode diagnosis
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalIndeksPenyakit" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Indeks Kematian
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Riwayat kematian 
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalIndeksKematian" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Kematian
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Buat laporan kematian untuk pada tempat layanan
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalLaporanKematian" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Indeks Tindakan
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Riwayat pemeriksaan pasien berdasarkan kode tindakan
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalIndeksTindakan" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            RM Response Time
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Histori response time pengantaran Rekam Medis
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalRMResponseTime" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Rekap Laporan Kunjungan Rawat Jalan
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Rekap Laporan Setiap Poli Pada Tanggal Tertentu
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#rekapLaporanKunjunganRawatJalan" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Data Pendukung Rekap Laporan Kunjungan Rawat Jalan
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Data Pendukung Pria Wanita & Konsul Setiap Poli Pada Tanggal Tertentu
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#dataPendukungRekapLaporanKunjunganRawatJalan" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <!-- <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                           Data Pelayanan Berdasarkan Usia Rawat Jalan
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Rekap transaksi rawat jalan berdasarkan usia pasien.
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#dataPelayananBerdasarkanUsiaRawatJalan" >Buat Laporan</button>
                    </div>
                </div>
            </div> -->

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            10 Besar Rawat Jalan Berdasarkan ICD
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        10 Besar Rawat Jalan Berdasarkan ICD
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#sepuluhBesarRawatJalanICD" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            10 Besar Rawat Jalan Berdasarkan ICD Setiap Poli
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        10 Besar Rawat Jalan Berdasarkan ICD Setiap Poli
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#sepuluhBesarRawatJalanICDSetiapPoli" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Populasi
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan kunjungan berdasarkan usia, jenis kelamin, agama, dan pendidikan
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#laporanPopulasi" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Demografi
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan pasien yang mengalami diagnosis tertinggi pada provinsi pilihan
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#laporanDemografi" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Surveilans Kasus PTM Kota Surabaya (Rawat Inap)
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan Surveilans Kasus PTM dari rumah sakit kabupaten/kota Surabaya untuk rawat inap 
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#laporanSurveilans" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Surveilans Kasus PTM Kota Surabaya (Rawat Jalan)
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan Surveilans Kasus PTM dari rumah sakit kabupaten/kota Surabaya untuk rawat jalan 
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#laporanSurveilansRawatJalan" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Penderita Diabetes Melitus
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan Penderita Diabetes Melitus di kota Surabaya berdasarkan rentang waktu tertentu 
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#laporanDiabates" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Penderita Hipertensi
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan Penderita Hipertensi di kota Surabaya berdasarkan rentang waktu tertentu 
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#laporanHipertensi" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Penderita TBC
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan Penderita TBC di kota Surabaya berdasarkan rentang waktu tertentu 
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#laporanTBC" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Pasien Katarak yang Belum/Sudah Dioperasi
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Form Laporan Pasien Katarak baik yang belum maupun telah dioperasi 
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#laporanKatarak" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12" style="display: none;">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Pasien Katarak yang Belum/Sudah Dioperasi
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Form Laporan Pasien Katarak baik yang belum maupun telah dioperasi 
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#katarak" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Kematian Dinkes
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Rekapitulasi Laporan Kematian Rumah Sakit dalam bentuk format Dinkes 
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#laporanKematianDinkes" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Kematian
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Rekapitulasi Laporan Kematian Rumah Sakit 
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#laporanKematianRSAL" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Penderita Penyakit Kronis
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan Penderita Penyakit Kronis (P2K) {{config('app.name')}}
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#laporanP2K" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Data Pasien Rawat Inap
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan Data Pasien Rawat Inap dalam bentuk PDF {{config('app.name')}} 
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#laporanRanap" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Lansia Pelayanan Kesehatan Minimal
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Daftar Lansia yang telah mendapatkan Pelayanan Kesehatan Minimal 
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#laporanLansia" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Kinerja Pelayanan Rumah Sakit
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Indikator kinerja pelayanan rumah sakit dalam setahun 
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#laporanKinerja" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan STP Rumah Sakit
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan STP untuk Rawat Inap dan Rawat Jalan {{config('app.name')}}
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#laporanSTP" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Pasien KRS
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Rekapitulasi Pasien yang telah melakukan KRS
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#laporanPasienKRS" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Pasien Resume Rawat Inap
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan resume pasien rawat inap
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#laporanResume" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Kematian BPJS
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan resume kematian BPJS
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalLaporanKematianBPJS" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Surat Keterangan Dirawat
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Surat keterangan bahwa pasien dalam perawatan.
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalSuratKeteranganDirawat" >Buat Surat</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Penyisiran Kasus TB
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan Penyisiran Kasus TB
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalLaporanPenyisiranKasusTB" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Surveilans Triage IGD
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Surveilans Triage IGD
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalSurveilansTriageIGD" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Kunjungan IGD
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan kunjungan pada IGD berdasarkan jenis pembayaran pasien per 3 bulan
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-laporan-kunjungan-igd">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Pengunjung IGD
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan pengunjung pada IGD berdasarkan jenis pembayaran pasien per 3 bulan
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-laporan-pengunjung-igd">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Rincian Pasien Dirawat
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan perincian pasien di rawat inap per hari
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-pasien-dirawat-harian">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12" style="display: none;">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Perawatan Terintegrasi
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan perawatan integrasi
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#perawatan-integrasi">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12" style="display: none;">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Kegiatan Rumah Sakit
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan kegiatan rumah sakit
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#kegiatan-rs">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12" style="display: none;">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Penderita Hipertensi 1.4A
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan Penderita Hipertensi di kota Surabaya
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#laporanHipertensi_4a" >Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12" style="display: none;">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Penderita Hipertensi 1.4B
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan bulanan penderita hipertensi
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#penderita-hipertensi">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12" style="display: none;">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Penderita Hipertensi 1.4C
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan bulanan penderita hipertensi
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#laporanHipertensi_4c">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Persalinan
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan bulanan persalinan
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#persalinan">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12" style="display: none">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Penderita Usia 15 - 59 Tahun
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan bulanan penderita baru usia 15 - 59 tahun yang berobat dirumah sakit kota Surabaya tahun 2019
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#penderita-baru">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Pengunjung Pulang
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan Pengunjung Pulang
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_pengunjung_pulang">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12" style="display: none;">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Kemoterapi Radioterapi Penderita Kanker
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan penderita kanker yang mendapat pengobatan kemoterapi dan radioterapi 
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_kemoterapi_radioterapi">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12" style="display: none;">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Kematian Bayi dan Balita
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan kematian Bayi dan Balita 
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_kematian_bayi_balita">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12" style="display: none;">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Surveilansa Aktif Rumah Sakit (SARS)
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Lembar Pengumpul Data KLB
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_sars">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12" style="display: none;">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Jumlah Kunjungan Baru - Lama
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan Jumlah Kunjungan Baru/Lama Rawat Jalan, Rawat Inap, Gangguan Jiwa 
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_baru_lama">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12" style="display: none;">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Wabah
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan Wabah Dalam Kurun Tanggal Tertentu 
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_wabah">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12" style="display: none;">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Data Pasien Jiwa Surabaya
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Untuk pencapaian SPM Pencegahan dan Pengendalian PTM berdasarkan Peraturan Menteri No. 4 Tahun 2019 
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_pasien_jiwa">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12" style="display: none;">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Daftar Penderita Baru Diabetes Melitus
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Untuk pencapaian SPM Pencegahan dan Pengendalian PTM berdasarkan Peraturan Menteri No. 4 Tahun 2019 
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_diabetes_baru">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12" style="display: ;">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Daftar Penderita Baru Kanker di Surabaya
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Untuk pencapaian SPM Pencegahan dan Pengendalian PTM berdasarkan Peraturan Menteri No. 4 Tahun 2019
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_kanker_baru">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12" style="display: none;">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Pelayanan Kesehatan Penderita Diabetes Melitus
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan Pelayanan Kesehatan Penderita Diabetes Melitus Bulanan
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_diabetes_bulanan">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12" style="display: none;">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Formulir Pencegahan dan Pengendalian Infeksi (PPI)
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Formulir Pencegahan dan Pengendalian Infeksi (PPI)
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_ppi">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Data Pasien Rawat Jalan
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Data Pasien Rawat Jalan
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-pasien-rawat-jalan">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Data Pelayanan Pasien Rawat Inap
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Data Pelayanan Pasien Rawat Inap
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-pasien-rawat-inap">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12" style="display: none;">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Mingguan Wabah
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan mingguan wabah
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-wabah">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12" style="display: none;">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Lahir Mati
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan lahir mati
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-lahir-mati">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12" style="display: none;">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Rujukan Rumah Sakit
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan rujukan rumah sakit
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-rujukan-rs">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Rekap Jumlah Kasus per User
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan jumlah kasus untuk tiap user berdasarkan profesi
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-rekap-jumlah-kasus-user">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Aktifitas Poli Psikologi
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan aktifitas poli psikologi
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-laporan-aktifitas-poli-psikologi">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Kunjungan Unit Tindakan
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan kunjungan pada unit tindakan berdasarkan jenis pembayaran pasien per 3 bulan
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-kunjungan-unit-tindakan">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Indikator Pelayanan
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan Indikator Pelayanan
                    </div>
                    <div class="block-content block-content-full text-center">
                        <a href="{{ url('pasien/laporan/printlaporan/rl-1-2-indikator-pelayanan') }}" class="btn btn-secondary">Buka Laporan</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Data Pasien IGD
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Data Pasien IGD
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-pasien-igd">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Data Pasien Medical Checkup
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Data Pasien Medical Checkup
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-pasien-mcu">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Sensus Harian Rawat Inap
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan Sensus Harian Rawat Inap
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-sensus-harian-ranap">Buat Laporan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="block block-bordered" style="height: 285px !important">
                    <div class="block-header">
                        <div class="block-title text-center">
                            Laporan Keterbacaan Rekam Medis
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        Laporan Keterbacaan Rekam Medis
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-laporan-keterbacaan-rekam-medis">Buat Laporan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
@include('pasien.statistik.components.modals')


@endsection

@section('js')
@include('pasien.statistik.js')
@endsection