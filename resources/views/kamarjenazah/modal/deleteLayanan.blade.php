<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-popout" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Layanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah anda yakin akan menghapus layanan ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="buttonDelete"><i class="fa fa-times"></i> Hapus</button>
        <button class="btn btn-alt-danger" style="display: none" type="button" id="buttonDeleteLoading">
        <i class="fa fa-asterisk fa-spin"></i> Menghapus
        </button>
      </div>
    </div>
  </div>
</div>
