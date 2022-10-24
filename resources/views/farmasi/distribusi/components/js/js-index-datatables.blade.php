<script type="text/javascript">
$(document).ready(function(){
    var oTable = $("#distribusi_farmasi").DataTable({
        pageLength: 10,
        autoWidth: false,
        lengthChange: false,
        ordering: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: API_URL+"/farmasi/{{session('farmasi')->slug}}/distribusi/get",
            data: function(d) {
                d.farmid = "{{session('farmasi')->id}}";
                d.unit_tujuan = $('#cari-unit-select2').val();
                d.tanggal_awal = $('#tanggal_awal').val();
                d.tanggal_akhir = $('#tanggal_akhir').val();
                d.jenis = $('#jenis-select2').val();
                d.status = function() {
                    var status = [];
                    if($('#status_menunggu').is(":checked")) status.push(0);
                    if($('#status_konfirmasi').is(":checked")) status.push(1);
                    if($('#status_selesai').is(":checked")) status.push(2);
                    return status;
                },
                d.kategori = function() {
                    var kategori = [];
                    if($('#tipe_masuk').is(":checked")) kategori.push(1);
                    if($('#tipe_keluar').is(":checked")) kategori.push(-1);
                    return kategori;
                }
            }
        },
        language: {
            processing: '<i class="fa fa-4x fa-asterisk fa-spin text-info mt-50"></i>'
        },
        columns: [
            { data: 'rownum', name: 'rownum', orderable: false, searchable: false, class: 'text-center'},
            { data: 'tujuan', name: 'tujuan'},
            { data: 'kategori', name: 'kategori', class: 'text-center'},
            { data: 'waktu', name: 'waktu', class: 'text-center'},
            { data: 'status', name: 'status', orderable: false, class: 'text-center'},
            { data: 'keterangan', name: 'keterangan', orderable: false, class: 'text-center'},
            { data: 'detail', name: 'detail', orderable: false, searchable: false, class: 'text-center'},
        ],
        order: []
    })
    $('#searchBtn').on('click', function(e) {
        oTable.draw();
        e.preventDefault();
    });
});
</script>