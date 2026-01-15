@extends('farmasi.layouts.laporanv2.non-navbar')

@section('title')
Farmasi - Rekap Pendapatan Farmasi
@endsection

@section('subtitle')
Laporan
@endsection

@section('page-title')
Laporan Rekap Pendapatan Farmasi
@endsection


@section('content')

<div class="block">
    <div class="block-content">
        <div class="alert alert-primary">Mengambil data transaksi yang telah di konfirmasi. Menghitung harga + laba, tanpa embalase</div>
        <h6>FILTER</h6>
        <div class="row">
            <div class="col-2">
                @include('farmasi.laporanv2.components.form-date-range-month')
            </div>
            <div class="col-2">
                <div class="form-group">
                    @include('farmasi.laporan.modals.components.form-asal-pelayanan')
                </div>
            </div>
            <div class="col-2">
                @include('farmasi.laporan.modals.components.form-farmasi-basic')
            </div>
            <div class="col-2">
                @include('farmasi.laporan.modals.components.form-jenis-resep')
            </div>
            <div class="col-2">
                @include('farmasi.laporan.modals.components.form-asuransi')
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
                <tr></tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

</div>
@endsection

@section('js')
<script type="text/javascript">
    data_fetched = 0;
    start_date = '';
    end_date = '';
    lokasi_id = '';
    resep_jenis = '';
    farmasi_ids = '';
    asuransi_tipe_id = '';
    data_per_fetch = 1;
    subtotal_per_month = [];
    table_data = [];

    $('.btn-get-data').click(function() {
        start_date = $('#tanggal_awal').val();
        end_date = $('#tanggal_akhir').val();
        lokasi_id = $('#lokasi_id').val();
        resep_jenis = $('#resep_jenis').val();
        asuransi_tipe_id = $('#filter_asuransi_tipe_id').val();
        farmasi_ids = $('#farmasi_ids').val();
        

        dataForm = {
            'tanggal_awal': start_date,
            'tanggal_akhir': end_date,
            'lokasi_id': lokasi_id,
            'resep_jenis': resep_jenis,
            'farmasi_ids': farmasi_ids,
            'asuransi_tipe_id': asuransi_tipe_id
        }

        $('.btn-get-data-loading').show();
        $('.progress-data-loader-container').hide();
        updateProgressBar(1)

        data_fetched = 0;
        export_data = [];
        $('#main_table thead tr').html('')
        $('#main_table tbody').html('')
        subtotal_per_month = [];
        table_data = [];

        $.ajax({
            url: "{{url('')}}/laporan/farmasi/laporan-rekap-pendapatan-farmasi/get-header",
            dataType: 'json',
            tryCount: 0,
            retryLimit: 3,
            data: dataForm,
            success: function(results) {
                total_data = results.data
                var text_total_data = numeral(total_data).format('0,0');
                var text_total_data = text_total_data.replace(",", ".")
                $('.progress-data-loader-container').show();
                $('.progress-data-loader-total-data').html(text_total_data);
                data_fetched = 0;

                header = results.header
                temp_array = ['No', 'Pasien'];

                html_content = `
                    <th>No</th>
                    <th>Pasien</th>
                `
                $.each(header, function(index, value) {
                    html_content += `<th>` + value + `</th>`
                    subtotal_per_month[index] = 0
                    temp_array.push(value);
                });
                html_content += `<th>Total</th>`
                temp_array.push("Total");
                table_data.push(temp_array)


                $('#main_table thead tr').html(html_content)
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

        dataForm = {
            'tanggal_awal': start_date,
            'tanggal_akhir': end_date,
            'lokasi_id': lokasi_id,
            'resep_jenis': resep_jenis,
            'farmasi_ids': farmasi_ids,
            'asuransi_tipe_id': asuransi_tipe_id,
            'data_fetched': data_fetched
        }


        $.ajax({
            url: "{{url('')}}/laporan/farmasi/laporan-rekap-pendapatan-farmasi/get-data",
            dataType: 'json',
            tryCount: 0,
            retryLimit: 3,
            data: dataForm,
            success: function(results) {
                data = results.data;
                data_fetched += data_per_fetch

                temp_array = [data_fetched, results.nama_asuransi];

                html_content = `<tr>
                    <td>` + data_fetched + `</td>
                    <td>` + results.nama_asuransi + `</td>
                `
                var total = 0;
                $.each(data, function(index, value) {

                    formattedNumber = formatNumberWithDots(value)
                    html_content += `<td>` + formattedNumber + `</td>`

                    total += value;
                    subtotal_per_month[index] += value;
                    temp_array.push(value)
                });

                temp_array.push(total)
                formattedNumber = formatNumberWithDots(total)
                html_content += `<td>` + formattedNumber + `</td></tr>`
                $('#main_table tbody').append(html_content)
                table_data.push(temp_array)

                if (data_fetched < total_data) {
                    getDataset()
                    var percentage = Math.ceil(data_fetched / total_data * 100)
                    updateProgressBar(percentage);
                } else {
                    updateProgressBar(100);
                    $('.btn-get-data-loading').hide();

                    temp_array = ['', 'TOTAL'];
                    html_content = `<tr>
                    <td></td>
                    <td>TOTAL</td>
                    `
                    var total = 0;
                    $.each(subtotal_per_month, function(index, value) {
                        formattedNumber = formatNumberWithDots(value)
                        html_content += `<td>` + formattedNumber + `</td>`
                        total += value;
                        temp_array.push(value)
                    });
                    formattedNumber = formatNumberWithDots(total)
                    html_content += `<td>` + formattedNumber + `</td></tr>`
                    $('#main_table tbody').append(html_content)
                    temp_array.push(total)
                    table_data.push(temp_array)
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


    function downloadExcel() {
        const jsonData = JSON.stringify(table_data);
        var lokasi_text = $('#lokasi_id option:selected').text();
        console.log(lokasi_text)
        $('.btn-download-excel-loading').show();

        $.ajax({
            url: "{{url('')}}/laporan/farmasi/laporan-rekap-pendapatan-farmasi/download-excel",
            dataType: 'json',
            tryCount: 0,
            retryLimit: 3,
            data: {
                'data': jsonData,
                'tanggal_awal': start_date,
                'tanggal_akhir': end_date,
                'lokasi_id': lokasi_id,
                'resep_jenis': resep_jenis,
                'farmasi_ids': farmasi_ids,
                'asuransi_tipe_id': asuransi_tipe_id,
                'lokasi_text' : lokasi_text,
            },
            success: function(results) {
                var url = '{{url("")}}'+results.url
                downloadFile(url, results.filename);
                $('.btn-download-excel-loading').hide();
            },
            error: function(xhr, textStatus, errorThrown) {
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                    return;
                }
                $('.btn-get-data-loading').hide();
                errorNotify('Error', 'Terjadi kesalahan server, tidak dapat mengambil data')

                $('.btn-download-excel-loading').hide();
                return;
            }
        })
    }
</script>
@include('farmasi.laporanv2.components.js-progress-bar-updater')
@include('farmasi.laporanv2.components.js-error-notify')
@endsection