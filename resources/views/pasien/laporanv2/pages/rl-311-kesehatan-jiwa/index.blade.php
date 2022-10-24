@extends('pasien.layouts.laporanv2.page-result')

@section('title')
RL 3.11 Kesehatan Jiwa - Laporan - Administrasi & Rekam Medis
@endsection

@section('subtitle')
Laporan
@endsection

@section('page-title')
RL 3.11 Kesehatan Jiwa
@endsection


@section('content')
<div class="block-content">
    <h6>FILTER</h6>
    <div class="row">
        <div class="col-4">
            @include('pasien.laporanv2.components.form-date-range')
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
                <th>No</th>
                <th>Jenis Kegiatan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

@endsection

@section('js')
<script type="text/javascript">
    var total_data = 0;
    var data_per_fetch = 2;
    var data_fetched = 0;

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
        start_date = $('.input-daterange-start').val()
        end_date = $('.input-daterange-end').val()
        data_fetched = 0;
        $('.btn-get-data-loading').show();
        $('.progress-data-loader-container').hide();
        updateProgressBar(1)
        var dataTableObj = $('.js-dataTable-full').DataTable();  
        dataTableObj.clear().draw();

        $.ajax({ 
            url: API_URL + '/pasien/laporan-v2/page/rl-311-kesehatan-jiwa/get-total-data',
            dataType: 'json',
            tryCount : 0,
            retryLimit : 3,
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
            url: API_URL + '/pasien/laporan-v2/page/rl-311-kesehatan-jiwa/get-data',
            dataType: 'json',
            tryCount : 0,
            retryLimit : 3,
            data : 'datestart='+start_date+'&dateend='+end_date+'&datafetched='+data_fetched+'&limit='+data_per_fetch,
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
@include('pasien.laporanv2.components.js-progress-bar-updater')
@include('pasien.laporanv2.components.js-error-notify')
@endsection