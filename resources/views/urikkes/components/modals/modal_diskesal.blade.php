@php($modal_tipe = "diskesal")
<div class="modal fade" id="modal-diskesal" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Laporan Integrasi Sistem Diskesal</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('urikkes/laporan/diskesal')}}" method="post" target="_blank">
                        {{ csrf_field() }}
                        @include('urikkes.components.modals.components.tanggal-pemeriksaan')
                        @include('urikkes.components.modals.components.get-by')
                        <input type="submit" name="submit" value="cetak" class="btn-submit btn btn-primary float-right">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
