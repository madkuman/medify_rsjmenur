function saveAlert(type, param, url, name, id) {
  // console.log("abc");
  $('.save-button').on('click', function() {
    var cek = 1;
    var form = document.getElementById(id);
    if(form){
      for(var i=0; i < form.elements.length; i++){
        if((form.elements[i].value == '' || form.elements[i].value == 0) && form.elements[i].hasAttribute('required'))
        {
          cek = 0;
          // $(element).parent().addClass("is-invalid");
          form.elements[i].classList.add("is-invalid");
          // alert('Tolong Isi Semua Data yang Diperlukan!!!');
          // break;
        }
        else if((form.elements[i].value != '' || form.elements[i].value != 0) && form.elements[i].classList.contains("is-invalid"))
        {
          form.elements[i].classList.remove("is-invalid");
        }
      }  
    }
    //console.log(cek);
    if(cek == 1)
    { 
      swal({
        title: "Apakah anda yakin?",
        text: "Pastikan " + name.toLowerCase() + " yang akan disimpan sudah benar",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: 'Tidak', 
        closeOnConfirm: false,
        confirmButtonText: "Ya, saya yakin!",
        confirmButtonColor: "#ec6c62"
      })
      .then((isConfirm) => {
        if(isConfirm.value) {
          if(type == 1) {
            if(name == 'Data pangkat')
              formatToAngka('#gaji');
            
            $(param).submit();
          }
          else if(type == 2) {
            if(name == 'Data pangkat')
              formatToAngka('#salary');
            console.log("tipe 2");
            $(param).attr('action', url + "/" + id).submit();
          }
        }
        else {
          swal("Batal Simpan", name + " tidak disimpan", "error");
        }
      });
    }
    else{
      // console.log(cek);
      document.documentElement.scrollTop = 0;
      callSwal('error','Gagal','Terdapat Masukan yang Kosong',0);
    }    
  });
}

function deleteAlert(param1, param2, url, name) {
  $(param1).on('click', function() {
    let dataId = $(this).data('id');

    swal({
      title: "Apakah anda yakin?",
      text: name + " yang telah dihapus tidak dapat dikembalikan lagi",
      type: "warning",
      showCancelButton: true,
      cancelButtonText: 'Tidak', 
      closeOnConfirm: false,
      confirmButtonText: "Ya, saya yakin!",
      confirmButtonColor: "#ec6c62"
    })
    .then((isConfirm) => {
      if(isConfirm.value) {
        $(param2).attr('action', url + "/" + dataId).submit();
      }
      else {
        swal("Batal Hapus", name + " tidak dihapus", "error");
      }
    });
  });
}

function verifAlert(param1, param2, url, name) {
  $(param1).on('click', function() {
    let dataId = $(this).data('id');

    swal({
      title: "Apakah anda yakin?",
      text: "Pastikan " + name.toLowerCase() + " yang akan diverifikasi sudah benar",
      type: "warning",
      showCancelButton: true,
      cancelButtonText: 'Tidak', 
      closeOnConfirm: false,
      confirmButtonText: "Ya, saya yakin!",
      confirmButtonColor: "#ec6c62"
    })
    .then((isConfirm) => {
      if(isConfirm.value) {
        $(param2).attr('action', url + "/" + dataId).submit();
      }
      else {
        swal("Batal Verifikasi", name + " tidak diverifikasi", "error");
      }
    });
  });
}

function deleteAlertNoUrl(param1, param2, name) {
  $(param1).on('click', function() {
    swal({
      title: "Apakah anda yakin?",
      text: name + " yang telah dihapus tidak dapat dikembalikan lagi",
      type: "warning",
      showCancelButton: true,
      cancelButtonText: 'Tidak', 
      closeOnConfirm: false,
      confirmButtonText: "Ya, saya yakin!",
      confirmButtonColor: "#ec6c62"
    })
    .then((isConfirm) => {
      if(isConfirm.value) {
        $(param2).submit();
      }
      else {
        swal("Batal Hapus", name + " tidak dihapus", "error");
      }
    });
  });
}