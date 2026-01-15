<div aria-hidden="true" aria-labelledby="modal-fromright" class="modal fade" id="modal-readback" role="dialog"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-fromright modal-dialog" role="document">
        <div class="modal-content">
            <div class="block-transparent mb-0 block rounded">
                <div class="block-header">
                    <h3 class="block-title">Readback</h3>
                    <div class="block-options">
                        <button aria-label="Close" class="btn-block-option" data-dismiss="modal" type="button">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form action="{{ url('api/kasus') }}/{{ $nomor_kasus }}/cppt/set-readback"
                        class="js-validation-be-contact" method="post">
                        {{ csrf_field() }}
                        <input id="cppt_id" name="cppt_id" type="hidden">
                        <div class="form-group mb-5">
                            <label class="form-label" for="dokter">Dokter</label><br>
                            <select class="form-control js-select2" data-placeholder="Pilih Dokter" id="dokter"
                                id="readback-dokter" multiple name="dokter[]" style="width:100%">
                                @foreach ($kasus->kolaborator as $kolaborator)
                                    @php
                                        $user_kolab = $kolaborator->user;
                                        if (!isset($user_kolab) || $user_kolab->profesi != 1) {
                                            continue;
                                        }
                                    @endphp
                                    <option selected value="{{ $user_kolab->id }}">{{ $user_kolab->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="notes">Catatan</label>
                            <textarea class="form-control" id="notes" name="notes" style="width:100%"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn-alt btn-click-animate btn-hero btn-primary float-right" type="submit">
                                <i class="fa fa-send mr-5"></i> Kirim
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="{{ url('api/kasus') }}/{{ $nomor_kasus }}/cppt/verifikasi-readback" hidden id="verifReadback" method="POST">
    {{ csrf_field() }}
    <input id="readback_id" name="readback_id" type="hidden">
</form>
