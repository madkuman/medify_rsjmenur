<script type="text/javascript">
	$('.input-implementasi').select2({
		closeOnSelect: false
	});

	$('.toggleFormBtn').click(function(){
		var method = $(this).data('method')

		if(method == 'create')
		{
			$('#modalForm .input-id').val('')
			$('#modalForm .input-jam').val('')
			$('#modalForm .input-diagnosis').val(0).trigger('change')
			$('#modalForm .input-implementasi').val("").trigger('change')
			$('#modalForm .input-evaluasi').val('')
		}
		if(method == 'edit')
		{
			$('#modalForm .input-id').val($(this).data('id'))
			$('#modalForm .input-jam').val($(this).data('jam'))
			$('#modalForm .input-diagnosis').val($(this).data('diagnosis')).trigger('change')

			$('#modalForm .input-implementasi').val($(this).data('implementasi')).trigger('change')
			$('#modalForm .input-evaluasi').val($(this).data('evaluasi'))
		}

		$('#modalForm').modal('show')
	})
	$('#modalForm .input-diagnosis').change(function(){
		var content = $(this).find(':selected').data('content');
		var value = $(this).val();
		$('#modalForm .input-implementasi').empty().trigger("change");

		$.each(value, function( v_index, v_item ) {
			var implementasi_items = implementasi_array[v_item]
			console.log({v_item,implementasi_items})
			$.each(implementasi_items, function( index, item ) {
				// var newOption = new Option(item.konten, item.id, false, false);
				var newOption = '<option value="'+item.id+'" data-diagnosa="'+item.diagnosa+'">'+item.konten+'</option>'
				$('#modalForm .input-implementasi').append(newOption).trigger('change');
			});
		});
	})

	$('.deleteBtn').click(function(){	
		id = $(this).data("id");
		$('#deleteInputId').val(id);
		swal({
			title: "Hapus",
			text: "Apakah anda yakin akan menghapus data ini?",
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
			{
				$('#formDelete').submit();
			}
		});
	})
	var implementasi_array = []

@foreach($kasus_asuhan as $item)
@php $array = [] @endphp
    @if ($item->checked_opsi_mandiri != 'N;')
        @foreach ((unserialize($item->checked_opsi_mandiri)) as $checked_mandiri)
            @php 
                $item_implementasi = $item->asuhan->detail->where('id', $checked_mandiri)->first();
                $temp = new \stdClass();
                $temp->id = $item_implementasi->id;
                $temp->konten = $item_implementasi->konten;
                $temp->diagnosa = $item->asuhan->diagnosa;
                $array[] = $temp;
            @endphp
        @endforeach
    @endif
    @if ($item->mandiri_tambahan != NULL)
    	@php
        $temp = new \stdClass();
        $temp->id = 0;
        $temp->konten = $item->mandiri_tambahan;
        $temp->diagnosa = $item->asuhan->diagnosa;
        $array[] = $temp;
        @endphp
    @endif 

    @if ($item->checked_opsi_kolaborasi != 'N;')
        @foreach ((unserialize($item->checked_opsi_kolaborasi)) as $checked_kolaborasi)
            @php 
                $item_implementasi = $item->asuhan->detail->where('id', $checked_kolaborasi)->first();
                $temp = new \stdClass();
                $temp->id = $item_implementasi->id;
                $temp->konten = $item_implementasi->konten;
                $temp->diagnosa = $item->asuhan->diagnosa;
                $array[] = $temp;
            @endphp
        @endforeach
    @endif
    @if ($item->kolaborasi_tambahan != NULL)
    	@php
        $temp = new \stdClass();
        $temp->id = 0;
        $temp->konten = $item->kolaborasi_tambahan;
        $temp->diagnosa = $item->asuhan->diagnosa;
        $array[] = $temp;
        @endphp
    @endif 
	implementasi_array[{{$item->asuhan->id}}] = {!! json_encode($array) !!}
@endforeach


	$('.input-implementasi').on("change", function(e) { 
		var data = $('.input-implementasi').select2('data')
		var array = [];
		$.each(data, function( index, value ) {
			var object = {id : value.id, text : value.text, diagnosa: $(value.element).data('diagnosa')}
			array.push(object)
		});
		if(array.length > 0)
		{
			var data_json = JSON.stringify(array)
			$('.input-implementasi-text').val(data_json)	
		}
		else $('.input-implementasi-text').val('')	
	});
</script>