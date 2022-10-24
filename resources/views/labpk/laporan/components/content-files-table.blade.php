<table class="table table-bordered table-striped table-vcenter js-dataTable-full">
	<thead>
		<tr>
			<th class="text-center">No</th>
			<th>Nama File</th>
			<th>Download</th>
		</tr>
	</thead>
	<tbody>
		@foreach($lap->files as $item)
		<tr>
			<td class="text-center">{{$loop->iteration}}</td>
			<td>{{$item->file_name}}</td>
			<td>
				<a class="btn btn-sm btn-primary" href="{{url($item->file_path)}}">
					<i class="fa fa-download"></i> Download
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>