<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="" method="POST" action="{{url('humas/komplain/new')}}" id="form-add">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0">Tambah Respon</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        {{ csrf_field() }}
                        <div class="row">
				            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label class="control-label">Komplain</label>
                                    <textarea class="form-control form-control-lg" name="kompketerangan" rows="3" placeholder="Isikan Komplain" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Lokasi</label>
                                    <input type="text" class="form-control" name="lokasi" placeholder="Isikan Lokasi" required>
                                </div>

				                <div class="form-group">
				                    <label class="control-label">Tanggal / Waktu Komplain</label>
				                    <div class="form-inline">
				                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="komp-hari-new" name="komphari" style="width: 15%;">
                                            <option value="">Tanggal</option>
                                            @for($i=1; $i<=31; $i++)
                                                <option value="{{$i}}"
                                                @if ($i == date('d')) {{"selected"}} @endif
                                                >{{$i}}</option>
                                            @endfor
                                        </select>

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="komp-bulan-new" onchange="changeKompDate('new')" name="kompbulan" style="width: 15%;">
                                            <option value="">Bulan</option>
                                            <option value="01" @if ('01' == date('m')) {{"selected"}} @endif>Januari</option>
                                            <option value="02" @if ('02' == date('m')) {{"selected"}} @endif>Februari</option>
                                            <option value="03" @if ('03' == date('m')) {{"selected"}} @endif>Maret</option>
                                            <option value="04" @if ('04' == date('m')) {{"selected"}} @endif>April</option>
                                            <option value="05" @if ('05' == date('m')) {{"selected"}} @endif>Mei</option>
                                            <option value="06" @if ('06' == date('m')) {{"selected"}} @endif>Juni</option>
                                            <option value="07" @if ('07' == date('m')) {{"selected"}} @endif>Juli</option>
                                            <option value="08" @if ('08' == date('m')) {{"selected"}} @endif>Agustus</option>
                                            <option value="09" @if ('09' == date('m')) {{"selected"}} @endif>September</option>
                                            <option value="10" @if ('10' == date('m')) {{"selected"}} @endif>Oktober</option>
                                            <option value="11" @if ('11' == date('m')) {{"selected"}} @endif>November</option>
                                            <option value="12" @if ('12' == date('m')) {{"selected"}} @endif>Desember</option>
                                        </select>

                                        @php
                                            $firstYear = (int)date('Y') - 39;
                                            $lastYear = (int)date('Y');
                                        @endphp

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0 komp-tahun" id="komp-tahun-new" onchange="changeKompDate('new')" name="komptahun" style="width: 15%;">
                                            <option value="">Tahun</option>
                                            @for($i=$lastYear; $i>=$firstYear; $i--)
                                                <option value="{{$i}}" @if ($i == date('Y')) {{"selected"}} @endif>{{$i}}</option>
                                            @endfor
                                        </select>

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="kompjam" style="width: 15%;">
                                            <option value="">Jam</option>
                                            @for($i=0; $i<=23; $i++)
                                                <option value="{{$i}}" @if ($i == date('H')) {{"selected"}} @endif>{{$i}}</option>
                                            @endfor
                                        </select>

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="kompmenit" style="width: 15%;">
                                            <option value="">Menit</option>
                                            @for($i=0; $i<=59; $i++)
                                                <option value="{{$i}}" @if ($i == date('i')) {{"selected"}} @endif>{{$i}}</option>
                                            @endfor
                                        </select>
				                    </div>
				                </div>

				                <div class="form-group">
                                    <label class="control-label">Tanggal / Waktu Respon</label>
                                    <div class="form-inline">
                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="resp-hari-new" name="resphari" style="width: 15%;">
                                            <option value="" selected>Tanggal</option>
                                            @for($i=1; $i<=31; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="resp-bulan-new" onchange="changeRespDate('new')" name="respbulan" style="width: 15%;">
                                            <option value="" selected>Bulan</option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>

                                        @php
                                            $firstYear = (int)date('Y') - 39;
                                            $lastYear = (int)date('Y');
                                        @endphp

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="resp-tahun-new" onchange="changeRespDate('new')" name="resptahun" style="width: 15%;">
                                            <option value="">Tahun</option>
                                            @for($i=$lastYear; $i>=$firstYear; $i--)
                                                <option value="{{$i}}" {{-- $i == $lastYear ? 'selected' : '' --}}>{{$i}}</option>
                                            @endfor
                                        </select>

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="respjam" style="width: 15%;">
                                            <option value="">Jam</option>
                                            @for($i=0; $i<=23; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="respmenit" style="width: 15%;">
                                            <option value="">Menit</option>
                                            @for($i=0; $i<=59; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

				            </div>
				        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn-alt btn-hero btn-secondary min-width-125 mr-5" data-dismiss="modal">
                            Tutup
                        </button>
                        <button type="submit" class="btn-alt btn-hero btn-primary min-width-125" id="btn-save">
                            <i class="fa fa-send mr-5"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>