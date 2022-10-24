
<script>


	$("#ganti_dokter_dropdown").select2({
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
		
	$(".ganti_dokter_child_dropdown").select2({
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
	
	function addDokterChildSelect2()
	{
		$(".ganti_dokter_child_dropdown").select2({
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
	}

	$(document).ready(function(){
		var field = 
		`<div class="form-group">
		<div class="row">
		<input type="hidden" name="id[]" value="0">
		<label class="col-5 child-field">Judul Operasi</label>
		<label class="col-5 ml-5 child-field">Dokter Penanggung Jawab</label>
		<input type="text" class="col-5 form-control ml-15 mr-5 child-field" autocomplete="off" name="judul_child[]" placeholder="Masukkan Judul Operasi" required>
		<select class="js-select2 col-5 form-control ml-15 ganti_dokter_child_dropdown child-field" style="width: 45%;" name="dokter_child[]" data-placeholder="Pilih Dokter" required>
		<option value="{{$child->doctor_id or $transaksi->doctor_id}}" selected="">{{$child->dokter->name or $transaksi->dokter->name}}</option>
		</select>
		<a href="javascript:void(0);" class="remove_button col-1 pr-0 child-field"><span class="fa fa-2x fa-trash" style="color: red;"></a>
		</div>
		</div>`;
		$('#add-operasi-join-btn').click(function(){
			$('#operasi-join-container').append(field);
			addDokterChildSelect2();
		});
		$('#operasi-join-container').on('click', '.remove_button', function(e){
			e.preventDefault();
			$(this).parent('div').remove();
		});

	});
</script>