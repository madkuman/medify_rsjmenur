<script type="text/javascript">
    var total_data = 0;
    var data_per_fetch = 1;
    var data_fetched = 0;
    var tahun_transaksi = ''

    var dataTableObj = $('.js-dataTable-full').DataTable({
        "ordering": true,
        pageLength: 10,
        scrollX: true,
        lengthMenu: [
            [5, 10, 15, 20],
            [5, 10, 15, 20]
        ],
        autoWidth: false,
        dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [{
            extend: 'excel',
            className: 'btn btn-secondary',
            text: '<i class="fa fa-download"></i> Excel'
        }], 
    });

    $('.btn-get-data').click(function() {
        start_date = $('.input-daterange-start').val()
        end_date = $('.input-daterange-end').val()
        tahun_transaksi = $('[name="tahun_transaksi"]').val()
        data_fetched = 0;
        $('.btn-get-data-loading').show();
        $('.progress-data-loader-container').hide();
        updateProgressBar(1)
        dataTableObj.clear().draw();

        $.ajax({
            url: API_URL + '/pasien/laporan-v2/page/rl-3-1-rawat-inap/get-total-data',
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
                getDataset();

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
        $.ajax({
            url: API_URL + '/pasien/laporan-v2/page/rl-3-1-rawat-inap/get-data',
            dataType: 'json',
            tryCount: 0,
            retryLimit: 3,
            data: {
                tahun_transaksi,
                data_fetched,
                data_per_fetch
            },
            success: function(results) {
                var data = results.data
                var last_id = results.last_id
                data_fetched += data_per_fetch
                console.log(data_fetched)
                $.each(data, function(index, value) {

                    array_temp = [];
                    $.each(value, function(obj_name, obj_value) {
                        array_temp.push(obj_value)
                    })

                    dataTableObj.row.add(array_temp).draw(false);
                });

                if (data_fetched < total_data) {
                    getDataset()
                    var percentage = Math.ceil(data_fetched / total_data * 100)
                    updateProgressBar(percentage);
                } else {
                    updateProgressBar(100);
                    $('.btn-get-data-loading').hide();
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

</script>
