<div class="block">
	<div class="block-content">
		<h6 class="text-muted">FILTER</h6>
		<form action="#" method="get" class="">
			<div class="row">
				<div class="col-2">
					<label class="mr-2">Mulai</label>
					<div class="form-group">
						<input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0 js-datepicker" name="tgl_komplain_start" id="tgl_komplain_start"  data-date-format="dd-mm-yyyy" value="{{$tgl_komplain_start->format('d-m-Y')}}">
					</div>
				</div>
				<div class="col-2">
					<label class="mr-2">Akhir</label>
					<div class="form-group">
						<input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0 js-datepicker" name="tgl_komplain_end" id="tgl_komplain_end"  data-date-format="dd-mm-yyyy" value="{{$tgl_komplain_end->format('d-m-Y')}}">
					</div>
				</div>
				<div class="col-2">
					<label>Status</label>
					<div class="form-group">
						<select class="form-control" name="status">
							<option value="semua" @if($status == 'semua') selected @endif>Semua</option>
							<option value="belum_respon" @if($status == 'belum_respon') selected @endif>Belum Respon</option>
							<option value="sudah_respon" @if($status == 'sudah_respon') selected @endif>Sudah Respon</option>
						</select>
					</div>
				</div>
				<div class="col-2">
					<label>Urutkan</label>
					<div class="form-group">
						<select class="form-control" name="sort_by">
							<option value="tgl_komplain_terbaru" @if($sort_by == 'tgl_komplain_terbaru') selected @endif>Terbaru</option>
							<option value="tgl_komplain_terlama" @if($sort_by == 'tgl_komplain_terlama')selected @endif>Paling Awal</option>
						</select>
					</div>
				</div>
				<div class="col-2">
					<label class="mr-2">&nbsp;</label>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">
							<i class="fa fa-filter"></i> Filter
						</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>