@php($modal_tipe = "pns")
<div class="modal fade" id="modal-pamen-pns-jiwa-treadmill" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Laporan Pamen dan PNS Gol IV yang melaksanakan Urikkes Jiwa dan Treadmill</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('urikkes/laporan/pamen-pns-jiwa-treadmill')}}" method="post" target="_blank">
                        {{ csrf_field() }}
                        @include('urikkes.components.modals.components.perlengkapan-surat')
                        @include('urikkes.components.modals.components.tanggal-pemeriksaan')
                        @include('urikkes.components.modals.components.ttd')
                        <input type="submit" name="submit" value="cetak" class="btn-submit btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>