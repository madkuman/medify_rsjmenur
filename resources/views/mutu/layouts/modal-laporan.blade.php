<div id="modal_iad" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/iad')}}" class="js-validation-be-contact">
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit IAD Bundle Checklist</div>
                    @include('mutu.layouts.components.zona-tanggal')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_isk" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/isk')}}" class="js-validation-be-contact">
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit ISK</div>
                    @include('mutu.layouts.components.zona-tanggal')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_ido" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/ido')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit IDO Bundle Checklist</div>
                    @include('mutu.layouts.components.zona-tanggal')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_vap" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/vap')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit Ventilator Bundle Checklist</div>
                    @include('mutu.layouts.components.zona-tanggal')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_cuci_tangan" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/cuci-tangan')}}" class="js-validation-be-contact">
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit Cuci Tangan</div>
                    <div class="form-group">
                        <label class="" for="example-daterange1">User</label>
                        <select name="user" id="user" class="js-select2 form-control" style="width: 100%">
                            @foreach($users as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label class="col-12">Tanggal</label>
                        <div class="input-daterange input-group col-8 " data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        </div>
                    </div>
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_kejadian_jatuh" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/kejadian-jatuh')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit Kejadian Jatuh</div>
                    @include('mutu.layouts.components.zona-tanggal')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_kejadian_hap" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/kejadian-hap')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit Kejadian HAP</div>
                    @include('mutu.layouts.components.zona-tanggal')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_kejadian_plebitis" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/kejadian-plebitis')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit Kejadian Plebitis</div>
                    @include('mutu.layouts.components.zona-tanggal')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_kejadian_dekubitus" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/kejadian-dekubitus')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit Kejadian Dekubitus</div>
                    @include('mutu.layouts.components.zona-tanggal')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_kepatuhan_sepsis" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/kepatuhan-sepsis')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit Sepsis</div>
                    @include('mutu.layouts.components.zona-tanggal')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_waktu_tunggu" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/waktu-tunggu')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Waktu Tunggu Rawat Jalan</div>
                    <div class="form-group row">
                        <label class="col-12">Tanggal</label>
                        <div class="input-daterange input-group col-8 " data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        </div>
                    </div>
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_jam_buka" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/jam-buka')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Jam Buka Pelayanan</div>
                    <div class="form-group row">
                        <label class="col-12">Tanggal</label>
                        <div class="input-daterange input-group col-8 " data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        </div>
                    </div>
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_identifikasi" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/kepatuhan-identifikasi')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit Kepatuhan Identifikasi Pasien</div>
                    @include('mutu.layouts.components.zona-tanggal')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_kematian_pasien_48" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/kematian-pasien-48')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit Kematian Pasien < 48 Jam</div>

                    <div class="form-group row">
                        <label class="col-12">Tanggal</label>
                        <div class="input-daterange input-group col-8 " data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        </div>
                    </div>
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_kepatuhan_visite" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/kepatuhan-visite')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit Kepatuhan Jam Visite</div>
                    @include('mutu.layouts.components.ruangan-tanggal')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_penilaian_cppt_dpjp" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/penilaian-cppt-kehadiran-dpjp')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Evaluasi Peniliain CPPT dan Kehadiran DPJP</div>
                    @include('mutu.layouts.components.ruangan-tanggal')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_pengumpulan_data" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/pengumpulan-data')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Pengumpulan Data Review</div>
                    <div class="form-group">
                        <label class="" for="example-daterange1">Pasien</label>
                        <select name="lokasi" id="lokasi" class="js-select2 form-control" style="width: 100%">
                            <option value="">Kevin Fachreza</option>
                            <option value="">Aldi Febriansyah</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="" for="example-daterange1">Kasus</label>
                        <select name="lokasi" id="lokasi" class="js-select2 form-control" style="width: 100%">
                            <option value="">Ambeien</option>
                            <option value="">Kolera</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_pengumpulan_data_review" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/pengumpulan-data-review')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Pengumpulan Data Review</div>
                    <div class="form-group">
                        <label class="" for="example-daterange1">Pasien</label>
                        <select name="lokasi" id="lokasi" class="js-select2 form-control" style="width: 100%">
                            <option value="">Kevin Fachreza</option>
                            <option value="">Aldi Febriansyah</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="" for="example-daterange1">Kasus</label>
                        <select name="lokasi" id="lokasi" class="js-select2 form-control" style="width: 100%">
                            <option value="">Ambeien</option>
                            <option value="">Kolera</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_checklist_edukasi_stroke" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg modal-fullscreen">
        <div class="modal-content">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/checklist-edukasi-stroke')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-5">Formulir checklist edukasi stroke</div>
                    @include('mutu.layouts.components.modal-checklist-edukasi-stroke')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal_mata" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/mata')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit Mata</div>
                    <div class="form-group row">
                        <label class="col-12">Tanggal</label>
                        <div class="input-daterange input-group col-8 " data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        </div>
                    </div>
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_igd" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/igd')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit IGD</div>
                    <div class="form-group row">
                        <label class="col-12">Tanggal</label>
                        <div class="input-daterange input-group col-8 " data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        </div>
                    </div>
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- ============= Modal Komplain IT ============ -->
<div id="modal_komplain_it" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/it')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Mutu Terkait Respon Terhadap Komplain IT</div>
                    <div class="form-group row">
                        <label class="col-12">Tanggal</label>
                        <div class="input-daterange input-group col-8 " data-date-format="dd-mm-yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        </div>
                    </div>
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_gizi" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/gizi')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Mutu Gizi</div>
                    <div class="form-group row">
                        <label class="col-12">Tanggal</label>
                        <div class="input-daterange input-group col-8 " data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        </div>
                    </div>
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_k3" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/k3')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Keamanan, Kesehatan dan Keselamatan Kerja</div>
                    <div class="form-group row">
                        <label class="col-12">Tanggal</label>
                        <div class="input-daterange input-group col-8 " data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        </div>
                    </div>
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<div id="modal_rehabmed" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/rehabmed')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Mutu Rehabilitasi Medis</div>
                    @include('mutu.layouts.components.ruangan-tanggal')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_humas_komplain" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/humas-komplain')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Humas - Komplain</div>
                    <div class="form-group row">
                        <label class="col-12">Tanggal</label>
                        <div class="input-daterange input-group col-8 " data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        </div>
                    </div>
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- ============= Modal Harmat - Listrik Mati ============ -->
<div id="modal_harmat_listrik_mati" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/harmat/listrik-mati')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Mutu Terkait Keterlambatan Respon Time Genset</div>
                    <div class="form-group row">
                        <label class="col-12">Tanggal</label>
                        <div class="input-daterange input-group col-8 " data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        </div>
                    </div>
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- ============= Modal Harmat - Perbaikan Alat ============ -->
<div id="modal_harmat_perbaikan_alat" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/harmat/perbaikan-alat')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Mutu Terkait Perbaikan Alat</div>
                    <div class="form-group row">
                        <label class="col-12">Tanggal</label>
                        <div class="input-daterange input-group col-8 " data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        </div>
                    </div>
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_labpa" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/labpa')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Ketepatan Pelayanan Lab PA</div>

                    <div class="form-group">
                        <label class="" for="example-daterange1">Pemeriksaan</label>
                        <select name="target" id="lokasi" class="js-select2 form-control" style="width: 100%">
                            @foreach($target_labpa->ketepatan as $l)
                                <option value="{{$l->header}}">{{$l->header}}</option>
                            @endforeach
                        </select>
                    </div>
                    @include('mutu.layouts.components.range-datepicker')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_kematian_24jam" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/kematian-24-jam')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Rekap Kematian Pasien IGD dalam Kurun Waktu Kurang dari 24 jam</div>
                    <div class="form-group row">
                        <label class="col-12">Tanggal</label>
                        <div class="input-daterange input-group col-8 " data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        </div>
                    </div>
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_kuisioner_penilaian" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/kuisioner-penilaian')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Kuisioner - Laporan Penilaian Kuisioner</div>
                    <div class="form-group row">
                        <label class="col-12">Nama Kuisioner</label>
                        <div class="col-12">
                            <select class="form-control js-select2" style="width: 100%" name="kuisioner_id" required>
                                <option value="" disabled selected>-- Pilih Kuisioner --</option>
                                @foreach ($kuisionerlist as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="formid"> </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal_labpk_goldar" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/labpk-goldar')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Ketepatan Pelayanan Lab PK</div>
                    @include('mutu.layouts.components.range-datepicker')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_labpk_bakteri" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/labpk-bakteri')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Infeksi Bakteri Lab PK</div>
                    <div class="form-group">
                        <label class="" for="example-daterange1">Jenis Bakteri</label>
                        <select name="bakteri" id="user" class="js-select2 form-control" style="width: 100%">
                            <option value="">Semua</option>
                            <option value="mdr">Bakteri MDR</option>
                            <option value="karbapenemase">Bakteri Karbapenemase</option>
                            <option value="esbl">Bakteri ESBL</option>
                            <option value="aureus">Bakteri Aureus</option>
                        </select>
                    </div>
                    @include('mutu.layouts.components.range-datepicker')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_radiologi_film" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/radiologi-film')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Film Ditolak/Film Keluar</div>
                    @include('mutu.layouts.components.range-datepicker')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_radiologi_ketepatan_usg" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/radiologi-ketepatan-usg')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Ketepatan Pelayanan USG Lab Radiologi</div>
                    @include('mutu.layouts.components.range-datepicker')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_radiologi_ketepatan_konvensional" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/radiologi-ketepatan-konvensional')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Ketepatan Pelayanan Konvensional Lab Radiologi</div>
                    @include('mutu.layouts.components.range-datepicker')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_kesesuaian_bedah" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/kesesuaian-bedah')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Kesesuaian Diagnosis Rencana dan Pasca Operasi</div>
                    <div class="form-group row">
                        <label class="col-12">Tanggal Operasi</label>
                        <div class="input-daterange input-group col-8 " data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        </div>
                    </div>
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<div id="modal_gilut_ketepatan_konvensional" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/gilut-ketepatan')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Ketepatan Pelayanan Departemen Gigi dan Mulut</div>
                    <div class="form-group">
                        <label class="" for="example-daterange1">Jenis Ketepatan</label>
                        <select name="jenis" id="user" class="js-select2 form-control" style="width: 100%">
                            <option value="Cabut Gigi Salah">Cabut Gigi Salah</option>
                            <option value="Trauma Bur Gigi">Trauma Bur Gigi</option>
                        </select>
                    </div>
                    @include('mutu.layouts.components.range-datepicker')
                    <div id="formid"> </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_pd_jantung" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/pd-jantung')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan PD Jantung</div>
                    <div class="form-group row">
                        <label class="col-12">Tanggal</label>
                        <div class="input-daterange input-group col-8 " data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        </div>
                    </div>
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_steroid" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/steroid')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Kulit Kelamin Steroid</div>
                    <div class="form-group row">
                        <label class="col-12">Tanggal</label>
                        <div class="input-daterange input-group col-8 " data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        </div>
                    </div>
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_couter" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/couter')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Kulit Kelamin Couter</div>
                    <div class="form-group row">
                        <label class="col-12">Tanggal</label>
                        <div class="input-daterange input-group col-8 " data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        </div>
                    </div>
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_kesesuaian_pra_bedah" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/kesesuaian-asesmen-pra-bedah')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Kesesuaian Pengisian Pra Bedah Pasca Operasi</div>
                    <div class="form-group row">
                        <label class="col-12">Tanggal Operasi</label>
                        <div class="input-daterange input-group col-8 " data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        </div>
                    </div>
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_dermatits" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/dermatits')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Kulit Kelamin Dermatits</div>
                    <div class="form-group row">
                        <label class="col-12">Tanggal</label>
                        <div class="input-daterange input-group col-8 " data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" autocomplete="off" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        </div>
                    </div>
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_tht_cwd" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/tht-cwd')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Ketepatan THT - CWD/CWU</div>
                    @include('mutu.layouts.components.range-datepicker')
                    <div id="formid"> </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal_tht_laring" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/tht-laring')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Ketepatan THT - Bedah Laring Mikroskopik</div>
                    @include('mutu.layouts.components.range-datepicker')
                    <div id="formid"> </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_tht_septoplasti" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/tht-septoplasti')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Ketepatan THT - Septoplasti</div>
                    @include('mutu.layouts.components.range-datepicker')
                    <div id="formid"> </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_tht_sinusitis" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/tht-sinusitis')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Ketepatan THT - Penanganan Sinusitis Parasinalis</div>
                    @include('mutu.layouts.components.range-datepicker')
                    <div id="formid"> </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_surveilans_iad" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/iad-surveilans')}}" class="js-validation-be-contact">
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Survailans IAD Bundle Checklist</div>
                    @include('mutu.layouts.components.zona-tanggal')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_surveilans_isk" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/isk-surveilans')}}" class="js-validation-be-contact">
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Survailans ISK</div>
                    @include('mutu.layouts.components.zona-tanggal')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_surveilans_ido" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/ido-surveilans')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Survailans IDO Bundle Checklist</div>
                    @include('mutu.layouts.components.zona-tanggal')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modal_surveilans_vap" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="get" action="{{url('mutu/laporan/vap-surveilans')}}" class="js-validation-be-contact">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Survailans Ventilator Bundle Checklist</div>
                    @include('mutu.layouts.components.zona-tanggal')
                    <div id="formid"> </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>