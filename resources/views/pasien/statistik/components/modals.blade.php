
<div id="modal-laporan-pengunjung-rj" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form class="js-validation-be-contact" method="post" action="{{url('pasien/laporan/printlaporan/pengunjung-rj-triwulan')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Pengunjung Triwulan</div>
                    @include('pasien.statistik.components.form-triwulan')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_morbiditas" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/morbiditas')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Morbiditas</div>
                    @include('pasien.statistik.components.form-layanan-3')
                    @include('pasien.statistik.components.form-date-range')
                    <div class="form-group row">
                        <label class="col-12" for="example-daterange1">Format Laporan</label>
                        <div class="col-lg-8">
                            <select class="form-control" id="tujuan_laporan" name="format">
                                <option value="ri">Rawat Inap</option>
                                <option value="rj">Rawat Jalan</option>
                            </select>
                        </div>
                    </div>

                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal_10_besar_penyakit" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/sepuluhbesar')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">10 Besar Penyakit</div>
                    @include('pasien.statistik.components.form-layanan-3')
                    @include('pasien.statistik.components.form-date-range')
                    <div class="form-group row">
                        <label class="col-12" for="example-daterange1">Format Laporan</label>
                        <div class="col-lg-8">
                            <select class="form-control" id="tujuan_laporan" name="format">
                                <option value="ri">Rawat Inap</option>
                                <option value="rj">Rawat Jalan</option>
                            </select>
                        </div>
                    </div>
                    <div id="formid"> </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal_diagnosis_kasus" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/diagnosis')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Diagnosis Kasus</div>
                    @include('pasien.statistik.components.form-layanan-3')
                    @include('pasien.statistik.components.form-date-range')
                    <div id="formid"> </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_laporan_icd10" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/icd10')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">ICD10</div>
                   
                    @include('pasien.statistik.components.form-basic')
                    @include('pasien.statistik.components.form-icd10')
                    <input type="hidden" class="form-control form-control-lg" id="id-diagnosis" name="id-diagnosis" placeholder="" value="">
                    <div id="formid"> </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal_rincian_pasien_ranap" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/rincian-pasien-ranap')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Rawat Inap Rincian Pasien Keluar Masuk</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div id="formid"> </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal-pasien-dirawat-harian" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/rincian-harian-pasien-dirawat')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Rincian Harian Pasien Dirawat</div>
                    <p class="mb-30">Pilih tanggal yang anda butuhkan.</p>
                    
                    @include('pasien.statistik.components.form-date-single')
                    <div id="formid"> </div>

                    @include('pasien.statistik.components.form-ttd')

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal_kemoterapi_radioterapi" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/kemoterapi-radioterapi')}}" target="_blank" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Pengobatan Kemoterapi Radioterapi</div>
                    @include('pasien.statistik.components.form-triwulan')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_kematian_bayi_balita" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/kematian-bayi-balita')}}" target="_blank" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Kematian Bayi dan Balita</div>
                    @include('pasien.statistik.components.form-triwulan')

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_sars" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/sars')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Surveilans Aktif Rumah Sakit (SARS)</div>
                    <p class="mb-30">Pilih tanggal yang anda butuhkan.</p>
                    @include('pasien.statistik.components.form-date-single')
                    <div id="formid"> </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal_baru_lama" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form class="js-validation-be-contact" method="post" action="{{url('pasien/laporan/printlaporan/baru-lama')}}">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Jumlah Kunjungan Baru-Lama Rawat Jalan, Rawat Inap, Gangguan Jiwa</div>
                    @include('pasien.statistik.components.form-date-tahun')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_wabah" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/wabah')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Wabah</div>
                    @include('pasien.statistik.components.form-date-range')
                    <input type="hidden" class="form-control form-control-lg" id="id-diagnosis" name="id-diagnosis" placeholder="" value="">
                    <div id="formid"> </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal_pasien_jiwa" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/pasien-jiwa')}}" target="_blank" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Data Pasien Jiwa Surabaya</div>
                    @include('pasien.statistik.components.form-triwulan')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_diabetes_bulanan" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/diabetes-bulanan')}}" target="_blank" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Pelayanan Kesehatan Penderita Diabetes Melitus</div>
                    @include('pasien.statistik.components.form-triwulan')

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_diabetes_baru" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/diabetes-baru')}}" target="_blank" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Daftar Penderita Baru Diabetes Melitus kota Surabaya</div>
                    @include('pasien.statistik.components.form-triwulan')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_ppi" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/ppi')}}" target="_blank" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Formulir Pencegahan dan Pengendalian Infeksi (PPI)</div>
                    @include('pasien.statistik.components.form-triwulan')

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_kanker_baru" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/kanker-baru')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600"> Daftar Penderita Baru Kanker di Surabaya</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>



