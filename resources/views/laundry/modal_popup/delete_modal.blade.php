<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-popout modal-dialog-centered modal-lg" role="document">
    <div class="block rounded modal-content transaction-index" ng-controller="PasienController">
      <div class="modal-header pb-0">
        <h5 id="exampleModalLabel">Anda yakin untuk menghapus permintaan ini ?</h5>
      </div>
      <div class="modal-body text-right">
        <button type="button" class="btn btn-secondary" style="padding:0px 40px;" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger" style="padding:0px 40px;" id="buttonDeleteModal">Ya</button>
        <button class="btn btn-alt-danger ml-2" style="display: none; padding:0px 40px;" type="button"  id="buttonDeleteLoading">
        <i class="fa fa-asterisk fa-spin"></i> Memuat
        </button>
      </div>
    </div>
  </div>
</div>
