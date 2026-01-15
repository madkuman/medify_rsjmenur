
<script type="text/javascript">
    var farm_id = "{{session('farmasi')->id}}";
    var screen_id = "{{$screen->id}}";
    var oTable;
    var oTable_umum;
    var is_running = true;
    var current_page = 1;
    var transaksi_id = [];
    var nomor_rm = [];
    var status_check_in = '<div class="ribbon ribbon-bookmark ribbon-info"><div class="ribbon-box">Check In</div></div>';
    var status_ditelaah = '<div class="ribbon ribbon-bookmark ribbon-warning"><div class="ribbon-box">Telaah Resep</div></div>';
    var status_dikerjakan = '<div class="ribbon ribbon-bookmark ribbon-primary"><div class="ribbon-box">Dikerjakan</div></div>';
    var status_penyerahan = '<div class="ribbon ribbon-bookmark ribbon-warning"><div class="ribbon-box">Siap Diserahkan</div></div>';
    var start = 0;
        
    // Function to scroll the table to the bottom
    function autoScrollBPJS() {
        const tableContainerBPJS = document.querySelector('#block_bpjs');
        tableContainerBPJS.scrollTop = tableContainerBPJS.scrollHeight;
    }
    function autoScroll() {
        const tableContainer = document.querySelector('#block_umum');
        tableContainer.scrollTop = tableContainer.scrollHeight;
    }
    
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
        $.ajax({
            url : API_URL+"/farmasi/screen/task/get/"+farm_id+"/"+screen_id+"/bpjs",
            type: 'GET',
            success: function(result) {
                resetPaginateBPJS()
                startCarousel()
                realtimeUpdate()
                console.log(result);
                $.each( result, function( key, value ) {
                    // transaksi_id.push(value.id);
                    if(value.pasien_detail) if (!nomor_rm.includes(value.pasien_detail.no_rm)) nomor_rm.push(value.pasien_detail.no_rm);
                    else nomor_rm.push('-');

                    nomor_rm.sort();
                    if(value.pasien_detail) index_of = jQuery.inArray(value.pasien_detail.no_rm, nomor_rm);
                    else {
                        index_of = jQuery.inArray('-', nomor_rm);
                    }
                    appendRow(value, index_of, 'bpjs')
                    console.log(transaksi_id)
                });
            }
        })
        $.ajax({
            url : API_URL+"/farmasi/screen/task/get/"+farm_id+"/"+screen_id+"/tunai",
            type: 'GET',
            success: function(result) {
                resetPaginateBPJS()
                startCarousel()
                realtimeUpdate()
                console.log(result);
                $.each( result, function( key, value ) {
                    // transaksi_id.push(value.id);
                    if(value.pasien_detail) if (!nomor_rm.includes(value.pasien_detail.no_rm)) nomor_rm.push(value.pasien_detail.no_rm);
                    else nomor_rm.push('-');

                    nomor_rm.sort();
                    if(value.pasien_detail) index_of = jQuery.inArray(value.pasien_detail.no_rm, nomor_rm);
                    else {
                        index_of = jQuery.inArray('-', nomor_rm);
                    }
                    appendRow(value, index_of, 'tunai')
                    console.log(transaksi_id)
                });
            }
        })

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

    function resetPaginateUmum() {
        console.log('run reset paginate')
        row_total = $(".row-index").length;
        last_page = Math.ceil(row_total / 6);
        page_flag = 1;
        counting = 0;
        row_index = 0;
        $('#task_table_umum tbody tr').attr('id', '');

        $(".row-index").each(function() {
            // counting++;
            // if (counting % 7 == 0) page_flag++;

            $(this).parents('tr').attr('id','row_'+row_index++);
            // $(this).parents('tr').addClass('row-page-'+page_flag);
            // if (counting > 6) {
            //     $(this).parents('tr').addClass('d-none');
            // }
        });
    }
    function resetPaginateBPJS() {
        console.log('run reset paginate')
        row_total = $(".row-index").length;
        last_page = Math.ceil(row_total / 6);
        page_flag = 1;
        counting = 0;
        row_index = 0;
        $('#task_table_bpjs tbody tr').attr('id', '');

        $(".row-index").each(function() {
            // counting++;
            // if (counting % 7 == 0) page_flag++;

            $(this).parents('tr').attr('id','row_'+row_index++);
            // $(this).parents('tr').addClass('row-page-'+page_flag);
            // if (counting > 2) {
            //     $(this).parents('tr').addClass('d-none');
            // }
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
                    if(item.pembayaran_detail.perusahaan.tipe.flag_tipe == 'tunai') {
                        id_transaksi = item.id;
                        no_rm = item.pasien_detail ? item.pasien_detail.no_rm : '-';
                        index = transaksi_id.indexOf(id_transaksi);

                        item_tr = $('#id-umum-'+id_transaksi).parents('tr');
                        if (item.deleted_at != null) {
                            console.log('masuk hapus');
                            transaksi_id.splice(index, 1);
                            item_tr = $('#id-umum-'+id_transaksi).parents('tr');
                            item_tr.remove();
                        } else if (item.status == 1) {
                            console.log('masuk status');
                            transaksi_id.splice(index, 1);
                            item_tr = $('#id-umum-'+id_transaksi).parents('tr');
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

                        // resetPaginateUmum();
                        autoScroll();
                        if ($('#task_table_umum tbody tr').length == 0) {
                            $('#task_table_umum tbody').append('<tr class="odd" id=""><td valign="top" colspan="5" class="dataTables_empty animated fadeIn">No data available in table</td></tr>');
                        }
                    } else if(item.pembayaran_detail.perusahaan.tipe.flag_tipe == 'bpjs') {
                        id_transaksi = item.id;
                        no_rm = item.pasien_detail ? item.pasien_detail.no_rm : '-';
                        index = transaksi_id.indexOf(id_transaksi);

                        item_tr = $('#id-bpjs-'+id_transaksi).parents('tr');
                        if (item.deleted_at != null) {
                            console.log('masuk hapus');
                            transaksi_id.splice(index, 1);
                            item_tr = $('#id-bpjs-'+id_transaksi).parents('tr');
                            item_tr.remove();
                        } else if (item.status == 1) {
                            console.log('masuk status');
                            transaksi_id.splice(index, 1);
                            item_tr = $('#id-bpjs-'+id_transaksi).parents('tr');
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

                        // resetPaginateBPJS();
                        autoScrollBPJS();
                        if ($('#task_table_bpjs tbody tr').length == 0) {
                            $('#task_table_bpjs tbody').append('<tr class="odd" id=""><td valign="top" colspan="5" class="dataTables_empty animated fadeIn">No data available in table</td></tr>');
                        }
                    }
                   
                });

                if (data.new_data.length > 0) {
                    $.each( data.new_data, function( key, value ) {
                        if(value.pasien_detail) if (!nomor_rm.includes(value.pasien_detail.no_rm)) nomor_rm.push(value.pasien_detail.no_rm);
                        else nomor_rm.push('-');

                        nomor_rm.sort();
                        if(value.pasien_detail) index_of = jQuery.inArray(value.pasien_detail.no_rm, nomor_rm);
                        else {
                            index_of = jQuery.inArray('-', nomor_rm);
                        }
                        if(value.pembayaran_detail.perusahaan.tipe.flag_tipe == 'tunai') {
                            resetPaginateUmum()
                            appendRow(value, index_of, 'tunai')
                        } else if (value.pembayaran_detail.perusahaan.tipe.flag_tipe == 'bpjs') {
                            resetPaginateBPJS()
                            appendRow(value, index_of, 'bpjs')
                        }
                    });
   

                }

                // if (data.shown_data_box) {
                //     transaksi_box = data.shown_data_box;
                //     $('.no_antrian_box').html(transaksi_box.nomor_antrian);
                //     $('.loket_box').html(transaksi_box.loket_antrian.nama);
                // }
                autoScroll();
                autoScrollBPJS();
            }
        })
    }

    function appendRow(data, index_of, slug) {
        console.log(data + index_of + slug)
        row_index = 0;

        if (data.status == 0 && data.dikerjakan_at != null) {
            content = status_dikerjakan;
        } else if (data.status == 0 && data.status_ditelaah == 1 && data.dikerjakan_at == null) {
            content = status_ditelaah;
        } else {
            content = status_check_in;
        }
        if(transaksi_id.includes(data.id)) {
        } else {
            if(slug == 'tunai') {
            $('#task_table_umum tbody tr').attr('class', '');

            row_content = '<tr><td class="text-center animated fadeIn" width="30%"><span id="id-umum-'+data.id+'">'+data.nomor_antrian+'</span>'
                +'</td><td class="text-center animated fadeIn" width="20%">'+(data.pasien_detail ? data.pasien_detail.no_rm : '-')
                +'</td><td class="text-center animated fadeIn" width="25%">'+data.waktu_estimasi_selesai
                +'</td><td class="text-center status-content animated fadeIn" width="25%">'+content+'</td></tr>';
            $('#task_table_umum tbody').append(row_content);
            transaksi_id.push(data.id);
            } else if(slug == 'bpjs') {
                row_content = '<tr><td class="text-center animated fadeIn" width="30%"><span id="id-bpjs-'+data.id+'">'+data.nomor_antrian+'</span>'
                    +'</td><td class="text-center animated fadeIn" width="20%">'+(data.pasien_detail ? data.pasien_detail.no_rm : '-')
                    +'</td><td class="text-center animated fadeIn" width="25%">'+data.waktu_estimasi_selesai
                    +'</td><td class="text-center status-content animated fadeIn" width="25%">'+content+'</td></tr>';
                $('#task_table_bpjs tbody').append(row_content);
                transaksi_id.push(data.id);
            }
        }
       
       
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
            console.log('update ke view jalan');
            updateKontenAntrian(data);
            announceAntrian(data.transaksi_id, data.loket_id);
        }
    }

    function updateKontenAntrian(data) {
        if(data.kode == 'BN' ) {
            $('#no-antrian-bpjs-non').html(data.nomor_antrian);
            $('#loket-bpjs-non').html(data.loket_nama);
            blinkAnimate('#no-antrian-bpjs-non');
            blinkAnimate('#loket-bpjs-non');
        } else if(data.kode == 'BR') {
            $('#no-antrian-bpjs').html(data.nomor_antrian);
            $('#loket-bpjs').html(data.loket_nama);
            blinkAnimate('#no-antrian-bpjs');
            blinkAnimate('#loket-bpjs');
        } else if(data.kode == 'UR')  {
            $('#no-antrian-umum-non').html(data.nomor_antrian);
            $('#loket-umum-non').html(data.loket_nama);
            blinkAnimate('#no-antrian-umum-non');
            blinkAnimate('#loket-umum-non');
        } else if(data.kode == 'UN') {
            $('#no-antrian-umum').html(data.nomor_antrian);
            $('#loket-umum').html(data.loket_nama);
            blinkAnimate('#no-antrian-umum');
            blinkAnimate('#loket-umum');
        }

    }

    function blinkAnimate(element)
    {
        $(element).animate({opacity: 0}, 200, "linear", function() {
            $(this).animate({opacity: 1}, 200);
        });
    }

    function recallAntrian(){
        announceAntrian(current_transaksi_id, current_loket_id);
        blinkAnimate('#no-antrian-bpjs-non');
        blinkAnimate('#loket-bpjs-non');
        blinkAnimate('#no-antrian-bpjs');
        blinkAnimate('#loket-bpjs');
        blinkAnimate('#no-antrian-umum');
        blinkAnimate('#loket-umum');
        blinkAnimate('#no-antrian-umum-non');
        blinkAnimate('#loket-umum-non');
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