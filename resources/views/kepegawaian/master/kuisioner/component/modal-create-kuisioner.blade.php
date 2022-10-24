<div class="modal fade" id="modal-create-kuisioner" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="" method="POST" action="{{url('kepegawaian/master/kuisioner/baru')}}" id="form-add-kuisioner">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0">Tambah Kuisioner</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label class="control-label">Nama</label>
                                    <input type="hidden" id="kuisionerid" name="kuisionerid">
                                    <input type="text" class="form-control form-control-lg" id="nama" name="nama" placeholder="Isikan Nama Kuisioner" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Deskripsi</label>
                                    <textarea class="form-control form-control-lg" id="deskripsi" name="deskripsi" rows="3" placeholder="Isikan Deskripsi Kuisioner" required></textarea>
                                </div>
                                <div class="form-group row">
                                    <div class="col-3">
                                        <label class="control-label">Status Aktif</label><br>
                                        <label class="css-control css-control-success css-switch">
                                            <input type="checkbox" id="status" name="status" class="css-control-input" value="1">
                                            <span class="css-control-indicator">
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="control-label">Kuisioner Publik</label><br>
                                        <label class="css-control css-control-success css-switch">
                                            <input type="checkbox" id="publik" name="publik" class="css-control-input publik-check" value="1">
                                            <span class="css-control-indicator">
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <label class="control-label">Departemen</label><br>
                                        <select class="form-control js-select2" style="width: 100%;text-transform:uppercase" name="departemen" id="departemen" disabled>
                                            <option value="" disabled selected>-- Pilih Departemen --</option>
                                            @foreach ($departemen as $item)
                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn-alt btn-hero btn-secondary min-width-125 mr-5" data-dismiss="modal">
                            Tutup
                        </button>
                        <button type="submit" class="btn-alt btn-hero btn-primary min-width-125" id="btn-save">
                            <i class="fa fa-send mr-5"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>