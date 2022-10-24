@extends('keuangan.layouts.main')


@section('title')
{{$data->name}} - Kategori - Keuangan
@endsection

@section('css')

<style>
.dataTables_processing {
	background-color: white;
}
</style>
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="block block-rounded">
			<div class="block-header" style="padding-bottom: 0;">
				<div class="block-title row">
					<div class="col-6" style="padding-left: 0;">
						<span><h4 style="margin-bottom: 0;">Detail Kategori</h4></span>
					</div>
					<div class="col-6">
						<a href="{{url('keuangan/pengaturan/kategori/edit')}}/{{$data->id}}" 
							class="btn btn-warning pull-right  mr-5"><i class="fa fa-edit"></i> Edit
						</a>
						<a href="{{url('keuangan/pengaturan/kategori/delete/')}}/{{$data->id}}">
							<button  class="btn btn-danger pull-right mr-5"><i class="fa fa-trash"></i> Delete</button>
						</a>
					</div>
				</div>
			</div>
			<hr>
			<div class="block-content">
				<div class="row">
					<div class="col-6">
						<label>Id Kategori</label>
						<p class="h5">{{$data->id}}</p>
					</div>
					<div class="col-6">
						<label>Nama Kategori</label>
						<p class="h5">{{$data->name}}</p>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<label>Jenis Kategori</label>
						<p class="h5"> @if($data->type == 2) Pengeluaran @else Pemasukan @endif</p>
					</div>
					<div class="col-6">
						<label>Kode Anggaran</label>
						<p class="h5">{{$data->kode_anggaran}}</p>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<label>Sub Kategori Dari</label>
						<p class="h5">{{$nama[0]}}</p>
					</div>
					<div class="col-6">
						<label>Total Anggaran</label>
						<p class="h5">Rp. {{number_format($data->total_anggaran)}}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection




@section('js')

@endsection