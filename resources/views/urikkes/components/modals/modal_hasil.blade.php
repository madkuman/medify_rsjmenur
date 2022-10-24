@php($modal_tipe = "hasil")
<div class="modal fade" id="modal-hasil" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Hasil Uji dan Pemeriksaan Kesehatan</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('urikkes/laporan/riwayat/')}}" method="post" target="_blank">
                        {{ csrf_field() }}
                        @include('urikkes.components.modals.components.perlengkapan-surat')
                        @include('urikkes.components.modals.components.tanggal-pemeriksaan')
                        @include('urikkes.components.modals.components.ttd')
                        @include('urikkes.components.modals.components.get-by')
                        <input type="submit" name="submit" value="Cetak" class="btn-submit btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>