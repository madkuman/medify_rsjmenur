<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">

    $(document).ready(function() {
        $('#date').combodate({
            customClass: 'js-select2 form-control',
            smartDays: true,
            maxYear: new Date().getFullYear() + 1
        });
        var tgl = $('#date').val();
        dataTable(tgl);
    });

    $("#cariPeriode").submit(function(event) {
        event.preventDefault();
        $('#example').DataTable().destroy();
            var tgl = $('#date').val();
        dataTable(tgl);
    });
    
    
    
    function dataTable(tgl){
        $('#example').dataTable( {
            lengthMenu: [[10, 15, 20, 25], [10, 15, 20, 25]],
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "ordering": false,
            language: {
                processing: '<div class="panel panel-default"><i class="fa fa-4x fa-gear fa-spin text-info"></i></div>',
                searchPlaceholder: "Cari pegawai"
            },
            "ajax": {
                "url": BASE_URL+"remunerasi/api/data-beban-kerja",
                "dataType": "json",
                "type": "POST",
                "data": {
                    "_token": "{{ csrf_token() }}",
                    "bulan": tgl,
                }
            },
            "columns": [
                {"data": "nomer", "className": "text-center"},
                {"data": "pegawai"},
                {"data": "bulan", "className": "text-center"},
                {"data": "index", "className": "text-center"},
                {"data": "action", "className": "text-center"}
            ],
        })
    };


     // GET DATA
     function editBeban(data){
         console.log(data);
            var id      = data.getAttribute("data-id")
            var nama    = data.getAttribute("data-nama")
            var nrp     = data.getAttribute("data-nrp")
            var bulan   = data.getAttribute("data-bulan")
            var beban   = data.getAttribute("data-beban")
            $('#id').val(id);
            $('#bulan').html(bulan);
            $('#nama').html(nama);
            $('#nrp').html(nrp);
            $('#index_beban').val(beban);
           
			$('#modal-update-beban').modal('show');
		};

    $(document).on('click','#btn-modal-create', function () {
        $('#modal-create-beban-pegawai').modal('show');
        $('#submit-beban-kerja').attr("disabled", false);
        $('#date-modal').combodate({
            customClass: 'js-select2 form-control',
            smartDays: true,
            maxYear: new Date().getFullYear() + 1
        });
    })
</script>