<div class="modal fade" id="modal-update-identitas-medis" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Edit Informasi Medis</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content py-0">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/datamedis/identitas/medis/update" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" class="form-control form-control-lg" id="" name="identitas-id" placeholder="" value="{{ $identitas->id }}">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label>Tinggi Badan</label>
                                        <input type="number" class="form-control form-control-lg"  name="tinggi_badan" placeholder="Dalam satuan cm." value="{{ $identitas->tinggi_badan }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label>Berat Badan</label>
                                        <input type="number" class="form-control form-control-lg"  name="berat_badan" placeholder="Dalam satuan kg." value="{{ $identitas->berat_badan }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label>Lingkar Perut</label>
                                        <input type="number" class="form-control form-control-lg"  name="lingkar_perut" placeholder="Dalam satuan cm." value="{{ $identitas->lingkar_perut }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label>Lingkar Dada</label>
                                        <input type="number" class="form-control form-control-lg"  name="lingkar_dada" placeholder="Dalam satuan cm." value="{{ $identitas->lingkar_dada }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label>Warna Kulit</label>
                                        <input type="text" class="form-control form-control-lg"  name="warna_kulit" placeholder="Warna Kulit." value="{{ $identitas->warna_kulit}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label>Warna Mata</label>
                                        <input type="text" class="form-control form-control-lg"  name="warna_mata" placeholder="Warna Mata." value="{{ $identitas->warna_mata }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label>Bentuk Badan</label>
                                        <input type="text" class="form-control form-control-lg"  name="bentuk_badan" placeholder="Bentuk Badan" value="{{ $identitas->bentuk_badan }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label>Golongan Darah</label>
                                        <select name="golongan_darah" class="form-control">
                                            <option value="" selected disabled>Pilih Golongan Darah</option>
                                            <option value="A" @if($identitas->golongan_darah == 'A') selected @endif>A</option>
                                            <option value="B" @if($identitas->golongan_darah == 'B') selected @endif>B</option>
                                            <option value="AB" @if($identitas->golongan_darah == 'AB') selected @endif>AB</option>
                                            <option value="O" @if($identitas->golongan_darah == 'O') selected @endif>O</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label>Riwayat Sakit</label>
                                        <input type="text" class="form-control form-control-lg"  name="riwayat_sakit" placeholder="Riwayat sakit." value="{{ $identitas->riwayat_sakit }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12" for="example-tags1">Alergi Makanan</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="js-tags-input form-control" data-height="34px"  name="alergi_makanan" value="{{$identitas->alergi_makanan}}">
                                        <small>Tekan TAB setelah input tiap item</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12" for="example-tags1">Alergi Obat</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="js-tags-input form-control" data-height="34px"  name="alergi_obat" value="{{$identitas->alergi_obat}}">
                                        <small>Tekan TAB setelah input tiap item</small>
                                    </div>
                                </div>

                                @if(!empty($identitas->tanggal_tirah_baring_start))
                                @php $tirah_baring_start = indonesian_date($identitas->tanggal_tirah_baring_start,'d-m-Y')
                                @endphp
                                @else
                                @php $tirah_baring_start = '' @endphp
                                @endif

                                @if(!empty($identitas->tanggal_tirah_baring_end))
                                @php $tirah_baring_end = indonesian_date($identitas->tanggal_tirah_baring_end,'d-m-Y')
                                @endphp
                                @else
                                @php $tirah_baring_end = '' @endphp
                                @endif  

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Hari Tirah Baring</label>
                                            <div class="input-group" >
                                                <input type="text" class="form-control js-datepicker" name="tanggal_tirah_baring_start" value="{{$tirah_baring_start}}" placeholder="From" data-week-start="1" data-autoclose="true"  autocomplete="off" data-date-format="dd-mm-yyyy" data-today-highlight="true">
                                                <div class="input-group-prepend input-group-append">
                                                    <span class="input-group-text font-w600">hingga</span>
                                                </div>
                                                <input type="text" class="form-control js-datepicker" name="tanggal_tirah_baring_end" value="{{$tirah_baring_end}}" placeholder="From" data-week-start="1" data-autoclose="true"  autocomplete="off" data-date-format="dd-mm-yyyy" data-today-highlight="true">
                                            </div>
                                            <small>Isi jika pasien sedang Tirah Baring</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>              
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn-alt btn-hero btn-click-animate btn-primary min-width-175 pull-right">
                                    <i class="fa fa-send mr-5"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
