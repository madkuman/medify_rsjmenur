<div class="row">
	<div class="col-12 bg-danger">
		<div class="py-10 px-50">
			<form method="POST" id="undanganForm" action="{{url('kasus')}}/{{$kasus->nomor_kasus}}/kolaborator/admin">
				{{csrf_field()}}
				<span class="mb-0 text-white font-w600">Kasus ini belum memiliki DPJP</span>
				<button class="btn btn-alt-danger btn-sm ml-10">Jadi DPJP</button>
				<input type="hidden" name="id" value="{{Auth::user()->id}}" id="inputIDUndangan">
			</form>
		</div>
	</div>
</div>