@extends('pasien.layouts.main')
@section('title')
Update Index Elastic
@endsection
@section('subtitle')
@endsection
@section('content')
<div class="content pt-100">
	<div class="form-group">
		<label>Min</label>
		<input type="number" id="min" class="form-control">
	</div>
	<div class="form-group">
		<label>Max</label>
		<input type="number" id="max" class="form-control">
	</div>
	<div class="form-group">
		<label>slave</label>
		<input type="number" id="slave" class="form-control" value="20">
	</div>
	<div class="form-group">
		<label>Max job</label>
		<input type="number" id="max_job" class="form-control" value="100">
	</div>
	<div class="form-group">
		<button id="buttonSubmit" class="btn btn-primary">Submit</button>
		<button id="buttonLoading" class="btn btn-primary" disabled>Loading</button>
	</div>
	<div class="row">
		<div class="col-4">
			<div id="daftar-selesai" class="py-100">
				<h4>SUCCESS</h4>
			</div>
		</div>
		<div class="col-4">
			<div id="daftar-gagal" class="py-100">
				<h4>FAIL</h4>
			</div>
		</div>
		<div class="col-4">
			<div id="daftar-status" class="py-100">
				<h4>STATUS</h4>
			</div>
		</div>
	</div>
</div>
@endsection
@section('js')
<script type="text/javascript">
	$('#buttonLoading').hide();
	$('#buttonSubmit').click(function(){
		var min_val = $('#min').val();
		var max_val = $('#max').val();
		var min = parseInt(min_val)
		var max = parseInt(max_val)
		$('#buttonSubmit').hide();
		$('#buttonLoading').show();
		var slave = parseInt($('#slave').val())
		var max_job = parseInt($('#max_job').val())
		requestController(min,max,slave,max_job)
	})
	function requestController(min,max,slave,max_job)
	{
		var job_total = max - min;
		var job_capacity = slave * max_job;
		var total_batch_job = job_total / job_capacity;
		var current_batch = 0;
		console.log(min,max,slave,max_job,total_batch_job)
		for(j = 0; j < slave; j++)
		{
			var job_start = (job_capacity * 0 + min) + (j * max_job)
			var job_end = (job_capacity * 0 + min) + ((j+1) * max_job)
			content = "<div id='slave-"+j+"'>SLAVE" + j + " : <span id='status-"+j+"'>START</span></div>"
			$('#daftar-status').append(content);
			ajax(job_start,job_end,j,current_batch,job_capacity,total_batch_job,job_start,job_end);
		}
	}
	function ajax(current_min,current_max,slave_num,current_batch,job_capacity,total_batch_job,static_min,static_max)
	{
		$.ajax({
			type: "GET",
			url: BASE_URL + "keuangan/tarif/admin/update-tag/"+current_min+"/"+current_max,
			success: function (response) {
				content = "SLAVE-"+slave_num+ ": min : "+ current_min +" ---- max : "+ current_max + "<br>";
				$('#daftar-selesai').append(content);
				current_batch += 1;
				next_current_min = job_capacity * current_batch + static_min;
				next_current_max = job_capacity * current_batch + static_max;
				$('#status-'+slave_num).html('DONE BATCH ' + current_batch + " / " + total_batch_job);
				if(current_batch < total_batch_job){
					ajax(next_current_min,next_current_max,slave_num,current_batch,job_capacity,total_batch_job,static_min,static_max)
				}
			},
			error: function () {
				content = "SLAVE-"+slave_num+ " FAILED : min : "+ current_min +" ---- max : "+ current_max + "<br>";
				$('#daftar-gagal').append(content);
				$('#status-'+slave_num).html('RETRYING BATCH ' + current_batch + " / " + total_batch_job);
				$.ajax(this);
				return;
			}
		});
	}
</script>
@endsection