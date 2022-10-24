<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="" method="POST" action="" id="form-edit">
                {{ csrf_field() }}
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0">Ubah Data Riwayat Perbaikan Alat</h4>
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
                                    <label class="control-label">Nama Alat</label>
                                    <input class="form-control" type="text" name="nama_alat" id="edit_nama_alat" placeholder="Isikan Nama Alat">
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Asal Ruangan</label>
                                    <select class="form-control" type="text" name="asal_ruangan" id="edit_asal_ruangan" placeholder="Isikan Asal Ruangan" style="width: 100%">
                                    </select>  
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Tanggal Laporan</label>
                                    <div class="form-inline">
                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="tanggal_laporan" id="edit_tanggal_laporan" style="width: 30%;">
                                            <option value="">Tanggal</option>
                                            @for($i=1; $i<=31; $i++)
                                                <option value="{{$i}}" @if(date('d') == $i){{'selected'}}@endif>{{$i}}</option>
                                            @endfor
                                        </select>
                                        @php
                                            $bulan = '1';
                                        @endphp
                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="bulan_laporan" id="edit_bulan_laporan" style="width: 30%;">
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

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="tahun_laporan" id="edit_tahun_laporan" style="width: 35%;">
                                            <option value="">Tahun</option>
                                            @for($i=$lastYear; $i>=$firstYear; $i--)
                                                <option value="{{$i}}" @if(date('Y') == $i){{'selected'}}@endif>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Jam Laporan</label>
                                    <div class="form-inline">
                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="jam_laporan" id="edit_jam_laporan" style="width: 30%;">
                                            <option value="">Jam</option>
                                            @for($i=00; $i<=23; $i++)
                                                <option value="{{$i}}" @if(date('H') == $i){{'selected'}}@endif>{{$i}}</option>
                                            @endfor
                                        </select>

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="menit_laporan" id="edit_menit_laporan" style="width: 30%;">
                                            <option value="">Menit</option>
                                            @for($i=00; $i<=59; $i++)
                                                <option value="{{$i}}" @if(date('i') == $i){{'selected'}}@endif>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Tanggal Identifikasi</label>
                                    <div class="form-inline">
                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="tanggal_identifikasi" id="edit_tanggal_identifikasi" style="width: 30%;">
                                            <option value="">Tanggal</option>
                                            @for($i=1; $i<=31; $i++)
                                                <option value="{{$i}}" @if(date('d') == $i){{'selected'}}@endif>{{$i}}</option>
                                            @endfor
                                        </select>
                                        @php
                                            $bulan = '1';
                                        @endphp
                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="bulan_identifikasi" id="edit_bulan_identifikasi" style="width: 30%;">
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

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="tahun_identifikasi" id="edit_tahun_identifikasi" style="width: 35%;">
                                            <option value="">Tahun</option>
                                            @for($i=$lastYear; $i>=$firstYear; $i--)
                                                <option value="{{$i}}" @if(date('Y') == $i){{'selected'}}@endif>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Jam Identifikasi</label>
                                    <div class="form-inline">
                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="jam_identifikasi" id="edit_jam_identifikasi" style="width: 30%;">
                                            <option value="">Jam</option>
                                            @for($i=00; $i<=23; $i++)
                                                <option value="{{$i}}" @if(date('H') == $i){{'selected'}}@endif>{{$i}}</option>
                                            @endfor
                                        </select>

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="menit_identifikasi" id="edit_menit_identifikasi" style="width: 30%;">
                                            <option value="">Menit</option>
                                            @for($i=00; $i<=59; $i++)
                                                <option value="{{$i}}" @if(date('i') == $i){{'selected'}}@endif>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label">Tanggal Service</label>
                                    <div class="form-inline">
                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="tanggal_mulai" id="edit_tanggal_mulai" style="width: 30%;">
                                            <option value="">Tanggal</option>
                                            @for($i=1; $i<=31; $i++)
                                                <option value="{{$i}}" @if(date('d') == $i){{'selected'}}@endif>{{$i}}</option>
                                            @endfor
                                        </select>
                                        @php
                                            $bulan = '1';
                                        @endphp
                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="bulan_mulai" id="edit_bulan_mulai" style="width: 30%;">
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

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="tahun_mulai" id="edit_tahun_mulai" style="width: 35%;">
                                            <option value="">Tahun</option>
                                            @for($i=$lastYear; $i>=$firstYear; $i--)
                                                <option value="{{$i}}" @if(date('Y') == $i){{'selected'}}@endif>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Tanggal Selesai</label>
                                    <div class="form-inline">
                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="tanggal_selesai" id="edit_tanggal_selesai" style="width: 30%;">
                                            <option value="">Tanggal</option>
                                            @for($i=1; $i<=31; $i++)
                                                <option value="{{$i}}" @if(date('d') == $i){{'selected'}}@endif>{{$i}}</option>
                                            @endfor
                                        </select>
                                        @php
                                            $bulan = '1';
                                        @endphp
                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="bulan_selesai" id="edit_bulan_selesai" style="width: 30%;">
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

                                        <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="tahun_selesai" id="edit_tahun_selesai" style="width: 35%;">
                                            <option value="">Tahun</option>
                                            @for($i=$lastYear; $i>=$firstYear; $i--)
                                                <option value="{{$i}}" @if(date('Y') == $i){{'selected'}}@endif>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Alasan</label>
                                    <textarea class="form-control form-control-lg" id="edit_alasan" name="alasan" rows="3" placeholder=""></textarea>
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