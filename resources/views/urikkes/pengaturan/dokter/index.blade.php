@extends('urikkes.layouts.main')

@section('title')
Pengaturan Dokter - Medical Checkup
@endsection

@section('subtitle')
Pengaturan / TTD
@endsection

@section('content')
<main id="main-container">
		@include('urikkes.layouts.navbar')
	<div class="content">
		<div class="row mb-20">
			<div class="col-2  font-w400">
				<a href="{{url('urikkes/pengaturan')}}" class="link-effect text-primary">&larr; Kembali ke pengaturan</a>
			</div>
			<div class="col-10">
				<button  class="btn btn-primary float-right" data-toggle="modal" data-target="#add-dokter">+ Buat Baru</button>
			</div>
		</div>
		<div class="block-content" style="background-color: white">
			<table class="table table-hover table-vcenter">
				<thead>
					<tr>
						<th style="width: 15%">No</th>
						<th style="width: 25%">Sebagai</th>
						<th style="width: 25%">Nama Dokter</th>
						<th style="width: 20%">Keterangan</th>
						<th style="width: 15%">Action</th>
					</tr>
				</thead>
				<tbody>
					@forelse($dokter as $dok)
					<tr>
						<td>{{$loop->iteration}}</td>
						<td>{{$dok->sebagai}}</td>
						<td>{{$dok->nama}}</td>
						<td>{{$dok->keterangan}}</td>
						<td>
							<a href="" class="btn btn-alt-primary btn-square" data-toggle="modal" data-target="#editDokter{{$dok->id}}">
								<i class="fa fa-pencil" aria-hidden="true"></i>
							</a>
							<button href="" class="btn btn-alt-danger btn-square hapus"  data-id="{{$dok->id}}">
								<i class="fa fa-trash" aria-hidden="true"></i>
							</button>
						</td>
					</tr>
					@empty
					<tr>
						<td class="text-center">
							Dokter Pemeriksa Masih Kosong.
						</td>
					</tr>
					@endforelse
				</tbody>
			</table>
		</div>
		<br>
	</div>
</main>
@foreach($dokter as $dok)
@include('urikkes.pengaturan.dokter.modals.edit')
@endforeach
@include('urikkes.pengaturan.dokter.modals.baru')
@endsection

@section('js')
<script type="text/javascript">
	$('.hapus').on('click', function(e) {
		var id = $(this).data('id');
		 $.ajax({
            type:'POST',
            url:'{{url("urikkes/pengaturan/dokter/delete")}}',
            data: {
              "_token": "{{ csrf_token() }}",
              "dokter_id" : id,
            },
            success:function(data){
              swal(
                {
                    title:"Berhasil!",
                    text:"Data dokter pemeriksa berhasil dihapus", 
                    type:"success",
                    timer:3000,
                }).then(function() {
                        location.href = '{{url("urikkes/pengaturan/dokter")}}';
                });
            },
            error:function(data){
              swal(
                {
                   type: "error", 
                   title: "Gagal",
                   text: "Data dokter pemeriksa gagal dihapus",
                    timer:3000,
                });
            }
          });
	})
</script>
@endsection