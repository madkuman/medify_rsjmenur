@php $page=1; @endphp
	@foreach($result as $row)
		@if ($page>1)
			<div style="page-break-after: always;"></div>
		@endif
		@php $page++ @endphp
		@include('keuangan.piutang.penagihan-print.penunjang.permintaan')
		@if(isset($row['detail']))
			<div style="page-break-after: always;"></div>
			@foreach($row['detail'] as $k => $d)
				@switch ($departemen) 
					@case('Radiologi')
						@include('keuangan.piutang.penagihan-print.penunjang.detail-hasil-radiologi')
						@break
					@case('LabPA')
						@include('keuangan.piutang.penagihan-print.penunjang.detail-hasil-labpa')
						@break
					@case('LabPK')
						@include('keuangan.piutang.penagihan-print.penunjang.detail-hasil-labpk')
						@break
				@endswitch
				@if(isset($row['detail'][$k+1]))
					<div style="page-break-after: always;"></div>
				@endif
			@endforeach
		@endif
	@endforeach