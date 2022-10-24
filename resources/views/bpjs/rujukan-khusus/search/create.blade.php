@extends('bpjs.layouts.main')

@section('title')
    Buat - Rujukan Khusus
@endsection

@section('subtitle')
    Rujukan Khusus
@endsection

@section('css')
    <style type="text/css">
    </style>
@endsection

@section('content')
    <main id="main-container">
        @include('bpjs.layouts.navbar')
        <div class="container">
            <div class="block rounded">
                <div class="block-header border-bottom">
                    <h5>Buat Rujukan Khusus Baru</h5>
                </div>
                <div class="block-content">
                    <form action="" method="post" id="form-create">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-8 col-lg-4">
                                <div class="form-group">
                                    <label class="control-label">Nomor Rujukan <span style="color: red">*</span></label>
                                    <input type="text" name="nomor_rujukan" class="form-control" required>
                                </div>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-8 col-lg-6">
                                <h6>Tambah Diagnosa</h6>
                                <div class="form-group">
                                    <label class="control-label">
                                        Diagnosa <span style="color: red">*</span>
                                        <i class="fa fa-asterisk fa-spin text-info loading" style="display: none;"></i>
                                    </label>
                                    <select class="form-control select-diagnosis" name="temp_diagnosis" id="addition-diagnosis" data-placeholder="Pilih Diagnosis"
                                        style="width: 100%">
                                        <option></option>
                                    </select>
                                    <small class="text-danger error-message"></small>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Tipe <span style="color: red">*</span></label>
                                    <br>
                                    <label class="css-control css-control-primary css-radio">
                                        <input type="radio" class="css-control-input addition-tipe" name="tipe" value="P">
                                        <span class="css-control-indicator"></span>Primer
                                    </label>
                                    <label class="css-control css-control-primary css-radio">
                                        <input type="radio" class="css-control-input addition-tipe" name="tipe" value="S">
                                        <span class="css-control-indicator"></span>Sekunder
                                    </label>
                                </div>
                                <button class="btn btn-sm btn-alt-primary" id="addition-submit-diagnosis" disabled>Tambah Diagnosis</button>
                                <hr>
                                <h6>Daftar Diagnosis</h6>
                                <div class="row" id="addition-container-diagnosis"></div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-8 col-lg-6">
                                <h6>Tambah Prosedur</h6>
                                <div class="form-group">
                                    <label class="control-label">
                                        Prosedur <span style="color: red">*</span>
                                        <i class="fa fa-asterisk fa-spin text-info loading" style="display: none;"></i>
                                    </label>
                                    <select class="form-control select-prosedur" name="temp_prosedur" id="addition-prosedur" data-placeholder="Pilih Prosedur"
                                        style="width: 100%">
                                        <option></option>
                                    </select>
                                    <small class="text-danger error-message"></small>
                                </div>
                                <button class="btn btn-sm btn-alt-primary" id="addition-submit-prosedur" disabled>Tambah Prosedur</button>
                                <hr>
                                <h6>Daftar Prosedur</h6>
                                <div class="row" id="addition-container-prosedur"></div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-8 col-lg-6">


                            </div>
                            <div class="col-12">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary"> Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
