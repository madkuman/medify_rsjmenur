<div id="modal_tambah" class="modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Jenis Pegawai</h4>
            </div>
            <form action="{{url()->current()}}/baru" id="form_tambah" autocomplete="off" method="POST">
                {{csrf_field()}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Jenis Pegawai</label>
                        <input class="form-control" type="text" placeholder="Masukkan Jenis Pegawai" name="nama">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Indek</label>
                        <input type="number" step="any" class="form-control" placeholder="Jumlah Indek" name="index" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-batal" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary pull-right btn-submit" style="margin-left: 4px ;"> <i class="fa fa-spin fa-spinner fa-1x btn-spin"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>