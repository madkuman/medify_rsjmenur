<div class="modal fade" id="modal-hasil-alatbantu-{{$item->id}}" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
  <div class="modal-dialog modal-dialog-fromright modal-dialog modal-fullscreen" role="document">
    <div class="modal-content">
      <div class="block block-themed block-transparent mb-0">
        <div class="block-header">
          <h3 class="block-title">
            Asesmen Awal 
            @if($item->type == 'rsj-menur-rm-04-1-form-triage')
            Form Triage
            @else
            Lain lain
            @endif
          </h3>
          <div class="block-options">
            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
              <i class="si si-close"></i>
            </button>
          </div>
        </div>
        <div class="block-content" style="padding-left: 25px; padding-right: 25px;">
          @if($item->type == 'rsj-menur-rm-04-1-form-triage')
          @include('kasus.datamedis.content.asesmenawal.single.single-form-triage')
          @else
          Tidak ditemukan asesmen
          @endif
        </div>
      </div>
    </div>
  </div>
</div>