<div class="modal fade" id="modal-update-status" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="" method="POST" action="" id="form-update-status">
                {{ csrf_field() }}
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0">Update Status Perbaikan Alat</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="d-none text-center" id="loading-update-status">
                            <i class="fa fa-spin fa-spinner fa-7x"></i>
                        </div>
                        <div class="row" id="content-update-status">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Nama Alat</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="update-status_nama_alat" value="lorem ipsum">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Asal Ruangan</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="update-status_asal_ruangan" value="lorem ipsum">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" id="label_tanggal">Tanggal Service</label>
                                    <div class="form-inline">
                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="tanggal" style="width: 30%;">
                                            <option value="">Tanggal</option>
                                            @for($i=1; $i<=31; $i++)
                                                <option value="{{$i}}" @if(date('d') == $i){{'selected'}}@endif>{{$i}}</option>
                                            @endfor
                                        </select>
                                        @php
                                            $bulan = '1';
                                        @endphp
                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="bulan" style="width: 30%;" required>
                                            @while($bulan < 13)
                                                <option value="{{$bulan}}" @if(date('F') == date('F', strtotime('2001-'.$bulan))){{'selected'}}@endif>{{date('F', strtotime('2001-'.$bulan))}}</option>
                                                @php 
                                                    $bulan++;
                                                @endphp
                                            @endwhile
                                        </select>

                                        @php
                                            $firstYear = (int)date('Y') - 39;
                                            $lastYear = (int)date('Y');
                                        @endphp

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="tahun" style="width: 35%;">
                                            <option value="">Tahun</option>
                                            @for($i=$lastYear; $i>=$firstYear; $i--)
                                                <option value="{{$i}}" @if(date('Y') == $i){{'selected'}}@endif>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" id="label_jam">Jam Laporan</label>
                                    <div class="form-inline">
                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="jam" style="width: 30%;">
                                            <option value="">Jam</option>
                                            @for($i=00; $i<=23; $i++)
                                                <option value="{{$i}}" @if(date('H') == $i){{'selected'}}@endif>{{$i}}</option>
                                            @endfor
                                        </select>

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="menit" style="width: 30%;">
                                            <option value="">Menit</option>
                                            @for($i=00; $i<=59; $i++)
                                                <option value="{{$i}}" @if(date('i') == $i){{'selected'}}@endif>{{$i}}</option>
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