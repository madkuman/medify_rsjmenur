
@extends('layouts.main2')

@section('title')
Pelaksanaan - Kamar Operasi - Medify
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
    @include('kamaroperasi.layouts.header')

    <div class="content">
        <div class="row">
            @include('kamaroperasi.layouts.sidebar')

            <!-- Updates -->
            <div class="col-lg-4 col-xl-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="block">
                            <ul class="nav nav-tabs nav-tabs-block nav-justified nav-primary" data-toggle="tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#beranda">Beranda</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#rencana">Rencana</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#pasca">Hasil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tim">Tim</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#pengaturan">Pengaturan</a>
                                </li>
                            </ul>
                            <div class="block-content tab-content overflow-hidden">
                                <div class="tab-pane fade fade-left show active" id="beranda" role="tabpanel">
                                    @include('kamaroperasi.pelaksanaan.beranda.index')
                                </div>
                                <div class="tab-pane fade fade-left" id="rencana" role="tabpanel">
                                    @include('kamaroperasi.pelaksanaan.rencana.index')
                                </div>
                                <div class="tab-pane fade fade-left" id="pasca" role="tabpanel">
                                    @include('kamaroperasi.pelaksanaan.pasca.index')
                                </div>
                                <div class="tab-pane fade fade-left" id="tim" role="tabpanel">
                                    @include('kamaroperasi.pelaksanaan.tim.index')
                                </div>
                                <div class="tab-pane fade fade-left" id="pengaturan" role="tabpanel">
                                    @include('kamaroperasi.pelaksanaan.pengaturan.index')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Updates -->
        </div>
    </div>
</main>
<!-- END Main Container -->


@endsection

@section('css')

@endsection

@section('js')

<script type="text/javascript">

    jQuery(function () {
        // Init page helpers (BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Input + Range Sliders + Tags Inputs plugins)
        Codebase.helpers(['datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider', 'tags-inputs']);
    });
