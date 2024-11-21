<script type="text/javascript">
    function bayiBaruLahir() {
        $('#bayi_modal').modal('show');
    }


    $('#submitBayi').click(function() {
        var jk = $('#selectJenisKelamin').val()
        var ruangan = $('#selectRuanganBayi').val()
        var error = 0;

        if (jk == "") {
            $('#errorBayiSelectJenisKelamin').show();
            error = 1;
        } else $('#errorBayiSelectJenisKelamin').hide();
        if (ruangan == "") {
            $('#errorBayiSelectRuanganBayi').show();
            error = 1;
        } else $('#errorBayiSelectRuanganBayi').hide();

        if (error == 0) submitBayi();
    });

    function submitBayi() {
        var formData = new FormData();
        formData.append('nomor_kasus', "{{ $kasus->nomor_kasus }}");
        formData.append('no_sep', $('#nomor_sep').val());
        formData.append('jenis_kelamin', $('#selectJenisKelamin').val());
        formData.append('is_intensif', $('#is_intensif').prop('checked') ? 1 : 0);
        formData.append('bed', $('#selectRuanganBayi').val());

        $('#loadingBayi').show();
        $('#bayiButtons').hide();
        $.ajax({
            type: "POST",
            url: API_URL + "/kasus/administrasi/bayi-lahir",
            enctype: 'multipart/form-data',
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function(response) {
                $('#loadingBayi').hide();
                $('#bayiButtons').show();
                callSwalString(response);
                // window.open("{{ url()->current() }}/rawatinap/pindah","_blank");
                $('#bayi_modal').modal('hide');
            },
            error: function() {
                callSwal('error', 'Transaksi Gagal', 'Silahkan Coba Lagi', 0);
                $('#loadingBayi').hide();
                $('#bayiButtons').show();
                $('#bayi_modal').modal('hide');
            }
        });
    }


    function callSwalString(string) {
        var response = JSON.parse(string);
        callSwalNewtab(response.type, response.title, response.text, 0)

    }
    $('#is_intensif').change(function() {
        //console.log($('#is_intensif').val());
        var intensif;
        /*if($(this[0]).prop('checked',false)){
              $(this[0]).prop('checked',true)
              intensif = 1;
           }
           else{
                $(this[0]).prop('checked',false)
                intensif = 0;
           }*/
        if ($('#is_intensif').is(':checked')) {
            intensif = 1;
        } else {
            intensif = 0;
        }
        console.log($('#is_intensif'), intensif);
        // requestRuangan(intensif);
    });
    $('#selectRuanganBayi').select2({
        ajax: {
            url: API_URL + "/kasus/administrasi/rawatinap/ruang-kosong-bayi",
            dataType: 'json',
            data: function(params) {
                $('#loadingRuangBayi').show();
                var query = {
                    keyword: params.term,
                    is_bayi: 1,
                    is_intensif: ($('#is_intensif').is(':checked')) ? 1 : 0,
                    nomor_kasus: "{{ $kasus->nomor_kasus }}"
                }
                return query;
            },
            processResults: function(data, params) {
                bed = data.data;
                $('#loadingRuangBayi').hide();
                return {
                    results: $.map(bed, function(obj) {
                        return {
                            id: obj.id,
                            text: obj.ruangan.bangsal.nama + " - " +
                                obj.ruangan.nama + " - " +
                                obj.nama +
                                " (Kelas " + obj.ruangan.kelas_ruang.nama + ")"
                        };
                    })
                };
            },
        }
    });

    // function requestRuangan(intensif){

    //   var formData = new FormData();
    //   formData.append('nomor_kasus', "{{ $kasus->nomor_kasus }}");
    //   formData.append('is_bayi', 1);
    //   formData.append('is_intensif', intensif);
    //   console.log(intensif);
    //   $('#loadingRuangBayi').show();
    //   $.ajax({
    //       type: "POST",
    //       url: API_URL + "/kasus/administrasi/rawatinap/ruang-kosong",
    //       enctype: 'multipart/form-data',
    //       contentType: false,
    //       processData: false,
    //       headers: {
    //           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //       },
    //       data: formData,
    //       success: function (response) {
    //         console.log(JSON.parse(response));
    //         data = JSON.parse(response).data;
    //         $('#selectRuanganBayi').empty();
    //         $('#selectRuanganBayi').append(new Option("", "", false, false));
    //         for (var i = 0; i < data.length; i++) {
    //           var text =  data[i].ruangan.bangsal.nama + " - "+ 
    //                       data[i].ruangan.nama+ " - "+ 
    //                       data[i].nama 
    //                       " (Kelas "+data[i].ruangan.kelas+")";
    //           var newOption = new Option(text, data[i].id, false, false);
    //           $('#selectRuanganBayi').append(newOption);
    //         }
    //         $('#loadingRuangBayi').hide();
    //       },
    //       error: function () {
    //           callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
    //           $('#loadingRuangBayi').hide();
    //       }
    //   }); 
    // }
</script>
