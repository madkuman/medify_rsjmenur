<script type="text/javascript">

    var filter_jenis
    var filter_date_start
    var filter_date_end

    initValue();

    function initValue()
    {
        filter_jenis = $('.filter-jenis').val();
        filter_date_start = $('#filter-date-1').val();
        filter_date_end = $('#filter-date-2').val();
    }

    $(document).ready(function() {
        table.draw();
    });

    var table = $('#tableCuti').DataTable({
        "ordering": true,
        pageLength: 10,
        lengthMenu: [[10, 15, 20], [10, 15, 20]],
        autoWidth: false,
        processing: true,
        serverSide: true,
        bFilter:false,
        language: {
            processing: '<div class="panel panel-default"><i class="fa fa-4x fa-gear fa-spin text-info"></i></div>'
        },
        ajax: {
            type: "GET",
            dataType: "json",
            url: API_URL + '/kepegawaian/cuti/kuota/get-mutasi',
            data: function(d) {
                d.date_start = filter_date_start;
                d.date_end = filter_date_end;
                d.master_cuti_id = filter_jenis;
            }
        },
        columns: [
        { data: 'no', name: 'no' },
        { data: 'jenis_cuti', name: 'jenis_cuti' },
        { data: 'tanggal', name: 'tanggal' },
        { data: null, name: 'cuti_pengajuan_id', render: function (data, type, row, meta) {
                content = '';
                if(data.cuti_pengajuan_id != ''){
                    content =`<a class="btn btn-secondary" target="_blank" href="{{url('')}}/cuti/pengajuan/form/`+data.cuti_pengajuan_id+`">Lihat</a></div>`;
                }
                return content;
            },
        },
        { data: null, name: 'cuti_pengajuan_id', render: function (data, type, row, meta) {
                content = '';
                if(data.cuti_pengajuan_id != ''){
                    content =`<span class="badge badge-info">`+data.disetujui_pada+`</span>`;
                }
                return content;
            },
        },
        { data: 'kuota_perubahan', name: 'kuota_perubahan' },
        { data: 'kuota_sisa', name: 'kuota_sisa' },
        ],
        order: [[ 0, "asc" ]]
    });

    $(".filter-jenis").on('change', function(){
        initValue()
        table.draw(true);
    });

    $("#filter-date-1").on('change', function(){
        initValue()
        table.draw(true);
    });
    $("#filter-date-2").on('change', function(){
        initValue()
        table.draw(true);
    });

</script>