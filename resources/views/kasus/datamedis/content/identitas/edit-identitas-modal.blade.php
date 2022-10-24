<div class="modal fade" id="modal-update-identitas" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Edit Identitas</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                @if(empty($kasus->pasien_id))
                <div class="block-content py-0">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/datamedis/identitas/rekammedis/update" method="post">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <div class="col-12">
                                <label for="be-contact-name">Nomor Rekam Medis</label>
                                <input type="text" class="form-control form-control-lg" id="be-contact-name" name="nomor-rm" placeholder="Masukkan nomor rekam medis">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn-alt btn-hero btn-primary min-width-175 pull-right">
                                    <i class="fa fa-send mr-5"></i> Update Rekam Medis
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @else
                <div class="block-content py-0">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/datamedis/identitas/update" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        

                        <div class="row justify-content-center ">
                            <div class="col-md-4 ">
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type="file" id="avatar" name="avatar" accept=".png, .jpg, .jpeg" />
                                        <label for="avatar"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview" style="background-image: url({{url($identitas->avatar_thumb)}});">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <input type="hidden" class="form-control form-control-lg" id="" name="identitas-id" placeholder="" value="{{ $identitas->id }}">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="be-contact-name">Nomor Rekam Medis</label>
                                <input type="text" class="form-control form-control-lg" id="be-contact-name" name="nomor-rm" placeholder="Masukkan nomor rekam medis" value="{{$kasus->pasien->no_rm}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="be-contact-name">Nama Pasien</label>
                                <input type="text" class="form-control form-control-lg" id="be-contact-name" name="nama" placeholder="Enter your name.." value="{{ $identitas->nama }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="example-select">Jenis Kelamin</label>
                            <div class="col-md-12">
                                <select class="form-control" id="example-select" name="jenis-kelamin" disabled>
                                    <option value="L" {{ $identitas->jenis_kelamin == 'L' ? 'selected' : ''}}>Laki-Laki</option>
                                    <option value="P" {{ $identitas->jenis_kelamin == 'P' ? 'selected' : ''}}>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="example-select">Status Pernikahan</label>
                            <div class="col-md-12">
                                <select class="form-control" id="example-select" name="status">
                                    <option value="1" {{ $identitas->status == 1 ? 'selected' : ''}}>Belum Menikah</option>
                                    <option value="2" {{ $identitas->status == 2 ? 'selected' : ''}}>Menikah</option>
                                    <option value="3" {{ $identitas->status == 3 ? 'selected' : ''}}>Duda / Janda</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="be-contact-name">Tempat Lahir</label>
                                <input type="text" class="form-control form-control-lg" id="be-contact-name" name="tempat-lahir" placeholder="Enter your name.." value="{{ $identitas->tempat_lahir }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="example-datepicker1">Tanggal Lahir</label>
                            <div class="col-lg-12">
                                <input type="text" class="js-datepicker form-control" id="example-datepicker1" name="tanggal-lahir" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="" value=" {{$identitas->tanggal_lahir}} " disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="be-contact-name">Alamat</label>
                                <input type="text" class="form-control form-control-lg" id="be-contact-name" name="alamat" placeholder="Enter your name.." value="{{ $identitas->alamat }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="be-contact-name">No HP</label>
                                <input type="text" class="form-control form-control-lg" id="be-contact-name" name="hp" placeholder="Enter your name.." value="{{ $identitas->no_hp }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="be-contact-name">No Identitas</label>
                                <input type="text" class="form-control form-control-lg" id="be-contact-name" name="no-identitas" placeholder="Enter your name.." value="{{ $identitas->no_identitas }}">
                            </div>
                        </div>
                        <div class="">
                            <div class="">
                                <input type="hidden" class="form-control form-control-lg" id="id-asuransi" name="id-asuransi" placeholder="" value="99">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="be-contact-name">Pekerjaan</label>
                                <input class="form-control" value="{{$identitas->pekerjaan}}" name="pekerjaan">
                                {{--
                                <select name="pekerjaan" id="selectPekerjaan" class="form-control js-select2" style="width: 100%;" data-size="2">
                                    @foreach($jenis_pekerjaan as $item)
                                        @if($item->nama == $identitas->pekerjaan)
                                            <option value="{{$item->nama}}" selected="selected">{{$item->nama}}</option>
                                @else
                                <option value="{{$item->nama}}">{{$item->nama}}</option>
                                @endif
                                @endforeach
                                </select>
                                --}}
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
                @endif
            </div>
        </div>
    </div>
</div>