</script>
<script>
    $(window).ready(function(){
        $('#formhasil').hide();
    });

    $("#catat").click(function(){
        $('#readhasil').hide();
        $('#formhasil').show();
    });

    var edit = function() {
      $('#summernote').summernote({focus: true,height: 200});
    };

    var save = function() {
        var markup = $('#summernote').summernote('code');
        $('#summernote').summernote('destroy');
        var id = {{$transaksi->id}};
        console.log(id);

        $.ajax({
            url: '{{url('ajax/kamaroperasi/rencana/')}}',
            method: "POST",
            data: { "_token": "{{csrf_token()}}",
            "id": id,
            "deskripsi": markup
            },
            datatype:"json",
            success: function(response) {
                console.log(response);
            }
        });
    };

    $(function () {
        var options = {
            twentyFour: true,
            showSeconds: false,
            title: 'Pilih Waktu'
        };
        $('.wickedpicker-mulai').wickedpicker(options);
    });

    $(function () {
        var options = {
            twentyFour: true,
            showSeconds: false,
            title: 'Waktu Selesai'
        };
        $('.wickedpicker-selesai').wickedpicker(options);
    });

    $(function () {
        var options = {
            now: "01:00",
            twentyFour: true,
            showSeconds: false
        };
        $('.wickedpicker2').wickedpicker(options);
    });

    $(document).ready(function() {
        $('.js-select2-item-ronde').select2({
            placeholder: 'Pilih ronde baru.',
        });
    });

    $(document).ready(function() {
        $('.js-select2-item').select2({
            placeholder: 'Pilih obat yang akan digunakan',
        });
    });

    $('#btnAdd').on('click', function(e) {
        e.preventDefault();
        $('.js-select2-item').select2('destroy');
        var row1 =
        '<div class="form-group row items">' +
            '<div class="col-lg-6">' +
                '<select class="js-select2-item" name="obats[]" style="width: 100%">' +
                    '<option></option>' +
                    @foreach($items as $item)
                        '<option value="{{$item->id}}" data-price="{{$item->price}}" data-qty="{{$item->qty_ready}}">{{$item->name}}</option>' +
                    @endforeach
                '</select>' +
            '</div>' +
            '<div class="col-md-3">' +
                '<input type="number" id="jumlah" class="form-control" placeholder="Jumlah" name="jumlah[]">' +
            '</div>'+
            '<div class="col-md-1">' +
                '<button type="button" class="btn btn-danger remove-item-new" title="Tekan untuk menghapus item">' +
                    '<i class="fa fa-times" aria-hidden="true"></i>' +
                '</button>' +
            '</div>'+
        '</div>';
        $('#obat').append(row1);
        $('.js-select2-item').select2({
            placeholder: 'Pilih obat yang akan digunakan',
        });
    });

    $('#obat').on('click', '.remove-item-new', function(e) {
        e.preventDefault();
        $(this).closest('.items').remove();
    });

    $(document).ready(function() {
        $('.js-select2-item-pasca').select2({
            placeholder: 'Pilih obat yang telah digunakan',
        });
    });

    $('#btnPascaAdd').on('click', function(e) {
        e.preventDefault();
        $('.js-select2-item-pasca').select2('destroy');
        var row2 =
        '<div class="form-group row items-pasca">' +
            '<div class="col-lg-6">' +
                '<select class="js-select2-item-pasca" name="pascaobats[]" style="width: 100%">' +
                    '<option></option>' +
                    @foreach($rencana as $rencanas)
                        '<option value="{{$rencanas->obat_id}}">{{$rencanas->obat->name}}</option>' +
                    @endforeach
                '</select>' +
            '</div>' +
            '<div class="col-md-3">' +
                '<input type="number" id="jumlah" class="form-control" placeholder="Jumlah" name="pascajumlah[]">' +
            '</div>'+
            '<div class="col-md-1">' +
                '<button type="button" class="btn btn-danger remove-item-new-pasca" title="Tekan untuk menghapus item">' +
                    '<i class="fa fa-times" aria-hidden="true"></i>' +
                '</button>' +
            '</div>'+
        '</div>';
        $('#pascaobat').append(row2);
        $('.js-select2-item-pasca').select2({
            placeholder: 'Pilih obat yang akan digunakan',
        });
    });

    $('#pascaobat').on('click', '.remove-item-new-pasca', function(e) {
        e.preventDefault();
        $(this).closest('.items-pasca').remove();
    });

    $(document).ready(function() {
        $('.js-select2-item-tim').select2({
            placeholder: 'Pilih anggota yang akan bertugas',
        });
        $('.js-select2-tim-role').select2({
            placeholder: 'Pilih peran anggota operasi',
        });
    });

    $('#btnTimAdd').on('click', function(e) {
        e.preventDefault();
        $('.js-select2-item-tim').select2('destroy');
        $('.js-select2-tim-role').select2('destroy');
        var row3 =
        '<div class="form-group row tims">' +
            '<div class="col-lg-6">' +
                '<select class="js-select2-item-tim" name="namatim[]" style="width: 100%">' +
                    '<option></option>' +
                    @foreach($user as $users)
                        '<option value="{{$users->id}}">{{$users->name}}</option>' +
                    @endforeach
                '</select>' +
            '</div>' +
            '<div class="col-lg-3">' +
                '<select class="js-select2-tim-role" name="peran[]" style="width: 100%">' +
                    '<option></option>' +
                    @foreach($role as $roles)
                        '<option value="{{$roles->id}}">{{$roles->nama}}</option>' +
                    @endforeach
                '</select>' +
            '</div>' +
            '<div class="col-md-1">' +
                '<button type="button" class="btn btn-danger remove-item-new-tim" title="Tekan untuk menghapus item">' +
                    '<i class="fa fa-times" aria-hidden="true"></i>' +
                '</button>' +
            '</div>'+
        '</div>';
        $('#tim-operasi').append(row3);
        $('.js-select2-item-tim').select2({
            placeholder: 'Pilih anggota yang akan bertugas',
        });
        $('.js-select2-tim-role').select2({
            placeholder: 'Pilih peran anggota operasi',
        });
    });

    $('#btnNewTimAdd').on('click', function(e) {
        e.preventDefault();
        $('.js-select2-item-tim').select2('destroy');
        $('.js-select2-tim-role').select2('destroy');
        $('.submit').remove();
        var row4 =
        '<div class="form-group row tims">' +
            '<div class="col-lg-6">' +
                '<select class="js-select2-item-tim" name="namatim[]" style="width: 100%">' +
                    '<option></option>' +
                    @foreach($user as $users)
                        '<option value="{{$users->id}}">{{$users->name}}</option>' +
                    @endforeach
                '</select>' +
            '</div>' +
            '<div class="col-lg-3">' +
                '<select class="js-select2-tim-role" name="peran[]" style="width: 100%">' +
                    '<option></option>' +
                    @foreach($role as $roles)
                        '<option value="{{$roles->id}}">{{$roles->nama}}</option>' +
                    @endforeach
                '</select>' +
            '</div>' +
            '<div class="col-md-1">' +
                '<button type="button" class="btn btn-danger remove-item-new-tim" title="Tekan untuk menghapus item">' +
                    '<i class="fa fa-times" aria-hidden="true"></i>' +
                '</button>' +
            '</div>'+
        '</div>';
        var button =
        '<div class="submit">' +
            '<button type="submit" class="btn btn-primary pull-right">Simpan</button>' +
        '</div>';
        $('#tim-operasi').append(row4);
        $('#mytim').append(button);
        $('.js-select2-item-tim').select2({
            placeholder: 'Pilih anggota yang akan bertugas',
        });
        $('.js-select2-tim-role').select2({
            placeholder: 'Pilih peran anggota operasi',
        });
    });

    $('#tim-operasi').on('click', '.remove-item-new-tim', function(e) {
        e.preventDefault();
        $(this).closest('.tims').remove();
        if ( $('#tim-operasi').children().length == 0 ) {
            $('.submit').remove();
        }
    });

    $('document').ready(function() {
        $('.hapus-tim').on('click', function() {
            var id = $(this).data("tim");
            console.log(id);
            swal({
                title: "Apa anda yakin ?",
                text: "Anggota ini akan dihapus dari daftar tim pelaksanaan operasi",
                type: "warning",
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-default',
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
                allowOutsideClick: false
            }).then((result) => {
                  if (result.value) {
                    window.location = "{{url('/kamaroperasi/pelaksanaan/tim/hapus')}}/"+id;
                  } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                  ) {
                    swal(
                      'Hapus Dibatalkan',
                      'Tidak ada data yang berubah.',
                      'error'
                    )
                  }
            })
        })
    });

    $(document).ready(function() {
        loadRonde();
    });
    $('#tanggal').on('change', function() {
      loadRonde();
    });
    $('#ruangan').on('change', function() {
      loadRonde();
    });

    function loadRonde()
    {
        var id= $("#ruangan").val();
        var date= $("#tanggal").val();
        var newdate= moment(date,"DD-MM-YYYY").format('YYYY-MM-DD');
        console.log(id);
        console.log(newdate);
        if (date == '{{Carbon\Carbon::createFromFormat('Y-m-d', $transaksi->jadwal_operasi)->format('d-m-Y')}}') {
            console.log("sama");
            var content = '<option value="{{$transaksi->nomor_ronde}}" selected="selected">{{$transaksi->nomor_ronde}}</option>';
        } else {
            var content = '<option></option>';
        }

        $.ajax
        ({
            url: '{{url('ajax/kamaroperasi/pengaturan/')}}',
            method: "POST",
            data:
            {
                "_token": "{{csrf_token()}}",
                "id": id,
                "tanggal": newdate
            },
            datatype:"json",
            success: function(response)
            {
                //console.log(JSON.parse(response));


                $.each(JSON.parse(response), function(idx, elem){
                    console.log(elem);
                    content += '<option value="'+elem+'">'+elem+'</option>';
                });
                $('#pilih-ronde').html(content);
            }
        });
    }
</script>


@endsection
