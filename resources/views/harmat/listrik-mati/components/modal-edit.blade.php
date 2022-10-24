<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="" method="POST" action="" id="form-edit">
                {{ csrf_field() }}
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0">Ubah Data Riwayat Listrik Mati</h4>
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
                                    <label class="control-label">Tanggal Listrik Mati</label>
                                    <div class="form-inline">
                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="tanggal_mati" id="edit_tanggal_mati" style="width: 30%;">
                                            <option value="">Tanggal</option>
                                            @for($i=1; $i<=31; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="bulan_mati" id="edit_bulan_mati" style="width: 30%;">
                                            <option value="">Bulan</option>
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

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="tahun_mati" id="edit_tahun_mati" style="width: 35%;">
                                            <option value="">Tahun</option>
                                            @for($i=$lastYear; $i>=$firstYear; $i--)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Jam Listrik Mati</label>
                                    <div class="form-inline">
                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="jam_mati" id="edit_jam_mati" style="width: 30%;">
                                            <option value="">Jam</option>
                                            @for($i=0; $i<=23; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="menit_mati" id="edit_menit_mati" style="width: 30%;">
                                            <option value="">Menit</option>
                                            @for($i=0; $i<=59; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="detik_mati" id="edit_detik_mati" style="width: 35%;">
                                            <option value="">Detik</option>
                                            @for($i=0; $i<=59; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Jam Listrik Nyala</label>
                                    <div class="form-inline">
                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="jam_nyala" id="edit_jam_nyala" style="width: 30%;">
                                            <option value="">Jam</option>
                                            @for($i=0; $i<=23; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="menit_nyala" id="edit_menit_nyala" style="width: 30%;">
                                            <option value="">Menit</option>
                                            @for($i=0; $i<=59; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="detik_nyala" id="edit_detik_nyala" style="width: 35%;">
                                            <option value="">Detik</option>
                                            @for($i=0; $i<=59; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Keterangan</label>
                                    <textarea class="form-control form-control-lg" id="edit_keterangan" name="keterangan" rows="3" placeholder="Isikan Keterangan"></textarea>
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