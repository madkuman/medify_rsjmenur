@extends('pasien.layouts.laporanv2.page-result')

@section('title')
DKK - 34. Laporan Bulanan Diare - Laporan - Administrasi & Rekam Medis
@endsection

@section('subtitle')
Laporan
@endsection

@section('page-title')
DKK - 34. Laporan Bulanan Diare
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
    <table class="table table-bordered table-striped table-vcenter js-dataTable-full nowrap" id="example">
        <thead>
            <tr>
                <th rowspan="4">No</th>
                <th rowspan="4">FASYANKES</th>
                <th colspan="44">FASILITAS PELAYANAN KESEHATAN</th>
            </tr>
            <tr>
                <th colspan="4">0 - 6 Bln</th>
                <th colspan="4">&#8805 6 Bln - &#60; 1 Th</th>
                <th colspan="4">1 - 4 Th</th>
                <th colspan="4">5 - 9 Th</th>
                <th colspan="4">10 - 14 Th</th>
                <th colspan="4">15 - 19Th</th>
                <th colspan="4">&#62; 20 Th</th>
                <th colspan="4">Jumlah</th>
                <th colspan="5">Penderita Diare < 5 Th Diberi</th>
                <th colspan="2" rowspan="2">Penderita Diare > 5 Th Diberi</th>
                <th colspan="5">Jumlah Pemakaian</th>
            </tr>
            <tr>
                @for ($i = 0; $i < 8; $i++)
                    <th colspan="2">P</th>
                    <th colspan="2">M</th>
                @endfor
                <th rowspan="2">Oralit</th>
                <th colspan="3">Zink</th>
                <th rowspan="2">RL</th>
                <th rowspan="2">Oralit</th>
                <th colspan="3">Zink</th>
                <th rowspan="2">RL</th>
            </tr>
            <tr>
                @for ($i = 0; $i < 16; $i++)
                    <th>L</th>
                    <th>P</th>
                @endfor
                <th>0-5 Bln</th>
                <th>≥ 6 Bln - < 1 Th</th>
                <th>1 -4 Th</th>
                <th>Oralit</th>
                <th>RL</th>
                <th>0-5 Bln</th>
                <th>≥ 6 Bln - < 1 Th</th>
                <th>1 -4 Th</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<form action="{{ url()->current() }}/download" method="post" id="form-download-excel" target="_BLANK">
    {{ csrf_field() }}
    <input type="hidden" name="data">
    <input type="hidden" name="date">
</form>

@endsection

@section('js')
<script type="text/javascript">
    var total_data = 0;
    var data_per_fetch = 2;
    var data_fetched = 0;
    var export_data = [];
    var current_date = null;

    $('.js-dataTable-full').dataTable({
        "ordering": false,
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
                    $('#form-download-excel').find('input[name="date"]').val(current_date);
                    $('#form-download-excel').submit();
                }
            }
        ]
    });

    $('.btn-get-data').click(function(){
        start_date = $('.input-daterange-start').val()
        end_date = $('.input-daterange-end').val()
        if(start_date == ''){
            $('.input-daterange-start').focus();
            return;
        }
        if(end_date == ''){
            $('.input-daterange-end').focus();
            return;
        }
        current_date = start_date+'<->'+end_date;
        $('.btn-get-data-loading').show();
        $('.progress-data-loader-container').hide();
        updateProgressBar(1)
        var dataTableObj = $('.js-dataTable-full').DataTable();  
        dataTableObj.clear().draw();
        export_data = [];
        $.ajax({ 
            url: API_URL + '/pasien/laporan-v2/page/dkk-34-laporan-bulanan-diare/get-total-data',
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
            url: API_URL + '/pasien/laporan-v2/page/dkk-34-laporan-bulanan-diare/get-data',
            dataType: 'json',
            tryCount : 0,
            retryLimit : 3,
            data : {
                datestart : start_date,
                dateend : end_date,
            },
            success:function(results){
                var data = results.data
                var last_id = results.last_id
                data_fetched+=data_per_fetch

                $.each(data, function( index, value ) {
                    dataTableObj.row.add(value).draw( false );
                    export_data.push(value);
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