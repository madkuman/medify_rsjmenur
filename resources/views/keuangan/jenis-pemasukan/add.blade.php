<div id="add-modal" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-bg">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="post" action="{{url()->current()}}/simpan">
                    {{ csrf_field() }}
                    <div name="modal-title" class="font-size-lg font-w600">Tambah/Edit Jenis Pemasukan</div>
                    <div class="form-group row">
                        <label class="col-12">Nama</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" autocomplete="off" name="nama" id="nama-jenis-pemasukan" required>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id-jenis-pemasukan">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" >Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>