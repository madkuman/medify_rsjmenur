@extends('unit-tindakan.layouts.main')

@section('title')
Pengaturan - {{$tindakan->nama}} - Unit Tindakan
@endsection

@section('subtitle')
{{$tindakan->nama}} / Pengaturan
@endsection

@section('content')
<div class="block">
	<div class="block-header block-header-default row mx-0">
		<h3 class="block-title col-lg-10 col-sm-12 pl-0">Pengaturan Unit {{$tindakan->nama}}</h3>
		<div class="col-lg-2 col-sm-12 pl-0">
            <button class="btn btn-danger my-5" type="button" data-toggle="modal" data-target="#delete-unit" data-dismiss="modal"><span class="fa fa-trash"></span> Hapus Unit Tindakan</button>
        </div>
	</div>
	<div class="block-content">
		<div class="row">
			<form method="POST" class="col-lg-4 col-sm-12">
				{{csrf_field()}}
				<div class="form-group row">
					<label class="col-12" for="example-text-input">Nama Unit Tindakan</label>
					<div class="col-12">
						<input type="text" class="form-control" name="nama" value="{{$tindakan->nama}}" required>
					</div>
				</div>
				<div class="form-group">
                    <label>Lokasi Unit </label>
                    <select class="js-select2 form-control" id="kategori-select2" name="lokasi_id" style="width: 100%;" disabled>
                        <option value="">Pilih Lokasi Unit</option>
                        @foreach($lokasi as $l)
                            <option value="{{$l->id}}" @if($tindakan->lokasi_id == $l->id) selected @endif>{{$l->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Poliklinik Unit </label>
                    <select class="js-select2 form-control" id="kategori-select2" name="poli_id" style="width: 100%;">
                        <option value="0" selected="">Tidak Terhubung Poli</option>
                        @foreach($poli as $p)
                            <option value="{{$p->id}}" @if($tindakan->poli_id == $p->id) selected @endif>{{$p->name}}</option>
                        @endforeach
                    </select>
                </div>
				<div class="form-group">
					<input type="hidden" name="id" value="{{$tindakan->id}}">
					<button class="btn btn-primary btn-hero pull-right mb-5">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="delete-unit" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-popout" role="document">
        <div class="modal-content">
            <div class="block block-transparent mb-0">
                <div class="block-content" style="background-color: #fafafa">
                    <form class="js-validation-be-contact" action="{{url()->current()}}/delete" method="POST">
                        {{ csrf_field() }}

                        <input type="hidden" name="id" value="{{$tindakan->id}}">
                        <h5 class="font-w400">
                            Apakah anda yakin akan menghapus unit tindakan ini?
                        </h5>

                        <div class="form-group row">
                            <div class="col-12">
                                <button type="button" data-dismiss="modal" class="btn-alt btn-hero btn-regular min-width-100 float-right">Batal
                                </button>
                                <button type="submit" class="btn-alt btn-hero btn-danger min-width-100 float-right">
                                    <i class="fa fa-check mr-5"></i> Hapus
                                </button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css')
<style type="text/css">
.clickable-row {
	cursor: pointer;
}
</style>
@endsection

@section('js')
@endsection