<div id="laporanResume" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/pasien-resume-inap')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Pasien Resume Inap</div>
                    @include('pasien.statistik.components.form-date-range')

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal-10-besar-penyakit-penyebab-meninggal" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/10-besar-penyakit-penyebab-meninggal')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">10 Besar Penyakit Penyebab Meninggal</div>
                    <p class="mb-30">Pilih tanggal yang anda butuhkan.</p>
                    
                    @include('pasien.statistik.components.form-date-range')
                    <div id="formid"> </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-submit" >Print</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modalTanggal4" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form class="js-validation-be-contact" method="post" action="{{url('pasien/laporan/printlaporan/kunjungan')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Kunjungan Rawat Jalan Triwulan</div>
                    @include('pasien.statistik.components.form-triwulan')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>



<div id="modal-laporan-pengunjung-igd" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form class="js-validation-be-contact" method="post" action="{{url('pasien/laporan/printlaporan/pengunjung-igd-triwulan')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Pengunjung IGD Triwulan</div>
                    @include('pasien.statistik.components.form-triwulan')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal-laporan-kunjungan-igd" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form class="js-validation-be-contact" method="post" action="{{url('pasien/laporan/printlaporan/kunjungan-igd-triwulan')}}" target="_blank">
                    {{ csrf_field() }}<div name="modal-title" class="font-size-lg font-w600">Laporan Kunjungan IGD Triwulan</div>
                    @include('pasien.statistik.components.form-triwulan')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modalTanggal5" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/sepuluhbesarrawatinap')}}">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">10 Besar Penyakit Rawat Inap</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modalTanggal6" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/morbiditasrawatinap')}}">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Morbiditas Rawat Inap</div>

                    @include('pasien.statistik.components.form-date-range')

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div id="modalTanggal8" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/diagnosisrawatinap')}}">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Diagnosis Kasus Rawat Inap</div>

                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modalRekapTransaksiJenisBayarRawatJalan" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/rekap-transaksi-rawatjalan-berdasarkan-jenis-pembayaran')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Rekap Transaksi Rawat Jalan Berdasarkan Jenis Pembayaran Pasien</div>
                    @include('pasien.statistik.components.form-basic')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modalIndeksDokter" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/indeks-dokter')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Indeks Dokter</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modalIndeksPenyakit" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/indeks-penyakit')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Indeks Penyakit</div>
                    @include('pasien.statistik.components.form-basic')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modalIndeksKematian" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/indeks-kematian')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Indeks Kematian</div>
                    @include('pasien.statistik.components.form-basic')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modalIndeksTindakan" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/indeks-tindakan')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Indeks Tindakan</div>
                    @include('pasien.statistik.components.form-basic')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modalRMResponseTime" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/rm-response-time')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Response Time Rekam Medis</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modalLaporanKematian" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/laporan-kematian')}}" target="_blank" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Kematian</div>
                    @include('pasien.statistik.components.form-basic')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modalLaporanKematianBPJS" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/laporan-kematian-bpjs')}}" target="_blank" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Kematian BPJS</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="rekapLaporanKunjunganRawatJalan" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/rekap-laporan-kunjungan-rawat-jalan')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Rekap Laporan Kunjungan Rawat Jalan</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="dataPendukungRekapLaporanKunjunganRawatJalan" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/data-pendukung-rekap-laporan-kunjungan-rawat-jalan')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Data Pendukung Rekap Laporan Kunjungan Rawat Jalan</div>
                    @include('pasien.statistik.components.form-date-range')

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="dataPelayananBerdasarkanUsiaRawatJalan" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/data-pelayanan-berdasarkan-usia-rawat-jalan')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Rekap Usia Kunjungan Rawat Jalan</div>
                    @include('pasien.statistik.components.form-date-range')

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="sepuluhBesarRawatJalanICD" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/sepuluh-besar-rawat-jalan-icd')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Sepuluh Besar Rawat Jalan ICD</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="sepuluhBesarRawatJalanICDSetiapPoli" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/sepuluh-besar-rawat-jalan-icd-setiap-poli')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Sepuluh Besar Rawat Jalan ICD Setiap Poli</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="laporanPopulasi" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/laporan-populasi')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Populasi</div>
                    @include('pasien.statistik.components.form-basic')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="laporanDemografi" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/laporan-demografi')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Demografi</div>
                    <p class="mb-30">Laporan pasien yang mengalami diagnosis tertinggi pada provinsi pilihan.</p>
                    @include('pasien.statistik.components.form-basic')
                    @include('pasien.statistik.components.form-icd10')
                    @include('pasien.statistik.components.form-jk')
                    @include('pasien.statistik.components.form-usia')
                    
                    <div id="formid"> </div>

                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="laporanSurveilans" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('pasien/laporan/printlaporan/surveilans')}}" target="_blank">
                    <input type="hidden" name="type" value="1">
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Surveilans Kasus PTM Surabaya (Rawat Inap)</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="laporanSurveilansRawatJalan" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('pasien/laporan/printlaporan/surveilans')}}" target="_blank">
                    <input type="hidden" name="type" value="2">
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Surveilans Kasus PTM Surabaya (Rawat Jalan)</div>
                   
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="laporanDiabates" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/diabetes')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Penderita Diabates Melitus di kota Surabaya</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="laporanHipertensi" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/hipertensi')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Penderita Hipertensi di kota Surabaya</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div id="laporanTBC" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/tbc')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Penderita TBC di kota Surabaya</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div id="modalLaporanPenyisiranKasusTB" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/penyisiran-kasus-tb')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Penyisiran Kasus TB </div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modalSurveilansTriageIGD" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/surveilans-triage-igd')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Surveilans Triage IGD</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="laporanKatarak" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/katarak')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Form Laporan Pasien Katarak dan Pasien Katarak yang Sudah Dioperasi</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="katarak" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/laporan-katarak')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Form Laporan Pasien Katarak dan Pasien Katarak yang Sudah Dioperasi</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="laporanKematianDinkes" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/kematianDinkes')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Form Laporan Kematian sesuai dengan format Dinas Kesehatan</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="laporanKematianRSAL" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/kematianRSAL')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Form Laporan Kematian sesuai dengan format Arsip</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="laporanP2K" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/P2K')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Pasien Penderita Penyakit Kronis</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="laporanSTP" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/stp')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan STP Rumah Sakit</div>
                    @include('pasien.statistik.components.form-date-range')
                    @include('pasien.statistik.components.form-layanan-3')
                    @include('pasien.statistik.components.form-ttd')
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modalSuratKeteranganDirawat" class="modal fade "  role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="GET" action="" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Surat Keterangan Dirawat</div>
                    <div class="form-group row">
                        <label class="col-12">Nama Pasien</label>
                        <div class="col-lg-8">
                            <select class="js-select2 form-control pasien-select2" name="pasien" id="pasien-select" style="width: 100%">
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12">Kasus <i class="fa fa-spinner fa-spin" id="loading-kasus" style="display: none"></i></label>
                        <div class="col-lg-8">
                            <select class="js-select2 form-control" name="kasus" id="kasus-select" style="width: 100%" required>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="buttonSubmit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="laporanPasienKRS" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/krs')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Pasien KRS</div>
                    @include('pasien.statistik.components.form-basic')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="laporanRanap" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('pasien/laporan/printlaporan/ranap')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Data Pasien Rawat Inap</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="laporanLansia" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/lansia')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Lansia Pelayanan Kesehatan Minimal</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="laporanKinerja" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/indikatorKinerja')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Indikator Kinerja Pelayanan</div>
                    @include('pasien.statistik.components.form-date-tahun')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="perawatan-integrasi" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form class="js-validation-be-contact" method="post" action="{{url('pasien/laporan/printlaporan/laporan-perawatan-integrasi')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Perawatan Integrasi</div>
                    @include('pasien.statistik.components.form-triwulan')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="kegiatan-rs" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form class="js-validation-be-contact" method="post" action="{{url('pasien/laporan/printlaporan/laporan-kegiatan-rs')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Kegiatan Rumah Sakit</div>
                    @include('pasien.statistik.components.form-triwulan')

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="penderita-hipertensi" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/laporan-penderita-hipertensi')}}" target="_blank" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Penderita Hipertensi</div>
                    @include('pasien.statistik.components.form-triwulan')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit"  >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="laporanHipertensi_4a" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/laporan-penderita-hipertensi-4a')}}" target="_blank" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Penderita Hipertensi</div>
                    @include('pasien.statistik.components.form-triwulan')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="laporanHipertensi_4c" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/laporan-penderita-hipertensi-4c')}}" target="_blank" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Penderita Hipertensi</div>
                    @include('pasien.statistik.components.form-date-tahun')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="persalinan" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/laporan-persalinan')}}" target="_blank" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Persalinan</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="katarak" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/laporan-pasien-katarak')}}" target="_blank" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Persalinan</div>
                    @include('pasien.statistik.components.form-triwulan')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal_pengunjung_pulang" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/pengunjung-pulang')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Pengunjung Pulang</div>
                    <p class="mb-30">Pilih tanggal yang anda butuhkan</p>
                    <div class="form-group">
                        <label class="col-12 px-0">Lokasi</label>
                        <select name="lokasi" class="form-control js-select2" required style="width: 100%">
                            <option value="0" selected>Semua</option>         
                            @foreach($lokasi_igd as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach                   
                        </select>
                    </div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="form-group">
                        <label class="col-12 px-0">Status</label>
                        <select name="status" class="form-control js-select2" required style="width: 100%">
                            <option value="1" selected>Pulang</option>         
                            <option value="2">Rawat Inap</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="penderita-baru" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/penderita-usia-15-59')}}" target="_blank" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Penderita Baru Usia 15-59 Tahun</div>
                    @include('pasien.statistik.components.form-triwulan')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal-pasien-rawat-jalan" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/pasien-rawat-jalan')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Data Pasien Rawat Jalan</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal-pasien-rawat-inap" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/pasien-rawat-inap')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Data Pasien Rawat Inap</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal-wabah" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/wabah-mingguan')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Mingguan Wabah</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal-rekap-jumlah-kasus-user" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('pasien/laporan/printlaporan/rekap-jumlah-kasus-user')}}" target="_blank">
                    <div name="modal-title" class="font-size-lg font-w600">Rekap Jumlah Kasus Tiap User</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="form-group">
                        <label>Profesi</label><br>
                        <select class="js-select2 form-control" name="profesi" style="width: 100%">
                            @foreach($profesi as $item)
                            <option value="{{$item->id}}">{{$item->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div id="modal-lahir-mati" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/lahir-mati')}}" target="_blank" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Penderita Hipertensi</div>
                    @include('pasien.statistik.components.form-triwulan')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal-rujukan-rs" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form class="js-validation-be-contact" method="post" action="{{url('pasien/laporan/printlaporan/rujukan-rs')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Rujukan Rumah Sakit</div>
                    @include('pasien.statistik.components.form-triwulan')

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div id="modal-laporan-aktifitas-poli-psikologi" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/laporan-aktifitas-poli-psikologi')}}" target="_blank" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Aktifitas Poli Psikologi</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal-kunjungan-unit-tindakan" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form class="js-validation-be-contact" method="post" action="{{url('pasien/laporan/printlaporan/kunjungan-unit-tindakan-triwulan')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Kunjungan Unit Tindakan Triwulan</div>
                    @include('pasien.statistik.components.form-triwulan')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal-pasien-igd" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/data-pasien-igd')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Data Pasien IGD</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal-pasien-mcu" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/data-pasien-mcu')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Data Pasien Medical Checkup</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="modal-sensus-harian-ranap" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content ">
            <div class="modal-body">
                <div name="modal-title" class="font-size-lg font-w600 mb-3">Laporan Sensus Rawat Inap</div>
                <nav>
                    <div class="nav nav-pills" id="nav-tab" role="tablist">
                      <a class="nav-link active" id="nav-list-tab" data-toggle="tab" href="#nav-list" role="tab" aria-controls="nav-list" aria-selected="true">Daftar Laporan</a>
                      <a class="nav-link" id="nav-add-tab" data-toggle="tab" href="#nav-add" role="tab" aria-controls="nav-add" aria-selected="false">Tambah Laporan baru</a>
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active pt-3" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">
                        <table class="table table-hover table-bordered table-sm" style="width: 100%" id="table-laporan-sensus-rawat-inap"></table>
                    </div>
                    <div class="tab-pane fade pt-3 px-3" id="nav-add" role="tabpanel" aria-labelledby="nav-add-tab">
                        <form method="post" action="{{url('pasien/laporan/printlaporan/laporan-sensus-rawat-inap')}}" target="_blank" class="js-validation-be-contact">
                            {{ csrf_field() }}
                                @include('pasien.statistik.components.form-date-month')
                            
                            <button class="btn btn-primary btn-submit">Submit</button>
                        </form>
                    </div>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="modal-laporan-keterbacaan-rekam-medis" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url('pasien/laporan/printlaporan/laporan-keterbacaan-rekam-medis')}}" target="_blank">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Laporan Keterbacaan Rekam Medis</div>
                    @include('pasien.statistik.components.form-date-range')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal-sensus-harian-ranap-ruangan" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content ">
            <div class="modal-body">
                <div name="modal-title" class="font-size-lg font-w600 mb-3">Laporan Sensus Rawat Inap Ruangan</div>
                <nav>
                    <div class="nav nav-pills" id="nav-tab" role="tablist">
                      <a class="nav-link active" id="nav-list-tab" data-toggle="tab" href="#nav-list-ruangan" role="tab" aria-controls="nav-list" aria-selected="true">Daftar Laporan</a>
                      <a class="nav-link" id="nav-add-tab" data-toggle="tab" href="#nav-add-ruangan" role="tab" aria-controls="nav-add" aria-selected="false">Tambah Laporan baru</a>
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active pt-3" id="nav-list-ruangan" role="tabpanel" aria-labelledby="nav-list-tab">
                        <table class="table table-hover table-bordered table-sm" style="width: 100%" id="table-laporan-sensus-rawat-inap-ruangan"></table>
                    </div>
                    <div class="tab-pane fade pt-3 px-3" id="nav-add-ruangan" role="tabpanel" aria-labelledby="nav-add-tab">
                        <form method="post" action="{{url('pasien/laporan/printlaporan/laporan-sensus-rawat-inap-ruangan')}}" target="_blank" class="js-validation-be-contact">
                            {{ csrf_field() }}
                                @include('pasien.statistik.components.form-date-month')
                                <div class="form-group">
                                    <select name="ruangan" id="sensus-ruangan" class="js-select2" style="width: 100%" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                            <button class="btn btn-primary btn-submit">Submit</button>
                        </form>
                    </div>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>