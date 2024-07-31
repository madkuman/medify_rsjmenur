<div class="modal" id="riwayatModal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<div class="modal-content">
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header" style="width: 100%">
					<h3 class="block-title">Riwayat Pemberian Obat</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="text-center mt-20">
					<button id="kasus-farmasi-rpo-button-1day" class="btn btn-primary" onclick="kasusFarmasiRPOToggleContent('1day')" >Per Hari</button>
					<button id="kasus-farmasi-rpo-button-3days" class="btn btn-outline-primary" onclick="kasusFarmasiRPOToggleContent('3days')">Per 3 Hari</button>
					<button id="kasus-farmasi-rpo-button-1drug" class="btn btn-outline-primary" onclick="kasusFarmasiRPOToggleContent('1drug')">Per Obat</button>
				</div>
				@include('kasus.farmasi.modal.pengobatan-riwayat-display-1day');
				@include('kasus.farmasi.modal.pengobatan-riwayat-display-1drug');
				@include('kasus.farmasi.modal.pengobatan-riwayat-display-3days');
			</div>
		</div>
	</div>
</div>