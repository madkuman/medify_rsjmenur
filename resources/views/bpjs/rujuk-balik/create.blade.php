@extends('bpjs.layouts.main')

@section('title')
    Buat - Rujuk Balik
@endsection

@section('subtitle')
    Rujuk Balik
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
                    <h5>Buat Rujuk Balik Baru</h5>
                </div>
                <div class="block-content">
                    <form action="" method="post" id="form-create">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-8 col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Pilih Inputan</label>
                                    <div class="___class_+?8___">
                                        <div class="custom-control custom-radio custom-control-inline my-10">
                                            <input class="custom-control-input input-type" type="radio" name="pilih_inputan" id="type1" value="1"
                                                checked="">
                                            <label class="custom-control-label" for="type1">Pilih Pasien</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline my-10">
                                            <input class="custom-control-input input-type" type="radio" name="pilih_inputan" id="type2" value="2">
                                            <label class="custom-control-label" for="type2">Input SEP</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">No. SEP</label>
                                    <input type="text" name="no_sep" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
                                        Pasien
                                        <i class="fa fa-asterisk fa-spin text-info loading" style="display: none;"></i>
                                    </label>
                                    <select name="pasien_id" class="form-control select-pasien" data-placeholder="Pilih Pasien"
                                        style="width: 100%">
                                        <option></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Kasus</label>
                                    <select name="kasus_id" class="form-control select-kasus" data-placeholder="Pilih Kasus" style="width: 100%">
                                        <option></option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">
                                        Program PRB
                                        <i class="fa fa-asterisk fa-spin text-info loading" style="display: none;"></i>
                                    </label>
                                    <select name="kode_program_prb" class="form-control select-program-prb" data-placeholder="Pilih Program"
                                        style="width: 100%">
                                        <option></option>
                                    </select>
                                    <small class="text-danger error-message"></small>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Keterangan</label>
                                    <textarea name="keterangan" class="form-control" cols="30" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Saran</label>
                                    <textarea name="saran" class="form-control" cols="30" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-8 col-lg-6">
                                <h6>Tambah Obat</h6>
                                <div class="form-group">
                                    <label class="control-label">
                                        Obat *
                                        <i class="fa fa-asterisk fa-spin text-info loading" style="display: none;"></i>
                                    </label>
                                    <select class="form-control select-obat" name="temp_obat" id="addition-obat" data-placeholder="Pilih Obat"
                                        style="width: 100%">
                                        <option></option>
                                    </select>
                                    <small class="text-danger error-message"></small>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Jumlah *</label>
                                    <input type="text" class="form-control" id="addition-jumlah">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Signa 1</label>
                                    <input type="text" class="form-control" id="addition-signa-1">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Signa 2</label>
                                    <input type="text" class="form-control" id="addition-signa-2">
                                </div>
                                <button class="btn btn-sm btn-alt-primary" id="addition-submit">Tambah Obat</button>
                                <hr>
                                <h6>Daftar Obat</h6>
                                <div class="row" id="addition-container"></div>
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
        //Section Select2
        $('.select-program-prb').select2();

        fetchProgramPrbData();

        function fetchProgramPrbData() {
            $.ajax({
                url: API_URL + '/bpjs/referensi/program-prb-all',
                dataType: 'json',
                beforeSend() {
                    $('.select-program-prb').parents('.form-group').find('.loading').show();
                },
                success: function(data, params) {
                    $('.select-program-prb').parents('.form-group').find('.loading').hide();
                    if (data.metaData.code != 200) {
                        $('.select-program-prb').parents('.form-group').find('.error-message').text('Error BPJS : ' + data
                            .metaData.message)
                        return [];
                    } else {
                        $('.select-program-prb').parents('.form-group').find('.error-message').text('');
                        let result = $.map(data.response.list, function(obj) {
                            return {
                                id: obj.kode,
                                text: obj.kode + " " + obj.nama
                            };
                        });

                        $('.select-program-prb').select2({
                            data: result,
                        });
                    }
                }
            });
        }

        $('.select-obat').select2({
            ajax: {
                url: function(params) {
                    return API_URL + '/bpjs/referensi/obat-generik-program-prb';
                },
                data: function(params) {
                    return {
                        'nama_obat': params.term,
                    }
                },
                dataType: 'json',
                beforeSend() {
                    $('.select-obat').parents('.form-group').find('.loading').show();
                },
                processResults: function(data, params) {
                    $('.select-obat').parents('.form-group').find('.loading').hide();

                    if (data.metaData.code != 200) {
                        $('.select-obat').parents('.form-group').find('.error-message').text('Error BPJS : ' + data
                            .metaData.message)
                        return [];
                    } else {
                        $('.select-obat').parents('.form-group').find('.error-message').text('');
                        return {
                            results: $.map(data.response.list, function(obj) {
                                return {
                                    id: obj.kode,
                                    text: obj.nama,
                                };
                            })
                        };
                    }
                },
                cache: true
            }
        });

        $('.select-pasien').select2({
            ajax: {
                url: function(params) {
                    return API_URL + '/pasien/get-bpjs/' + params.term;
                },
                dataType: 'json',
                beforeSend() {
                    $('.select-pasien').parents('.form-group').find('.loading').show();
                },
                processResults: function(data, params) {
                    $('.select-pasien').parents('.form-group').find('.loading').hide();
                    return {
                        results: $.map(data, function(obj) {
                            return {
                                id: obj.id,
                                text: obj.name,
                                detail: obj
                            };
                        })
                    };
                },
                cache: true
            }
        });
        $('.select-pasien').on('select2:select', function(e) {
            var data = e.params.data;

            let kasus_data = [];
            kasus_data.push({
                id: '',
                text: '',
            })
            $.each(data.detail.kasus, function(i, item) {
                kasus_data.push({
                    id: item.id,
                    text: item.nomor_kasus + " " + item.judul_kasus,
                    detail: item,
                });
            })
            $('[name="no_sep"]').val('');
            $('.select-kasus').empty().trigger('change');
            $('.select-kasus').select2({
                data: kasus_data,
            });
        });

        $('.select-kasus').select2();
        $('.select-kasus').on('select2:select', function(e) {
            var data = e.params.data;

            $('[name="no_sep"]').val(data.detail?.sep?.no_sep || '');
        });


        //Section Form
        $('[name="pilih_inputan"]').on('change', function() {
            let value = $(this).val();

            if (value == 1) {
                $('[name="no_sep"]').attr('readonly', true);
                $('[name="pasien_id"]').parents('.form-group').show();
                $('[name="kasus_id"]').parents('.form-group').show();
            } else {
                $('[name="no_sep"]').attr('readonly', false);
                $('[name="pasien_id"]').parents('.form-group').hide();
                $('[name="kasus_id"]').parents('.form-group').hide();
            }
        })

        //Section Addition
        var obat_data = [];
        $('#addition-submit').on('click', function() {
            if (!addition_allow_add) return;

            let kode_obat = $('#addition-obat').val();
            let nama_obat = $('#addition-obat').select2('data')[0]['text'];
            let jumlah = $('#addition-jumlah').val();
            let signa1 = $('#addition-signa-1').val();
            let signa2 = $('#addition-signa-2').val();

            obat_data.push({
                kode_obat: kode_obat,
                nama_obat: nama_obat,
                jumlah: jumlah,
                signa1: signa1,
                signa2: signa2,
            });

            resetAddition();
            fetchAddition();
        })

        $(document).on('click', '.btn-addition-remove', function() {
            let header = $(this).parents('.addition-header');
            let index = header.data('index');

            if (index !== -1) {
                obat_data.splice(index, 1);
            }
            fetchAddition();
        })

        var addition_allow_add = false;
        $('#addition-obat,#addition-jumlah').on('change', function() {
            let obat = $('#addition-obat').val();
            let jumlah = $('#addition-jumlah').val();

            addition_allow_add = (obat != "" && jumlah != "");

            $('#addition-submit').attr('disabled', !addition_allow_add);
        })

        function resetAddition() {
            $('#addition-obat').val('').trigger('change');
            $('#addition-jumlah').val('')
            $('#addition-signa-1').val('')
            $('#addition-signa-2').val('')
        }

        fetchAddition()

        function fetchAddition() {
            $('#addition-container').html('');
            $.each(obat_data, function(i, item) {
                $('#addition-container').append(`
                <div class="col-12 addition-header" data-index="${i}">
                    <div class="block">
                        <div class="block-content">
                            <h6>
                                ${item.nama_obat}
                                <a href="javascript:void(0)" class="text-danger float-right btn-addition-remove"> <i class="fas fa-times"></i></a>
                            </h6>
                            <p class="m-0">Jumlah : ${item.jumlah}</p>
                            <p class="m-0">Signa : ${item.signa1} x ${item.signa2}</p>
                            <input type="hidden" name="obat[${i}][kode_obat]" value="${item.kode_obat}">
                            <input type="hidden" name="obat[${i}][nama_obat]" value="${item.nama_obat}">
                            <input type="hidden" name="obat[${i}][jumlah]" value="${item.jumlah}">
                            <input type="hidden" name="obat[${i}][signa1]" value="${item.signa1}">
                            <input type="hidden" name="obat[${i}][signa2]" value="${item.signa2}">
                        </div>
                    </div>
                </div>
                `);
            })
            if (obat_data.length == 0) {
                $('#addition-container').append(`
                <div class="col-12">
                    <div class="alert alert-warning">
                        Obat Kosong
                    </div>
                </div>
                `);
            }
        }

        //Form
        jQuery.validator.addMethod("has_obat", function(value, element) {
            return obat_data.length > 0;
        }, "* Setidaknya memiliki 1 Obat");

        $('#form-create').submit(function(e) {
            e.preventDefault();

            if ($(this).valid()) {
                let form_data = new FormData($(this)[0]);
                form_data.set('program_prb',$('.select-program-prb').select2('data')[0]['text']);
                let submit_button = $(this).find('[type="submit"]');
                setActiveButton(submit_button, false);
                $.ajax({
                    url: $(this).attr('action'),
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
                            callSwal('success','Berhasil',"Berhasil Membuat Rujuk Balik","bpjs/rujuk-balik")
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
                'no_sep': {
                    required: true
                },
                'kode_program_prb': {
                    required: true,
                },
                // 'temp_obat' : {
                //     has_obat : true,
                // }
            }
        });
    </script>

@endsection
