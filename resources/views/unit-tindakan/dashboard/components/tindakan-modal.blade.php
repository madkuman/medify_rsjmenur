<div data-keyboard="false" class="modal fade" id="modal-create-tindakan" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-full" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Buat Tindakan Baru</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <form class="js-validation-be-contact" action="{{url('unit-tindakan/'.$tindakan->slug.'/periksa')}}" method="post">
                    <input type="hidden" name="kasus_id" id="kasus-id">
                    <input type="hidden" name="transaksi_id" id="transaksi-id">
                    {{ csrf_field() }}
                    <input type="hidden" id="tarif-kelas">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="block-content">     
                             @include('kasus.datamedis.content.tindakan.components-perawat.main')
                         </div>
                     </div>
                     <div class="col-md-6 top-tindakan">
                        @include('kasus.datamedis.content.tindakan.components-perawat.tindakan-selected')
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>