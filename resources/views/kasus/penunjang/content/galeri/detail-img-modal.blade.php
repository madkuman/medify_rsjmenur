<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="modal-slideup" aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideup" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Edit</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/penunjang/edit">
                <div class="block-content">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$item->id}}">
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" value="{{$item->judul}}" name="judul">
                    </div>
                    <div class="form-group">
                        <label>Caption</label>
                        <textarea class="form-control" name="caption" rows="9">{{$item->caption}}</textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-alt-success">
                    <i class="fa fa-check"></i> Perfect
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modal-slideup" aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideup" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Apakah anda yakin?</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <form id="formDelete" method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/penunjang/delete">
                    <input type="hidden" name="id" id="inputIDDelete" value="{{$item->id}}">
                    {{csrf_field()}}
                <div class="block-content">
                    Penunjang yang telah dihapus tidak dapat dikembalikan lagi
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-alt-danger">
                    <i class="fa fa-check"></i> Hapus
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

