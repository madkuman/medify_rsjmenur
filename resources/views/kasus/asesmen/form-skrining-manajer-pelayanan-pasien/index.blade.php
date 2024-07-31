@extends('kasus.layouts.main')

@section('title')
    {{ $kasus->judul_kasus }} - Form Skrining Manajer Pelayanan Pasien - Kasus
@endsection

@section('content')
    <main id="main-container">
        @include('kasus.layouts.header')

        <div class="content">
            <div class="row">
                @include('kasus.layouts.sidebar')

                <div class="col-lg-9 col-xl-9">
                    <div class="block block-bordered">
                        <div class="block-content">
                            @if (session('my_role_' . $kasus->nomor_kasus))
                                <button type="button"
                                    class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn"
                                    data-toggle="modal" data-target="#addModal">
                                    <i class="fa fa-pencil"></i> Form Skrining Manajer Pelayanan Pasien Baru
                                </button>
                            @endif
                            <h4>Form Skrining Manajer Pelayanan Pasien</h4>
                            <hr>
                            @php $count = count($asesmen) @endphp
                            @forelse($asesmen as $item)
                                @if ($item->created_by == Auth::user()->id)
                                    <button class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn"
                                        data-id="{{ $item->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <button class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn"
                                        data-id="{{ $item->id }}" data-index="{{ $loop->iteration - 1 }}">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                @endif
                                <a type="btn" href="{{ url()->current() }}/print/{{ $item->id }}"
                                    class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right"
                                    target="_blank">
                                    <i class="fa fa-print"></i>
                                </a>
                                <button class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right showBtn"
                                    data-id="{{ $item->id }}" data-index="{{ $loop->iteration - 1 }}">
                                    <i class="fa fa-search"></i>
                                </button>
                                <h5 class="mb-5 pl-5">#Form Skrining Manajer Pelayanan Pasien {{ $count }}</h5>

                                @if (!empty($item->creator->avatar_thumb))
                                    <div class="float-left mr-10">
                                        <img class="img-avatar img-avatar-sm img-avatar-thumb"
                                            src="{{ url($item->creator->avatar_thumb) }}" alt="">
                                    </div>
                                @else
                                    <div class="float-left mr-10">
                                        <img class="img-avatar img-avatar-sm img-avatar-thumb"
                                            src="{{ url('assets/img/placeholder.jpg') }}" alt="">
                                    </div>
                                @endif
                                <div class="creator">
                                    <h6 class="pt-10">
                                        <small class="text-muted">Dibuat Oleh</small><br>
                                        {{ $item->creator->name ?? '-' }}<br>
                                        {{ date('d F y, H:i', strtotime($item->created_at)) }}
                                    </h6>
                                </div>

                                <hr class="my-20">
                                @php $count-- @endphp
                            @empty

                                <div class="text-center py-50">
                                    <h4 class="font-w400 mb-5">Belum ada asesmen Form Skrining Manajer Pelayanan Pasien
                                        tersedia</h4>
                                    <p>Klik tombol <b>Form Skrining Manajer Pelayanan Pasien Baru</b> untuk melakukan
                                        asesmen.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <form method="POST" action="{{ url()->current() }}/delete" id="formDelete">
        {{ csrf_field() }}
        <input name="id" type="hidden" id="deleteInputId">

    </form>
    @include('kasus.asesmen.form-skrining-manajer-pelayanan-pasien.modal')
    @include('kasus.asesmen.form-skrining-manajer-pelayanan-pasien.modal-hasil')
@endsection

@section('js')
    <script src="{{ url('') }}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
    <script type="text/javascript">
        var data = @json($asesmen);

        $(document).ready(function() {
            $(".deleteBtn").click(function(e) {
                e.preventDefault();
                id = $(this).data("id");
                $("#deleteInputId").val(id);
                swal({
                    title: "Hapus",
                    text: "Apakah anda yakin akan menghapus data ini?",
                    showCancelButton: true,
                    reverseButtons: true,
                    type: "warning",
                    confirmButtonClass: "btn btn-danger",
                    cancelButtonClass: "btn btn-default",
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Kembali",
                    closeOnConfirm: false
                }).then(function(result) {
                    if (result.value) {
                        $("#formDelete").submit();
                    }
                });
            });

            $(".editBtn").click(function(e) {
                id = $(this).data("id");
                var item = data[$(this).data("index")];
                if (item != "" && item != undefined) {
                    $("#id").val(item.id);
                    @include('kasus.asesmen.form-skrining-manajer-pelayanan-pasien.js-form-edit')
                } else {
                    $("#id").val(0);
                    @include('kasus.asesmen.form-skrining-manajer-pelayanan-pasien.js-form-create')
                }
                $("#addModal").modal("toggle");
            });

            $(".showBtn").click(function(e) {
                id = $(this).data("id");

                var item = data[$(this).data("index")];
                var val = item.val;

                var hasil = `@include('kasus.asesmen.form-skrining-manajer-pelayanan-pasien.hasil')`;
                $("#showModalHasil #myModalBody").html(hasil);

                $('.block-hasil input.risiko-check').each(function(_, element) {
                    var data_row = $(element).data('row');
                    var data_col = $(element).data('col');
                    var row_name = `row_${data_row}`;
                    var col_name = `col_${data_col}`;

                    if (val.risiko.hasOwnProperty(row_name) && val.risiko[row_name].hasOwnProperty(
                            col_name)) {
                        var is_checked = val.risiko[row_name][col_name].check ?? false;
                        $(element).prop('checked', is_checked);
                    }
                });

                $('.block-hasil .risiko-text').each(function(_, element) {
                    var data_row = $(element).data('row');
                    var data_col = $(element).data('col');
                    var row_name = `row_${data_row}`;
                    var col_name = `col_${data_col}`;

                    if (val.risiko.hasOwnProperty(row_name) && val.risiko[row_name].hasOwnProperty(
                            col_name)) {
                        var input_value = val.risiko[row_name][col_name].text ?? '';
                        if (input_value) $(element).text(input_value);
                    }
                });

                $('.block-hasil .risiko-ket').each(function(_, element) {
                    var data_row = $(element).data('row');
                    var data_col = $(element).data('col');
                    var row_name = `row_${data_row}`;
                    var col_name = `col_${data_col}`;

                    if (val.risiko.hasOwnProperty(row_name) && val.risiko[row_name].hasOwnProperty(
                            col_name)) {
                        var input_value = val.risiko[row_name][col_name].ket ?? '';
                        $(element).html(nl2br(input_value, true));
                    }
                });

                $('.block-hasil #waktu-prediksi').text(val.waktu_prediksi);

                $("#showModalHasil").modal("toggle");
            });
        });

        function formatDate(input) {
            if (input === null) {
                return null;
            } else {
                var datePart = input.match(/\d+/g),
                    year = datePart[0],
                    month = datePart[1],
                    day = datePart[2];

                return day + "/" + month + "/" + year;
            }
        }

        function nl2br(str, is_xhtml) {
            var breakTag = (is_xhtml || typeof is_xhtml === "undefined") ? "<br />" : "<br>";
            return (str + "").replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, "$1" + breakTag + "$2");
        }
    </script>
@endsection
