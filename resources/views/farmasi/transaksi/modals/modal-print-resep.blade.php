<div class="modal" id="modal-print-resep-{{$transaksi->id}}" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="GET" action="{{url('farmasi/'.session('farmasi')->slug.'/resep/print/'.$transaksi->slug)}}" target="_blank">

            <input type="hidden" name="id" value="{{$transaksi->id}}">
            <input type="hidden" name="farmasi" value="{{session('farmasi')->slug}}">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Print Resep </h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-12">
                                @include('farmasi.transaksi.modals.components.dokter',['id_radio' => 'resep'])
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="penyedia">Nomor Resep</label>
                                    <input type="text" class="form-control" name="nomor_resep" placeholder="Nomor Resep" value="{{$transaksi->final_detail->nomor_resep}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-primary  form-print" id="btn-simpan-retur">
                        <i class="fa fa-check"></i> Cetak
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>