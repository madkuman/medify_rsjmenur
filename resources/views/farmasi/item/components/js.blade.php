@if (session('farmasi')->jenis < 4)
<script type="text/javascript">
    $('#kategori-select2').select2();
</script>
<script type="text/javascript">
    $('#jenis-select2').select2();
</script>
@else
<script type="text/javascript">
    $(document).ready(function(){
        $('#satuan-select2').select2({
            tags: true
        });
        $('.js-example-basic-multiple').select2({
            tags: true
        });
    });

    function formatBarang (item) {
        console.log(item);
        if (item.loading || item.text) {
            return item.text;
        }
        var markup = item.nama + " ("+item.satuan+")";
        return markup;
    }

    function formatBarangSelection (item) {
        if(item.nama) return item.nama + " ("+item.satuan+")";
        else return item.text;
    }

    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
</script>
@endif
<script type="text/javascript">
    $(document).ready(function(){
        var oTable = $("#items_farmasi").DataTable({
            pageLength: 10,
            autoWidth: false,
            lengthChange: false,
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: API_URL+"/farmasi/{{session('farmasi')->slug}}/item/load-data",
                data: function(d) {
                    d.farmid = "{{session('farmasi')->id}}";
                    d.nama_barang = $('#nama_barang').val();
                    d.kategori = $('#kategori-select2').val();
                    d.jenis = $('#jenis-select2').val();
                    d.harga_minimal = $('#harga_minimal').val();
                    d.harga_maksimal = $('#harga_maksimal').val();
                    d.stok_minimal = $('#stok_minimal').val();
                    d.stok_maksimal = $('#stok_maksimal').val();
                }
            },
            language: {
                processing: '<i class="fa fa-4x fa-asterisk fa-spin text-info mt-50"></i>'
            },
            columns: [
                { data: 'rownum', name: 'rownum', orderable: false, searchable: false, class: 'text-center'},
                { data: 'nama', name: 'nama'},
                { data: 'stok', name: 'stok'},
                { data: 'harga', name: 'harga', class: 'text-center'},
                { data: 'expired', name: 'expired', class: 'text-center'},
                { data: 'kategori', name: 'kategori', orderable: false, class: 'text-center'},
                { data: 'detail', name: 'detail', orderable: false, searchable: false, class: 'text-center'},
            ],
            order: []
        })
        $('#searchBtn').on('click', function(e) {
            oTable.draw();
            e.preventDefault();
        });

        $('#btnReset').on('click', function(e) {
            $('#nama_barang').val(null).trigger('change');
            $('#stok_maksimal').val(null).trigger('change');
            $('#stok_minimal').val(null).trigger('change');
            $('#harga_maksimal').val(null).trigger('change');
            $('#harga_minimal').val(null).trigger('change');
            $('#kategori-select2').val(null).trigger('change');
            oTable.draw();
            e.preventDefault();
        });
        $('#btnFilter').on('click', function(){
            $(this).addClass('d-none');
            $('#items_farmasi_wrapper').css('margin-top','90px')
            $('#filter-data').removeClass('d-none');
        });

        $('#btnCancel').on('click', function(){
            $(this).parents('#filter-data').addClass('d-none');
            $('#items_farmasi_wrapper').css('margin-top','')
            $('#btnFilter').removeClass('d-none'); 
        });
    });
</script>