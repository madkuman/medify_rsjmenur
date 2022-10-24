<div class="modal fade" id="modal-form-kuota-cuti" role="dialog" aria-labelledby="modal-fromtop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromtop modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <form class="" method="POST" action="{{url()->current()}}/form" id="main-form">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0"><span id="modal-option">Tambah</span> Cuti</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option btn-close" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="input-id" value="0">
                        <input type="hidden" name="user_id" id="input-user-id" value="{{$user->id}}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Jenis Cuti</label>
                                    <select class="form-control" name="master_cuti_id" id="input-jenis-cuti" required>
                                        @foreach($master_cuti as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Jumlah Cuti</label>
                                    <input type="number" name="jumlah_cuti" id="input-jumlah-cuti" placeholder="Masukkan Jumlah Cuti" class="form-control" required autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-delete btn-outline-danger" type="button" style="display:none">Hapus</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-default pull-right btn-close" data-dismiss="modal">
                            Tutup
                        </button>
                        <button class="btn btn-primary pull-right btn-submit" type="submit" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
                        <button class="btn btn-alt-primary btn-hero pull-right" style="display: none" type="button"  id="buttonLoading" disabled>
                            <i class="fa fa-asterisk fa-spin"></i> Loading
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>