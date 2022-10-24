@foreach($transaksi->detail as $detail)
	@if(!is_null($detail->result))
		<?php $result = json_decode($detail->result); ?>
		<div class="modal" id="modalHasil{{$detail->id}}" tabindex="-1" role="dialog" aria-labelledby="modalHasil{{$detail->id}}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-popout" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">{{$detail->tarif->deskripsi}}</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                        	@if($result->jenis_form == 'papsmear')
                        		@include('labpa.transaksi.content.form-papsmear')
                        	@else
                        		@include('labpa.transaksi.content.form-pemeriksaan')                        	
                        	@endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

	@endif
@endforeach