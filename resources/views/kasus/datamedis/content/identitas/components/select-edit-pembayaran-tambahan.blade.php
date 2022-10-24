<div class="row mt-10">
	<div class="col-8">
		<select class="form-control" data-size="5" name="pembayaran_tambahan[]" style="width: 100%;">
			<option @if($active_select_pembayaran_tambahan == 0) selected @endif disabled>Pilih Pembayaran</option>
			@foreach($metode as $item)
			<option value="{{$item->id}}" @if($active_select_pembayaran_tambahan == $item->id) selected @endif>{{$item->perusahaan->nama ?? '-'}} - {{$item->no_asuransi}} - Kelas {{$item->kelas->nama ?? '-'}}</option>  
			@endforeach
		</select>
	</div>
	<div class="col-2">
		<button type="button" class="btn btn-outline-danger btn-delete-edit-pembayaran-pembayaran"><i class="fa fa-trash"></i></button>
	</div>
</div>