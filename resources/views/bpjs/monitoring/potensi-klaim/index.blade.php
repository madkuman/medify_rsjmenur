@extends('bpjs.layouts.main')

@section('title')
    Potensi Klaim - Monitoring
@endsection

@section('subtitle')
    Monitoring / Potensi Klaim
@endsection

@section('css')
    <style>
        .dataTables_processing {
            background-color: white;
        }
        .pink {
            background-color: pink !important;
        }
    </style>
@endsection
@section('content')
    <main id="main-container">
        @include('bpjs.layouts.navbar')
        <div class="content pt-20">
            <div class="row">
                <div class="col-12">
                    <div class="block p-10 px-0" id="main-block">
                        <div class="block-header px-30 pt-20">
                            <h3 class="block-title">Monitoring Potensi Klaim</h3>
                        </div>
                        <div class="block-content">
                            @include('bpjs.monitoring.potensi-klaim.filter')
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-vcenter js-datatable" id="js-datatable"
                                       style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">No RM</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">DPJP</th>
                                        <th class="text-center">Tanggal MRS</th>
                                        <th class="text-center">Tanggal KRS</th>
                                        <th class="text-center">Ruangan</th>
                                        <th class="text-center">Status Readmisi</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection

@section('js')
    <script type="text/javascript">
        var total_data = 0;
        var data_per_fetch = 500;
        var data_fetched = 0;

        $('.js-datatable').dataTable({
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
                    extend: 'excel',
                    className: 'btn btn-secondary',
                    text: '<i class="fa fa-download"></i> Excel'
                }
            ]
        });

        $('.btn-get-data').click(() => {
            let total_url = `{{ url()->current() }}/get-header`;
            let data_url = `{{ url()->current() }}/get-data`;
            load_total_data($('#js-datatable'), total_url, data_url, filter_data);
        });

        function filter_data() {
            return {
                filter_start_date: $('.input-daterange-start').val(),
                filter_end_date: $('.input-daterange-end').val(),
                data_fetched: data_fetched,
                limit: data_per_fetch
            };
        }

        let load_total_data = (dtable, url, data_url, request_data) => {
            data_fetched = 0;
            $('.btn-get-data-loading').show();
            $('.progress-data-loader-container').hide();
            update_progress_bar(1);
            let datatable = dtable.DataTable();
            datatable.clear().draw();

            $.ajax({
                url: url,
                dataType: 'json',
                tryCount: 0,
                retryLimit: 3,
                data: request_data(),
                success: (results) => {
                    total_data = results.data;
                    let text_total_data = numeral(total_data).format('0, 0');
                    text_total_data = text_total_data.replace(',', '.');
                    $('.progress-data-loader-container').show();
                    $('.progress-data-loader-total-data').html(text_total_data);

                    data_fetched = 0;
                    load_dataset(dtable, data_url, filter_data);
                },
                error : (xhr, textStatus, errorThrown) => {
                    this.tryCount++;
                    if (this.tryCount <= this.retryLimit) {
                        $.ajax(this);
                        return;
                    }
                    $('.btn-get-data-loading').hide();
                    error_notify('Error', 'terjadi kesalahan server, tidak dapat mendapatkan Total Data');
                }
            });
        }

        let load_dataset = (dtable, url, request_data) => {
            let datatable = dtable.DataTable();
            $.ajax({
                url: url,
                dataType: 'json',
                tryCount: 0,
                retryLimit: 3,
                data: request_data(),
                success: (results) => {
                    let data = results.data;
                    let arr_length = (results.data).length;
                    data_fetched += (arr_length > data_per_fetch ? arr_length : data_per_fetch);

                    $.each(data, (index, value) => {
                        let array_temp = [];
                        $.each(value, (obj_name, obj_value) => {
                            array_temp.push(obj_value);
                        });
                        let row_node = datatable.row.add(array_temp).draw(false).node();
                        $(row_node).addClass('text-center');
                    });

                    if(data_fetched < total_data)
                    {
                        let percentage = Math.ceil(data_fetched/total_data*100);
                        update_progress_bar(percentage);
                        load_dataset(dtable, url, filter_data);
                    }
                    else
                    {
                        update_progress_bar(100);
                        $('.btn-get-data-loading').hide();
                    }
                },
                error : (xhr, textStatus, errorThrown) => {
                    this.tryCount++;
                    if (this.tryCount <= this.retryLimit) {
                        $.ajax(this);
                        return;
                    }
                    $('.btn-get-data-loading').hide();
                    error_notify('Error', 'terjadi kesalahan server, tidak dapat mengambil data');
                }
            });
        }

        let update_progress_bar = (percentage) => {
            let progress_bar = $('#progress-bar-progress');
            if (percentage >= 100) {
                if ($('#progress-bar-progress.progress-bar-striped').length > 0) {
                    progress_bar.removeClass('progress-bar-striped');
                }

                if ($('#progress-bar-progress.progress-bar-animated').length > 0) {
                    progress_bar.removeClass('progress-bar-animated');
                }

                if ($('#progress-bar-progress.bg-success').length < 1) {
                    progress_bar.addClass('bg-success');
                }
            } else {
                if ($('#progress-bar-progress.progress-bar-striped').length < 1) {
                    progress_bar.addClass('progress-bar-striped');
                }

                if ($('#progress-bar-progress.progress-bar-animated').length < 1) {
                    progress_bar.addClass('progress-bar-animated');
                }

                if ($('#progress-bar-progress.bg-success').length > 0) {
                    progress_bar.removeClass('bg-success');
                }
            }

            progress_bar.css('width', `${percentage}%`);
            $('.progress-bar-label').html(`${percentage}%`);
        }

        let error_notify = (title,message) => {
            $.notify({
                title: `<strong>${title}</strong>`,
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