<div id="modal_edit" class="modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Loket</h4>
            </div>
            <form action="{{url()->current()}}/edit" id="form_edit" autocomplete="off" method="POST">
                {{csrf_field()}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nama Loket</label>
                        <input class="form-control" id="nama_edit" type="text" placeholder="Masukkan Nama Loket" name="nama" required>
                        <small>contoh : Loket 1</small>
                    </div>
                    <div class="form-group">
                        <label>Jenis Pasien</label>
                        <select name="jenis_pasien" class="form-control" id="jenis_pasien_edit" required>
                            <option disabled value="">Pilih jenis pasien</option>
                            <option value="2">Pasien Baru</option>
                            <option value="1">Pasien Lama</option>
                            <option value="3">Pasien Tunai</option>
                            <option value="4">Pasien TNI/Keluarga TNI</option>
                            <option value="5">Pamen/Pati TNI</option>
                        </select>
                    </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-batal" data-dismiss="modal">Batal</button>
                    <a id="del-btn">
                        <button type="submit" class="btn btn-primary pull-right btn-submit" style="margin-left: 4px ;"> <i class="fa fa-spin fa-spinner fa-1x btn-spin"></i> Simpan</button>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>