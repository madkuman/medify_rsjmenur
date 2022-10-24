<div class="modal fade" id="resepModalEdit" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Ubah Paket</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="main-form-container" action="{{url()->current()}}/edit" id="form_edit_resep" method="post">
                        <input type="hidden" id="paketEditID" name="id">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Nama Paket Obat</label>
                            <input class="form-control" name="nama_paket" id="paketEditNama">
                        </div>
                        @include('farmasi.paket-obat.modals.components.form', ['extra_id' => "-edit"])
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-hero btn-click-animate btn-alt-primary min-width-175 submit-resep">
                                    <i class="fa fa-send mr-5"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>