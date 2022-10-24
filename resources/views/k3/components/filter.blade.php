<div class="block">
	<div class="block-header block-header-default">
		<h3 class="block-title">Filter Tanggal Komplain</h3>
	</div>
	<div class="block-content">
		<form action="{{url('humas')}}" method="get">
			<div class="form-group">
				<label for="tgl_kunjungan_mulai">Mulai</label>
				<input type="text" class="form-control js-datepicker" name="filter_start"  data-date-format="dd-mm-yyyy" value="{{date('d-m-Y', strtotime($start))}}">
				<label for="tgl_kunjungan_selesai">s/d</label>
				<input type="text" class="form-control js-datepicker " name="filter_end"  data-date-format="dd-mm-yyyy" value="{{date('d-m-Y', strtotime($end))}}">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>