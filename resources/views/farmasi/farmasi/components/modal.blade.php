<div class="modal" id="modal-large" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" enctype="multipart/form-data" action="{{url('farmasi/new')}}">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Tambah Farmasi Baru</h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Farmasi" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Jenis </label>
                                    <select class="js-select2 form-control" id="kategori-select2" name="jenis" data-placeholder="Pilih Jenis" style="width: 100%;" required>
                                        <option></option>
                                        <option value="1">Unit Farmasi</option>
                                        <option value="2">Depo</option>
                                        <option value="4">Gudang</option>
                                    </select>
                                </div>
                                <div class="form-group d-none">
                                    <label class="col-12" for="example-file-input">Logo Farmasi</label>
                                    <div class="col-12">
                                        <input type="file" id="example-file-input" name="image">
                                    </div>
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