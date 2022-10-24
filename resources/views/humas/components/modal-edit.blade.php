<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="" method="POST" action="{{url('humas/komplain/edit')}}" id="form-add">
                {{ csrf_field() }}
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0">Ubah Respon</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content" id="block-edit-content">
                        <div class="d-none text-center" id="loading">
                            <i class="fa fa-spin fa-spinner fa-7x"></i>
                        </div>
                        <div class="row d-none" id="edit-content">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label class="control-label">Komplain</label>
                                    <input type="hidden" id="komplain-id" name="komplainid">
                                    <textarea class="form-control form-control-lg" id="keterangan" name="kompketerangan" rows="3" placeholder="Isikan Komplain" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Lokasi</label>
                                    <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Isikan Lokasi" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Tanggal / Waktu Komplain</label>
                                    <div class="form-inline">
                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0 komp-hari" id="komp-hari-edit" name="komphari" style="width: 15%;">
                                            <option value="" disabled>Tanggal</option>
                                            @for($i=1; $i<=31; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0 komp-bulan" id="komp-bulan-edit" onchange="changeKompDate('edit')" name="kompbulan" style="width: 15%;">
                                            <option value="" disabled>Bulan</option>
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

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0 komp-tahun" id="komp-tahun-edit" onchange="changeKompDate('edit')" name="komptahun" style="width: 15%;">
                                            <option value="">Tahun</option>
                                            @for($i=$lastYear; $i>=$firstYear; $i--)
                                                <option value="{{$i}}" {{-- $i == $lastYear ? 'selected' : '' --}}>{{$i}}</option>
                                            @endfor
                                        </select>

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="komp-jam-edit" name="kompjam" style="width: 15%;">
                                            <option value="">Jam</option>
                                            @for($i=0; $i<=23; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="komp-menit-edit" name="kompmenit" style="width: 15%;">
                                            <option value="">Menit</option>
                                            @for($i=0; $i<=59; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Tanggal / Waktu Respon</label>
                                    <div class="form-inline">
                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="resp-hari-edit" name="resphari" style="width: 15%;">
                                            <option value="0">Tanggal</option>
                                            @for($i=1; $i<=31; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="resp-bulan-edit" onchange="changeRespDate('edit')" name="respbulan" style="width: 15%;">
                                            <option value="0">Bulan</option>
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

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="resp-tahun-edit" onchange="changeRespDate('edit')" name="resptahun" style="width: 15%;">
                                            <option value="0">Tahun</option>
                                            @for($i=$lastYear; $i>=$firstYear; $i--)
                                                <option value="{{$i}}" {{-- $i == $lastYear ? 'selected' : '' --}}>{{$i}}</option>
                                            @endfor
                                        </select>

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="resp-jam-edit" name="respjam" style="width: 15%;">
                                            <option value="default">Jam</option>
                                            @for($i=0; $i<=23; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="resp-menit-edit" name="respmenit" style="width: 15%;">
                                            <option value="default">Menit</option>
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