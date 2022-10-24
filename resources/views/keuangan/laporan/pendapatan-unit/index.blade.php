@extends('keuangan.layouts.main')

@section('title')
    Laporan Pendapatan Unit - Keuangan
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
                        <h5 class="mb-0">Laporan Pemasukan - Rekap Pemasukan Harian</h5>
                    </div>
                    <div class="block-content">
                        <h6>FILTER</h6>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label>Pilih Bulan dan Tahun *</label>
                                        <input type="text" required class="form-control bg-white" id="form-input-date-month" name="bulan_tahun" autocomplete="off" data-autoclose="true"
                                               data-today-highlight="true" data-date-format="yyyy-mm" onkeydown="return false" placeholder="yyyy-mm" value="{{date('Y-m')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label>Pilih Perusahaan</label>
                                        <select class="js-select2 form-control" id="form-select-perusahaan" multiple="multiple" name="perusahaan[]" style="width: 100%">
                                            @foreach($perusahaan as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select>
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
                                <th>Unit</th>
                                <th>Nilai</th>
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


        $("#form-input-date-month").datepicker({
            format: "yyyy-mm",
            startView: "months",
            minViewMode: "months"
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
            date = $('#form-input-date-month').val();
            perusahaan = $('#form-select-perusahaan').val();
            data_fetched = 0;
            $('.btn-get-data-loading').show();
            $('.progress-data-loader-container').hide();
            updateProgressBar(1)
            var dataTableObj = $('.js-dataTable-full').DataTable();
            dataTableObj.clear().draw();

            $.ajax({
                url: API_URL + '/keuangan/laporan/pendapatan-unit/get-total-data',
                dataType: 'json',
                tryCount : 0,
                retryLimit : 3,
                data : 'date='+date+'&perusahaan='+perusahaan,
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
                url: API_URL + '/keuangan/laporan/pendapatan-unit/get-data',
                dataType: 'json',
                tryCount : 0,
                retryLimit : 3,
                data : 'date='+date+'&perusahaan='+perusahaan+'&datafetched='+data_fetched+'&limit='+data_per_fetch,
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
                    if(perusahaan.length  == 0) document.title = 'Pendapatan Unit Dari Semua Pembayaran';
                    else document.title = 'Pendapatan Unit Dari Pembayaran '+ results.perusahaan_nama
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