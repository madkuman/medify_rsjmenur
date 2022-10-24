<div class="modal" id="modal-normal" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" enctype="multipart/form-data" action="{{url()->current()}}/new">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Sumber Dana Baru</h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="control-label">Nama Sumber Dana</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Nama Sumber Dana" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="control-label">Kategori</label>
                                    <select class="js-select2 form-control" name="kategori_id" style="width: 100%;" data-placeholder="Pilih Kategori">
                                        @foreach($kategori as $supp)
                                            <option value="{{$supp->id}}">{{$supp->nama}}</option>
                                        @endforeach
                                    </select>
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