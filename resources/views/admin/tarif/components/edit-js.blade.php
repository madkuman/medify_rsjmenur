<script type="text/javascript">

	
	$('.input-harga').mask("000.000.000.000.000", {reverse: true});
	var trCount = {{count($tarif)}};
	var tbody = $('#harga-tbody');
	$(document).on('click', '#tambahRecord', function(){
		trCount++;
		tbody.append(`@include('admin.tarif.components.create-tr')`);
		$('.input-harga').mask("000.000.000.000.000", {reverse: true});
	});
	$(document).on('click', '.remove', function(el){
		var deleteId = $(this).data('delete');
		if(deleteId !== undefined)
		{
			swal({
			  title: 'Hapus harga ini?',
			  text: "Anda tidak dapat mengembalikan harga yang sudah dihapus",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonClass: 'btn btn-alt-danger',
			  cancelButtonClass: 'btn btn-alt-success',
			  cancelButtonText: 'Tidak',
			  confirmButtonText: 'Ya',
			}).then((result) => {
			  if (result.value) {
			    $("<input>").attr({
	                type: 'hidden',
	                name: `deleted_id[]`,
	                value: deleteId
	            }).appendTo("#edit-form");
	            deleteHarga(this);
			  }
			});
		}
		else {
			deleteHarga(this);
		}
		trCount--;
	});

	function deleteHarga(el){
		$(el).parent().parent().remove();
		reindexNum();
	}
	function reindexNum(){
		$('.index-num').each(function(key, item){
			item.innerText = key+1;
		});
	}

</script>