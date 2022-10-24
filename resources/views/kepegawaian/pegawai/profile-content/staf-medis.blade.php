<div class="row">
	<div class="col-12 mt-10 mb-20">
		<h5 class="card-title font-w400">DATA STAFF MEDIS</h5>
		<hr>
		<div class="col-12 my-10">
			
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Surat Izin Praktek</label>
				</div>
				<div class="col">
					{{!empty($item->sip) ? $item->sip : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Surat Izin Praktek Aktif Hingga</label>
				</div>
				<div class="col">
					{{!empty($item->sip_expired_at) ? $item->sip_expired : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>File Surat Izin Praktek</label>
				</div>
				<div class="col">
					@if(!empty($item->sip_file))
					<a href="{{asset('uploads/kepegawaian/profile')}}/{{$item->sip_file}}"
						@if(strpos($item->sip_file, '.zip')) download @else target="_blank"@endif>Lihat File</a>
					@else
					Tidak Tersedia
					@endif
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>STR</label>
				</div>  
				<div class="col">
					{{ $item->str ?? '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>STR Aktif Hingga</label>
				</div>
				<div class="col">
					{{ $item->str_expired ?? '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>File STR</label>
				</div>
				<div class="col">
					@if(!empty($item->str_file))
					<a href="{{url('uploads/kepegawaian/profile')}}/{{$item->str_file}}" 
						@if(strpos($item->str_file, '.zip')) download @else target="_blank"@endif>Lihat File</a>
					@else
					Tidak Tersedia
					@endif
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>SKK/RKK</label>
				</div>  
				<div class="col">
					{{ $item->ppa_1 ?? '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>File SKK/RKK</label>
				</div>
				<div class="col">
					@if(!empty($item->ppa_1_file))
					<a href="{{url('uploads/kepegawaian/profile')}}/{{$item->ppa_1_file}}" 
						@if(strpos($item->ppa_1_file, '.zip')) download @else target="_blank"@endif>Lihat File</a>
					@else
					Tidak Tersedia
					@endif
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>KRED</label>
				</div>  
				<div class="col">
					{{ $item->ppa_2 ?? '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>File KRED</label>
				</div>
				<div class="col">
					@if(!empty($item->ppa_2_file))
					<a href="{{url('uploads/kepegawaian/profile')}}/{{$item->ppa_2_file}}" 
						@if(strpos($item->ppa_2_file, '.zip')) download @else target="_blank"@endif>Lihat File</a>
					@else
					Tidak Tersedia
					@endif
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>EVKIN</label>
				</div>  
				<div class="col">
					{{ $item->ppa_3 ?? '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>File EVKIN</label>
				</div>
				<div class="col">
					@if(!empty($item->ppa_3_file))
					<a href="{{url('uploads/kepegawaian/profile')}}/{{$item->ppa_3_file}}" 
						@if(strpos($item->ppa_3_file, '.zip')) download @else target="_blank"@endif>Lihat File</a>
					@else
					Tidak Tersedia
					@endif
				</div>
			</div>
		</div>
	</div>
</div>