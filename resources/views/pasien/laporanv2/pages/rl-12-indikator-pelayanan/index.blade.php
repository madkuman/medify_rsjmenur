@extends('pasien.layouts.laporanv2.page-result')

@section('title')
RL 1.2 Indikator Pelayanan - Laporan - Administrasi & Rekam Medis
@endsection

@section('subtitle')
Laporan
@endsection

@section('page-title')
RL 1.2 Indikator Pelayanan
@endsection


@section('content')
<div class="block-content">
    <h6>FILTER</h6>
    <div class="row">
        <div class="col-4">
            @include('pasien.laporanv2.components.form-select2',$bangsal_select)
        </div>
    </div>
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
                <th>Parameter</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

@endsection

@section('js')
<script type="text/javascript">
    const DT_PAGELENGTH = 12;
    var total_data = 0;
    var data_per_fetch = 2;
    var data_fetched = 0;

    var dataTableObj;

    var laporan_data = {
        'jumlah_hari_perawatan' : {
            key : 'jumlah_hari_perawatan',
            parameter : 'Jumlah Hari Perawatan',
            value : null,
        },
        'jumlah_tempat_tidur' : {
            key : 'jumlah_tempat_tidur',
            parameter : 'Jumlah Tempat Tidur (Ambil dari SK Direktur)',
            value : null,
        },
        'jumlah_pasien_krs_hidup' : {
            key : 'jumlah_pasien_krs_hidup',
            parameter : 'Jumlah Pasien KRS Hidup',
            value : null,
        },
        'jumlah_pasien_krs_mati' : {
            key : 'jumlah_pasien_krs_mati',
            parameter : 'Jumlah Pasien KRS Mati',
            value : null,
        },
        'jumlah_pasien_krs_mati_lebih_48' : {
            key : 'jumlah_pasien_krs_mati_lebih_48',
            parameter : 'Jumlah Pasien Mati > 48 Jam Perawatan',
            value : null,
        },
        'jumlah_pasien_krs' : {
            key : 'jumlah_pasien_krs',
            parameter : 'Jumlah Pasien KRS Hidup + Mati',
            value : null,
        },
        'bor' : {
            key : 'bor',
            parameter : 'BOR',
            value : null,
            is_persen : true,
        },
        'avlos' : {
            key : 'avlos',
            parameter : 'AVLOS',
            value : null,
        },
        'toi' : {
            key : 'toi',
            parameter : 'TOI',
            value : null,
        },
        'bto' : {
            key : 'bto',
            parameter : 'BTO',
            value : null,
        },
        'ndr' : {
            key : 'ndr',
            parameter : 'NDR',
            value : null,
        },
        'gdr' : {
            key : 'gdr',
            parameter : 'GDR',
            value : null,
        },
        'total_day' : {
            key : 'total_day',
            parameter : 'Total Hari',
            value : null,
        },
    };

    $(document).ready(function(){
        data_fetched = 0;
        $('.progress-data-loader-container').hide();
        updateProgressBar(1)
        dataTableObj = $('.js-dataTable-full').DataTable({
            "ordering": true,
            pageLength: DT_PAGELENGTH,
            scrollX: true,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            autoWidth: false,
            dom : "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            columns: [
                {
                    data : null,
                    render: (data, type, row, meta) => {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
                },
                {
                    data : 'parameter'
                },
                {
                    className : 'text-right',
                    data : (data) => {
                        if(data.is_persen){
                            return (Math.round(data.value * 100)).toString()+"%";
                        }
                        return Math.round(data.value * 100) / 100;
                    },
                },
            ],
            buttons: [
                { extend: 'excel', className: 'btn btn-secondary',text: '<i class="fa fa-download"></i> Excel' }
            ]
        });

        $('.btn-get-data').on('click',function(){
            updateProgressBar(1);
            dataTableObj.clear().draw();
            $('.progress-data-loader-container').show();
            $('.progress-data-loader-total-data').html(12);
            filter();
        });

        $('[name="bangsal_id"]').on('change',function(e){
            let val = $(this).val();
            console.log(val.length);
            if(val.length == 0){
                $(this).find('[value="-1"]').prop('selected',true);
                $(this).trigger('change');
            }

            if(val.length > 1){
                if($(this).find('[value="-1"]').prop('selected') == true){
                    $(this).find('[value="-1"]').prop('selected',false);
                    $(this).trigger('change');
                }
            }
        });
    })

    function refreshDataTable(){
        dataTableObj.clear()
        $.each(laporan_data, function(i, item){
            if(i == 'total_day' || item.value == null) return;
            dataTableObj.row.add(item);
        })
        dataTableObj.draw()
    }

    function resetData(){
        $.each(laporan_data, function(i, item){
            item.value = null;
        })
    }

    function setDataLaporan(key, value){
        laporan_data.find( item => item.key === key).value = value;
    }

    var all_ajax_request = [
        'jumlah_hari_perawatan',
        'jumlah_pasien_krs_hidup',
        'jumlah_pasien_krs_mati',
        'jumlah_pasien_krs_mati_lebih_48',
        'jumlah_pasien_krs',
        'total_day',
    ];
    
    var current_ajax_request = [];
    function filter(){
        resetData();
        console.log(laporan_data);
        current_ajax_request = all_ajax_request.slice();
        type = current_ajax_request.shift();
        _invoke(type);
    }

    function _calculate(){
        if((laporan_data.jumlah_tempat_tidur.value * laporan_data.total_day.value) != 0)
			laporan_data.bor.value = laporan_data.jumlah_hari_perawatan.value / (laporan_data.jumlah_tempat_tidur.value * laporan_data.total_day.value);
		else
			laporan_data.bor.value = 0;

		if(laporan_data.jumlah_pasien_krs.value != 0)
			laporan_data.avlos.value = laporan_data.jumlah_hari_perawatan.value / laporan_data.jumlah_pasien_krs.value;
		else
			laporan_data.avlos.value = 0;
			
		if(laporan_data.jumlah_pasien_krs.value != 0)
			laporan_data.toi.value = ((laporan_data.jumlah_tempat_tidur.value * laporan_data.total_day.value) - laporan_data.jumlah_hari_perawatan.value) / laporan_data.jumlah_pasien_krs.value;
		else
			laporan_data.toi.value = 0;

		if(laporan_data.jumlah_tempat_tidur.value != 0)
			laporan_data.bto.value = laporan_data.jumlah_pasien_krs.value / laporan_data.jumlah_tempat_tidur.value;
		else
			laporan_data.bto.value = 0;

		if(laporan_data.jumlah_pasien_krs.value != 0)
			laporan_data.ndr.value = (laporan_data.jumlah_pasien_krs_mati_lebih_48.value / laporan_data.jumlah_pasien_krs.value) * 1000;
		else
			laporan_data.ndr.value = 0;

		if(laporan_data.jumlah_pasien_krs.value != 0)
			laporan_data.gdr.value = (laporan_data.jumlah_pasien_krs_mati.value / laporan_data.jumlah_pasien_krs.value) * 1000;
		else
			laporan_data.gdr.value = 0;

        refreshDataTable();
        updateProgressBar(100);
    }

    function _invoke(type){
        $.ajax({ 
            url: API_URL + '/pasien/laporan-v2/page/rl-12-indikator-pelayanan/get-data',
            dataType: 'json',
            'data' : {
                type       : type,
                start      : $('[name="daterange-start"]').val(),
                end        : $('[name="daterange-end"]').val(),
                bangsal_id : $('[name="bangsal_id"]').val(),
            },
            tryCount : 0,
            retryLimit : 3,
            success:function(results){
                if(typeof results.data == 'object'){
                    $.each(results.data,function(i,item){
                        laporan_data[i].value = item;
                    })
                }else{
                    laporan_data[type].value = results.data;
                }
                refreshDataTable();

                
                type = current_ajax_request.shift();
                if(type != null){
                    _invoke(type);
                }else{
                    _calculate();
                }

                updateProgressBar(100 - current_ajax_request.length * 20);
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
    }
</script>
@include('pasien.laporanv2.components.js-progress-bar-updater')
@include('pasien.laporanv2.components.js-error-notify')
@endsection