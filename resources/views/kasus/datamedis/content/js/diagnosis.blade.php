
<script type="text/javascript">
    /*DIAGNOSIS*/
    function diagnosisDeleteModal(id,index)
    {
        $('#diagnosisDeleteModal #diagnosis-id').val(id)
        $('#diagnosisDeleteModal').modal('show');
    }

    $('#modal-create-diagnosis #submit-create-diagnosis').prop('disabled',true);
    var AutoCompleteCreateDiagnosis = function() {

        var ListLayanan = {};
        //console.log(ListLayanan)

        var initAutoComplete = function(){
            jQuery('#modal-create-diagnosis .diagnosis-autocomplete').autoComplete({
                minChars: 2,
                source: function(term, suggest){
                    term = term.toLowerCase();
                    
                    $.ajax({
                        url: API_URL+"/kasus/get/list/diagnosis?keyword="+term,
                        type: 'GET',
                        dataType: 'json',
                        tryCount : 0,
                        retryLimit : 3,
                        beforeSend: function(){
                            $('#diagnosis_error_wrapper').hide();
                        },
                        success: function(response) {
                            data = response.data
                            if(data.length > 0){
                                for (i = 0; i < data.length; i++) {
                                    var suggestword = data[i].code_icd+" - "+data[i].long_desc;
                                    if(data[i].bpjs_support == 0) {
                                        suggestword = suggestword + " <span class='badge badge-danger'>Tidak di Support BPJS</span>";
                                    }
                                    ListLayanan[suggestword] = data[i];
                                    suggestions.push(suggestword);
                                    var suggestword = {};
                                }
                                suggest(suggestions);
                            }
                            else
                            {
                                $('#diagnosis_error_wrapper').text('Diagnosis tidak ditemukan, gunakan keyword lain').show();
                            }
                        },
                        error: function() {
                            this.tryCount++;
                            if (this.tryCount <= this.retryLimit) {
                                $.ajax(this);
                                return;
                            }            
                            return;
                        },
                    });

                    var suggestions    = [];


                },
                onSelect: function(event, term, item) {
                    var text = ListLayanan[term].code_icd + " - " + ListLayanan[term].long_desc
                    $("#modal-create-diagnosis #nama-diagnosis").val(text);
                    $("#modal-create-diagnosis #id-diagnosis").val(ListLayanan[term].id)
                    $('#modal-create-diagnosis #submit-create-diagnosis').prop('disabled',false);
                    //$("#tindakan-input-edit-daftar-id").val(ListLayanan[term].id);
                }
            });
        };

        return {
            init: function () {
                initAutoComplete();
            }
        };
    }();


    function addDiagnosisSuggest(element)
    {
        id = $(element).data("id");
        desc = $(element).data("desc");

        $('#id-diagnosis').val(id)
        $('#nama-diagnosis').val(desc)
        $('#modal-create-diagnosis #submit-create-diagnosis').prop('disabled',false);
    }

    function historiDiagnosis()
    {
        window.open(
        "{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/diagnosis/histori","popUpWindow",
        "height=800,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes");
    }


    $(document).on('click', '.update-plafon', function(){
        var data = $(`#edit_plafon`).serialize();
        if($(".diagnosis-block").length == 0){
            swal('Gagal', "Silahkan isi diagnosis Pasien BPJS terlebih dahulu", 'error');
            return false;
        }
        swal({
            title: 'Update Plafon?',
            text: "Proses ini membutuhkan sedikit waktu",
            type: 'warning',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-primary',
            showCancelButton: true,
            confirmButtonText: 'Update',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                swal({
                    html: `<h4>Mengupdate Plafon</h4><span class="fa fa-4x fa-cog fa-spin text-primary text-center loader"></span>`,
                    showCancelButton: false,
                    showConfirmButton: false
                });
                $.get(`{{url('kasus')}}/{{$kasus->nomor_kasus}}/update-plafon`, data)
                    .done(function(result){
                        var parsed_res = JSON.parse(result);
                        swal.close();
                        if(parsed_res.status == 200){
                            swal('Berhasil', parsed_res.message, 'success');
                            location.reload();
                        } else if(parsed_res.status == 201) {
                            var cmg_div = $("#cmg-content");
                            parsed_res.cmg.forEach(function(item, i){
                                cmg_div.append(`
                                    <div class="custom-control custom-checkbox mb-5">
                                        <input class="custom-control-input" type="checkbox" name="cmg[]" id="example-checkbox${i}" value="${item.code}" checked>
                                        <label class="custom-control-label" for="example-checkbox${i}">${item.code} ${item.description}</label>
                                    </div>
                                `);
                            });
                            $("#modal_cmg").modal('show');
                        } else {
                            swal('Gagal', parsed_res.message, 'error');
                        }
                    })
                    .fail(function(result){
                        swal.close();
                        swal('Gagal', "Terjadi kesalahan server", 'error');
                    });
            }
        });
    });

    $(document).on('click', '#submit-cmg', function(){
        var data = $("#cmg_form").serialize();
        swal({
            title: 'Apakah anda yakin?',
            text: "Proses ini tidak dapat dikembalikan",
            type: 'warning',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-primary',
            showCancelButton: true,
            confirmButtonText: 'Update',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                swal({
                    html: `<h4>Mengupdate Plafon</h4><span class="fa fa-4x fa-cog fa-spin text-primary text-center loader"></span>`,
                    showCancelButton: false,
                    showConfirmButton: false
                });
                $.get(`{{url('kasus')}}/{{$kasus->nomor_kasus}}/update-plafon-part-two`, data)
                    .done(function(result){
                        var parsed_res = JSON.parse(result);
                        swal.close();
                        if(parsed_res.status == 200) {
                            swal('Berhasil', parsed_res.message, 'success');
                            location.reload();
                        } else {
                            swal('Gagal', parsed_res.message, 'error');
                        }
                    })
                    .fail(function(result){
                        swal.close();
                        swal('Gagal', "Terjadi kesalahan server", 'error');
                    });
            }
        });
    })

    $('.btn-kanker-toggle').click(function(){
        var id = $(this).data('id')
        var stadium = $(this).data('stadium')
        $('#modal-update-kanker-stadium .input-id-diagnosis').val(id);
        $('#modal-update-kanker-stadium .input-stadium').val(stadium).change();
        $('#modal-update-kanker-stadium').modal('toggle');
    })
</script>