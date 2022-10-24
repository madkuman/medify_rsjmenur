<div class="col-12 px-0">
    <br><p class="h5 my-0 mb-10">BUKTI PENYERAHAN DARAH</p>
    <div class="form-group">
        <table class="table table-bordered table-vcenter" id="bukti_penyerahan_darah">
            <tr>
                <td><label>Tanggal</label></td>
                <td><label>Jam</label></td>
                <td><label>No Kantong</label></td>
                <td><label>No Slang</label></td>
                <td><label>Jenis Darah</label></td>
                <td><label>Golongan Darah</label></td>
                <td><label>Rhesus&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
                <td><label>Hasil Cross&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
                <td><label>Pemberi</label></td>
                <td><label>Penerima</label></td>
                <td></td>
            </tr>
            <tbody id="transfusi_tbody">
                @forelse($transaksi->hasil_transfusi as $i => $h)
                    <tr class="transfusi-row" id="transfusi_row_{{$i}}">
                        <input type="hidden" name="transfusi_id[]" value="{{$h->id}}" id="transfusi_id_{{$i}}">
                        <td>
                            <div class="col-12 px-0">
                                <input type="text" name="tanggal[]" class="js-datepicker form-control" value="{{date('d/m/Y', strtotime($h->tanggal))}}">
                            </div>
                        </td>
                        <td>
                            <div class="col-12 px-0">
                                <input type="text" class="form-control time" name="jam[]" value="{{date('H:i', strtotime($h->jam))}}">
                            </div>
                        </td>
                        <td>
                            <div class="col-12 px-0">
                                <input type="text" class="form-control" name="no_kantong[]" value="{{$h->no_kantong}}">
                            </div>
                        </td>
                        <td>
                            <div class="col-12 px-0">
                                <input type="text" class="form-control" name="no_slang[]" value="{{$h->no_slang}}">
                            </div>
                        </td>
                        <td>
                            <div class="col-12 px-0">
                                <input type="text" class="form-control" name="jenis_darah[]" value="{{$h->jenis_darah}}">
                            </div>
                        </td>
                        <td>
                            <div class="col-12 px-0">
                                <select class="form-control" name="golongan_darah[]">
                                    @foreach($goldar as $g)
                                        <option value="{{$g}}" @if($h->gol_darah == $g) selected @endif>{{$g}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="col-12 px-0">
                                <select class="form-control" name="rhesus[]">
                                    @foreach($rhesus as $g)
                                        <option value="{{$g}}" @if($h->rhesus == $g) selected @endif>{{$g}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="col-12 px-0">
                                <select class="form-control" name="hasil_cross[]">
                                    @foreach($hasil_cross as $g)
                                        <option value="{{$g}}" @if($h->gol_darah == $g) selected @endif>{{$g}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="col-12 px-0">
                                <input type="text" class="form-control" name="pemberi[]" value="{{$h->pemberi}}">
                            </div>
                        </td>
                        <td>
                            <div class="col-12 px-0">
                                <input type="text" class="form-control" name="penerima[]" value="{{$h->penerima}}">
                            </div>
                        </td>
                        <td class="px-0">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-lg btn-circle btn-outline-danger cancel-bukti" @if($i == 0) disabled="" @endif data-id="{{$i}}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>                
                @empty
                    <tr class="transfusi-row" id="transfusi_row_0">
                        <td>
                            <div class="col-12 px-0">
                                <input type="text" name="tanggal[]" class="js-datepicker form-control" value="">
                            </div>
                        </td>
                        <td>
                            <div class="col-12 px-0">
                                <input type="text" class="form-control time" name="jam[]" value="">
                            </div>
                        </td>
                        <td>
                            <div class="col-12 px-0">
                                <input type="text" class="form-control" name="no_kantong[]" value="">
                            </div>
                        </td>
                        <td>
                            <div class="col-12 px-0">
                                <input type="text" class="form-control" name="no_slang[]" value="">
                            </div>
                        </td>
                        <td>
                            <div class="col-12 px-0">
                                <input type="text" class="form-control" name="jenis_darah[]" value="">
                            </div>
                        </td>
                        <td>
                            <div class="col-12 px-0">
                                <select class="form-control" name="golongan_darah[]">
                                    @foreach($goldar as $g)
                                        <option value="{{$g}}">{{$g}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="col-12 px-0">
                                <select class="form-control" name="rhesus[]">
                                    @foreach($rhesus as $g)
                                        <option value="{{$g}}">{{$g}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="col-12 px-0">
                                <select class="form-control" name="hasil_cross[]">
                                    @foreach($hasil_cross as $g)
                                        <option value="{{$g}}">{{$g}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="col-12 px-0">
                                <input type="text" class="form-control" name="pemberi[]" value="">
                            </div>
                        </td>
                        <td>
                            <div class="col-12 px-0">
                                <input type="text" class="form-control" name="penerima[]" value="">
                            </div>
                        </td>
                        <td class="px-0">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-lg btn-circle btn-outline-danger cancel-bukti" disabled="">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
            <tr>
                <td colspan="11" class="text-center">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-lg btn-circle btn-primary mr-5 mb-5 tambah-bukti" id="tambah_bukti">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>