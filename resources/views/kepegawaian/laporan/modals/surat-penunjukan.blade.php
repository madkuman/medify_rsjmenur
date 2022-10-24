<div class="modal"  id="surat-penunjukan"  role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form class="modal-content form-submit" method="get" action="{{url()->current()}}/surat-penunjukan" target="_blank" enctype="multipart/form-data">
			<div class="block mb-0">
				<div class="block-header">
					<h3 class="block-title">Surat Penunjukan</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content">
					<!-- JUDUL -->
					<div class="form-group">
						<label>Judul Surat</label>
						<div class="form-inline">
							<input type="text" name="judul" class="form-control" style="width: 100%">
						</div>
					</div>

					<!-- JENIS -->
					<div class="form-group">
						<div class="form-group">
							<label>Jenis Surat</label>
							<select class="form-control js-select2" style="width: 100%" name="jenis">
								<option value="Sprin">Sprin</option>
							</select>
						</div>
					</div>

					<!-- NAMA -->
					<!-- <div class="form-group">
						<div class="form-group">
							<label>Nama</label>
							<select class="form-control js-select2" style="width: 100%" name="nama">
								<option value="nama">Pentol</option>
							</select>
						</div>
					</div> -->

					<!-- DAFTAR PERSONEL -->
					<div class="form-group">
						<div class="form-group">
							<label>Daftar Personel</label>
							<select class="form-control js-select2" style="width: 100%" name="daftar-personel[]" multiple="multiple">
								@foreach($pegawai as $item)
								<option value="{{$item->id}}">{{$item->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					@include('kepegawaian.laporan.component-form.bulan-tahun-combodate')
					@include('kepegawaian.laporan.component-form.tanda-tangan-select2')
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