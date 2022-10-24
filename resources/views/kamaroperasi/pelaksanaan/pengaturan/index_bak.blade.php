{{--
<div id="read-jadwal" class="content pt-0">
	<div class="row">
		<div class="col-lg-6">
			<h3 class="font-w400">Jadwal Operasi</h3>
			<h5 class="font-w400"><small>Jadwal Operasi</small><br> {{Carbon\Carbon::createFromFormat('Y-m-d', $transaksi->jadwal_operasi)->format('l, j F Y')}}</h5>
			<h5 class="font-w400"><small>Ruang Operasi</small><br> {{$transaksi->ruangan->name}}</h5>
			<h5 class="font-w400"><small>Nomor Ronde</small><br> {{ $transaksi->nomor_ronde}}</h5>
			<h5 class="font-w400"><small>Status Pelaksanaan Operasi</small><br> {{ $transaksi->status == 1 ? 'Terlaksana' : 'Dalam Perencanaan' }}</h5>
		</div>
		<div class="col-lg-6">
			<h3 class="font-w400">Dokter Pelaksana</h3>
			<h5 class="font-w400"><small>Nama Dokter</small><br> {{ $transaksi->dokter->name }}</h5>
		</div>
		<div class="col-lg-12"><hr></div>
		<div class="col-lg-12 text-center">
			<button id="pengaturan" class="btn btn-primary ">Ubah Rincian</button>	
		</div>
	</div>
</div>
--}}

@if($transaksi->status==0)
<div id="formpengaturan" class="content pt-0">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="font-w400">Pengaturan Jadwal Operasi</h3>
            <form id="pengaturan_jadwal" method="POST" action="{{url('/kamaroperasi/pelaksanaan/pengaturan')}}">
                {{csrf_field()}}
                <div class="form-group row">
                    <label class="col-12">Tanggal Operasi</label>
                    <div class="col-lg-9">
                        <input type="text" class="js-datepicker form-control" id="tanggal" name="tanggal" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" value="{{Carbon\Carbon::createFromFormat('Y-m-d', $transaksi->jadwal_operasi)->format('d-m-Y')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Ruangan</label>
                    <div class="col-md-9">
                        <select class="js-select2-item" id="ruangan" name="ruangan" style="width: 100%">
							<option></option>
						  	@foreach($ruang as $index => $ruangs)
						  		@if($ruangs->id == $transaksi->ruangan->id)
						  			<option value="{{$transaksi->ruangan->id}}" selected="selected">{{$transaksi->ruangan->name}}</option>
						  		@else
						  			<option value="{{$ruangs->id}}">{{$ruangs->name}}</option>
						  		@endif
			                @endforeach
						</select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Ronde</label>
                    <div class="col-md-9">
                        <select id="pilih-ronde" class="js-select2-item-ronde" name="ronde" style="width: 100%">
							<option value="{{$transaksi->nomor_ronde}}">{{$transaksi->nomor_ronde}}</option>
						</select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Dokter</label>
                    <div class="col-md-9">
                        <select class="js-select2-item" name="dokter" style="width: 100%">
							<option></option>
						  	@foreach($dokter as $index => $dokters)
						  		@if($dokters->id == $transaksi->dokter->id)
						  			<option value="{{$transaksi->dokter->id}}" selected="selected">{{$transaksi->dokter->name}}</option>
						  		@else
			                    	<option value="{{$dokters->id}}">{{$dokters->name}}</option>
			                    @endif
			                @endforeach
						</select>
                    </div>
                </div>
                <input type="hidden" name="id" value="{{$transaksi->id}}">
                <div class="form-group row">
                    <div class="col-12">
                        <button id="simpan" type="submit" class="btn btn-primary pull-right">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@else
<div class="content pt-0">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="font-w400">Pengaturan Jadwal Operasi</h3>
            <h5 class="font-w400">Operasi telah dilaksanakan. Pengaturan ulang jadwal sudah tidak bisa dilakukan.</h5>
        </div>
    </div>
</div>
@endif