<div class="modal fade show" id="modalAlatMedisSelesai" tabindex="-1" role="dialog" aria-labelledby="modalAlatMedisSelesai" aria-hidden="true">
    <form method="POST" action="{{url()->current()}}/selesai" id="formSelesai">
        {{csrf_field()}}
        <input type="hidden" name="items_template_id" id="items_template_id" value="">
        <div class="modal-dialog modal-dialog-popin" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Pengembalian Alat Medis</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <p>Apakah anda yakin akan mengembalikan alat medis tersebut ?</p>
                        <div class="form-group">
                            <label for="jumlah_pengembalian">Jumlah Pengembalian</label>
                            <input type="number" class="form-control" id="jumlah_pengembalian" name="jumlah_pengembalian" max="" value="">
                        </div>
                    </div>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Tidak
                    </button>
                    <button type="submit" class="btn btn-primary btn-click-animate">
                        <i class="fa fa-check"></i>Ya
                    </button>
                </div>
            </div>
        </div>    
    </form>
</div>