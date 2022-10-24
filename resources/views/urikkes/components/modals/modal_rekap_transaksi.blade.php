@php($modal_tipe = "rekap transaksi")
<div class="modal fade" id="modal-rekap-transaksi" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Rekapitulasi Transaksi Medical Checkup</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('urikkes/laporan/rekap-transaksi/')}}" method="post" target="_blank">
                        {{ csrf_field() }}
                        @include('urikkes.components.modals.components.tanggal-pemeriksaan')
                        <input type="submit" name="submit" value="cetak" class="btn-submit btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>