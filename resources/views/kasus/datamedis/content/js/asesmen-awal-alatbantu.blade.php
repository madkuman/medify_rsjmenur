<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">    
  var form_triage = JSON.parse({!!json_encode(str_replace("`", "'", $form_triage))!!});

  $('.editFormTriage').click(function(e) {
    var id = $(this).data('id');
    $('.id-asesmen').val(id);
    $(this).hide();
    $("#edit-loading-"+id).show();
    var item = JSON.parse(form_triage[id].val);
    var entry = Object.entries(item);
    if(item.jenis == "Form Triage"){
      for (var i = 0; i < entry.length; i++) {
        var key = entry[i][0];
        var val = entry[i][1];
        if(val != null && val != ""){
          $(`#modal-form-triage textarea[name="${key}"]`).html(val);
          $(`#modal-form-triage select[name="${key}"]`).val(val);
          $(`#modal-form-triage :text[name="${key}"]`).val(val);
          $(`#modal-form-triage :checkbox[name="${key}"]`).prop('checked', true);
        }
      }
      $('#modal-form-triage').modal('toggle');
    }
    else{
      $(`#modal-form-triage textarea`).html("");
      $(`#modal-form-triage :text`).val("");
      $(`#modal-form-triage :checkbox`).prop('checked', false);
    }
    $(this).show();
    $("#edit-loading-"+id).hide();
  });

  $(".deleteFormTriage").click(function(e){
    e.preventDefault();
    id = $(this).data("id");
    $('#deleteFormTriageId').val(id);
    swal({
      title: "Hapus",
      text: "Apakah anda yakin akan menghapus asesmen ini?",
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
        $('#formDeleteFormTriage').submit();
      }
    });
  });
</script>