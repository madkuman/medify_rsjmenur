@extends('kasus.layouts.main')

@section('title')
    {{ $kasus->judul_kasus }} - {{ $judul_asesmen }} - Kasus
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
                                    <i class="fa fa-pencil"></i> {{ $judul_asesmen }} Baru
                                </button>
                            @endif
                            <h4>{{ $judul_asesmen }}</h4>
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
                                <h5 class="mb-5 pl-5">#{{ $judul_asesmen }} {{ $count }}</h5>

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
                                        {{ $item->creator->name }}<br>
                                        {{ date('d F y, H:i', strtotime($item->created_at)) }}
                                    </h6>
                                </div>

                                <hr class="my-20">
                                @php $count-- @endphp
                            @empty

                                <div class="text-center py-50">
                                    <h4 class="font-w400 mb-5">Belum ada asesmen {{ $judul_asesmen }} tersedia</h4>
                                    <p>Klik tombol <b>{{ $judul_asesmen }} Baru</b> untuk melakukan asesmen.</p>
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
    @include($view_path . '.modal')
    @include($view_path . '.modal-hasil')
@endsection

@section('js')
    <script src="{{ url('') }}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
    <script type="text/javascript">
        var data = @json($asesmen);

        $(document).ready(function() {
            $(".time").mask("00:00");

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

                var fields = [{
                        selector: ".evaluasi-tgl",
                        key: "tgl"
                    },
                    {
                        selector: ".evaluasi-jam",
                        key: "jam"
                    },
                    {
                        selector: ".evaluasi_masalah",
                        key: "masalah"
                    },
                    {
                        selector: ".evaluasi_plan",
                        key: "plan"
                    },
                    {
                        selector: ".evaluasi_ket",
                        key: "ket"
                    }
                ];

                if (item != "" && item != undefined) {
                    // form-edit
                    $("#id").val(item.id);
                    var item_val = JSON.parse(item.val);
                    setFormValue(fields, item_val);
                    $("input[name=diagnosa_medis]").val(item_val.diagnosa_medis)
                    $("input[name=tgl_asesmen]").val(item_val.tgl_asesmen)
                    $("input[name=mpp]").val(item_val.mpp)
                } else {
                    // form-create
                    $("#id").val(0);
                    setFormValue(fields, null)
                }
                $("#addModal").modal("toggle");
            });

            $(".showBtn").click(function(e) {
                id = $(this).data("id");
                var item = data[$(this).data("index")];

                var evaluasi_fields = [{
                        selector: "#myModalBody span.evaluasi-tgl",
                        key: "tgl"
                    },
                    {
                        selector: "#myModalBody span.evaluasi-jam",
                        key: "jam"
                    },
                    {
                        selector: "#myModalBody td.evaluasi-masalah",
                        key: "masalah"
                    },
                    {
                        selector: "#myModalBody td.evaluasi-plan",
                        key: "plan"
                    },
                    {
                        selector: "#myModalBody td.evaluasi-ket",
                        key: "ket"
                    }
                ];

                var hasil = `@include($view_path . '.hasil')`;
                $("#showModalHasil #myModalBody").html(hasil);

                var item_val = JSON.parse(item.val);
                setFormValue(evaluasi_fields, item_val, true);
                $("#myModalBody td.diagnosa-medis").text(item_val.diagnosa_medis)
                $("#myModalBody td.tgl-asesmen").text(item_val.tgl_asesmen)
                $("#myModalBody td.mpp").text(item_val.mpp)

                $("#showModalHasil").modal("toggle");
            });

            function setFormValue(fields, item, is_text=false) {
                fields.forEach(function(field) {
                    var $elements = $(field.selector);
                    $elements.each(function(index, element) {
                        if (item && item.evaluasi && index < item.evaluasi.length) {
                            if (is_text) {
                                $(element).text(item.evaluasi[index][field.key]);
                            } else {
                                $(element).val(item.evaluasi[index][field.key]);
                            }
                        } else {
                            $(element).val("");
                        }
                    });
                });
            }
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
