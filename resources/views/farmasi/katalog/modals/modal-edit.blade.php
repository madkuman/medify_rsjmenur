<div class="modal" id="modal-normal" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" enctype="multipart/form-data" action="{{url('farmasi/'.session('farmasi')->slug.'/master-bahan-aktif')}}/edit">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$master_bahan_aktif->id}}">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Ubah Bahan Aktif</h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="control-label">Nama Bahan Aktif</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Nama Bahan Aktif" value="{{$master_bahan_aktif->nama}}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary btn-square">
                         <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>