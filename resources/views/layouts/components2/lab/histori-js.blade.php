<script type="text/javascript">
    $(document).ready(function(){
        @if(session('status'))
        swal(
            '{{session("message")}}',
            "",
            '{{session("status")}}'
            );
        @endif
        var oTable = $("#historiTable").DataTable({
            scrollX:        true,
            scrollCollapse: true,
            dom: "t p r",
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{url($link."/histori/ajax")}}',
                data: function(d) {
                    d.nama = $("#namaPasien").val();
                    d.no_rm = $("#rmPasien").val();
                    d.tanggal_mulai = $("#tanggalMulai").val();
                    d.tanggal_akhir = $("#tanggalAkhir").val();
                    d.jenis_pasien = $("#jenisPasien").val();
                    d.asal_ruang = $("#asalRuang").val();
                    d.tipe_transaksi = $("#tipeTransaksi").val();
                    d.jenis_layanan = $("#jenisLayanan").val();
                    d.status = $("#status").val();
                    d.jenis_pemeriksaan = $("#jenisPemeriksaan").val();
                }
            },
            language: {
                processing: '<i class="fa fa-4x fa-asterisk fa-spin text-info"></i>'
            },
            columns: [
            { data: 'pasien_rm'},
            { data: 'patient_id', name: 'patient_id'},
            { data: 'kasus_id', name: 'kasus_id'},
            { data: 'result_created_at', name: 'result_created_at'},
            { data: 'created_at'},
            { data: 'lokasi_id', name: 'lokasi_id'},
            { data: 'layanan', name: 'layanan', orderable: false, searchable: false},
            { data: 'harga_total', name: 'harga_total', className:"text-right"},
            { data: 'status', name: 'status', orderable: false, searchable: false, className:"text-center"},
            { data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: []
        });
        $('#searchBtn').on('click', function(e) {
            oTable.draw();
            e.preventDefault();
        });
        $("#resetForm").on('click', (e)=> {
            document.getElementById('searchForm').reset();
            oTable.draw();
        })
    });
    $(function () {
        var downloadBtn = $("#downloadBtn");
        $(document).on("click", "button.fileDownload", function () {

            var nama = $("#namaPasien").val();
            var no_rm = $("#rmPasien").val();
            var jenis_pasien = $("#jenisPasien").val();
            var tanggal_mulai = $("#tanggalMulai").val();
            var tanggal_akhir = $("#tanggalAkhir").val();
            var asal_ruang = $("#asalRuang").val();
            var tipe_transaksi = $("#tipeTransaksi").val();
            var jenis_layanan = $("#jenisLayanan").val();
            var jenis_pemeriksaan = $("#jenisPemeriksaan").val();
            var targetLink = `{{url($link.'/histori/download')}}?nama=${nama}&no_rm=${no_rm}&jenis_pasien=${jenis_pasien}&tanggal_mulai=${tanggal_mulai}&tanggal_akhir=${tanggal_akhir}&asal_ruang=${asal_ruang}&tipe_transaksi=${tipe_transaksi}&jenis_layanan=${jenis_layanan}&jenis_pemeriksaan=${jenis_pemeriksaan}`;

            window.open(
              targetLink,
              '_blank' // <- This is what makes it open in a new window.
              );
        });
    });
</script>