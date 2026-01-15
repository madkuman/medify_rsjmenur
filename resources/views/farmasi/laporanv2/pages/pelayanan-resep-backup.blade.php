@extends('farmasi.layouts.laporanv2.page-result')

@section('title')
    Farmasi - Laporan Pelayanan Resep
@endsection

@section('subtitle')
    Laporan
@endsection

@section('page-title')
    Laporan Pelayanan Resep
@endsection


@section('content')
    <div class="block-content">
        <h6>FILTER</h6>
        <div class="row">
            <div class="col-4">
                @include('farmasi.laporanv2.components.form-date-range')
            </div>
            <div class="col-4">
                <div class="form-group">
                    @include('farmasi.laporan.modals.components.form-asal-pelayanan')
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="penyedia">Jenis Pembayaran</label>
                    <select class="form-control js-select2" id="jenis_pembayaran" name="jenis[]" placeholder="Pilih Jenis Pembayaran" multiple="multiple" style="width: 100%;">
                        @foreach($perusahaan as $usaha)
                            <option value="{{$usaha->id}}">{{$usaha->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4">
                @include('farmasi.laporan.modals.components.form-select-kategori')
            </div>
            <div class="col-4">
                @include('farmasi.laporan.modals.components.form-farmasi')
            </div>
            <div class="col-2 pt-20">
                @include('pasien.laporanv2.components.form-btn-filter')
            </div>
        </div>
        <div class="row progress-data-loader-container" style="display: none">
            <div class="col-4">
                Progress (Total Data : <span class="progress-data-loader-total-data">0</span>)
                <div class="progress push progress-data-loader-loading">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;">
                        <span class="progress-bar-label">0%</span>
                    </div>
                </div>
                <div class="progress push progress-data-loader-complete"  style="display: none">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                        <span class="progress-bar-label">100%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block-content">
        <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
            <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Deskripsi</th>
                <th colspan="3" class="text-center">IGD</th>
                <th colspan="3" class="text-center">Rawat Jalan</th>
                <th colspan="3" class="text-center">Rawat Inap</th>
                <th rowspan="2">Total</th>
            </tr>
            <tr>
                <td>Dilayani</td>
                <td>Tidak dilayani</td>
                <td>Total</td>
                <td>Dilayani</td>
                <td>Tidak dilayani</td>
                <td>Total</td>
                <td>Dilayani</td>
                <td>Tidak dilayani</td>
                <td>Total</td>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <form action="{{ url()->current() }}/download" method="post" id="form-download-excel" target="_BLANK">
        {{ csrf_field() }}
        <input type="hidden" name="data">
        <input type="hidden" name="start_date">
        <input type="hidden" name="end_date">
    </form>

@endsection

@section('js')
    <script type="text/javascript">
        var total_data = 0;
        var start_date = '';
        var end_date = '';
        var lokasi_id = '';
        var jenis = '';
        var kategori = '';
        var farmasi_ids = '';
        var farmasi_kriteria = '';
        var data_per_fetch = 1;
        var data_fetched = 0;
        var content = [];
        var export_data = [];

        $('.js-dataTable-full').dataTable({
            "ordering": true,
            pageLength: 10,
            scrollX: true,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            autoWidth: false,
            dom : "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                {
                    text : '<i class="fa fa-download"></i> Excel',
                    className : 'btn btn-secondary',
                    action : () => {
                        if(export_data.length == 0){
                            swal({
                                type : 'warning',
                                title : 'Gagal',
                                text : 'Data Kosong',
                            });
                            return;
                        }
                        $('#form-download-excel').unbind();
                        $('#form-download-excel').find('input[name="data"]').val(JSON.stringify(export_data));
                        $('#form-download-excel').find('input[name="start_date"]').val(start_date);
                        $('#form-download-excel').find('input[name="end_date"]').val(end_date);
                        $('#form-download-excel').submit();
                    }
                }
            ]
        });

        $('.btn-get-data').click(function(){
            start_date = $('.input-daterange-start').val();
            end_date = $('.input-daterange-end').val();
            lokasi_id = $('#lokasi_id').val();
            jenis = $('#jenis_pembayaran').val();
            kategori = $('#kategori').val();
            farmasi_ids = $('#farmasi_ids').val();
            farmasi_kriteria = $("input[name='farmasi_kriteria']:checked").val();

            data_fetched = 0;
            $('.btn-get-data-loading').show();
            $('.progress-data-loader-container').hide();
            updateProgressBar(1)
            var dataTableObj = $('.js-dataTable-full').DataTable();
            dataTableObj.clear().draw();
            export_data = [];

            $.ajax({
                url: "{{ url('api/farmasi/'.session('farmasi')->slug.'/laporan-v2/laporan-pelayanan-resep/get-total-data') }}",
                dataType: 'json',
                tryCount : 0,
                retryLimit : 3,
                data : {
                    'tanggal_awal' : start_date,
                    'tanggal_akhir' : end_date,
                    'lokasi_id' : lokasi_id,
                    'jenis' : jenis,
                    'kategori' : kategori,
                    'farmasi_ids' : farmasi_ids,
                    'farmasi_kriteria' : farmasi_kriteria
                },
                success:function(results){
                    total_data = results.data
                    var text_total_data = numeral(total_data).format('0,0');
                    var text_total_data = text_total_data.replace(",",".")
                    $('.progress-data-loader-container').show();
                    $('.progress-data-loader-total-data').html(text_total_data);
                    data_fetched = 0;
                    getDataset();

                },
                error : function(xhr, textStatus, errorThrown ) {
                    this.tryCount++;
                    if (this.tryCount <= this.retryLimit) {
                        $.ajax(this);
                        return;
                    }
                    $('.btn-get-data-loading').hide();
                    errorNotify('Error','Terjadi kesalahan server, tidak dapat mendapatkan Total Data')
                    return;
                }
            })
        })



        function getDataset()
        {
            var dataTableObj = $('.js-dataTable-full').DataTable();
            console.log({data_fetched})
            $.ajax({
                url: "{{ url('api/farmasi/'.session('farmasi')->slug.'/laporan-v2/laporan-pelayanan-resep/get-data') }}",
                dataType: 'json',
                tryCount : 0,
                retryLimit : 3,
                data : {
                    'tanggal_awal' : start_date,
                    'tanggal_akhir' : end_date,
                    'lokasi_id' : lokasi_id,
                    'jenis' : jenis,
                    'kategori' : kategori,
                    'farmasi_ids' : farmasi_ids,
                    'farmasi_kriteria' : farmasi_kriteria,
                    'datafetched' : data_fetched,
                    'limit' : data_per_fetch
                },
                success:function(results){
                    data = results.data;
                    data_fetched+=data_per_fetch

                    $.each(data, function( index, value ) {

                        array_temp = [];
                        $.each(value, function( obj_name, obj_value ) {
                            array_temp.push(obj_value)
                        })

                        dataTableObj.row.add(array_temp).draw( false );
                        export_data.push(array_temp);
                    });

                    if(data_fetched < total_data)
                    {
                        getDataset()
                        var percentage = Math.ceil(data_fetched / total_data * 100)
                        updateProgressBar(percentage);
                    }
                    else
                    {
                        updateProgressBar(100);
                        $('.btn-get-data-loading').hide();
                    }

                },
                error : function(xhr, textStatus, errorThrown ) {
                    this.tryCount++;
                    if (this.tryCount <= this.retryLimit) {
                        $.ajax(this);
                        return;
                    }
                    $('.btn-get-data-loading').hide();
                    errorNotify('Error','Terjadi kesalahan server, tidak dapat mengambil data')

                    return;
                }
            })
        }
    </script>
    @include('farmasi.laporanv2.components.js-progress-bar-updater')
    @include('farmasi.laporanv2.components.js-error-notify')
@endsection