<script type="text/javascript">
	$('#btn-add-edit-pembayaran-tambahan').click(function(){
		content = `@include('kasus.datamedis.content.identitas.components.select-edit-pembayaran-tambahan',['active_select_pembayaran_tambahan' => 0])`
		$('#append-pembayaran-tambahan-container').append(content)
	})
	$(document).on("click", ".btn-delete-edit-pembayaran-pembayaran", function(){ 
		$(this).parent().parent().remove();
	})

	function printSEP(){
		var print_sep_url = BASE_URL + "bpjs/sep/{{$kasus->active_sep->no_sep ?? ''}}/print";
		popupwindow(print_sep_url, "Print SEP Pasien", 600, 900);
	}
</script>