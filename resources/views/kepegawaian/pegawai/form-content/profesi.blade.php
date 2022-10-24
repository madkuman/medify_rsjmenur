<div class="block rounded">
	<div class="block-content">
		<h4 class="font-w400">DATA PROFESI</h4>
		<hr class="@if(!$is_hrd_member) d-none @endif">
		<div class="row @if(!$is_hrd_member) d-none @endif">
		</div>
		<div class="row">
			<div class="col-6">
				<div class="form-group">
					<label>Surat Izin Praktek</label>
					<input type="text" class="form-control" name="sip" value="{{$item->sip ?? ''}}">
				</div>
				<div class="form-group">
					<label>Surat Izin Praktek Aktif Hingga</label>
					<div class="input-group">
						{{ Form::text('sip_expired_at', null, ['class' => 'form-control combodate-maxyear', 'id' => 'sip_expired_at', 
						'data-format' => 'YYYY-MM-DD HH:mm:ss', 'data-template' => 'D MMMM YYYY'])}}
					</div>
				</div>

				<div class="form-group">
					<label class="col-form-label">Upload SIP <small>(Opsional)</small></label>
					<div class="input-group">
						<span class="input-group-prepend mt-5">
							<span class="btn btn-default btn-file btn-outline-primary">
								<i class="far fa-folder-open mr-5"></i>Pilih File<input type="file" multiple id="img-sip-input" name="file_sip[]">
							</span>
						</span>
						<input type="text"  id="file-name-sip" class="form-control ml-10" placeholder="Nama file" aria-label="Nama File" aria-describedby="basic-addon2" readonly>
					</div>
				</div>
			</div>
			<div class="col-6 text-center">
				@if(!empty($item->sip_file))
					<img class="mt-10 img-upload" id='img-sip-preview' src="{{url('uploads/kepegawaian/profile')}}/{{$item->sip_file}}" style="height: 200px" />
				@else
					<img class="mt-10 img-upload" id='img-sip-preview' style="height: 200px" />
				@endif

				Preview SIP
			</div>
			<div class="col-6">

				<div class="form-group">
					<label>STR</label>
					<input type="text" class="form-control" name="str" value="{{$item->str ?? ''}}">
				</div>
				<div class="form-group">
					<label>STR Aktif Hingga</label>
					<div class="input-group">
						{{ Form::text('str_expired_at', null, ['class' => 'form-control combodate-maxyear', 'id' => 'str_expired_at', 
						'data-format' => 'YYYY-MM-DD HH:mm:ss', 'data-template' => 'D MMMM YYYY'])}}
					</div>
				</div>

				<div class="form-group">
					<label class="col-form-label">Upload STR <small>(Opsional)</small></label>
					<div class="input-group">
						<span class="input-group-prepend mt-5">
							<span class="btn btn-default btn-file btn-outline-primary">
								<i class="far fa-folder-open mr-5"></i>Pilih File<input type="file" multiple id="img-str-input" name="file_str[]">
							</span>
						</span>
						<input type="text" id="file-name-str"  class="form-control ml-10" placeholder="Nama file" aria-label="Nama File" aria-describedby="basic-addon2" readonly>
					</div>
				</div>
			</div>
			<div class="col-6 text-center">
				@if(!empty($item->str_file))
					<img class="mt-10 img-upload" id='img-str-preview' src="{{url('uploads/kepegawaian/profile')}}/{{$item->str_file}}" style="height: 200px" />
				@else
					<img class="mt-10 img-upload" id='img-str-preview' style="height: 200px" />
				@endif
				Preview STR
			</div>
			<div class="col-6">
				<div class="form-group">
					<label>SKK/RKK</label>
					<input type="text" class="form-control" name="ppa_1" value="{{$item->ppa_1 ?? ''}}">
				</div>
				<div class="form-group">
					<label class="col-form-label">Upload SKK/RKK <small>(Opsional)</small></label>
					<div class="input-group">
						<span class="input-group-prepend mt-5">
							<span class="btn btn-default btn-file btn-outline-primary">
								<i class="far fa-folder-open mr-5"></i>Pilih File<input type="file" multiple id="img-ppa-1-input" name="file_ppa_1[]">
							</span>
						</span>
						<input type="text" id="file-name-ppa-1"  class="form-control ml-10" placeholder="Nama file" aria-label="Nama File" aria-describedby="basic-addon2" readonly>
					</div>
				</div>
			</div>
			<div class="col-6 text-center">
				@if(!empty($item->ppa_1_file))
					<img class="mt-10 img-upload" id='img-ppa-1-preview' src="{{url('uploads/kepegawaian/profile')}}/{{$item->ppa_1_file}}" style="height: 200px" />
				@else
					<img class="mt-10 img-upload" id='img-ppa-1-preview' style="height: 200px" />
				@endif
				Preview SKK/RKK
			</div>
			<div class="col-6">
				<div class="form-group">
					<label>KRED</label>
					<input type="text" class="form-control" name="ppa_2" value="{{$item->ppa_2 ?? ''}}">
				</div>
				<div class="form-group">
					<label class="col-form-label">Upload KRED <small>(Opsional)</small></label>
					<div class="input-group">
						<span class="input-group-prepend mt-5">
							<span class="btn btn-default btn-file btn-outline-primary">
								<i class="far fa-folder-open mr-5"></i>Pilih File<input type="file" multiple id="img-ppa-2-input" name="file_ppa_2[]">
							</span>
						</span>
						<input type="text" id="file-name-ppa-2"  class="form-control ml-10" placeholder="Nama file" aria-label="Nama File" aria-describedby="basic-addon2" readonly>
					</div>
				</div>
			</div>
			<div class="col-6 text-center">
				@if(!empty($item->ppa_2_file))
					<img class="mt-10 img-upload" id='img-ppa-2-preview' src="{{url('uploads/kepegawaian/profile')}}/{{$item->ppa_2_file}}" style="height: 200px" />
				@else
					<img class="mt-10 img-upload" id='img-ppa-2-preview' style="height: 200px" />
				@endif
				Preview KRED
			</div>
			<div class="col-6">
				<div class="form-group">
					<label>EVKIN</label>
					<input type="text" class="form-control" name="ppa_3" value="{{$item->ppa_3 ?? ''}}">
				</div>
				<div class="form-group">
					<label class="col-form-label">Upload EVKIN <small>(Opsional)</small></label>
					<div class="input-group">
						<span class="input-group-prepend mt-5">
							<span class="btn btn-default btn-file btn-outline-primary">
								<i class="far fa-folder-open mr-5"></i>Pilih File<input type="file" multiple id="img-ppa-3-input" name="file_ppa_3[]">
							</span>
						</span>
						<input type="text" id="file-name-ppa-3"  class="form-control ml-10" placeholder="Nama file" aria-label="Nama File" aria-describedby="basic-addon2" readonly>
					</div>
				</div>
			</div>
			<div class="col-6 text-center">
				@if(!empty($item->ppa_3_file))
					<img class="mt-10 img-upload" id='img-ppa-3-preview' src="{{url('uploads/kepegawaian/profile')}}/{{$item->ppa_3_file}}" style="height: 200px" />
				@else
					<img class="mt-10 img-upload" id='img-ppa-3-preview' style="height: 200px" />
				@endif
				Preview EVKIN
			</div>
		</div>
	</div>
</div>

<script>
	
</script>