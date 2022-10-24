<div id="modal_tambah" class="modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Subkualifikasi</h4>
            </div>
            <form action="{{url()->current()}}/baru" id="form_tambah" autocomplete="off" method="POST">
                {{csrf_field()}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nama Subkualifikasi</label>
                        <input class="form-control" id="nama" type="text" placeholder="Masukkan Nama Subkualifikasi" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label>Kualifikasi</label>
                        <select class="form-control" name="kualifikasi" id="kualifikasi" required>
                            <option value="">-- Masukkan Kualifikasi --</option>
                            @foreach ($kualifikasi as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
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