<div class="block block-rounded">
	<div class="block-header">
		<h3 class="block-title">REKAP TAGIHAN BERDASARKAN KATEGORI</h3>
	</div>
	<div class="block-content block-content-full">
		<div class="table-responsive push">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th class="text-center" style="width: 60px;">#</th>
						<th>Kategori</th>
						<th class="text-right" style="width: 200px;">Subtotal</th>
					</tr>
				</thead>
				<tbody>
					@php $total = 0 @endphp
					@foreach($rekap as $key => $item)
					<tr>
						<td class="text-center">
							{{$loop->iteration}}
						</td>
						<td>
							<span style="text-transform: uppercase;">{{$key}}</span>
						</td>
						<td class="text-right">
							Rp {{number_format($item,0)}}
						</td>
					</tr>
					@php $total += $item @endphp
					@endforeach
					<tr class="table-warning">
						<td></td>
						<td class="text-right font-w700 ">TOTAL</td>
						<td class="text-right font-w700 ">Rp {{number_format($total,0)}}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>