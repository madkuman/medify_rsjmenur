<div id="deletemodal" class="modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Data</h4>
            </div>
            
            <div class="modal-body">
                <p id="show-name"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-batal" data-dismiss="modal">Batal</button>
                <a id="del-btn">
                    <form id="form_delete" action="" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger pull-right btn-delete" style="margin-left: 4px ;"> <i class="fa fa-spin fa-spinner fa-1x btn-spin"></i> Hapus</button>
                    </form>
                </a>
            </div>
        </div>
    </div>
</div>