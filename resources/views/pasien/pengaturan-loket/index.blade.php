@extends('pasien.layouts.main')

@section('title')
Pasien - Pengaturan Loket
@endsection

@section('subtitle')
Daftar Loket
@endsection

@section('css')
<style type="text/css">
.block-content {
    padding-bottom: 18px;
}
#data_tabel_daftar_pasien_filter {
    position: relative;
    left: 280px;
}
</style>
@endsection

@section('content')
<main id="main-container">
    @include('pasien.layouts.navbar')
    <div class="container">
        <div class="row row-deck">
            <div class="col-sm-12">
                <div class="block rounded main-content transaction-index"  ng-controller="PasienController">
                    <div class="block-header">
                        <h3 class="block-title">Daftar Loket</h3>
                        <a href="#modal_tambah" data-toggle="modal" class="btn btn-primary">Loket Baru</a>
                    </div>
                    <div class="col-lg-12 col-12">
                        <div class="block rounded main-content transaction-index">
                          <div class="table-responsive">
                            <table class="table table-hover table-pointer table-vcenter js-dataTable-full" id="data_tabel_loket" style="font-family: sans-serif; width: 100%" >
                              <thead>
                                <tr class="header">
                                    <th style="width:8%">Nama Loket</th>
                                    <th style="width:20%">Jenis Pasien</th>
                                    <th style="width:5%">Aksi</th>
                                </tr>
                              </thead>
                              <tbody id="tabel_daftar_loket">
                              </tbody>
                            </table>
                            
                          </div>
                          
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('pasien/pengaturan-loket/modal-tambah')
@include('pasien/pengaturan-loket/modal-edit')
@include('pasien/pengaturan-loket/modal-delete')

@endsection


@section('js')


<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.btn-spin').hide();
    })
    $(document).on("click",".btn-submit", function () {
        $('.btn-spin').show();
    })
    $(document).on("click",".btn-delete", function () {
        $('.btn-spin').show();
    })
    $(document).on("click",".btn-batal", function () {
        $('.btn-spin').hide();
    })

    $(document).on("click","#btn_delete", function () {
        var url = $(this).data('url');
        var nama = $(this).data('nama');
        $(".selected").removeClass("selected");
        $(this).parent().parent().addClass("selected");
        $('#form_delete').attr('action',url);
        $("#show-name").html('Anda yakin ingin menghapus data ' + nama + '?')
    })
    // $('#btn_filter').click(function(){
    //     $('#spinner').removeAttr('class');
    //     $('#data_tabel_daftar_pasien').dataTable().fnDestroy();
    //     loadData();
    // })

    loadData()

    function loadData() {
        table = $('#data_tabel_loket').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        processing: true,
        serverSide: true,
        searching: false,
        pagingType: "full_numbers",
        paging: true,
        lengthMenu: [[10, 15, 25, 50], [10, 15, 25, 50]],
        order: [[ 1, 'desc' ]],
        language: {
                processing: '<div style="position: absolute; left:50%; top:25%"><i class="fa fa-4x fa-spinner fa-spin text-info"></i></div>'
            },
        ajax: {
            url: BASE_URL + '/pasien/get-loket',
        },
        columns: [
            { data: 'nama_loket' },
            { data: 'jenis_pasien'},
            { data: 'aksi'},
        ],
        });
    }

    $(document).on("click","#btn_edit", function () {
			var url =  $(this).data('url');
			getData(url);
			$(".selected").removeClass("selected");
			$(this).parent().parent().addClass("selected");
			$('#form_edit').attr('action',url);
		});
		function getData(url) {
        $.ajax({
            type: "GET",
            url: url,
			beforeSend:function() {
					$('#loading').removeClass('d-none');
					$('#edit-content').addClass('d-none');
				},
            success: function(data){
                $('#form_edit #nama_edit').val(data.nama_loket);
                $('#form_edit #jenis_pasien_edit').val(data.jenis_pasien);
				$('#loading').addClass('d-none');
				$('#edit-content').removeClass('d-none');
            },
        });
    }
</script>

@endsection