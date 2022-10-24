<div class="modal" id="modal-print-nota" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/transaksi/print/'.$transaksi->slug)}}" target="_blank">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$transaksi->id}}">
            <input type="hidden" name="farmasi" value="{{session('farmasi')->slug}}">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Print Nota </h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Penanggung Jawab</label>
                                    <input type="text" class="form-control" id="nama-pj" name="pj" placeholder="Nama Penanggung Jawab" value="{{$transaksi->nama_pasien}}">
                                </div>
                            </div>
                            <div class="col-12">
                                @include('farmasi.transaksi.modals.components.dokter',['id_radio' => 'nota'])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-alt-primary" id="btn-cetak-nota-2">
                        <i class="fa fa-check"></i> Cetak
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>