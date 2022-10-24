<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<script  type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    dataTable();
    countIndexPajak();

    function dataTable(){
        var tgl = $('#date').val();
        var kategori = $('#kategori').val();
        $('#example').dataTable( {
            lengthMenu: [[10, 15, 20], [10, 15, 20]],
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "scrollX": true,
            language: {
                processing: '<div class="panel panel-default"><i class="fa fa-4x fa-gear fa-spin text-info"></i></div>',
                searchPlaceholder: "Cari pegawai"
            },
            "ajax": {
                "url": BASE_URL + "remunerasi/api/data-laporan",
                "dataType": "json",
                "type": "POST",
                "data": {
                    "_token": "{{ csrf_token() }}",
                    "bulan_tahun": tgl,
                    "kategori" : kategori,
                }
            },
            "columns": [
                {"data": "nomer", "className": "text-center"},
                {"data": "cetak", "className": "text-center"},
                {"data": "pegawai"},
                {"data": "bank"},
                {"data": "kategori"},
                {"data": "golongan"},
                {"data": "pendidikan"},
                {"data": "jabatan"},
                {"data": "status"},
                {"data": "beban_kerja"},
                {"data": "resiko_kerja"},
                {"data": "masa_kerja"},
                {"data": "tim_pembagi_jasa"},
                {"data": "index_pajak"},
                {"data": "jasa_pelayanan", "className": "text-right"},
                {"data": "pelayanan_tambahan", "className": "text-right"},
                {"data": "potongan", "className": "text-right"},
                {"data": "total"}

            ],
        })
    };

    // SUBMIT LAPORAN
    $(document).on('click', '.btn-submit-print', function(){
        $(this).parent().parent().unbind('submit').submit();
    })

     // MODAL DANA
     $(document).on('click','#btn-modal-cetak', function () {
        $('#modal-create-dana').modal('show');
        $('.date-modal').combodate({
            customClass: 'js-select2 form-control',
            smartDays: true,
            maxYear: new Date().getFullYear() + 1
        });
    })

    $(document).on('click','#btn-modal-create', function () {
        $('#modal-create-laporan').modal('show');
        $('.date-modal').combodate({
            customClass: 'js-select2 form-control',
            smartDays: true,
            maxYear: new Date().getFullYear() + 1
        });
    })

    $("#cariPeriode").submit(function(event) {
        event.preventDefault();
        $('#example').DataTable().destroy();
        countIndexPajak();
        dataTable();
    });
    function countIndexPajak() {
        var tgl = $('#date').val();
        $.ajax({
            url: BASE_URL + "remunerasi/api/data-laporan-index-pajak?tanggal="+tgl,
            type: 'GET',
            dataType: 'json',
            beforeSend: function(){
            },
            success: function(data){
                console.log(data)
                data.forEach(myFunction);
                function myFunction(item,index) {
                    console.log(item)
                    $('#index-pajak-'+item.id).text(item.index_pajak);
                }
            },
            complete: function(){

            }
        });
    }
</script>