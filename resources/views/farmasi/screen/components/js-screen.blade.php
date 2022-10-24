
<script type="text/javascript">
    var farm_id = "{{session('farmasi')->id}}";
    var screen_id = "{{$screen->id}}";
    var oTable;
    var is_running = true;
    var current_page = 1;
    var transaksi_id = [];
    var nomor_rm = [];
    var status_check_in = '<div class="ribbon ribbon-bookmark ribbon-info"><div class="ribbon-box">Check In</div></div>';
    var status_ditelaah = '<div class="ribbon ribbon-bookmark ribbon-warning"><div class="ribbon-box">Telaah Resep</div></div>';
    var status_dikerjakan = '<div class="ribbon ribbon-bookmark ribbon-primary"><div class="ribbon-box">Dikerjakan</div></div>';
    var status_penyerahan = '<div class="ribbon ribbon-bookmark ribbon-warning"><div class="ribbon-box">Siap Diserahkan</div></div>';
    var start = 0;
    
    $(document).ready(function() {
        Codebase.loader('show');
    });

    $('.start-button').click(function() {
        Codebase.loader('hide');
        start = 1;
        loadTable();
        getDataUpdateAntrian();
    });

    function loadTable() {
        oTable = $('#task_table').DataTable({
            processing:true,
            // paging: false,
            searching: false,
            ordering: false,
            lengthChange: true,
            autoWidth: false,
            serverSide: true,
            destroy: true,
            pageLength: 5,
            ajax: {
                dataSrc: "data",
                url  : API_URL+"/farmasi/screen/task/get/"+farm_id+"/"+screen_id,
                type :'GET',
                error : function(xhr, textStatus, errorThrown){
                    $(".loading-circle").hide();
                    showMessage("fa fa-warning", "Terjadi kesalahan pada server, coba untuk refresh halaman", "warning", 5000);
                    console.log(xhr, textStatus, errorThrown);
                }
            },
            language: {
                processing: '<div style="width:100%;" class="text-center loading-circle"><i class="fa fa-4x fa-spinner fa-spin text-white-op" style="margin-top: 85px"></i></div>'
            },
            drawCallback: function() {
                $('#task_table tbody td').addClass("animated fadeIn");
            },
            initComplete: function(settings, json) {
                $.each( json.data, function( key, value ) {
                    transaksi_id.push(value.id);
                    if(value.pasien_detail) if (!nomor_rm.includes(value.pasien_detail.no_rm)) nomor_rm.push(value.pasien_detail.no_rm);
                    else nomor_rm.push('-');
                });
                resetPaginate()
                startCarousel()
                realtimeUpdate()
            },
            columns: [
                // { data: 'row_index', orderable: false, searchable: false, class: 'text-center' },
                { data: (data) => {
                        return `<span id="id-${data.id}">${data.no_antrian}</span>`;
                    }
                    , class: 'text-center'
                },
                { data: 'no_rm', class: 'text-center' },
                { data: 'estimasi', class: 'text-center' },
                { data: 'status', class: 'text-center status-content' }
            ]
        });

        $('#task_table_length').hide();
    }

    function showMessage(icon_txt, msg, type_txt, delay_notif = 1000) {
        $.notify({
            icon: icon_txt,
            message: msg,
        },{
            type: type_txt,
            placement: {
                from: "top",
                align: "center"
            },
            delay: delay_notif,
            animate: {
                enter: 'animated fadeIn',
                exit: 'animated fadeOut'
            }
        });
    }

    function resetPaginate() {
        console.log('run reset paginate')
        row_total = $(".row-index").length;
        last_page = Math.ceil(row_total / 6);
        page_flag = 1;
        counting = 0;
        row_index = 0;
        $('#task_table tbody tr').attr('id', '');

        $(".row-index").each(function() {
            counting++;
            if (counting % 7 == 0) page_flag++;

            $(this).parents('tr').attr('id','row_'+row_index++);
            $(this).parents('tr').addClass('row-page-'+page_flag);
            if (counting > 6) {
                $(this).parents('tr').addClass('d-none');
            }
        });
    }

    function startCarousel() {
        setInterval(function doSomething() {
            $('.row-page-'+current_page).addClass('d-none');
            current_page++;
            if (current_page > last_page) {
                current_page = 1;
            }
            $('.row-page-'+current_page).removeClass('d-none');
            if (is_running) realtimeUpdate();
        }, 5000);
    }

    function realtimeUpdate() {
        is_running = false;
        $.ajax({
            url: API_URL+"/farmasi/screen/task/get-realtime/"+farm_id+"/"+screen_id,
            type: 'POST',
            data: {transaksi_id: transaksi_id},
            dataType: 'JSON',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                is_running = true;
                console.log(transaksi_id);
                $.each( data.shown_data, function(key, item) {
                    id_transaksi = item.id;
                    no_rm = item.pasien_detail ? item.pasien_detail.no_rm : '-';
                    index = transaksi_id.indexOf(id_transaksi);

                    item_tr = $('#id-'+id_transaksi).parents('tr');
                    if (item.deleted_at != null) {
                        console.log('masuk hapus');
                        transaksi_id.splice(index, 1);
                        item_tr = $('#id-'+id_transaksi).parents('tr');
                        item_tr.remove();
                    } else if (item.status == 1) {
                        console.log('masuk status');
                        transaksi_id.splice(index, 1);
                        item_tr = $('#id-'+id_transaksi).parents('tr');
                        console.log(item_tr);
                        item_tr.remove();
                    } else if (item.status == 0 && item.dikerjakan_at != null) {
                        content = status_dikerjakan;
                        item_tr.find('.status-content').html(content);
                        return;
                    } else if (item.status == 0 && item.status_ditelaah == 1 && item.dikerjakan_at == null) {
                        content = status_ditelaah;
                        item_tr.find('.status-content').html(content);
                        return;
                    } else {
                        content = status_check_in;
                        item_tr.find('.status-content').html(content);
                        return;
                    }

                    resetPaginate();

                    if ($('#task_table tbody tr').length == 0) {
                        $('#task_table tbody').append('<tr class="odd" id=""><td valign="top" colspan="5" class="dataTables_empty animated fadeIn">No data available in table</td></tr>');
                    }
                });

                if (data.new_data.length > 0) {
                    $.each( data.new_data, function( key, value ) {
                        transaksi_id.push(value.id);
                        if(value.pasien_detail) if (!nomor_rm.includes(value.pasien_detail.no_rm)) nomor_rm.push(value.pasien_detail.no_rm);
                        else nomor_rm.push('-');

                        nomor_rm.sort();
                        if(value.pasien_detail) index_of = jQuery.inArray(value.pasien_detail.no_rm, nomor_rm);
                        else {
                            index_of = jQuery.inArray('-', nomor_rm);
                        }
                        appendRow(value, index_of)
                        console.log(transaksi_id)
                    });
                    check_available = $('#task_table tbody tr:first').attr('role');
                    if (check_available == undefined) {
                        $('#task_table tbody tr:first').remove();
                    }
                    resetPaginate()
                }

                if (data.shown_data_box) {
                    transaksi_box = data.shown_data_box;
                    $('.no_antrian_box').html(transaksi_box.nomor_antrian);
                    $('.loket_box').html(transaksi_box.loket_antrian.nama);
                }
            }
        })
    }

    function appendRow(data, index_of) {
        row_index = 0;

        if (data.status == 0 && data.dikerjakan_at != null) {
            content = status_dikerjakan;
        } else if (data.status == 0 && data.status_ditelaah == 1 && data.dikerjakan_at == null) {
            content = status_ditelaah;
        } else {
            content = status_check_in;
        }

        $('#task_table tbody tr').attr('class', '');

        row_content = '<td class="text-center animated fadeIn"><span id="id-'+data.id+'">'+data.nomor_antrian+'</span>'
            +'</td><td class="text-center animated fadeIn">'+(data.pasien_detail ? data.pasien_detail.no_rm : '-')
            +'</td><td class="text-center animated fadeIn">'+data.selesai_at
            +'</td><td class="text-center status-content animated fadeIn">'+content+'</td>';
        no_rm_exist_bottom = nomor_rm[index_of + 1];
        el_now = $('#task_table tbody tr .rm_'+no_rm_exist_bottom+':first');
        if (el_now.length == 0) {
            el_now = $('#task_table tbody tr:last');
            el_now.after('<tr role="row">'+row_content+'</tr>');
        } else {
            el_now = el_now.parents('tr');
            el_now.before('<tr role="row">'+row_content+'</tr>');
        }
        $('#task_table tbody tr').attr('id', '');
        $("#task_table tbody tr").each(function() {
            $(this).attr('id','row_'+row_index++);
        });
    }

    var times = 9000;
    var times_short = 3000;
    var times_medium = 5000;
    var times_long = 60000;
    var current_loket_id = 0;
    var current_loket_nama = '';
    var current_nomor_antrian = 0;
    var current_transaksi_id = 0;

    var intervalUpdateAntrian = setInterval(getDataUpdateAntrian, times);

    function getDataUpdateAntrian() {
        console.log('getDataUpdateAntrian');
        $.ajax({
            url: `{{ url('') }}/api/farmasi/${farm_id}/antrian-screen/update`,
            dataType: 'json',
            cache: false,
            type: 'GET',
            success: function(data) {
                console.log(data);
                clearInterval(intervalUpdateAntrian);
                if(data.status !== 0) updateViewAntrian(data);
                else intervalUpdateAntrian = setInterval(getDataUpdateAntrian, times_short); //jika tidak maka akan terus ngecall ajax tapi lebih cepat
                current_loket_id = data.loket_id;
                current_loket_nama = data.loket_nama;
                current_nomor_antrian = data.nomor_antrian;
                current_transaksi_id = data.transaksi_id;
            }
        });
    }

    function updateViewAntrian(data) {
        intervalUpdateAntrian = setInterval(getDataUpdateAntrian, times);
        if(current_nomor_antrian === data.nomor_antrian && current_loket_id === data.loket_id) recallAntrian();
        else
        {
            updateKontenAntrian(data);
            announceAntrian(data.transaksi_id, data.loket_id);
        }
    }

    function updateKontenAntrian(data) {
        $('#no-antrian').text(data.nomor_antrian);
        $('#loket').text(data.loket_nama);
        blinkAnimate('#no-antrian');
        blinkAnimate('#loket');
    }

    function blinkAnimate(element)
    {
        $(element).animate({opacity: 0}, 200, "linear", function() {
            $(this).animate({opacity: 1}, 200);
        });
    }

    function recallAntrian(){
        announceAntrian(current_transaksi_id, current_loket_id);
        blinkAnimate('#no-antrian');
        blinkAnimate('#loket');
    }

    function announceAntrian(transaksi_id, loket_id)
    {
        const url = "{{ url('') }}/assets/img/farmasi-tv/sound/generate";
        let file = `${url}/antrian_${transaksi_id}_${loket_id}.mp3`;
        doAnnounce(file);
    }

    var playing = 0;
    var queue_playlist = []
    var allowCheckQueuePlaylist = 1;

    function doAnnounce(file_name)
    {
        var audio = document.getElementById("player");
        audio.src = file_name;
        document.getElementById('player').muted = false;
        audio.play();
        audio.addEventListener("ended", function() {
            //done playing
            queue_playlist.shift();
            allowCheckQueuePlaylist = 1;
        });
    }
</script>