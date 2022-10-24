@extends('kepegawaian.layouts.main')

@section('title')
{{$user->name}} Kuota Cuti
@endsection

@section('subtitle')
Cuti
@endsection

@section('content')
<div class="container">
	<h3 class="mb-0">Kuota Cuti</h3>
	@include('kepegawaian.cuti.components.navbar-hr')
	<div class="block mt-10">
		<div class="block-header block-header-default">
			<h3 class="block-title">{{$user->name}}</h3>
			<button class="btn btn-secondary btn-add">Tambah Cuti</button>
			<hr>
		</div>
		@include('kepegawaian.cuti.kuota-hr.single.kuota-cuti-blocks')
		@include('kepegawaian.cuti.kuota-hr.single.table-mutasi')
	</div>
</div>

<form method="post" action="{{url()->current()}}/delete" id="form-delete">
	{{ csrf_field() }}
	<input type="hidden" id="id-delete" name="id">
</form>

@include('kepegawaian.cuti.kuota-hr.single.modal-form-kuota-cuti')
@endsection

@section('js')
@include('kepegawaian.cuti.kuota-hr.single.table-mutasi-js')
<script type="text/javascript">

    var today = "{{\Carbon\Carbon::today()->format('d-m-Y')}}"

    $(document).on("click",".btn-add", function () {
        $('#main-form').trigger('reset');
        $('#input-id').val(0);
        $('#input-jenis-cuti').val('bulanan');
        $('#input-jumlah-cuti').val('');
        $('#modal-option').text('Tambah');
        $('.btn-delete').hide()
        $('#modal-form-kuota-cuti').modal('show');
    })

    $(document).on("click",".btn-edit", function () {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var jenis_cuti = $(this).data('jenis-cuti');
        var jumlah_cuti = $(this).data('jumlah-cuti');

        $('#main-form').trigger('reset');
        $('#input-id').val(id);
        $('#input-nama').val(nama);
        $('#input-jenis-cuti').val(jenis_cuti);
        $('#input-jumlah-cuti').val(jumlah_cuti);
        $('#modal-option').text('Edit');
        $('.btn-delete').show()
        $('#modal-form-kuota-cuti').modal('show');
    })

	$(document).on('click', '.btn-delete', function(){ 
		id = $('#input-id').val();
        $('#modal-form-kuota-cuti').modal('hide');
		$('#id-delete').val(id);
		swal({
			title: "Hapus",
			text: "Apakah anda yakin akan menghapus data ini?",
			showCancelButton: true,
			reverseButtons: true,
			type: 'warning',
			confirmButtonClass: "btn btn-danger",
			cancelButtonClass: "btn btn-default",
			confirmButtonText: "Hapus",
			cancelButtonText: "Batal",
			closeOnConfirm: false
		}).then(function(result) {
			if(result.value)
			{
				$('#form-delete').submit();
			}
		});
	})
</script>
@endsection