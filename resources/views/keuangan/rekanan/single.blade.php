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
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				<a href="{{url('keuangan/pengaturan/kategori/edit')}}/{{$data->id}}" 
					class="btn btn-warning pull-right  mr-5"><i class="fa fa-edit"></i> Edit
				</a>
				<a href="{{url('keuangan/pengaturan/kategori/delete/')}}/{{$data->id}}">
					<button  class="btn btn-danger pull-right mr-5"><i class="fa fa-trash"></i> Delete</button>
				</a>
			</h3>
		</div>
		<hr>
		<div class="block-content">
			<div class="row">
				<div class="col-6">
                    <label>Id Rekanan</label>
                    <p class="h5">1234567</p>
                </div>
                <div class="col-6">
                    <label>Jenis Pimpinan</label>
                    <p class="h5">Kepala Departmen</p>
                </div>
			</div>
			<div class="row">
				<div class="col-6">
                    <label>Nama Rekanan</label>
                    <p class="h5">Rekan Kerja</p>
                </div>
                <div class="col-6">
                    <label>Nama Direktur</label>
                    <p class="h5">Kevin Fachreza</p>
                </div>
			</div>
			<div class="row">
				<div class="col-6">
                    <label>NPWP</label>
                    <p class="h5">12345678</p>
                </div>
                <div class="col-6">
                    <label>Alamat</label>
                    <p class="h5">Medayu no.70 Surabaya</p>
                </div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')

@endsection