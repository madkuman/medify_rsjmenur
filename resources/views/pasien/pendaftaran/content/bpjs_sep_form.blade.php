<div class="col-12 form-group input-group bpjs pilih-sep" id="sep_select_wrapper" style="display: none;">
	<select name="sep" class="form-control js-select2 sep_input" id="sep_select" data-placeholder="Nomor SEP Pasien"
		style="width: 91%;">
		<option value=""></option>
		@foreach($sep as $item)
		@if(isset($item->no_sep))
		<option value="{{json_encode($item)}}">{{$item->no_sep}} - @if($item->jenis_pelayanan == 1) Rawat Inap @else
			Rawat Jalan @endif</option>
		@endif
		@endforeach
	</select>
	<div class="input-group-append" style="width: 9%;">
		<button type="button" class="btn btn-alt-primary" id="sep_select_refresh"
			data-tanggal-start="{{date('d-m-Y',strtotime(" -1 month"))}}" data-tanggal-end="{{date('d-m-Y')}}"
			data-ppk="{{config('app.bpjs_ppk')}}">
			<i class="fa fa-refresh"></i>
		</button>
		<button type="button" class="btn btn-alt-primary" style="display: none;" id="sep_select_loading" disabled="">
			<i class="fa fa-asterisk fa-spin"></i>
		</button>
	</div>
</div>

<div class="col-12 form-group input-group bpjs pilih-sep" style="display: none;">
	<label class="css-control css-control-primary css-checkbox">
		<input type="checkbox" class="css-control-input sep_input" id="custom_sep_check">
		<span class="css-control-indicator"></span> SEP yang saya cari tidak terdaftar
	</label>
</div>

<div class="col-12 form-group input-group pilih-sep" id="sep_custom_wrapper" style="display: none;">
	<input type="text" name="sep" id="sep_custom" class="form-control sep_input" placeholder="Nomor SEP Pasien">
	<div class="input-group-append" style="width: 9%;">
		<button type="button" class="btn btn-alt-primary" id="sep_custom_send">
			<i class="fa fa-send"></i>
		</button>
		<button type="button" class="btn btn-alt-primary" style="display: none;" id="sep_custom_loading" disabled="">
			<i class="fa fa-asterisk fa-spin"></i>
		</button>
	</div>
</div>

<div class="col-12 pilih-sep" style="display: none;" id="infoBPJSWrapper">
	<div class="form-group">
		<div class="block block-bordered">
			<div class="block-content">
				<div id="infoBPJS" class="row">
					<div class="col-12 mb-20">
						<span class="font-w600 h3">
							Data Penerbitan SEP <i class="fa fa-spin fa-asterisk text-info" id="data_sep_loading"
								style="display: none;"></i>
						</span>
					</div>
					<div class="col-lg-4 col-12">
						<div class="font-w600">Nomor SEP</div>
					</div>
					<div class="col-lg-8 col-12 mb-5" id="data_sep"></div>
					<div class="col-lg-4 col-12">
						<div class="font-w600">Nomor Rujukan</div>
					</div>
					<div class="col-lg-8 col-12 mb-5" id="data_sep_rujukan"></div>
					<div class="col-lg-4 col-12">
						<div class="font-w600">Jenis Pelayanan</div>
					</div>
					<div class="col-lg-8 col-12 mb-5" id="data_sep_jenis_pelayanan"></div>
					<div class="col-lg-4 col-12">
						<div class="font-w600">Poli</div>
					</div>
					<div class="col-lg-8 col-12 mb-5" id="data_sep_poli"></div>

					<div class="col-lg-4 col-12">
						<div class="font-w600">DPJP</div>
					</div>
					<div class="col-lg-8 col-12 mb-5" id="data_sep_dpjp"></div>

					<div class="col-lg-4 col-12">
						<div class="font-w600">Poli Eksekutif</div>
					</div>
					<div class="col-lg-8 col-12 mb-5" id="data_sep_poli_eksekutif"></div>
					<div class="col-lg-4 col-12">
						<div class="font-w600">COB</div>
					</div>
					<div class="col-lg-8 col-12 mb-5" id="data_sep_cob"></div>
					<div class="col-lg-4 col-12">
						<div class="font-w600">Katarak</div>
					</div>
					<div class="col-lg-8 col-12 mb-5" id="data_sep_katarak"></div>
					<div class="col-lg-4 col-12">
						<div class="font-w600">Jaminan Laka</div>
					</div>
					<div class="col-lg-8 col-12 mb-5" id="data_sep_laka"></div>
					<div class="col-lg-4 col-12">
						<div class="font-w600">SEP Suplesi</div>
					</div>
					<div class="col-lg-8 col-12 mb-5" id="data_sep_suplesi_laka"></div>
					<div class="col-lg-4 col-12">
						<div class="font-w600">Tanggal Laka</div>
					</div>
					<div class="col-lg-8 col-12 mb-5" id="data_sep_tanggal_laka"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-12 form-group bpjs pilih-sep" id="sep_button_wrapper" style="display: none;">
	@if(!config('medify.third-party.vclaim.on_v2'))
	<button type="button" class="btn btn-info mb-10" id="sep_button_auto" style="width: 100%;">
		<i class="fa fa-plus"></i> Terbitkan SEP Otomatis
	</button>
	@endif
	<button type="button" class="btn btn-outline-info" id="sep_button" style="width: 100%;">
		<i class="fa fa-plus"></i> Terbitkan SEP Manual
	</button>
</div>