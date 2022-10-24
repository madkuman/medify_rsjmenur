<div class="modal" id="modalFormPemberianObat" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<form method="POST" action="{{url()->current()}}/pemberian-post" id="form-pemberian">
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title text-center">Pemberian Obat</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content ">
						{{csrf_field()}}
						<input type="hidden" class="input-id" name="id" >
						<input type="hidden" class="input-obat-px-id" name="catatan_pengobatan_pasien_id" >
						<div class="form-group">
							<label>Nama Obat</label>
							<input type="text" class="form-control input-obat-nama" disabled="">
						</div>
						<div class="form-group">
							<label>Jumlah Pemberian</label>
							<input type="number" name="jumlah" class="form-control input-jumlah" autocomplete="off" id="jumlah-pemberian" required="" min="0" step="any">
							<span class="text-danger d-none" id="warning-jumlah-pemberian">Masukkan jumlah dengan benar</span>
						</div>
						<div class="form-group">
							<label>Jam</label>
							<input type="text" name="jam" class="form-control time input-jam" placeholder="hh:mm" id="jam-pemberian" required="" value="Carbon\Carbon::now()->format('H:i')">
							<span class="text-danger d-none" id="warning-jam-pemberian">Masukkan jam dengan benar (hh:mm)</span>
						</div>
						<div class="form-group">
							<label>Tanggal</label>
							<input type="text" class="js-datepicker form-control date input-tanggal" autocomplete="off" name="tanggal" onkeydown="return false" data-week-start="1" data-autoclose="true" data-date-format="dd-mm-yyyy" value="" placeholder="dd-mm-yyyy" id="tanggal-pemberian" required="" data-today-highlight="true" min="" max="">
							<span class="text-danger d-none" id="warning-tanggal-pemberian">Masukkan tanggal dengan benar (H-30 sampai H+30)</span>
						</div>
						<div class="form-group">
							<label>Status</label>
							<select class="form-control input-status" name="status">
								<option value="sukses">Berhasil diberikan</option>
								<option value="pasien_tolak">Pasien menolak</option>
								<option value="kondisi">Batal karena kondisi</option>
								<option value="alergi">Reaksi alergi</option>
								<option value="eso">Efek samping obat</option>
								<option value="tap">obat tidak tersedia</option>
							</select>
						</div>
						<div class="form-group">
							<label>Evaluasi</label>
							<textarea class="form-control input-evaluasi" name="evaluasi"></textarea>
						</div>
						<div class="form-group">
							<label>Verifikator 1</label>
							<select class="form-control js-select2 input-verified-by" name="verified_by" style="width: 100%">
								@foreach($kolaborator as $item)
								<option value="{{$item->user->id}}">{{$item->user->name}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>Verifikator 2</label>
							<select class="form-control js-select2 input-verified-by-2" name="verified_by_2" style="width: 100%">
								@foreach($kolaborator as $item)
								<option value="{{$item->user->id}}">{{$item->user->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer" style="justify-content: flex-start;">
					<div class="form-group" style="width:100%">
						<button type="button" class="btn btn-click-animate btn-primary btn-simple pull-right" id="submit-pemberian">Simpan</button>
						<button type="button" class="btn btn-default btn-simple pull-right mr-5" data-dismiss="modal">Batal</button>
						<button type="button" class="btn btn-danger btn-simple deleteBtnPemberian" data-id="" >Hapus</button>
					</div>
				</div>
			</div><!-- /.modal-dialog -->
		</form>
	</div><!-- /.modal -->
</div>
