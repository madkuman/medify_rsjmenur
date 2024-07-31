@extends('kasus.layouts.main')

@section('title')
    {{ $kasus->judul_kasus }} - Resiko Bunuh Diri - Kasus
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
                                    data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Resiko Bunuh Diri
                                    Baru</button>
                            @endif
                            <h4>Resiko Bunuh Diri</h4>
                            <hr>
                            @php $count = count($alatbantu) @endphp
                            @forelse($alatbantu as $item)
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
                                <h5 class="mb-5 pl-5">#Resiko Bunuh Diri {{ $count }}</h5>

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
                                    <h4 class="font-w400 mb-5">Belum ada asesmen Resiko Bunuh Diri tersedia</h4>
                                    <p>Klik tombol <b>Resiko Bunuh Diri Baru</b> untuk melakukan asesmen.</p>
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
    @include('kasus.asesmen.resiko-bunuh-diri.modal')
    @include('kasus.asesmen.resiko-bunuh-diri.modal-hasil')
@endsection

@section('js')
    <script src="{{ url('') }}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
    <script type="text/javascript">
        var data = JSON.parse({!! json_encode(str_replace('`', "'", $alatbantu)) !!});

        $(document).ready(function() {
            $(".time").mask("00:00");
        });


        function nl2br(str, is_xhtml) {
            var breakTag = (is_xhtml || typeof is_xhtml === "undefined") ? "<br />" : "<br>";
            return (str + "").replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, "$1" + breakTag + "$2");
        }


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
            var val = item?.val ? JSON.parse(item.val) : "-";

            if (item != "" && item != undefined) {
                $("#id").val(item.id);
                @include('kasus.asesmen.resiko-bunuh-diri.js-form-edit')
            } else {
                $("#id").val(0);
                @include('kasus.asesmen.resiko-bunuh-diri.js-form-create')
            }
            $("#addModal").modal("toggle");
        });

        $(".showBtn").click(function(e) {
            id = $(this).data("id");

            var item = data[$(this).data("index")];
            var val = item.val ? JSON.parse(item.val) : "-";

            var hasil = `@include('kasus.asesmen.resiko-bunuh-diri.hasil')`;
            $("#showModalHasil #myModalBody").html(hasil);

            // update checkbox
            $(".block-hasil .checkbox-scoring").each(function() {
                var dataFaktor = $(this).data('faktor');
                var dataGroup = $(this).data('group');
                var dataShift = $(this).data('shift');
                var dataPoin = $(this).data('poin');

                try {
                    if (val.skoring[dataFaktor][dataGroup][dataShift] == dataPoin) {
                        $(this).text("✔️");
                    }
                } catch (err) {
                    console.error(err);
                }
            });

            // update skoring
            updateSkor(".block-hasil .skor-saat-ini", val.skoring);
            updateSkor(".block-hasil .skor-asesmen", val.skoring);
            updateSkor(".block-hasil .skor-total", val.skoring);

            // update level resiko
            if (val.level_resiko) {
                $(`.block-hasil input[name=level_resiko_show][value=${val.level_resiko}]`)
                    .prop('checked', true);
            }

            $("#showModalHasil").modal("toggle");
        });

        function updateSkor(selector, skoring) {
            $(selector).each(function(idx, _) {
                var dataGroup = $(this).data('group');
                var dataShift = $(this).data('shift');
                var totalSkor = 0;
                for (var faktor in skoring) {
                    try {
                        if (skoring[faktor][dataGroup][dataShift]) {
                            totalSkor += parseInt(skoring[faktor][dataGroup][dataShift]);
                        }
                    } catch (error) {
                        console.error(error);
                    }
                }
                $(this).text(totalSkor);
            });
        }

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
    </script>
@endsection
