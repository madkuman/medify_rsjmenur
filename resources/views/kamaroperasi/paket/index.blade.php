@extends('layouts.main2')

@section('title')
Manajemen Paket - Kamar Operasi - Medify
@endsection

@section('content')
<main id="main-container">
	<div class="content">
		@include('kamaroperasi.components.navbar')
		<div class="row">
			<div class="col-12">
				<div class="block block-rounded">
            <div class="block-header">
              <h3 class="block-title">Manajemen Paket</h3>
							<a href="{{url('kamaroperasi/paket/create')}}" class="btn btn-secondary" style="margin-left: 10px;"><i class="fa fa-plus"></i> Buat Paket Baru</a>
							<hr>
            </div>
            <div class="block-content">
              <table class="table table-bordered table-stripped table-hover">
                <thead>
                  <tr>
                    <th>NO</th>
                    <th>NAMA PAKET</th>
                    <th>TIPE</th>
                    <th>AKSI</th>
                  </tr>
                </thead>
				<tbody>
					@php
						$no = 1;
					@endphp
					@foreach ($pakets as $paket)
						<tr>
							<td>{{ $no++ }}</td>
							<td>{{ $paket->nama }}</td>
							<td>{{ $paket->tipe }}</td>
							<td>
								<a href="{{ url('/kamaroperasi/paket/show/'.$paket->id) }}" rel="tooltip" title="" class="btn btn-info btn-link btn-xs">
									<i class="fa fa-search"></i>
								</a>
								<a href="{{ url('/kamaroperasi/paket/edit/'.$paket->id) }}" rel="tooltip" title="" class="btn btn-info btn-link btn-xs">
									<i class="fa fa-pencil"></i>
								</a>
								<button href="{{ url('/kamaroperasi/paket/delete/'.$paket->id) }}" rel="tooltip" title="" class="btn btn-info btn-link btn-xs delete-data delete_button">
									<i class="fa fa-trash"></i>
								</button>
							</td>
						</tr>
					@endforeach
				</tbody>
              </table>
            </div>
          </div>
        </div>
			</div>
		</div>
</main>
@endsection

@section('js')
  <script>
    $("#manajemen_paket").addClass('active');

		$(".delete_button").click(function(e){
			e.preventDefault();
			var link = $(this).attr('href');
			swal({
				title: "Hapus",
				text: "Apakah anda yakin akan menghapus paket ini?",
				showCancelButton: true,
				reverseButtons: true,
				type: 'warning',
				confirmButtonClass: "btn btn-danger",
				cancelButtonClass: "btn btn-default",
				confirmButtonText: "Hapus",
				cancelButtonText: "Kembali",
				closeOnConfirm: false
			}).then(function(result) {
				if(result.value)
					window.location.href = link;
			});
		});
  </script>
@endsection
