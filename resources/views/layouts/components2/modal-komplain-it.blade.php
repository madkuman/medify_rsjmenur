<div class="modal fade" id="modal-komplain-it" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-fromright modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="" method="POST" action="{{url('it/komplain')}}" id="form-add">
                {{ csrf_field() }}
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0">Laporkan Masalah IT</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="d-none text-center" id="komplain_loading">
                            <i class="fa fa-spin fa-spinner fa-7x"></i>
                        </div>

                        <div class="row d-none" id="komplain-content">    
                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label class="control-label">Tanggal</label>
                                    <input type="text" class="form-control js-datepicker" name="tgl_komplain" data-date-format="dd-mm-yyyy" value="{{date('d-m-Y')}}">
                                </div>
                            </div>
                            <div class="col-md-4">

                                <div class="form-group">
                                    <label class="control-label">Jam Komplain</label>

                                    <div class="row gutters-tiny">
                                        <div class="col-6">
                                            <select class="form-control" name="jam_komplain" style="width: 100%;">
                                                <option value="">Jam</option>
                                                @for($i=00; $i<=23; $i++)
                                                <option value="{{$i}}" @if(date('H') == $i){{'selected'}}@endif>{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <select class="form-control" name="menit_komplain" style="width: 100%;">
                                                <option value="">Menit</option>
                                                @for($i=00; $i<=59; $i++)
                                                <option value="{{$i}}" @if(date('i') == $i){{'selected'}}@endif>{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">

                                <div class="form-group">
                                    <label class="control-label">Ruang/Poli</label>
                                    <select class="form-control" id="komplain_lokasi" name="lokasi" id="komplain_lokasi" style="width: 100%;">
                                        <option></option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Pesan</label>
                                    <textarea class="form-control form-control-lg" name="pesan" rows="3" placeholder="Isikan pesan" required></textarea>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn-alt btn-hero btn-secondary min-width-125 mr-5" data-dismiss="modal">
                            Tutup
                        </button>
                        <button type="submit" class="btn-alt btn-hero btn-primary min-width-125" id="btn-save-it">
                            <i class="fa fa-send mr-5"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>        