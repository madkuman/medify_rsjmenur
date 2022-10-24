<div class="modal"  id="daftar-keluar-masuk"  role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form class="modal-content form-submit" method="post" action="{{url()->current()}}/daftar-keluar-masuk" target="_blank" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="block mb-0">
				<div class="block-header">
					<h3 class="block-title">Daftar Keluar Masuk Personel</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content">
					@include('kepegawaian.laporan.component-form.bulan-tahun-combodate')
					<div class="form-group">
						<label>Jenis Pegawai</label>
						<select class="form-control js-select2" style="width: 100%" name="jenis_pegawai" required>
							<option value="semua">Semua</option>
							@foreach ($jenis_pegawai as $item)
							<option value="{{$item->id}}">{{$item->nama}}</option>
							@endforeach
							
						</select>
                    </div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary checkBtn submit-button">
					<i class="fa fa-print"></i> Cetak
				</button>
			</div>
		</form>
	</div>
</div>