<script type="text/javascript">
    $('.select-diagnosis').select2({
        ajax: {
            url: function(params) {
                return API_URL+"/kasus/get/list/diagnosis";
            },
            data: function(params) {
                return {
                    'keyword': params.term,
                }
            },
            dataType: 'json',
            beforeSend() {
                $('.select-diagnosis').parents('.form-group').find('.loading').show();
            },
            processResults: function(data, params) {
                $('.select-diagnosis').parents('.form-group').find('.loading').hide();

                if (data.data.length < 1) {
                    $('.select-diagnosis').parents('.form-group').find('.error-message').text('Data diagnosis tidak ditemukan')
                    return [];
                } else {
                    $('.select-diagnosis').parents('.form-group').find('.error-message').text('');
                    return {
                        results: $.map(data.data, function(obj) {
                            return {
                                id: obj.code_icd,
                                text: obj.code_icd+' - '+obj.long_desc,
                            };
                        })
                    };
                }
            },
            cache: true
        }
    });

    $('.select-prosedur').select2({
        ajax: {
            url: function(params) {
                return API_URL+"/kasus/get/list/icd9";
            },
            data: function(params) {
                return {
                    'keyword': params.term,
                }
            },
            dataType: 'json',
            beforeSend() {
                $('.select-prosedur').parents('.form-group').find('.loading').show();
            },
            processResults: function(data, params) {
                $('.select-prosedur').parents('.form-group').find('.loading').hide();

                if (data.data.length < 1) {
                    $('.select-prosedur').parents('.form-group').find('.error-message').text('Data prosedur tidak ditemukan')
                    return [];
                } else {
                    $('.select-prosedur').parents('.form-group').find('.error-message').text('');
                    return {
                        results: $.map(data.data, function(obj) {
                            return {
                                id: obj.code_icd,
                                text: obj.code_icd +' - '+ obj.long_desc,
                            };
                        })
                    };
                }
            },
            cache: true
        }
    });

    //add section
    var diagnosis_data = [];
    $('#addition-submit-diagnosis').on('click', function() {
        let kode_diagnosa = $('#addition-diagnosis').val();
        let diagnosa = $('#addition-diagnosis').select2('data')[0]['text'];
        let tipe = $('input[name="tipe"]:checked').val();

        diagnosis_data.push({
            kode_diagnosa: kode_diagnosa,
            diagnosa: diagnosa,
            tipe: tipe
        });

        resetAdditionDiagnosa();
        fetchAddition();
    })
    
    var addition_allow_add_diagnosa = false;
    $('#addition-diagnosis,input[name="tipe"]').on('change', function() {
        let diagnosa = $('#addition-diagnosis').val();
        let tipe = $('input[name="tipe"]:checked').val();

        addition_allow_add_diagnosa = (diagnosa != "" && tipe != "");

        $('#addition-submit-diagnosis').attr('disabled', !addition_allow_add_diagnosa);
    })

    function resetAdditionDiagnosa() {
        $('#addition-diagnosis').val('').trigger('change');
        $('input[name="tipe"]').prop('checked',false);
    }

    var prosedur_data = [];
    $('#addition-submit-prosedur').on('click', function() {
        let kode_prosedur = $('#addition-prosedur').val();
        let prosedur = $('#addition-prosedur').select2('data')[0]['text'];

        prosedur_data.push({
            kode_prosedur: kode_prosedur,
            prosedur: prosedur,
        });

        resetAdditionProsedur();
        fetchAddition();
    })
    
    var addition_allow_add_prosedur = false;
    $('#addition-prosedur').on('change', function() {
        let prosedur = $('#addition-prosedur').val();

        addition_allow_add_prosedur = (prosedur != "");

        $('#addition-submit-prosedur').attr('disabled', !addition_allow_add_prosedur);
    })

    function resetAdditionProsedur() {
        $('#addition-prosedur').val('').trigger('change');
    }

    fetchAddition();

    function fetchAddition() {
        $('#addition-container-diagnosis').html('');
        $.each(diagnosis_data, function(i, item) {
            console.log(item)
            let tipe_append = 'Primer';
            if (item.tipe == 'S') tipe_append = 'Sekunder';
            $('#addition-container-diagnosis').append(`
            <div class="col-12 addition-header-diagnosis" data-index="${i}">
                <div class="block">
                    <div class="block-content">
                        <h6>
                            ${item.diagnosa}
                            <a href="javascript:void(0)" class="text-danger float-right btn-addition-remove-diagnosis"> <i class="fas fa-times"></i></a>
                        </h6>
                        <p class="m-0">Tipe : ${tipe_append}</p>
                        <input type="hidden" name="diagnosa[${i}][kode_diagnosa]" value="${item.kode_diagnosa}">
                        <input type="hidden" name="diagnosa[${i}][diagnosa]" value="${item.diagnosa}">
                        <input type="hidden" name="diagnosa[${i}][tipe]" value="${item.tipe}">
                    </div>
                </div>
            </div>
            `);
        })
        if (diagnosis_data.length == 0) {
            $('#addition-container-diagnosis').append(`
            <div class="col-12">
                <div class="alert alert-warning">
                    Diagnosa Kosong
                </div>
            </div>
            `);
        }

        $('#addition-container-prosedur').html('');
        $.each(prosedur_data, function(i, item) {
            $('#addition-container-prosedur').append(`
            <div class="col-12 addition-header-prosedur" data-index="${i}">
                <div class="block">
                    <div class="block-content">
                        <h6>
                            ${item.prosedur}
                            <a href="javascript:void(0)" class="text-danger float-right btn-addition-remove-prosedur"> <i class="fas fa-times"></i></a>
                        </h6>
                        <input type="hidden" name="prosedur[${i}][kode_prosedur]" value="${item.kode_prosedur}">
                        <input type="hidden" name="prosedur[${i}][prosedur]" value="${item.prosedur}">
                    </div>
                </div>
            </div>
            `);
        })
        if (prosedur_data.length == 0) {
            $('#addition-container-prosedur').append(`
            <div class="col-12">
                <div class="alert alert-warning">
                    Prosedur Kosong
                </div>
            </div>
            `);
        }
    }

    $(document).on('click', '.btn-addition-remove-diagnosis', function() {
        let header = $(this).parents('.addition-header-diagnosis');
        let index = header.data('index');

        if (index !== -1) {
            diagnosis_data.splice(index, 1);
        }
        fetchAddition();
    })

    $(document).on('click', '.btn-addition-remove-prosedur', function() {
        let header = $(this).parents('.addition-header-prosedur');
        let index = header.data('index');

        if (index !== -1) {
            prosedur_data.splice(index, 1);
        }
        fetchAddition();
    })

    //Form
    jQuery.validator.addMethod("has_diagnosis", function(value, element) {
            return diagnosis_data.length > 0;
    }, "* Setidaknya memiliki 1 diagnosa");

    jQuery.validator.addMethod("has_prosedur", function(value, element) {
            return prosedur_data.length > 0;
    }, "* Setidaknya memiliki 1 prosedur");

    $('#form-create').submit(function(e) {
        e.preventDefault();

        if ($(this).valid()) {
            let form_data = new FormData($(this)[0]);
            let submit_button = $(this).find('[type="submit"]');
            setActiveButton(submit_button, false);
            $.ajax({
                url: BASE_URL + '/bpjs/rujukan-khusus/create',
                type: "POST",
                dataType: "JSON",
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => {
                    setActiveButton(submit_button, true);

                    if (response.metaData.code == 200) {
                        callSwal('success','Berhasil',"Berhasil Membuat Rujukan Khusus","bpjs/rujukan-list-khusus")
                    } else {
                        callSwal('error','Gagal',response.metaData.message,0)
                    }
                },
                error : () => {
                    setActiveButton(submit_button, true);
                }
            })
        }
    })
    $('#form-create').validate({
        ignore: [],
        errorClass: 'invalid-feedback animated fadeInDown',
        errorElement: 'small',
        errorPlacement: function(error, e) {
            jQuery(e).parents('.form-group').append(error);
        },
        highlight: function(e) {
            jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
        },
        success: function(e) {
            jQuery(e).closest('.form-group').removeClass('is-invalid');
            jQuery(e).remove();
        },
        rules: {
            'temp_diagnosis' : {
                has_diagnosis : true,
            },
            'temp_prosedur' : {
                has_prosedur : true,
            }
        }
    });

</script>
@endsection