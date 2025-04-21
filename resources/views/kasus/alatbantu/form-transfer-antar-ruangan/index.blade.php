@extends('kasus.layouts.main')

@section('title')
    {{ $kasus->judul_kasus }} - Form Transfer Antar Ruangan
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
                                    <i class="fa fa-pencil"></i> Form Transfer Antar Ruangan Baru
                                </button>
                                <h4>Form Transfer Antar Ruangan</h4>
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
                                        <button
                                            class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right delete-btn"
                                            data-id="{{ $item->id }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <button
                                            class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right edit-btn"
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
                                <h5 class="mb-5 pl-5">#Form Transfer Antar Ruangan {{ $loop->iteration }}</h5>
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
                                    <div class="col-6">
                                        @if (!empty($item->terima_by))
                                            @if (!empty($item->penerima->avatar_thumb))
                                                <div class="float-left mr-10 align-middle">
                                                    <img class="img-avatar img-avatar-sm img-avatar-thumb"
                                                        src="{{ url($item->creator->avatar_thumb) }}"
                                                        alt="avatar-penerima">
                                                </div>
                                            @else
                                                <div class="float-left mr-10 align-middle">
                                                    <img class="img-avatar img-avatar-sm img-avatar-thumb"
                                                        src="{{ url('assets/img/placeholder.jpg') }}"
                                                        alt="avatar-penerima">
                                                </div>
                                            @endif
                                            <div class="creator">
                                                <h6>
                                                    <small class="text-muted">Diterima Oleh</small><br>
                                                    {{ $item->penerima->name }}<br>
                                                    {{ date('d F y, H:i', strtotime($item->terima_at)) }}
                                                </h6>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-50">
                                    <h4 class="font-w400 mb-5">Belum ada asesmen Form Transfer Antar Ruangan tersedia
                                    </h4>
                                    <p>Klik tombol <strong>Form Transfer Antar Ruangan Baru</strong> untuk melakukan
                                        asesmen transfer antar ruangan</p>
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
            <div class="modal-dialog modal-dialog-fromright modal-dialog modal-fullscreen" role="document">
                <div class="modal-content">
                    <form id="create-edit-form" method="POST" action="#">
                        {{ csrf_field() }}
                        <div class="block block-themed block-transparent mb-0">
                            <div class="block-header">
                                <h3 class="block-title">Form Transfer Antar Ruangan</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                        <i class="si si-close"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="create-edit-modal-content" class="block-content"
                                style="padding-left: 25px; padding-right: 25px;">
                                @include('kasus.alatbantu.form-transfer-antar-ruangan.form')
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
        {{-- ./Modal Form Transfer Antar Ruangan Baru --}}

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

                $("select[name=dokter_spesialis_lain]")
                    .val(value?.dokter_spesialis_lain)
                    .trigger('change');

                if (value?.tgl_mrs) {
                    $("input[name=tgl_mrs]").val(value.tgl_mrs);
                } else {
                    $("input[name=tgl_mrs]").val(
                        "{{ !empty($kasus->mrs_at) ? date('Y-m-d', strtotime($kasus->mrs_at)) : '' }}");
                }
                $("input[name=tgl_pindah]").val(value?.tgl_pindah);

                $("select[name=diagnosis_mrs]").val(value?.diagnosis_mrs);
                $("select[name=diagnosis_mrs]").trigger('change');

                if (value?.alergi) $("input[name=alergi]").importTags(value.alergi);
                else $("input[name=alergi]").importTags("{{ $kasus->identitas->alergi_obat ?? '' }}");

                $("input[name=alasan_admisi]").val(value?.alasan_admisi);

                // RINGKASAN RIWAYAT PASIEN
                $("input[name=anamnesis]").val(value?.anamnesis);
                $("textarea[name=keluhan_utama]").val(value?.keluhan_utama);
                $("textarea[name=riwayat_penyakit]").val(value?.riwayat_penyakit);
                $("textarea[name=pemeriksaan_fisik]").val(value?.pemeriksaan_fisik);
                $("textarea[name=keadaan_umum]").val(value?.keadaan_umum);

                $("textarea[name=pemeriksaan_penunjang]").val(value?.pemeriksaan_penunjang);
                $("textarea[name=tindakan_medis]").val(value?.tindakan_medis);
                $("textarea[name=pemberian_terapi]").val(value?.pemberian_terapi);
                $("textarea[name=lain_lain]").val(value?.lain_lain);

                // KONDISI PASIEN
                $("input[name=dari_ruang]").val(value?.dari_ruang);
                $("input[name=ke_ruang]").val(value?.ke_ruang);

                $("input[name=transfer_sebelum]").val(value?.transfer_sebelum);
                $("input[name=transfer_sesudah]").val(value?.transfer_sesudah);

                $("input[name=keadaan_umum_sebelum]").val(value?.keadaan_umum_sebelum);
                $("input[name=keadaan_umum_sesudah]").val(value?.keadaan_umum_sesudah);

                $("input[name=kesadaran_sebelum]").val(value?.kesadaran_sebelum);
                $("input[name=kesadaran_sesudah]").val(value?.kesadaran_sesudah);

                $("input[name=tensi_sebelum]").val(value?.tensi_sebelum);
                $("input[name=tensi_sesudah]").val(value?.tensi_sesudah);

                $("input[name=suhu_sebelum]").val(value?.suhu_sebelum);
                $("input[name=suhu_sesudah]").val(value?.suhu_sesudah);

                $("input[name=nadi_sebelum]").val(value?.nadi_sebelum);
                $("input[name=nadi_sesudah]").val(value?.nadi_sesudah);

                $("input[name=resp_sebelum]").val(value?.resp_sebelum);
                $("input[name=resp_sesudah]").val(value?.resp_sesudah);

                $("textarea[name=catatan_sebelum]").val(value?.catatan_sebelum);
                $("textarea[name=catatan_sesudah]").val(value?.catatan_sesudah);

                $("select[name=petugas_sebelum]").val(value?.petugas_sebelum).trigger('change');
                $("select[name=petugas_sesudah]").val(value?.petugas_sesudah).trigger('change');
            }
        });
    </script>
@endsection
