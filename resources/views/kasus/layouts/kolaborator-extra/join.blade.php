<div class="row">
	<div class="col-12 bg-success">
		<div class="py-10 px-50">
			<form method="POST" id="undanganForm" action="{{url('api/kasus/kolaborator/join')}}">
				{{csrf_field()}}
				<input type="hidden" value="{{$kasus->id}}" name="kasus_id">
				<span class="mb-0 text-white font-w600">Anda belum menjadi kolaborator di kasus ini. "Jadi Kolaborator" agar anda bisa menginput data pada kasus ini.</span>
				<button class="btn btn-alt-success btn-sm ml-10">Jadi Kolaborator</button>
			</form>
		</div>
	</div>
</div>