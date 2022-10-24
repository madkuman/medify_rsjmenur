
<div class="modal fade" id="modal-chart-vital" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-fromright modal-dialog" role="document">
		<div class="modal-content">
			<div class="block rounded block-transparent mb-0">
				<div class="block-header">
					<h3 class="block-title">Grafik TTV</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content">
					<div class="mb-20">
						<button class="btn btn-primary" onclick="selectDataset('temperatur');">Temperatur</button>
						<button class="btn btn-primary" onclick="selectDataset('nadi');">Nadi</button>
						<button class="btn btn-primary" onclick="selectDataset('pernapasan');">Pernapasan</button>
						<button class="btn btn-primary" onclick="selectDataset('sistol');">Sistol</button>
						<button class="btn btn-primary" onclick="selectDataset('diastol');">Diastol</button>
						<button class="btn btn-primary" onclick="selectDataset('map_sistol_diastol');">MAP</button>
						<button class="btn btn-primary" onclick="selectDataset('spo2');">SPO2</button>
                        @if($kasus->lokasi->lokasi->departemen->slug != 'rawat-jalan')
						<button class="btn btn-primary" onclick="selectDataset('skala_nyeri');">Skala Nyeri</button>
						<button class="btn btn-primary" onclick="selectDataset('gula_darah_sewaktu');">Gula Darah</button>
						<button class="btn btn-primary" onclick="selectDataset('produksi_urine');">Produksi Urine</button>
						<button class="btn btn-primary" onclick="selectDataset('berat_badan');">Berat Badan</button>
						@endif
					</div>
					<h3 class="block-title text-center font-w600 vital-sign-chart-title" style="text-transform: capitalize;">Temperatur</h3>
					<div id="vitalSignCharts" style="width: 100%; height: 430px;"></div>
					<div id="vitalSignError" style="width: 100%; height: 430px; display: none;" class="text-center"><b>Berat Badan</b> Pasien Belum Diisi.</div>
				</div>
			</div>
		</div>
	</div>
</div>