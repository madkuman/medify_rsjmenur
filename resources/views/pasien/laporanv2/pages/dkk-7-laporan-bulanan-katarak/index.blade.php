@extends('pasien.layouts.laporanv2.page-result')

@section('title')
DKK - @ 7. Laporan Bulanan Katarak - Laporan - Administrasi & Rekam Medis
@endsection

@section('subtitle')
Laporan
@endsection

@section('page-title')
DKK - @ 7. Laporan Bulanan Katarak
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
               <th rowspan="2">No</th>
               <th rowspan="2">Nama Pasien</th>
               <th rowspan="2">NIK</th>
               <th rowspan="2">Alamat</th>
               <th colspan="2">Umur</th>
               <th rowspan="2">DIAGNOSA / KODE ICD X</th>
               <th colspan="2">Operasi Katarak</th>
               <th rowspan="2">Tanggal Operasi</th>
           </tr>
           <tr>
               <th>L</th>
               <th>P</th>
               <th>Sudah</th>
               <th>Belum</th>
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
        $('.btn-get-data-loading').show();
        $('.progress-data-loader-container').hide();
        updateProgressBar(1)
        var dataTableObj = $('.js-dataTable-full').DataTable();  
        current_date = start_date+'<->'+end_date;
        dataTableObj.clear().draw();
        export_data = [];
        $.ajax({ 
            url: API_URL + '/pasien/laporan-v2/page/dkk-7-laporan-bulanan-katarak/get-total-data',
            dataType: 'json',
            tryCount : 0,
            retryLimit : 3,
            data : {
                datestart : start_date,
                dateend : end_date,
            },
            success:function(results){
                total_data = results.data.count
                var text_total_data = numeral(total_data).format('0,0');
                var text_total_data = text_total_data.replace(",",".")
                $('.progress-data-loader-container').show();
                $('.progress-data-loader-total-data').html(text_total_data);
                data_fetched = 0;
                page = 1;
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



    let page = 1;
    function getDataset()
    {
        var dataTableObj = $('.js-dataTable-full').DataTable();
        console.log({data_fetched})
        $.ajax({ 
            url: API_URL + '/pasien/laporan-v2/page/dkk-7-laporan-bulanan-katarak/get-data',
            dataType: 'json',
            tryCount : 0,
            retryLimit : 3,
            data : {
                datestart : start_date,
                dateend : end_date,
                page : page,
            },
            success:function(results){
                var data = results.data
                data_fetched += results.data.length;

                $.each(data, function( index, value ) {
                    dataTableObj.row.add(value).draw( false );
                    export_data.push(value);
                });
                
                if(data_fetched < total_data) 
                {
                    page++;
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