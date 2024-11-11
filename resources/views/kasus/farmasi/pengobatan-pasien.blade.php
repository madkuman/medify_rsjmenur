@extends('kasus.layouts.main')
@section('title')
    {{ $kasus->judul_kasus }} - Catatan Pengobatan Pasien - Kasus
@endsection

@section('content')
    <main id="main-container">
        @include('kasus.layouts.header')
        <div class="content">
            <div class="row">
                @include('kasus.layouts.sidebar')


                <!-- Updates -->
                <div class="col-lg-8 col-xl-9">
                    <div class="row">
                        <div class="col-lg-12 modal-sidebar" style="display: none; margin-bottom: 5px;">
                            <button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal"
                                data-target="#modal-menu"><i class="fa fa-list"></i> Menu</button>
                        </div>
                        <div class="col-lg-12">
                            <div class="block rounded p-0">
                                @include('kasus.farmasi.components.navbar')

                                <div class="block-content px-20 pt-50">

                                    @if ($is_kolaborator)
                                        @if (count($pengobatan) > 0)
                                            <button type="button" class="btn btn-primary min-width-125 pull-right"
                                                data-toggle="modal" data-target="#riwayatModal"><i
                                                    class="fa fa-chart-area mr-5"></i>Riwayat Pemberian Obat</button>

                                            @if (config('medify.kasus.catatan_pemberian_obat.form_pemberian_obat') == '1')
                                                <button type="button"
                                                    class="btn btn-secondary min-width-125 pull-right  mr-10 isiPemberianObatBtnSingle"
                                                    data-method="create" data-id=""><i class="fa fa-plus mr-5"></i>Isi
                                                    Pemberian</button>
                                            @else
                                                <button type="button"
                                                    class="btn btn-secondary min-width-125 pull-right  mr-10 isiPemberianObatBtn"
                                                    data-method="create" data-id=""><i class="fa fa-plus mr-5"></i>Isi
                                                    Pemberian</button>
                                            @endif
                                        @endif

                                        <button type="button"
                                            class="btn btn-secondary min-width-125 pull-right  mr-10 isiObatBtn"
                                            data-method="create" data-id=""><i class="fa fa-plus mr-5"></i>Obat
                                            Baru</button>

                                        @if (count($pengobatan) > 0)
                                            <button type="button" class="btn btn-secondary pull-right dropdown-toggle mr-2"
                                                id="page-header-options-dropdown2" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-print mr-2" aria-hidden="true"></i>Cetak
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="page-header-options-dropdown2">
                                                <a class="dropdown-item" href="{{ url()->current() }}/print" target="_blank"
                                                    style="cursor: pointer;">
                                                    <i class="fa fa-clipboard mr-2" aria-hidden="true"></i>Cetak Pengobatan
                                                    Pasien
                                                </a>
                                                <button type="button" class="dropdown-item" style="cursor: pointer;"
                                                    data-toggle="modal" data-target="#modal-cetak-riwayat-pemberian-obat">
                                                    <i class="fa fa-clipboard mr-2" aria-hidden="true"></i>Cetak Riwayat
                                                    Pemberian Obat
                                                </button>
                                                <a class="dropdown-item" href="{{ url()->current() }}/print" target="_blank"
                                                    style="cursor: pointer;">
                                                    <i class="fa fa-clipboard mr-2" aria-hidden="true"></i>Cetak UDD
                                                </a>
                                                <a class="dropdown-item" href="{{ url()->current() }}/print" target="_blank"
                                                    style="cursor: pointer;">
                                                    <i class="fa fa-clipboard mr-2" aria-hidden="true"></i>Cetak ODDD
                                                </a>
                                            </div>
                                        @endif
                                    @endif

                                    <h4>Catatan Pengobatan Pasien</h4>
                                    <table class="table table-bordered table-vcenter table-responsive" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Obat</th>
                                                <th>Aturan</th>
                                                <th>Rute</th>
                                                @if (config('medify.kasus.riwayat_pemberian_obat.prevent_input_jika_obat_habis'))
                                                    <th>Jumlah Obat</th>
                                                    <th>Pemakaian</th>
                                                    <th>Sisa</th>
                                                @endif
                                                <th>Keterangan</th>
                                                <th>Jam Minum</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $count = 1 @endphp
                                            @forelse($pengobatan as $item)
                                                <tr>
                                                    <td>{{ $count++ }}</td>
                                                    <td>
                                                        <p style="white-space: pre">{{ $item->nama_obat ?? '-' }}</p>
                                                        @if (!empty($item->cb_segera_diberikan))
                                                            <span class="badge badge-danger"> Segera diberikan </span>
                                                        @endif
                                                        @if (!empty($item->cb_terlambat_diberikan))
                                                            <span class="badge badge-warning"> Terlambat diberikan </span>
                                                        @endif
                                                        @if (!empty($item->cb_pemberian_bebas))
                                                            <span class="badge badge-primary"> Waktu Pemberian bebas</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->aturan_pemakaian ?? '-' }}</td>
                                                    <td>{{ $item->rute ?? '-' }}</td>
                                                    @if (config('medify.kasus.riwayat_pemberian_obat.prevent_input_jika_obat_habis'))
                                                        <td>{{ $item->jumlah_obat ?? '-' }}</td>
                                                        <td>{{ $item->pemakaian ?? '-' }}</td>
                                                        <td>{{ $item->sisa ?? '-' }}</td>
                                                    @endif
                                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                                    <td></td>
                                                    <td>
                                                        @if ($is_kolaborator)
                                                            <button type="button" class="btn btn-secondary dropdown-toggle"
                                                                id="btnGroupDrop1" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">Menu</button>
                                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                                @if (session('my_role_' . $kasus->nomor_kasus))
                                                                    @if (empty($item->selesai_at))
                                                                        {{-- 
													<a class="dropdown-item isiPemberianBtn" href="javascript:void(0)" data-id="" data-obat-px-id="{{$item->id}}" data-nama="{{$item->nama_obat}}" data-method="create">
														<i class="fa fa-plus mr-5"></i>Isi Pemberian
													</a>
													<a class="dropdown-item" href="{{url()->current()}}/selesai/{{$item->id}}">
														<i class="fa fa-check mr-5"></i>Selesaikan
													</a>
													--}}

                                                                        @php
                                                                            $disabled = 'disabled';
                                                                        @endphp
                                                                        @if (session('my_role_' . $kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
                                                                            @php
                                                                                $disabled = '';
                                                                            @endphp
                                                                        @endif
                                                                        @if (empty($disabled))
                                                                            <a class="dropdown-item isiObatBtn"
                                                                                href="javascript:void(0)"
                                                                                data-content="{{ json_encode($item) }}"
                                                                                data-id="{{ $item->id }}"
                                                                                data-method="edit">
                                                                                <i class="fa fa-pencil mr-5"></i>Edit
                                                                            </a>
                                                                            <a class="dropdown-item deleteObatBtn"
                                                                                href="javascript:void(0)"
                                                                                data-id="{{ $item->id }}"
                                                                                disabled="{{ $disabled }}">
                                                                                <i class="fa fa-trash mr-5"></i>Hapus
                                                                            </a>
                                                                        @else
                                                                            <a class="dropdown-item">
                                                                                <i class="fa fa-info mr-5"></i>Anda Bukan
                                                                                Pembuat Item Ini
                                                                            </a>
                                                                        @endif
                                                                    @else
                                                                        <a class="dropdown-item"
                                                                            href="{{ url()->current() }}/selesai-batal/{{ $item->id }}">
                                                                            <i class="fa fa-times mr-5"></i>Batal Selesai
                                                                        </a>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">
                                                        <div class="text-center py-50">
                                                            <h4 class="font-w400 mb-5">Belum ada asesmen Catatan Pengobatan
                                                                Pasien tersedia</h4>
                                                            <p>Klik tombol <b>Catatan Pengobatan Pasien</b> untuk melakukan
                                                                asesmen Catatan Pengobatan Pasien</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
    <form method="POST" action="{{ url()->current() }}/pemberian-delete" id="formDeletePemberian">
        {{ csrf_field() }}
        <input name="id" type="hidden" class="input-id">
    </form>
    @include('kasus.farmasi.modal.pengobatan-riwayat')
    @include('kasus.farmasi.modal.pengobatan-pemberian-baru-single')
    @include('kasus.farmasi.modal.pengobatan-pemberian-baru')
    @include('kasus.farmasi.modal.pengobatan-add')
    @include('kasus.farmasi.modal.cetak-riwayat-pemberian-obat')

@endsection

@section('css')
    <style type="text/css">
        .zoom {
            bottom: 190px;
        }

        .zoom-out {
            bottom: 120px;
        }

        .zoom-init {
            bottom: 50px;
        }

        .tableFixHead {
            overflow-y: auto;
            height: 100px;
            border: none !important;
        }

        .tableFixHead .headrow-1 {
            top: 0;
        }

        .tableFixHead .headrow-2 {
            top: 40px;
        }

        .tableFixHead .headrow-1,
        .tableFixHead .headrow-2 {
            position: sticky;
            background: white;
            box-shadow: inset 1px 1px #eaecee, 0 1px #eaecee;
            border: none;
            z-index: 999;
        }

        .tableFixHead .headcol {
            background: white;
            position: sticky;
            width: 5em;
            left: 0;
            top: auto;
            border-top-width: 1px;
            margin-top: -1px;
            font-weight: 600;
            border: none;
            box-shadow: inset 0px 1px #eaecee, 1px 1px #eaecee;
        }

        .tableFixHead .headcolrow {
            z-index: 1000;
            position: sticky;
            left: 0;
            top: 0;
            background: white;
            box-shadow: inset 0px 1px #eaecee, 1px 1px #eaecee;
        }

        .tr-striped,
        .tr-striped td {
            background-color: #fbfbfb !important;
        }
    </style>
@endsection


@section('js')
    @include('kasus.farmasi.pengobatan-components.js')
    @include('kasus.farmasi.pengobatan-components.js-riwayat-pengobatan-modal-1day');
    @include('kasus.farmasi.pengobatan-components.js-riwayat-pengobatan-modal-3days');
    @include('kasus.farmasi.pengobatan-components.js-riwayat-pengobatan-modal-1drug');
    <script src="{{ url('') }}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
    <script type="text/javascript">
        var dataset_cppd = [];
        $(document).ready(function() {
            $('.time').mask('00:00');
            var zoom = 1;

            $('.zoom').on('click', function() {
                zoom += 0.1;
                $('.target').css('zoom', zoom);
            });
            $('.zoom-init').on('click', function() {
                zoom = 1;
                $('.target').css('zoom', zoom);
            });
            $('.zoom-out').on('click', function() {
                zoom -= 0.1;
                $('.target').css('zoom', zoom);
            });
        });

        $(document).ready(function() {
            $('#loading-obat').hide()
            $('#selected-obat').change(function(e) {
                var cpo_id = $('#selected-obat').find(":selected").val();
                if (cpo_id != null) {
                    $('#loading-obat').show()
                    catatanPengobatanPasien(cpo_id);
                }
            })
        })

        $(document).ready(function() {
            $('[rel="tooltip"]').tooltip({
                trigger: "hover"
            });
        });

        $(document).ready(function() {
            $(".deleteObatBtn").click(function(e) {
                e.preventDefault();
                id = $(this).data("id");
                $('#deleteInputId').val(id);
                swal({
                    title: "Hapus",
                    text: "Apakah anda yakin akan menghapus data ini?",
                    showCancelButton: true,
                    reverseButtons: true,
                    type: 'warning',
                    confirmButtonClass: "btn btn-danger",
                    cancelButtonClass: "btn btn-default",
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Kembali",
                    closeOnConfirm: false
                }).then(function(result) {
                    if (result.value) {
                        $('#formDelete').submit();
                    }
                });
            });
        });

        function kasusFarmasiRPOToggleContent(content_id) {
            array_class = ['1day', '1drug', '3days']

            $.each(array_class, function(key, value) {
                $('#kasus-farmasi-rpo-display-' + value).fadeOut();
                $('#kasus-farmasi-rpo-button-' + value).removeClass('btn-primary');
                $('#kasus-farmasi-rpo-button-' + value).addClass('btn-outline-primary');
            });


            $('#kasus-farmasi-rpo-button-' + content_id).addClass('btn-primary');
            $('#kasus-farmasi-rpo-button-' + content_id).removeClass('btn-outline-primary');
            $('#kasus-farmasi-rpo-display-' + content_id).fadeIn();
        }

        $(".save-pemberian-obat").click(function(e) {
            e.preventDefault();
            if ($('.input-select-obat').val().length == 0) {
                $('#error-nama-pemberian-obat').removeClass('d-none');
                return 0;
            } else {
                $('#error-nama-pemberian-obat').addClass('d-none');
            }

            if (FITUR_VERIFIKATOR_PEMBERIAN_OBAT != 'undefined' && FITUR_VERIFIKATOR_PEMBERIAN_OBAT == 0) {
                let verifikator_1 = $("#verified-by option:selected").val(); // .val() ini nge return id nya
                let verifikator_2 = $("#verified-by-2 option:selected").val(); // .val() ini nge return id nya
                if (verifikator_1 == verifikator_2) {
                    $('#error-verifikator-pemberian-obat').removeClass('d-none');
                    return 0;
                } else {
                    $('#error-verifikator-pemberian-obat').addClass('d-none');
                    $('#form-pemberian-obat').submit()
                }
            } else if (FITUR_VERIFIKATOR_PEMBERIAN_OBAT != 'undefined' && FITUR_VERIFIKATOR_PEMBERIAN_OBAT == 1) {
                let verify_1 = $('[name="verifikator_name"]').val(); // .val() ini nge return text nya
                let verify_2 = $('[name="verifikator_name_2"]').val(); // .val() ini nge return text nya
                if (verify_1 == verify_2) {
                    $('#error-verifikator-pemberian-obat').removeClass('d-none');
                    return 0;
                } else {
                    $('#error-verifikator-pemberian-obat').addClass('d-none');
                    $('#form-pemberian-obat').submit()
                }
            }
        });
    </script>
    @if (config('medify.kasus.ttd_verifikator_pemberian_obat.on'))
        <script type="text/javascript">
            $("#form-pemberian-obat").submit(function(e) {
                e.preventDefault();

                var actionurl = e.currentTarget.action;
                var imgUrl = saveImg();
                var imgUrl2 = saveImg2();

                var formData = $('#form-pemberian-obat').serializeArray();
                formData.push({
                    name: '_token',
                    value: '{{ csrf_token() }}'
                });
                formData.push({
                    name: 'imgUrl',
                    value: imgUrl
                });
                formData.push({
                    name: 'imgUrl2',
                    value: imgUrl2
                });

                $.ajax({
                    url: actionurl,
                    type: 'POST',
                    data: formData,
                    success: function(result) {
                        clearCanvas();
                        clearCanvas2();
                        window.location.href = "{{ url()->current() }}";
                    }
                });
            });

            // CANVAS FOR TTD FIELD
            var canvas, ctx, flag = false,
                prevX = 0,
                currX = 0,
                prevY = 0,
                currY = 0,
                pos = {};

            var lineColor = "black",
                lineWidth = 2;

            function initCanvas() {
                canvas = document.getElementById('canvas');
                canvas.style.touchAction = "none";
                ctx = canvas.getContext("2d");
                w = canvas.width;
                h = canvas.height;

                canvas.addEventListener("pointermove", function(e) {
                    e.preventDefault();
                    findXY('move', e)
                }, false);
                canvas.addEventListener("pointerdown", function(e) {
                    e.preventDefault();
                    findXY('down', e)
                }, false);
                canvas.addEventListener("pointerup", function(e) {
                    e.preventDefault();
                    findXY('up', e)
                }, false);
            }

            // draw line
            function draw() {
                ctx.beginPath();
                ctx.strokeStyle = lineColor;
                ctx.lineWidth = lineWidth;
                ctx.moveTo(prevX, prevY);
                ctx.lineTo(currX, currY);
                ctx.closePath();
                ctx.stroke();
            }

            // clear canvas
            function clearCanvas() {
                // Use the identity matrix while clearing the canvas
                ctx.setTransform(1, 0, 0, 1, 0, 0);
                ctx.clearRect(0, 0, w, h);
            }

            function saveImg() {
                var dataURL = canvas.toDataURL();
                return dataURL;
            }

            function getMousePos(canvas, evt) {
                var rect = canvas.getBoundingClientRect();
                return {
                    x: (evt.clientX - rect.left) / (rect.right - rect.left) * canvas.width,
                    y: (evt.clientY - rect.top) / (rect.bottom - rect.top) * canvas.height
                };
            }

            function findXY(res, e) {
                pos = getMousePos(canvas, e);
                prevX = currX;
                prevY = currY;
                currX = pos.x;
                currY = pos.y;

                if (res == 'down') {
                    flag = true;
                }
                if (res == 'up') {
                    flag = false;
                }
                if (res == 'move') {
                    if (flag) {
                        draw();
                    }
                }
            }

            //-------------------------------------------

            var canvas2, ctx2, flag2 = false,
                prevX2 = 0,
                currX2 = 0,
                prevY2 = 0,
                currY2 = 0,
                pos2 = {};

            function initCanvas2() {
                canvas2 = document.getElementById('canvas2');
                canvas2.style.touchAction = "none";
                ctx2 = canvas2.getContext("2d");
                w2 = canvas2.width;
                h2 = canvas2.height;

                canvas2.addEventListener("pointermove", function(e) {
                    e.preventDefault();
                    findXY2('move', e)
                }, false);
                canvas2.addEventListener("pointerdown", function(e) {
                    e.preventDefault();
                    findXY2('down', e)
                }, false);
                canvas2.addEventListener("pointerup", function(e) {
                    e.preventDefault();
                    findXY2('up', e)
                }, false);
            }

            // draw line
            function draw2() {
                ctx2.beginPath();
                ctx2.strokeStyle = lineColor;
                ctx2.lineWidth = lineWidth;
                ctx2.moveTo(prevX2, prevY2);
                ctx2.lineTo(currX2, currY2);
                ctx2.closePath();
                ctx2.stroke();
            }

            // clear canvas
            function clearCanvas2() {
                // Use the identity matrix while clearing the canvas
                ctx2.setTransform(1, 0, 0, 1, 0, 0);
                ctx2.clearRect(0, 0, w2, h2);
            }

            function saveImg2() {
                var dataURL2 = canvas2.toDataURL();
                return dataURL2;
            }

            function getMousePos2(canvas2, evt) {
                var rect2 = canvas2.getBoundingClientRect();
                return {
                    x2: (evt.clientX - rect2.left) / (rect2.right - rect2.left) * canvas2.width,
                    y2: (evt.clientY - rect2.top) / (rect2.bottom - rect2.top) * canvas2.height
                };
            }

            function findXY2(res2, e) {
                pos2 = getMousePos2(canvas2, e);
                prevX2 = currX2;
                prevY2 = currY2;
                currX2 = pos2.x2;
                currY2 = pos2.y2;

                if (res2 == 'down') {
                    flag2 = true;
                }
                if (res2 == 'up') {
                    flag2 = false;
                }
                if (res2 == 'move') {
                    if (flag2) {
                        draw2();
                    }
                }
            }


            $(document).ready(function() {
                initCanvas();
                $(".clearCanvas").click(function(e) {
                    clearCanvas();
                });
                initCanvas2();
                $(".clearCanvas2").click(function(e) {
                    clearCanvas2();
                });
            });
        </script>
    @endif
@endsection
