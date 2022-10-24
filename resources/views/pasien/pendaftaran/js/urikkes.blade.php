<script type="text/javascript">
	@if(empty($pasien->tni_pangkat->urikkes_paket_id))
	var default_value_urikkes = 0;
	@else
	var default_value_urikkes = {{$pasien->tni_pangkat->urikkes_paket_id}}
	setDefaultSelectUrikkes();
	@endif

	function setDefaultSelectUrikkes()
	{
		$('#selectPaket').val(default_value_urikkes).trigger('change');
	}


	function setMetodeBayarTunai(){
		var tunai_id = $('#selectPembayaran option[data-tunai="yes"]').val()
		if(tunai_id != undefined){
			$('#selectPembayaran').val(tunai_id).trigger('change');
			lihatMetode(tunai_id)
		}
	}

</script>