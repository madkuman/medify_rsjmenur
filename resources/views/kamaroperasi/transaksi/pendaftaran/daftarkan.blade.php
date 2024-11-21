@extends('kamaroperasi.transaksi.pendaftaran.base')

@section('additional-form')
    <div class="row">
        <div class="col-12 form-group">
            <label>Dokter Penanggung Jawab Operasi</label>
            <select class="js-select2 form-control" name="dokter" id="dokter_dropdown" data-placeholder="Pilih Dokter"
                required>
                @if ($permintaan->dokter)
                    <option value="{{ $permintaan->dokter->id }}">{{ $permintaan->dokter->name }}</option>
                @endif
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <label>Tanggal Operasi</label>
            <input type="text" autocomplete="off" class="js-datepicker form-control tanggal_operasi"
                name="tanggal_operasi" {{-- data-date-start-date="{{date('d-m-Y')}}" 
    --}} id="tanggal_operasi" data-week-start="1" data-autoclose="true"
                data-today-highlight="true" data-date-format="dd/mm/yyyy" placeholder="Pilih Tanggal"
                value="{{ $permintaan->jadwal_operasi ? \Carbon\Carbon::parse($permintaan->jadwal_operasi)->format('d/m/Y') : '' }}"
                required>
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <label>Jam Operasi</label>
            <input type="time" autocomplete="off" class="form-control time input-jam" name="jam_operasi" id="jam_operasi"
                placeholder="hh:mm" value="{{ $permintaan->jam_operasi ? Carbon\Carbon::now()->format('H:i') : '' }}"
                required>
        </div>
    </div>
    <div class="row  hide mb-20" id="warning-duplicate-transaksi">
        <div class="col-12">
            <div class="bg-danger text-white p-10 ">
                Pasien akan dioperasi pada tanggal:
                <div class="content">
                </div>
            </div>
        </div>
    </div>
    <div class="row hide mb-20" id="warning-duplicate-transaksi-loading">
        <div class="col-12">
            <div class="bg-danger text-white p-10">
                Sedang Mencari Transaksi Yang Akan Dilakukan Pasien <i class="fa fa-spinner fa-spin"></i>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-12 form-group">
            <label>Pilih Ruangan</label>
            <select class="js-select2 form-control" name="ruangan" id="ruangan_dropdown" data-placeholder="Pilih Ruangan"
                required>
                <option></option>
                @foreach ($ruangans as $ruangan)
                    <option value="{{ $ruangan->id }}"
                        {{ $permintaan ? ($ruangan->id == $permintaan->ruangan_id ? 'selected' : '') : '' }}>
                        {{ $ruangan->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <label>Pilih Ronde</label>
            <select class="js-select2 form-control" name="ronde" id="ronde_dropdown"
                data-placeholder="Tanggal dan Ruangan operasi harus terisi" disabled required>
                <option></option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <label>Judul Operasi</label>
            <input type="text" class="form-control" autocomplete="off" name="judul_operasi" id="judul_operasi"
                placeholder="Masukkan judul" value="{{ $permintaan->icd10->long_desc }}" required>
        </div>
    </div>
    <div class="form-group">
        <label class="css-control css-control-primary css-checkbox">
            <input type="checkbox" class="css-control-input" id="is_join" name="is_join">
            <span class="css-control-indicator"></span> <label> Operasi Join</label>
        </label>
    </div>
    <div class="row joint-operation" style="display: none;">
        <div class="col-12 form-group">
            <div id="field-container">
                <div class="form-group row">
                    <input type="text" class="col-md-10 form-control ml-15 child-field" autocomplete="off"
                        name="judul_child[]" value="" placeholder="Masukkan Judul Operasi">
                    <a href="javascript:void(0);" class="remove_button col-md-1 pr-0"><span class="fa fa-2x fa-trash"
                            style="color: red;"></a>
                </div>
            </div>
            <a href="javascript:void(0);" id="add-field-btn" class="btn btn-primary" title="Add field">
                <span class="fa fa-plus-circle text-center"></span> Tambah Operasi
            </a>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script>
        $("#dokter_dropdown").select2({
            data: initials.dokter,
            ajax: {
                url: '{{ url('ajax/kamaroperasi/search_tim') }}',
                delay: 250,
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                    }
                    return query;
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
            }
        });
        var changeRondeCandidate = function() {
            $.ajax({
                url: '{{ url('ajax/kamaroperasi/ronde_sisa') }}',
                dataType: 'json',
                data: {
                    tanggal: $("#tanggal_operasi").val(),
                    ruangan: $("#ruangan_dropdown").val()
                },
                success: function(data) {
                    $("#ronde_dropdown").empty();
                    $("#ronde_dropdown").append('<option></option>');
                    // console.log(initials);
                    if (initials.ronde && initials.tanggal == $("#tanggal_operasi").val() && initials
                        .ruangan == $("#ruangan_dropdown").val()) {
                        var is_correct_ruangan_ronde = true;
                    } else
                        var is_correct_ruangan_ronde = false;
                    var not_yet_appended = true;
                    $.each(data, function(key, value) {
                        // if (selected_ronde != '' && selected_ronde < value && not_yet_appended) {
                        if (is_correct_ruangan_ronde && initials.ronde < value &&
                            not_yet_appended) {
                            $("#ronde_dropdown").append('<option value="' + initials.ronde +
                                '" selected>Ronde ' + initials.ronde + '</option> ');
                            not_yet_appended = false;
                        }
                        $("#ronde_dropdown").append('<option value="' + value + '">Ronde ' + value +
                            '</option> ');
                    });
                    $("#ronde_dropdown").prop('disabled', false);
                    $("#ronde_dropdown").data('placeholder', 'Pilih Ronde').select2();
                }
            });
        };

        $("#ruangan_dropdown, #tanggal_operasi").on('change', function() {
            var tanggal = $("#tanggal_operasi").val();
            var ruangan = $("#ruangan_dropdown").val();
            if (tanggal.length > 0 && ruangan.length > 0) {
                $('#ronde_dropdown').attr('data-placeholder', 'Loading...');
                $("#ronde_dropdown").prop('disabled', true);
                changeRondeCandidate();
            } else {
                $("#ronde_dropdown").val('');
                $("#ronde_dropdown").prop('disabled', true);
            }
        });
        $('#tanggal_operasi').on('change', function() {
            tanggal = $('#tanggal_operasi').val();
            pasien = $('#pasien_dropdown').val();
            $('#warning-duplicate-transaksi-loading').show();
            $('#warning-duplicate-transaksi').hide();
            $.ajax({
                url: '{{ url('ajax/kamaroperasi/check-duplicate-transaksi') }}',
                dataType: 'json',
                data: {
                    tanggal: tanggal,
                    pasien: pasien
                },
                success: function(data) {
                    console.log(data)
                    console.log(data.length)
                    if (data.length > 0) {
                        $('#warning-duplicate-transaksi').show();
                        content = `<ul>`
                        $.each(data, function(key, value) {
                            content += `<li>
                ` + value.tanggal + ` - ` + value.diagnosis + `
              </li>`
                        });
                        content += `</ul>`

                        $('#warning-duplicate-transaksi .content').empty()
                        $('#warning-duplicate-transaksi .content').append(content);
                    }
                },
                complete: function(data) {
                    $('#warning-duplicate-transaksi-loading').hide();
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var minField = 1;
            var field =
                `<div class="form-group row">
      <input type="text" autocomplete="off" class="col-md-10 form-control ml-15 child-field" name="judul_child[]" value="" placeholder="Masukkan Judul Operasi">
      <a href="javascript:void(0);" class="remove_button col-md-1 pr-0"><span class="fa fa-2x fa-trash" style="color: red;"></a>
      </div>`;
            $('#add-field-btn').click(function() {
                $('#field-container').append(field);
                minField++
            });
            $('#field-container').on('click', '.remove_button', function(e) {
                if (minField > 1) {
                    e.preventDefault();
                    $(this).parent('div').remove();
                    minField--;
                }
            });

            $('#is_join').change(function() {
                if ($('#is_join').prop('checked') == true) {
                    $('.joint-operation').show(500);
                    $('.child-field').prop('required', true);
                } else {
                    $('.joint-operation').hide(500);
                    $('.child-field').removeAttr('required');
                }
            });

        });
    </script>
@endsection
