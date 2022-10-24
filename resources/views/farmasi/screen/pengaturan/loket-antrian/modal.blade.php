<div class="modal" id="modal-medium" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/screen-tv/loket-antrian')}}/save" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Loket Antrian</h3>
                    </div>
                    <div class="block-content">
                        <input type="hidden" class="form-control" name="id" id="id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="penyedia">Nama</label>
                                    <input type="text" class="form-control" name="nama" required>
                                    <small>contoh: Loket 1</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>File Sound</label>
                                    <input type="file" accept=".mp3" name="sound" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-square" id="close" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-click-animate btn-primary btn-simple">
                         <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>