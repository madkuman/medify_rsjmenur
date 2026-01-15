@extends('kasus.layouts.main')

@section('title')
{{ $kasus->judul_kasus }} - Hasil Pengujian Kesehatan
@endsection

@section('content')
<main id="main-container">
    @include('kasus.layouts.header')
    <div class="content">
        <div class="row">
            @include('kasus.layouts.sidebar')
            {{-- Content --}}
            <div class="col-lg-9 col-xl-9">
                <div class="block block-bordered">
                    <div class="block-content">
                        @if (session('my_role_' . $kasus->nomor_kasus))
                        <button id="create-btn" type="button"
                            class="btn btn-rounded btn-alt-primary min-width-125 pull-right">
                            <i class="fa fa-pencil"></i> Hasil Pengujian Kesehatan Baru
                        </button>
                        <h4>Hasil Pengujian Kesehatan</h4>
                        <hr>
                        @endif

                        {{-- store the converted json string --}}
                        @php
                        $formJson = [];
                        $kolaborator_user_ids = !empty($kasus->kolaborator)
                        ? $kasus->kolaborator->pluck('user_id')->toArray()
                        : [];
                        @endphp

                        @forelse ($alat_bantu as $item)
                        {{-- convert json string dari kolom 'val' ke object
                        kemudian menambahkan atribut id yang akan digunakan
                        untuk filter ketika edit form --}}
                        @php
                        $newFormJson = json_decode($item->val);
                        $newFormJson->id = $item->id;
                        $formJson[] = $newFormJson;
                        @endphp

                        @if (in_array(Auth::user()->id, $kolaborator_user_ids))
                        <div>
                            <button class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right delete-btn"
                                data-id="{{ $item->id }}">
                                <i class="fa fa-trash"></i>
                            </button>
                            <button class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right edit-btn"
                                data-id="{{ $item->id }}" data-index="{{ $loop->iteration - 1 }}">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <a type="btn" href="{{ url()->current() }}/print/{{ $item->id }}"
                                class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right"
                                target="_blank">
                                <i class="fa fa-print"></i>
                            </a>
                        </div>
                        @endif
                        <h5 class="mb-5 pl-5">#Hasil Pengujian Kesehatan {{ $loop->iteration }}</h5>
                        <div class="row">
                            <div class="col-6">
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
                                    <h6>
                                        <small class="text-muted">Dibuat Oleh</small><br>
                                        {{ $item->creator->name }}<br>
                                        {{ date('d F y, H:i', strtotime($item->created_at)) }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-50">
                            <h4 class="font-w400 mb-5">Belum ada Hasil Pengujian Kesehatan tersedia
                            </h4>
                            <p>Klik tombol <strong>Hasil Pengujian Kesehatan Baru</strong> untuk melakukan
                                pembuatan Hasil Pengujian Kesehatan Baru</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
            {{-- ./Content --}}
        </div>
    </div>

    {{-- Modal Create/Edit --}}
    <div class="modal fade" id="create-edit-modal" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
        <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="create-edit-form" method="POST" action="#">
                    {{ csrf_field() }}
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Hasil Pengujian Kesehatan</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div id="create-edit-modal-content" class="block-content"
                            style="padding-left: 25px; padding-right: 25px;">
                            @include('kasus.alatbantu.hasil-pengujian-kesehatan.form')
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-click-animate btn-primary btn-simple">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- ./Modal Surat Keterangan Fisik Baru --}}

    {{-- Delete Form --}}
    <form method="POST" action="{{ url()->current() }}/delete" id="form-delete">
        {{ csrf_field() }}
        <input name="alatbantu_id" type="hidden" id="delete-input-id">
    </form>
</main>
@endsection

@section('js')
<script src="{{ url('') }}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
    var createEditModal = $("#create-edit-modal");
        var createEditForm = $("#create-edit-form");
        var createEditModalContent = $("#create-edit-modal-content");
        var createUrl = `{{ url()->current() }}/submit`;
        var editUrl = `{{ url()->current() }}/update`;
        var formJson = @json($formJson);

        $(document).ready(function() {
            $(`input[name="transfer_sebelum"]`).mask("00:00");
            $(`input[name="transfer_sesudah"]`).mask("00:00");
            $('.input-tags').tagsInput({
                'height': '40px',
                'width': '100%',
                'defaultText': ''
            });

            $("#create-btn").click(function(e) {
                setValueForFormEdit(null);
                createEditForm.attr("action", createUrl);
                createEditModal.modal("show");
            });

            $(".edit-btn").click(function(e) {
                var alatBantuId = $(this).data('id');
                formJson.map(function(item) {
                    if (item.id === alatBantuId) {
                        createEditForm.attr("action", editUrl);
                        setValueForFormEdit(item);
                        createEditModal.modal("show");
                        return;
                    }
                });
            });

            $(".delete-btn").click(function(e) {
                e.preventDefault();
                var alatBantuId = $(this).data("id");
                $('#delete-input-id').val(alatBantuId);
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
                        $('#form-delete').submit();
                    }
                });
            });

            function setValueForFormEdit(value) {
                $("input[name=alatbantu_id]").val(value?.id);

                if (value?.dpjp) {
                    $("select[name=dpjp]").val(value.dpjp).trigger('change');
                } else {
                    @if ($kasus->dpjp->user->id ?? null)
                        $("select[name=dpjp]").val({{ $kasus->dpjp->user->id }}).trigger('change');
                    @else
                        $("select[name=dpjp]").val(null).trigger('change');
                    @endif
                }

                // PASIEN
                $("input[name=nomor]").val(value?.nomor);
                $("input[name=sip]").val(value?.sip);
                $("input[name=nip]").val(value?.nip);
                $("input[name=alamat]").val(value?.alamat);
                $("input[name=pendidikan]").val(value?.pendidikan);
                $("input[name=tanggal_pemeriksaan]").val(value?.tanggal_pemeriksaan);
                $("input[name=tensi]").val(value?.tensi);
                $("input[name=berat_badan]").val(value?.berat_badan);
                $("input[name=tinggi_badan]").val(value?.tinggi_badan);
                $("input[name=visus]").val(value?.visus);
                $("textarea[name=syarat]").val(value?.syarat);
            }
        });
</script>
@endsection