<script type="text/javascript">
	$('.hpht').on('change',function(){
		var hpht = $(this).datepicker('getDate');
		var date = hpht.getDate();
		var month = hpht.getMonth();
		var year = hpht.getFullYear();

		var tp = new Date(year,month,date + 40 * 7);
		var tp_form = $(this).closest('form').find('.tp');
		tp_form.datepicker('setDate',tp);
	});
	$(".deleteBtn").click(function(e){
		e.preventDefault();
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
	});
	$('#addModal #hamilterakhir').on('change', function() {
		if (this.value == 'Lain-lain') {
			$('#hamilterakhir_lain2').show();
			$('#meninggal').hide();
		}
		else if (this.value == 'Lahir hidup, cukup bulan, meninggal' || this.value == 'Lahir hidup, prematur meninggal'){
			$('#hamilterakhir_lain2').hide();
			$('#meninggal').show();
		} 
		else{
			$('#hamilterakhir_lain2').hide();
			$('#meninggal').hide();	
		}
	});
	$('#addModal input[type=radio][name=pernah_rujuk]').on('change', function() {
		if (this.value == 'Ya') {
			$('#pernah_rujuk_true').show();
		}
		else{
			$('#pernah_rujuk_true').hide();
		}
	});

	$('#addModal #keadaan_ibu').on('change', function() {
		if ($('#keadaan_ibu').val() == 'Meninggal') {
			$('#keadaan_ibu_meninggal').show();
		}

		else{
			$('#keadaan_ibu_meninggal').hide();
		}
	});


	$('#addModal #pergi_rujuk').on('change', function() {
		if ($('#pergi_rujuk').val() == 'Lain-lain') {
			$('#pergi_rujuk_lain2').show();
		}
		else{
			$('#pergi_rujuk_lain2').hide();
		}
	});

	$('#addModal #presentasi_janin').on('change', function() {
		if ($('#presentasi_janin').val() == 'Lain-lain') {
			$('#presentasi_janin_lain2').show();
		}
		else{
			$('#presentasi_janin_lain2').hide();
		}
	});

	$('#addModal #macam_persalinan').on('change', function() {
		if ($('#macam_persalinan').val() == 'Lain-lain') {
			$('#macam_persalinan_lain2').show();
		}
		else{
			$('#macam_persalinan_lain2').hide();
		}
	});

	$('#addModal #komplikasi_persalinan').on('change', function() {
		if ($('#komplikasi_persalinan').val() == 'Lain-lain') {
			$('#komplikasi_persalinan_lain2').show();
		}
		else{
			$('#komplikasi_persalinan_lain2').hide();
		}
	});

	$('#addModal #penolong_persalinan').on('change', function() {
		if ($('#penolong_persalinan').val() == 'Lain-lain') {
			$('#penolong_persalinan_lain2').show();
		}
		else{
			$('#penolong_persalinan_lain2').hide();
		}
	});

	$('#addModal #tempat_persalinan').on('change', function() {
		if ($('#tempat_persalinan').val() == 'Lain-lain') {
			$('#tempat_persalinan_lain2').show();
		}
		else{
			$('#tempat_persalinan_lain2').hide();
		}
	});

	$('#addModal #penyebab_kematian_ibu').on('change', function() {
		if ($('#penyebab_kematian_ibu').val() == 'Lain-lain') {
			$('#penyebab_kematian_ibu_lain2').show();
		}
		else{
			$('#penyebab_kematian_ibu_lain2').hide();
		}
	});

	$('#addModal #keadaan_bayi_lahir').on('change', function() {
		if ($('#keadaan_bayi_lahir').val() == 'Lain-lain') {
			$('#keadaan_bayi_lahir_lain2').show();
		}
		else{
			$('#keadaan_bayi_lahir_lain2').hide();
		}
	});

	$('#addModal #keadaan_bayi_1_minggu').on('change', function() {
		if ($('#keadaan_bayi_1_minggu').val() == 'Lain-lain') {
			$('#keadaan_bayi_1_minggu_lain2').show();
		}
		else{
			$('#keadaan_bayi_1_minggu_lain2').hide();
		}
	});

	$('#addModal #kematian_janin').on('change', function() {
		if ($('#kematian_janin').val() == 'Lain-lain') {
			$('#kematian_janin_lain2').show();
		}
		else{
			$('#kematian_janin_lain2').hide();
		}
	});

	$('#addModal #kematian_janin').on('change', function() {
		if ($('#kematian_janin').val() == 'Tidak Ada') {
			$('#kematian_janin_true').hide();
		}
		else{
			$('#kematian_janin_true').show();
		}
	});

	$('#addModal #penyebab_kematian_bayi').on('change', function() {
		if ($('#penyebab_kematian_bayi').val() == 'Lain-lain') {
			$('#penyebab_kematian_bayi_lain2').show();
		}
		else{
			$('#penyebab_kematian_bayi_lain2').hide();
		}
	});

	//EDIT MODAL
	$('.editBtn').on('click', function(){
		var id = $(this).data('id')
		$(`#editModal${id}`).modal('show')
	});
	$('.edit-modal .hamilterakhir').on('change', function() {
	var id = $(this).data('id')
		var lain = $(this).data('lain')
		var meninggal = $(this).data('meninggal')
		if (this.value == 'Lain-lain') {
			$(lain).show();
			$(meninggal).hide();
		}
		else if (this.value == 'Lahir hidup, cukup bulan, meninggal' || this.value == 'Lahir hidup, prematur meninggal'){
			$(lain).hide();
			$(meninggal).show();
		} 
		else{
			$(lain).hide();
			$(meninggal).hide();	
		}
	});
	$('.edit-modal .pernah-rujuk').on('change', function() {
	var id = $(this).data('id')
		if (this.value == 'Ya') {
			$(id).show();
		}
		else{
			$(id).hide();
		}
	});

	$('.edit-modal .keadaan-ibu').on('change', function() {
	var id = $(this).data('id')
		if (this.value == 'Meninggal') {
			$(id).show();
		}

		else{
			$(id).hide();
		}
	});


	$('.edit-modal .pergi-rujuk').on('change', function() {
	var id = $(this).data('id')
		if (this.value == 'Lain-lain') {
			$(id).show();
		}
		else{
			$(id).hide();
		}
	});

	$('.edit-modal .presentasi-janin').on('change', function() {
	var id = $(this).data('id')
		if (this.value == 'Lain-lain') {
			$(id).show();
		}
		else{
			$(id).hide();
		}
	});

	$('.edit-modal .macam-persalinan').on('change', function() {
	var id = $(this).data('id')
		if (this.value == 'Lain-lain') {
			$(id).show();
		}
		else{
			$(id).hide();
		}
	});

	$('.edit-modal .komplikasi-persalinan').on('change', function() {
	var id = $(this).data('id')
		if (this.value == 'Lain-lain') {
			$(id).show();
		}
		else{
			$(id).hide();
		}
	});

	$('.edit-modal .penolong-persalinan').on('change', function() {
	var id = $(this).data('id')
		if (this.value == 'Lain-lain') {
			$(id).show();
		}
		else{
			$(id).hide();
		}
	});

	$('.edit-modal .tempat-persalinan').on('change', function() {
	var id = $(this).data('id')
		if (this.value == 'Lain-lain') {
			$(id).show();
		}
		else{
			$(id).hide();
		}
	});

	$('.edit-modal .keadaan-ibu').on('change', function() {
	var id = $(this).data('id')
		if (this.value == 'Meninggal') {
			$(id).show();
		}
		else{
			$(id).hide();
		}
	});

	$('.edit-modal .penyebab-kematian-ibu').on('change', function() {
	var id = $(this).data('id')
		if (this.value == 'Lain-lain') {
			$(id).show();
		}
		else{
			$(id).hide();
		}
	});

	$('.edit-modal .keadaan-bayi-lahir').on('change', function() {
	var id = $(this).data('id')
		if (this.value == 'Lain-lain') {
			$(id).show();
		}
		else{
			$(id).hide();
		}
	});

	$('.edit-modal .keadaan-bayi-1-minggu').on('change', function() {
	var id = $(this).data('id')
		if (this.value == 'Lain-lain') {
			$(id).show();
		}
		else{
			$(id).hide();
		}
	});

	$('.edit-modal .kematian-janin').on('change', function() {
	var id_lain = $(this).data('id-lain')
	var id_true = $(this).data('id-true')
		if (this.value == 'Lain-lain') {
			$(id_lain).show();
		}
		else if (this.value == 'Tidak Ada') {
			$(id_true).hide();
			$(id_lain).hide();
		}
		else{
			$(id_lain).hide();
			$(id_true).show();	
		}

		console.log(id_lain);
		console.log(id_true);
	});

	$('.edit-modal .penyebab-kematian-bayi').on('change', function() {
	var id = $(this).data('id')
		if (this.value == 'Lain-lain') {
			$(id).show();
		}
		else{
			$(id).hide();
		}
	});
</script>