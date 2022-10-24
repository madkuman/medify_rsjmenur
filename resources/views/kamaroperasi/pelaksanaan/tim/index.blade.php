<div class="row">
	<div class="col-md-6">
		<h4 class="font-w400">Tim Penindak Operasi</h4>
	</div>
	<div class="col-md-6 text-right">
		@if ($tims->count())
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-tim"><i class="fa fa-pencil"></i> Edit</button>
		@else
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tim"><i class="fa fa-pencil"></i> Buat Tim</button>
		@endif
	</div>
</div>

@if ($tims->count())
<table width="50%">
	@foreach ($tims as $tim)
	<tr>
		<td width="10%">-</td>
		<td>{{ $tim->detail->name ?? '-'}}</td>
		<td>{{ $tim->role->nama ?? '-'}}</td>
	</tr>
	@endforeach
</table>
<br>
@else
<p>Tim penindak operasi belum ada</p>
@endif