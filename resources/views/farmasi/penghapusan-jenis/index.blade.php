@extends('farmasi.layouts.main')

@section('title')
Master Penghapusan Jenis
@endsection

@section('css')

<style type="text/css">
    .inline {
        display: inline;
    }
    .modal-content {
        border-radius: 0;
    }
    .clickable-row {
        cursor: pointer;
    }
    .mt-70 {
        margin-top: 70px !important;
    }
</style>
@endsection

@section('content')
    <div class="block" style="min-height: 350px">
        <div class="block-header block-header-default">
            <h3 class="block-title">Master Penghapusan Jenis</h3>
            <div class="block-options">
                <button type="button" class="btn btn-sm btn-primary btn-square editBtn">
                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Master Penghapusan Jenis Baru
                </button>
            </div>
        </div>
        <div class="block-content">
            <div class="block block-transparent">            
            <table class="table table-striped table-hover table-vcenter js-dataTable-full" id="main_table" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%">ID</th>
                        <th style="width: 25%">Nama</th>
                        <th class="text-center" style="width: 10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penghapusan_jenis as $item)
                        <tr>    
                            <td class="text-center">{{$item->id}}</td>
                            <td>{{$item->nama}}</td>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-alt-warning editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}" data-toggle="tooltip" title="Edit">
									<i class="fa fa-edit"></i>
								</button>
								<button class="btn btn-sm btn-alt-danger remove" id="remove" data-id="{{$item->id}}" data-toggle="tooltip" title="Delete">
									<i class="fa fa-trash"></i>
								</button>
                            </td>
                        </tr>
                    @endforeach
                        
                </tbody>
            </table>
        </div>
    </div>

    <form method="POST" action="{{url()->current()}}/delete" id="formDelete">
        {{csrf_field()}}
        <input name="id" type="hidden" id="deleteInputId">
        
    </form>

    @include('farmasi.penghapusan-jenis.modal')
@endsection

@section('js')
<script type="text/javascript">
    var data = JSON.parse({!!json_encode(str_replace("`", "'", $penghapusan_jenis))!!});

    var table = jQuery('.js-dataTable-full').dataTable({
            "ordering": true,
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            autoWidth: false
        });

    $(".editBtn").click(function(e){
        id = $(this).data("id");
        var item = data[$(this).data("index")];
        if(item != "" && item != undefined){
            $("#id").val(item.id);
            @include("farmasi.penghapusan-jenis.js-form-edit")
        }else{
            $("#id").val(0);
            @include("farmasi.penghapusan-jenis.js-form-create")
        }
        $("#modal-large").modal("toggle");
    });

    $(".remove").click(function(e){
		e.preventDefault();
		id = $(this).data("id");
		$("#deleteInputId").val(id);
		swal({
			title: "Hapus",
			text: "Apakah anda yakin akan menghapus data ini?",
			showCancelButton: true,
			reverseButtons: true,
			type: "warning",
			confirmButtonClass: "btn btn-danger",
			cancelButtonClass: "btn btn-default",
			confirmButtonText: "Hapus",
			cancelButtonText: "Kembali",
			closeOnConfirm: false
		}).then(function(result) {
			if(result.value)
			{
				$("#formDelete").submit();
			}
		});
	});
</script>
@endsection
{{-- @section('js')
    <script type="text/javascript" src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    @include('farmasi.item.components.js')
@endsection --}}