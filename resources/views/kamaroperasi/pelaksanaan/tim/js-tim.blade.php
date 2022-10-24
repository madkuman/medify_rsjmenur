<script type="text/javascript">



	var append_tim = function(initials = null){
		if(initials)
		{
			selected_anggota = '<option value="'+initials.detail.id+'">'+initials.detail.name+'</option>';
			init_user = initials.user;
			init_role = initials.role;
		}
		else
		{
			init_user = null;
			init_role = null;
			selected_anggota = '';
			selected_role = '';
		}
		$("#form_tim").append(`
			<div class="row alatform">
			<div class="col-5">
			<label>Peran</label>
			<select class="js-select2 form-control select2_role" style="width: 100%;" name="peran[]" data-placeholder="Masukkan Peran">
			<option></option>
			@foreach ($peran_tim as $role)
			<option value="{{ $role->id }}">{{ $role->nama }}</option>
			@endforeach
			</select>
			</div>
			<div class="col-6">
			<label>Anggota</label>
			<select class="js-select2 form-control select2_user" style="width: 100%;" name="namatim[]" data-placeholder="Masukkan Nama">
			`+selected_anggota+`
			</select>
			</div>
			<div class="col-1">
			<label></label>
			<button type="button" class="btn btn-danger btn_delete" onclick="delete_button(this)"><i class="fa fa-trash"></i></button>
			</div>
			</div>
			`);
		Codebase.helpers(['select2']);
		$(".select2_user").last().select2({
			data : init_user,
			ajax : {
				url: '{{ url('ajax/kamaroperasi/search_tim') }}',
				delay: 250,
				dataType: 'json',
				data: function (params) {
					var query = {
						search: params.term,
					}
					return query;
				},
				processResults: function (data) {
					return {
						results: data
					};
				},
			}
		});
		if (init_role)
		{
			$(".select2_role").last().val(init_role.id).change();
		}
	};
	
	$("#add_more_tim").click(function(){
		append_tim();
	});


	@if ($tims->count())
		$.ajax({
			url: '{{ url('ajax/kamaroperasi/rencana/tim') }}',
			dataType: 'json',
			data: {
				id: {{ $transaksi->id }}
			},
			success: function(data){
				$.each(data, function(ind, val){
					initials = {
						detail: {id: val.detail.id, name: val.detail.name},
						role: {id: val.role.id, name: val.role.nama},
					};
					append_tim(initials);
				});
			}
		});
		@else
		append_tim();
		@endif

	$("#tim_submit_button").click(function(){
		var len_user = $('.select2_user').filter(function(){
			return !$(this).val();
		}).length;
		var len_role = $('.select2_role').filter(function(){
			return !$(this).val();
		}).length;
		if (len_user == len_role && len_user != 1 && len_role != 1) {
			$("#submit_tim").submit()
		}
		else
		{
			swal({
				title: "Gagal",
				text: "Pastikan Anggota Tim dan Peran sudah terisi semua!",
				type: 'error',
				confirmButtonClass: "btn btn-primary"
			});
		}
	});
</script>