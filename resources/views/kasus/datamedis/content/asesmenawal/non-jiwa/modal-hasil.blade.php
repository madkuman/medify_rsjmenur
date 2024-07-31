<div class="modal fade" id="modal-hasil-{{$item->id}}" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
  <div class="modal-dialog modal-dialog-fromright modal-dialog modal-fullscreen" role="document">
    <div class="modal-content">
      <div class="block block-themed block-transparent mb-0">
        <div class="block-header">
          <h3 class="block-title">
            Asesmen Awal 
            @if(str_contains($item->type, 'gawat'))
              Gawat Darurat - Non Jiwa
            @elseif(str_contains($item->type, 'jalan'))
              Rawat Jalan - Non Jiwa
            @elseif(str_contains($item->type, 'inap'))
              Rawat Inap - Non Jiwa
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
          @if(str_contains($item->type, 'gawat'))
            @include('kasus.datamedis.content.asesmenawal.non-jiwa.single.single-dokter-gawat-darurat-non-jiwa')
          @elseif(str_contains($item->type, 'jalan'))
            @include('kasus.datamedis.content.asesmenawal.non-jiwa.single.single-dokter-rawat-jalan-non-jiwa')
          @elseif(str_contains($item->type, 'inap'))
            @include('kasus.datamedis.content.asesmenawal.non-jiwa.single.single-dokter-rawat-inap-non-jiwa')
          @else
            Tidak ditemukan asesmen
          @endif
        </div>
      </div>
    </div>
  </div>
</div>