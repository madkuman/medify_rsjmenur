<script type="text/javascript">
    $(document).ready(function(){
        var oTable = $("#transaksi_farmasi").DataTable({
            // pagingType: "input",
            pageLength: 10,
            autoWidth: false,
            lengthChange: false,
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: API_URL+"/farmasi/transaksi/get",
                data: function(d) {
                    d.farmid = "{{session('farmasi')->id}}";
                    d.slug = "{{session('farmasi')->slug}}";
                    d.tanggal_awal = $("#tanggal_awal").val();
                    d.tanggal_akhir = $("#tanggal_akhir").val();
                    d.jenis_pembayaran = $("#jenis-pembayaran").val();
                    d.status = function() {
                            if($('#status_selesai').is(":checked"))
                            {
                                if($('#status_menunggu').is(":checked")) return 2;
                                else return 1;    
                            }
                            if($('#status_menunggu').is(":checked")) return 0;
                    };
                    d.status_ditelaah = function() {
                            if($('#sudah_ditelaah').is(":checked")){

                                if($('#belum_ditelaah').is(":checked")) return 2;
                                else return 1;   
                            }
                            if($('#belum_ditelaah').is(":checked")) return 0;
                    }
                    d.cito = function () {
                        if($('#cito').is(":checked"))
                        {
                            return 1;
                        }
                    }
                    d.is_video = function () {
                        if($('#telekonsultasi').is(":checked"))
                        {
                            return 1;
                        }
                    }
                }
            },
            language: {
                processing: '<i class="fa fa-4x fa-asterisk fa-spin text-info mt-50"></i>'
            },
            columns: [
                { data: 'rownum', name: 'rownum', orderable: false, searchable: false, class: 'text-center'},
                { data: 'pasien', name: 'pasien'},
                { data: 'no_resep', name: 'no_resep'},
                { data: 'tanggal', name: 'tanggal', class: 'text-center'},
                { data: 'status', name: 'status', orderable: false, class: 'text-center'},
                { data: 'lokasi_text', name: 'lokasi_text', orderable: false, class: 'text-center'},
                { data: 'action', name: 'action', orderable: false, searchable: false, class: 'text-center'},
            ],
            order: []
        })
        $('#searchBtn').on('click', function(e) {
            oTable.draw();
            e.preventDefault();
        });
    });
</script>