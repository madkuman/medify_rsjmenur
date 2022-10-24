<script type="text/javascript">
function pindahRawatInap()
    {
        swal({
            title: 'Apakah anda yakin untuk memindahkan pasien ke ruangan lain?',
            text: "Anda tidak dapat mengembalikan pasien ke ruangan sebelumnya",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Pindahkan Pasien!',
            confirmButtonClass: 'btn btn-primary ml-10',
            cancelButtonClass: 'btn btn-outline-danger ',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                //window.open("{{url()->current()}}/rawatinap/pindah","Ruangan Baru Pasien", "height=200,width=200,modal=yes,alwaysRaised=yes");
                window.location = "{{url()->current()}}/rawatinap/pindah";
            }
        })
    }


    function daftarInap()
    {
        $('#daftar_inap_modal').modal('show');
    }
    $('#submitDaftarInap').click(function() {
	    submitInap();
	});

	function submitInap() {
	    var formData = new FormData();
        var kk = $('#kepala-keluarga').val();
        var diagnosis = $('#diagnosis').val();
	    formData.append('nomor_kasus', "{{$kasus->nomor_kasus}}");
	    formData.append('keterangan', $('#keterangan-inap').val());
        formData.append('kepala_keluarga', $('#kepala-keluarga').val());
        formData.append('diagnosis', $('#diagnosis').val());
        $('#loadingInap').show();
        $('#inapButtons').hide();
	    $.ajax({
	        type: "POST",
	        url: API_URL + "/kasus/administrasi/rawatinap/daftar",
	        enctype: 'multipart/form-data',
	        contentType: false,
	        processData: false,
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        data: formData,
	        success: function (response) {
                $('#loadingInap').hide();
                $('#inapButtons').show();
	            callSwal(response.status, response.title, response.message, 0).then((result) => {
                    if(response.status != "error")
                        location.reload();
                })
                if(response.status != "error")
	               popupwindow(`{{url()->current()}}/rawatinap/print-permintaan-opname/${response.transaksi_id}?kk=${kk}&diagnosis=${diagnosis}`,"Permintaan Opname","500","500");
	        },
	        error: function () {
              $('#loadingBayi').hide();
              $('#bayiButtons').show();
	            callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
	        }
	    });
	}
</script>