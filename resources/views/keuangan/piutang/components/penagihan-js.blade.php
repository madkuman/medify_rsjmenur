<script type="text/javascript">
  var target_print, tipe_print;
    function printPenagihan(el, jenis, link=''){
        var names = $('.invalid-'+jenis);
        var jenisFormatted = jenis.replace(/-/g, " ");
        var html = "Pasien ini tidak memiliki "+jenisFormatted+": <br>";
        var href = $(el).data('href');
        if(names.length == 0 ){
          if($(el).data('ttd')){
            target_print = link;
            tipe_print = "window";
            $("#modal-ttd").modal('show');
          }
          else{
            console.log($(el).data('ttd'));
            window.open(href, 
             'newwindow', 
             `width=${screen.width},height=${screen.height}`);
          }
          return;
        }
        $.each(names, function(index, val){
            html += `- ${$(val).val()}<br>`;
        });
        print_enable = true;
        if(names.length == {{count($piutang)}})
            print_enable = false;
        swal({
          title: 'Peringatan',
          html: html,
          type: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value && print_enable) {
            window.open(href, 
               'newwindow', 
               `width=${screen.width},height=${screen.height}`);
        }
    });
  }

  function printPenagihanAll(el, id, nama){
        var names = $('.invalid-'+id);

        var html = "Pasien berikut tidak memiliki Data Berikut: <br>";
        var href = $(el).data('href');

        if(names.length == 0 ){
            $("#modal-ttd").modal('show');
            target_print=href;
            tipe_print = "window";
            return;
        }
        $.each(names, function(index, val){
            html += `- ${$(val).data('invalid')}<br>`;
        });
        print_enable = true;
        if(names.length == {{count($piutang)}})
            print_enable = false;
        swal({
          title: 'Peringatan',
          html: html,
          type: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value && print_enable) {
            $("#modal-ttd").modal('show');
            target_print=href;
            tipe_print = "window";
        }
    });
  }
  $(document).on('click', '#btn-tagihkan', function(){
    $("<input>").attr({
      type: 'hidden',
      name: 'nomor_surat',
      value: $("#nomor_surat").val(),
    }).appendTo("#piutangForm");
    $("<input>").attr({
      type: 'hidden',
      name: 'judul',
      value: $("#judul").val(),
    }).appendTo("#piutangForm");
    swal({
      title: 'Kirim Penagihan?',
      text: "Penagihan tidak dapat diubah kembali",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya'
    }).then((result) => {
      if (result.value) {
        $("#piutangForm").submit();
      }
    })
  });

  $(document).on('click', '.btn-print', function(){
    target_print = $(this).data('href');
    if($(this).data('ttd')){
      $("#modal-ttd").modal('show');
    }
    else{
      window.open(target_print, '_blank');
    }
  });
  $(document).on('click', '#submit_print', function(){
    var ttd = $('#mengetahui').val();
    if(target_print.indexOf('?') != -1){
      target_print +='&ttd='+ttd;
    }
    else {
      target_print +='?ttd='+ttd;
    }
    window.open(target_print, 
       'newwindow', 
         `width=${screen.width},height=${screen.height}`);
  });
  $(document).on('click', '#btn-tambahkan-piutang', function(){
    if($(this).data('valid') == 0){
      swal('Gagal',
        'Tidak dapat menagihkan pembayaran BPJS dan Non BPJS sekaligus',
        'error');
      return true;
    }
    $('#modal_penagihan').modal('show');
  });
  $(document).on('click', '#btn_tagihkan', function(){
    if($(this).data('valid') == 0){
      swal('Gagal',
        'Tidak dapat menagihkan pembayaran BPJS dan Non BPJS sekaligus',
        'error');
      return true;
    }
    $('#modal_tagihkan').modal('show');
  })
  $(document).on('click', '.download-piutang-btn', function(e){
    var href = $(this).data('href');
    // const swal = swal.mixin({

    //   buttonsStyling: false,
    // })

    swal({
      title: 'Download File',
      text: "Pilih nama file",
      type: 'info',
      showCancelButton: true,
      confirmButtonText: 'Nomor SEP',
      cancelButtonText: 'Original',
      confirmButtonClass: 'btn btn-success',
      cancelButtonClass: 'btn btn-info',
      reverseButtons: true
    }).then((result) => {
      if (result.value) {
        window.open(`${href}?tipe=sep`, 'newwindow', `width=${screen.width},height=${screen.height}`);
      } else{
        window.open(`${href}?tipe=ori`, 'newwindow', `width=${screen.width},height=${screen.height}`);
      }
    })
  })
</script>