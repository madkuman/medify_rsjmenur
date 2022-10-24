<div class="modal fade" id="modal-hasil-{{$item['id']}}" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">
                        Asesmen Awal 
                        @if($item['jenis'] == 'Gawat Darurat' || $item['jenis'] == 'Gawat Darurat Dokter')
                        Gawat Darurat
                        @elseif($item['jenis'] == 'Rawat Jalan' || $item['jenis'] == 'Rawat Jalan Dokter')
                        Rawat Jalan
                        @elseif($item['jenis'] == 'Rawat Inap' || $item['jenis'] == 'Rawat Inap Dokter')
                        Rawat Inap
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
                    @if($item['jenis'] == 'Gawat Darurat')
                    @include('kasus.datamedis.content.asesmenawal.single.single-gawat-darurat')
                    @elseif($item['jenis'] == 'Rawat Jalan')
                    @include('kasus.datamedis.content.asesmenawal.single.single-rawat-jalan')
                    @elseif($item['jenis'] == 'Rawat Inap')
                    @include('kasus.datamedis.content.asesmenawal.single.single-rawat-inap')
                    @elseif($item['jenis'] == 'Gawat Darurat Dokter')
                    @include('kasus.datamedis.content.asesmenawal.single.single-dokter-gawat-darurat')
                    @elseif($item['jenis'] == 'Rawat Jalan Dokter')
                    @include('kasus.datamedis.content.asesmenawal.single.single-dokter-rawat-jalan')
                    @elseif($item['jenis'] == 'Rawat Inap Dokter')
                    @include('kasus.datamedis.content.asesmenawal.single.single-dokter-rawat-inap')
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>