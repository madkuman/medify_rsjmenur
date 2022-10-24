@extends('keuangan.layouts.main')

@section('title')
    Laporan Rekap Klaim - Keuangan
@endsection

@section('css')

@endsection
@section('content')
    @include('keuangan.laporan.components.header')
    <!-- Page Content -->
    <div class="mt-20">
        <div class="row">
            <div class="col-12">
                <div class="block">
                    <div class="block-header text-center">
                        <h5 class="mb-0">Laporan Rekap Klaim</h5>
                    </div>
                    <div class="block-content">
                        <h6>FILTER</h6>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label>Tahun *</label>
                                        <input type="text" required class="form-control bg-white" id="form-input-date-year" name="tahun" autocomplete="off" data-autoclose="true"
                                               data-today-highlight="true" data-date-format="yyyy" onkeydown="return false" placeholder="yyyy" value="{{date('Y')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 pt-20">
                                <button class="btn btn-primary btn-get-data"><i class="fa fa-spin fa-spinner btn-get-data-loading" style="display: none"></i> Filter</button>
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
                                <th>No</th>
                                <th>Bulan</th>
                                <th>Real Cost</th>
                                <th>Inacbg</th>
                                <th>Selisih RC dan Inacbg</th>
                                <th>Hasil Verifikasi</th>
                                <th>Realisasi</th>
                                <th>Tanggal Bayar</th>
                                <th>Sisa</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection

@section('js')
    <script type="text/javascript">

        var total_data = 0;
        var date = '';
        var perusahaan = [];
        var data_per_fetch = 100;
        var data_fetched = 0;


        $("#form-input-date-year").datepicker({
            format: "yyyy",
            startView: "years",
            minViewMode: "years"
        });

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
                { extend: 'excel', className: 'btn btn-secondary',text: '<i class="fa fa-download"></i> Excel' }
            ]
        });

        $('.btn-get-data').click(function(){
            date = $('#form-input-date-year').val();
            data_fetched = 0;
            $('.btn-get-data-loading').show();
            $('.progress-data-loader-container').hide();
            updateProgressBar(1)
            var dataTableObj = $('.js-dataTable-full').DataTable();
            dataTableObj.clear().draw();

            $.ajax({
                url: API_URL + '/keuangan/laporan/rekap-klaim/get-total-data',
                dataType: 'json',
                tryCount : 0,
                retryLimit : 3,
                data : 'date='+date,
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
            $.ajax({
                url: API_URL + '/keuangan/laporan/rekap-klaim/get-data',
                dataType: 'json',
                tryCount : 0,
                retryLimit : 3,
                data : 'date='+date+'&datafetched='+data_fetched+'&limit='+data_per_fetch,
                success:function(results){
                    var data = results.data
                    var last_id = results.last_id
                    data_fetched+=data_per_fetch

                    $.each(data, function( index, value ) {

                        array_temp = [];
                        $.each(value, function( obj_name, obj_value ) {
                            array_temp.push(obj_value)
                        })

                        dataTableObj.row.add(array_temp).draw( false );
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
    <script type="text/javascript">
        function updateProgressBar(percentage)
        {
            if(percentage < 100){
                $('.progress-data-loader-loading .progress-bar').css("width",percentage+"%")
                $('.progress-data-loader-loading .progress-bar-label').html(percentage+"%")

                $('.progress-data-loader-loading').show()
                $('.progress-data-loader-complete').hide()
            }
            else
            {
                $('.progress-data-loader-loading').hide()
                $('.progress-data-loader-complete').show()
            }
        }
    </script>
    <script type="text/javascript">

        function errorNotify(title,message)
        {
            $.notify({
                title: '<strong>'+title+'</strong>',
                message: message
            },{
                type: 'danger',
                placement: {
                    from: "top",
                    align: "center"
                },
                delay: 3000
            });
        }
    </script>
@endsection