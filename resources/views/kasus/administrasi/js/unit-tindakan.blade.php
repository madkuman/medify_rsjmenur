<script type="text/javascript">
 
  $('#unit-tindakan-submit').click(function() {
    submitUnitTindakan();
  });

  function submitUnitTindakan() {
    var formData = new FormData();
    formData.append('nomor_kasus', "{{$kasus->nomor_kasus}}");
    formData.append('unit_tindakan', $('#unit-tindakan').val());
    formData.append('keterangan', $('#unit-tindakan-keterangan').val());

    $('#loading-unit-tindakan').show();
    $('.unit-tindakan-button').hide();
    $.ajax({
        type: "POST",
        url: API_URL + "/kasus/administrasi/unit-tindakan/pendaftaran",
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function (response) {
          $('#loading-unit-tindakan').hide();
          $('.unit-tindakan-button').show();
            callSwalString(response);
            // window.open("{{url()->current()}}/rawatinap/pindah","_blank");
            $('#unit-tindakan-modal').modal('hide');
        },
        error: function () {
            callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
          $('#loading-unit-tindakan').hide();
          $('.unit-tindakan-button').show();
          $('#unit-tindakan-modal').modal('hide');
        }
    });
  }

 
  function callSwalString(string)
  {
      var response = JSON.parse(string);
      callSwalNewtab(response.status,response.title,response.message,0)

  }
</script>