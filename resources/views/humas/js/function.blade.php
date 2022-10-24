<script type="text/javascript">

    var lastday = function(y,m){
        return  new Date(y, m +1, 0).getDate();
    }

    function changeKompDate(sesi){
        var d = $('#komp-hari-'+sesi).val(); 
        var m = $('#komp-bulan-'+sesi).val(); 
        var y = $('#komp-tahun-'+sesi).val();
        if (y!="") {
            $('#komp-hari-'+sesi).children('option:not(:first)').remove();
            var last = lastday(y,m-1);
            for (var i = 1; i <= last; i++) {
                $('#komp-hari-'+sesi)
                    .append($("<option></option>")
                    .attr("value",i)
                    .text(i));
            }
            if (d>last) {
                $('#komp-hari-'+sesi).val(last);
            }else {
                $('#komp-hari-'+sesi).val(d);
            }
        }
    }

    function changeRespDate(sesi){
        var d = $('#resp-hari-'+sesi).val(); 
        var m = $('#resp-bulan-'+sesi).val(); 
        var y = $('#resp-tahun-'+sesi).val();
        if (y!="") {
            $('#resp-hari-'+sesi).children('option:not(:first)').remove();
            var last = lastday(y,m-1);
            for (var i = 1; i <= last; i++) {
                $('#resp-hari-'+sesi)
                    .append($("<option></option>")
                    .attr("value",i)
                    .text(i));
            }
            if (d>last) {
                $('#resp-hari-'+sesi).val(last);
            }else {
                $('#resp-hari-'+sesi).val(d);
            }
        }
    }

    function komplainEditModal(id)
    {
        // $('#loading-top').fadeIn();
        $.ajax({
            url: API_URL + '/humas/komplain/get/'+ id,
            type: 'GET',
            dataType: 'json',
            beforeSend:function() {
                $('#loading').removeClass('d-none');
                $('#edit-content').addClass('d-none');
            },
            success: function(data) {
                var kompid = data.id;
                var ket = data.komplain_keterangan;
                var lok = data.lokasi;
                var kompDatetime = data.komplain_tanggal;
                if(data.respon_tanggal == null) {
                    var resp = "0-0-0 default:00".split(' ');
                    var respDate = resp[0].split('-');
                    var respTime = resp[1].split(':');
                }else {
                    var respDatetime = data.respon_tanggal;
                    var resp = respDatetime.split(' ');
                    var respDate = resp[0].split('-');
                    var respTime = resp[1].split(':');
                }

                var komp = kompDatetime.split(' ');
                var kompDate = komp[0].split('-');
                var kompTime = komp[1].split(':');

                $('#komplain-id').val(kompid);
                $('#keterangan').val(ket);
                $('#lokasi').val(lok);

                $('#komp-hari-edit').val(parseInt(kompDate[2], 10));
                $('#komp-bulan-edit').val(kompDate[1]);
                $('#komp-tahun-edit').val(kompDate[0]);
                $('#komp-jam-edit').val(parseInt(kompTime[0], 10));
                $('#komp-menit-edit').val(parseInt(kompTime[1], 10));

                $('#resp-hari-edit').val(parseInt(respDate[2], 10));
                $('#resp-bulan-edit').val(respDate[1]);
                $('#resp-tahun-edit').val(respDate[0]);
                if(respTime[0] == 'default') {
                    $('#resp-jam-edit').val('default');
                    $('#resp-menit-edit').val('default');
                }else {
                    $('#resp-jam-edit').val(parseInt(respTime[0], 10));
                    $('#resp-menit-edit').val(parseInt(respTime[1], 10));
                }

                $('#loading').addClass('d-none');
                $('#edit-content').removeClass('d-none');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest, textStatus, errorThrown);
            },
        });

        $('#modal-edit').modal('show');
    }

    function komplainDelete(id)
    {
        $('#komplain-id-del').val(id);
        $('#modal-delete').modal('show');
    }
</script>