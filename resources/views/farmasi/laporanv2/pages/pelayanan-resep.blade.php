@extends('farmasi.layouts.laporanv2.non-navbar')

@section('title')
Farmasi - Pelayanan Resep
@endsection

@section('subtitle')
Laporan
@endsection

@section('page-title')
Laporan Pelayanan Resep
@endsection


@section('content')

<div class="block">
    <div class="block-content">
        <div class="alert alert-primary">Mengambil data transaksi, untuk tanggal diambil dari tanggal resep dibuat</div>
        <h6>FILTER</h6>

        <div class="row">
            <div class="col-3">
                @include('farmasi.laporanv2.components.form-date-range')
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="penyedia">Jenis Pembayaran</label>
                    <select class="form-control js-select2" id="jenis_pembayaran" name="jenis[]" placeholder="Pilih Jenis Pembayaran" multiple="multiple" style="width: 100%;">
                        @foreach($perusahaan as $usaha)
                        <option value="{{$usaha->id}}">{{$usaha->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-2">
                @include('farmasi.laporan.modals.components.form-select-kategori')
            </div>
            <div class="col-2">
                @include('farmasi.laporan.modals.components.form-farmasi')
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                @include('farmasi.laporanv2.components.form-btn-filter')
                @include('farmasi.laporanv2.components.form-btn-download-excel')
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
                <div class="progress push progress-data-loader-complete" style="display: none">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                        <span class="progress-bar-label">100%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block-content">
        <table class="table table-bordered table-striped table-vcenter" id="main_table">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Deskripsi</th>
                    <th colspan="3" class="text-center" style="border-bottom:solid 2px #eaecee">IGD</th>
                    <th colspan="3" class="text-center" style="border-bottom:solid 2px #eaecee">Rawat Jalan</th>
                    <th colspan="3" class="text-center" style="border-bottom:solid 2px #eaecee">Rawat Inap</th>
                    <th rowspan="2" class="text-center">Total</th>
                </tr>
                <tr>
                    <th  class="text-center">Dilayani</th>
                    <th  class="text-center">Tidak Dilayani</th>
                    <th  class="text-center">Total</th>
                    <th  class="text-center">Dilayani</th>
                    <th  class="text-center">Tidak Dilayani</th>
                    <th  class="text-center">Total</th>
                    <th  class="text-center">Dilayani</th>
                    <th  class="text-center">Tidak Dilayani</th>
                    <th  class="text-center">Total</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

</div>
<form action="{{ url()->current()}}/download" method="post" id="form-download-excel">
    {{ csrf_field() }}
    <input type="hidden" name="data">
    <input type="hidden" name="start_date">
    <input type="hidden" name="end_date">
    <input type="hidden" name="perusahaan_pembayaran_id">
    <input type="hidden" name="kategori">
    <input type="hidden" name="farmasi_ids">
    <input type="hidden" name="farmasi_kriteria">
</form>

@endsection

@section('js')
<script type="text/javascript">
    data_fetched = 0;
    start_date = '';
    end_date = '';
    resep_jenis = '';
    farmasi_ids = '';
    asuransi_tipe_id = '';
    data_per_fetch = 1;
    subtotal_per_month = [];
    table_data = [];

    $('.btn-get-data').click(function() {
        $('.btn-get-data-loading').show();
        $('.progress-data-loader-container').hide();
        updateProgressBar(1)

        data_fetched = 0;
        export_data = [];
        $('#main_table tbody').html('')
        subtotal_per_month = [];
        table_data = [];

        $.ajax({
            url: "{{url()->current()}}/get-header",
            dataType: 'json',
            tryCount: 0,
            retryLimit: 3,
            success: function(results) {
                total_data = results.data
                var text_total_data = numeral(total_data).format('0,0');
                var text_total_data = text_total_data.replace(",", ".")
                $('.progress-data-loader-container').show();
                $('.progress-data-loader-total-data').html(text_total_data);
                data_fetched = 0;
                getDataset()

            },
            error: function(xhr, textStatus, errorThrown) {
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                    return;
                }
                $('.btn-get-data-loading').hide();
                errorNotify('Error', 'Terjadi kesalahan server, tidak dapat mendapatkan Total Data')
                return;
            }
        })
    })

    function getDataset() {
        start_date = $('.input-daterange-start').val();
        end_date = $('.input-daterange-end').val();
        perusahaan_pembayaran_id = $('#jenis_pembayaran').val();
        kategori = $('#kategori').val()
        farmasi_ids = $('#farmasi_ids').val();
        farmasi_kriteria = $("input[name='farmasi_kriteria']:checked").val();

        dataForm = {
            'tanggal_awal': start_date,
            'tanggal_akhir': end_date,
            'perusahaan_pembayaran_id' : perusahaan_pembayaran_id,
            'kategori_id' : kategori,
            'farmasi_id' : farmasi_ids,
            'farmasi_kriteria' : farmasi_kriteria,
            'data_fetched' : data_fetched
        }

        $.ajax({
            url: "{{url()->current()}}/get-data",
            dataType: 'json',
            tryCount: 0,
            retryLimit: 3,
            data: dataForm,
            success: function(results) {
                data = results.data;
                row_ke = results.row_ke
                title = results.title
                data_fetched += data_per_fetch

                temp_array = [data_fetched, results.nama_asuransi];
                if (typeof table_data[row_ke] === 'undefined') {
                    table_data[row_ke] = [];
                }

                table_data[row_ke][0] = row_ke+1
                table_data[row_ke][1] = title
                table_data[row_ke].push(data.dilayani)
                table_data[row_ke].push(data.tidak_dilayani)
                table_data[row_ke].push(data.all)


                if (data_fetched < total_data) {
                    getDataset()
                    var percentage = Math.ceil(data_fetched / total_data * 100)
                    updateProgressBar(percentage);
                } else {
                    updateProgressBar(100);
                    $('.btn-get-data-loading').hide();
                    
                    $.each(table_data, function(index, row) {
                        table_data[index][11] = table_data[index][4] + table_data[index][7] + table_data[index][10]
                    });
                    buildTable()
                }

            },
            error: function(xhr, textStatus, errorThrown) {
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                    return;
                }
                $('.btn-get-data-loading').hide();
                errorNotify('Error', 'Terjadi kesalahan server, tidak dapat mengambil data')

                return;
            }
        })
    }

    function buildTable()
    {
        html_content = '';
        $.each(table_data, function(index, row) {
            html_content += '<tr>'
            $.each(row, function(index2, col){
                html_content += '<td>'+col+'</td>'
            })
            html_content += '/<tr>'
        });
        $('#main_table tbody').html(html_content)
    }


    function downloadExcel() {
        const jsonData = JSON.stringify(table_data);
        
        start_date = $('.input-daterange-start').val();
        end_date = $('.input-daterange-end').val();
        perusahaan_pembayaran_id = $('#jenis_pembayaran').val();
        kategori = $('#kategori').val()
        farmasi_ids = $('#farmasi_ids').val();
        farmasi_kriteria = $("input[name='farmasi_kriteria']:checked").val();

        $('#form-download-excel').unbind();
        $('#form-download-excel').find('input[name="data"]').val(JSON.stringify(table_data));
        $('#form-download-excel').find('input[name="start_date"]').val(start_date);
        $('#form-download-excel').find('input[name="end_date"]').val(end_date);
        $('#form-download-excel').find('input[name="perusahaan_pembayaran_id"]').val(perusahaan_pembayaran_id);
        $('#form-download-excel').find('input[name="kategori"]').val(kategori);
        $('#form-download-excel').find('input[name="farmasi_ids"]').val(farmasi_ids);
        $('#form-download-excel').find('input[name="farmasi_kriteria"]').val(farmasi_kriteria);
        $('#form-download-excel').submit();
    }
</script>
@include('farmasi.laporanv2.components.js-progress-bar-updater')
@include('farmasi.laporanv2.components.js-error-notify')
@endsection