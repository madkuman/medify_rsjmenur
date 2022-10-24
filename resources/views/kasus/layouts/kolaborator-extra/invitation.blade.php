<div class="row">
	<div class="col-12 bg-primary">
		<div class="py-10 px-50">
			<form method="POST" id="undanganForm" action="{{url('api/kasus/kolaborator/terima-undangan')}}">
				{{csrf_field()}}
				<span class="mb-0 text-white font-w600">Anda memiliki undangan di kasus ini</span>
				<button class="btn btn-alt-primary btn-sm ml-10">Terima Undangan</button>
				<input type="hidden" name="id" value="{{$kasus->my_invitation->id}}" id="inputIDUndangan">
			</form>
		</div>
	</div>
</div>