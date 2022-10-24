@extends('farmasi.layouts.main')

@section('title')
Farmasi Loket Antrian
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
            <h3 class="block-title">Loket Antrian</h3>
            <div class="block-options">
                <button type="button" class="btn btn-sm btn-primary btn-square editBtn">
                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Loket Antrian Baru
                </button>
            </div>
        </div>
        <div class="block-content">
            <div class="block block-transparent">            
            <table class="table table-striped table-hover table-vcenter js-dataTable-full" id="loket_antrian" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%">No</th>
                        <th class="text-center" style="width: 65%">Nama</th>
                        <th class="text-center" style="width: 20%">Sound</th>
                        <th class="text-center" style="width: 10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loket_antrian as $item)
                        <tr>    
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td>{{$item->nama}}</td>
                            <td>
                                @php
                                    $sound_url = '#javascript:void(0);';
                                    $sound_target = '';
                                    $sound_name = 'Belum Punya Sound';
                                    if(!empty($item->sound)){
                                        $sound_url    = url($item->sound);
                                        $sound_target = '_blank';
                                        $end_name = explode('/', $item->sound);
                                        $sound_name   = end($end_name);
                                    }
                                @endphp
                                <a href="{{$sound_url}}" target="{{$sound_target}}">{{$sound_name}}</a>
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

    @include('farmasi.screen.pengaturan.loket-antrian.modal')
@endsection

@section('js')
<script type="text/javascript">
    var data = JSON.parse({!!json_encode(str_replace("`", "'", $loket_antrian))!!});

    var table = jQuery('.js-dataTable-full').dataTable({
            "ordering": true,
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            autoWidth: false
        });

    $(".editBtn").click(function(e){
        console.log('tes');
        id = $(this).data("id");
        var item = data[$(this).data("index")];
        console.log('tes 2');
        if(item != "" && item != undefined){
            $("#id").val(item.id);
            $(`:text[name="nama"]`).val(item.nama);            
        }else{
            $("#id").val(0);
            $(`:text[name="nama"]`).val("");
        }
        $("#modal-medium").modal("toggle");
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