<div class="modal fade" id="modal-create-resep" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block mb-0">
                <div class="block-header">
                    <h3 class="block-title">Tambah Paket Obat</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form action="{{url()->current()}}/create" id="form_create_resep" method="post" class="main-form-container">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Nama Paket Obat</label>
                            <input class="form-control" name="nama_paket">
                        </div>
                        @include('settings.components.form', ['extra_id' => ""])
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button type="submit" id="" class="btn submit-resep btn-click-animate btn-hero btn-alt-primary min-width-175">
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