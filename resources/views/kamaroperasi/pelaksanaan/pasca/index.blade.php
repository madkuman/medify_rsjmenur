@if(!empty($transaksi->hasil_id))
<div id="readhasil" class="content readhasil pt-0">
    <div class="row">
        <div class="col-lg-6">
            <h3 class="font-w400">Hasil Operasi
            <a href="{{url()->current()}}/print/hasil" class="btn btn-primary" target="_blank">Print</a></h3>
        </div>
        <div class="col-lg-6">
            <!--<button id="ubah" class="btn btn-primary pull-right">Ubah Hasil</button>-->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <h5 class="font-w400"><small>Diagnosis Awal</small><br>{{$transaksi->hasil->diagnosis_awal}}</h5>
            <h5 class="font-w400"><small>Diagnosis Akhir</small><br> {{$transaksi->hasil->diagnosis_akhir}}</h5>
            <h5 class="font-w400"><small>Persiapan</small><br> {{$transaksi->hasil->persiapan}}</h5>
            <h5 class="font-w400"><small>Posisi</small><br> {{$transaksi->hasil->posisi}}</h5>
            <h5 class="font-w400"><small>Disinfektan</small><br>{{$transaksi->hasil->disinfektan}}</h5>
            <h5 class="font-w400"><small>Incisi</small><br> {{$transaksi->hasil->incisi}}</h5>
            <h5 class="font-w400"><small>Temuan Operasi</small><br> {{$transaksi->hasil->temuan_operasi}}</h5>
            <h5 class="font-w400"><small>Tindakan</small><br> {{$transaksi->hasil->tindakan}}</h5>
            <h5 class="font-w400"><small>Pendarahan</small><br> {{$transaksi->hasil->pendarahan}}</h5>
        </div>
        <div class="col-lg-6">
            <h5 class="font-w400"><small>Advice Post Ops</small><br> {{$transaksi->hasil->advice_post}}</h5>
            <h5 class="font-w400"><small>Pemeriksaan PA</small><br> {{$transaksi->hasil->pemeriksaan_pa}}</h5>
            <h5 class="font-w400"><small>Jenis Operasi</small><br> {{$transaksi->hasil->jenis_operasi}}</h5>
            <h5 class="font-w400"><small>Tanggal Operasi</small><br> {{\Carbon\Carbon::createFromFormat('Y-m-d', $transaksi->hasil->tanggal_operasi)->format('d-m-Y')}}</h5>
            <h5 class="font-w400"><small>Waktu Mulai</small><br> {{\Carbon\Carbon::createFromFormat('H:i:s', $transaksi->hasil->waktu_mulai)->format('H:i')}}</h5>
            <h5 class="font-w400"><small>Waktu Selesai</small><br> {{\Carbon\Carbon::createFromFormat('H:i:s', $transaksi->hasil->waktu_selesai)->format('H:i')}}</h5>
            <h5 class="font-w400"><small>Lama Anastesi</small><br> {{\Carbon\Carbon::createFromFormat('H:i:s', $transaksi->hasil->lama_anastesi)->format('H:i')}}</h5>
        </div>
        <div class="col-lg-6">
        </div>
    </div>
</div>
@else 
<div id="readhasil" class="content pt-0">
    <div class="row">
        <div class="col-lg-6">
            <h3 class="font-w400">Hasil Operasi</h3>
            <h5 class="font-w400">Belum ada hasil operasi.</h5>
        </div>
        <div class="col-lg-6">
            <button id="catat" class="btn btn-primary pull-right">Catat Hasil</button>
        </div>
    </div>
</div>
@endif

<div id="formhasil" class="content pt-0">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="font-w400">Hasil Operasi</h3>
            <form id="hasil_pasca" method="POST" action="{{url('ajax/kamaroperasi/pasca/')}}">
                {{csrf_field()}}
                <div class="form-group row">
                    <label class="col-12">Diagnosis Awal</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="awal" name="diag_awal">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Diagnosis Akhir</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="akhir" name="diag_akhir" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Persiapan</label>
                    <div class="col-md-9">
                        <textarea class="form-control" name="persiapan" rows="4" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Posisi Pasien</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="posisi" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Disinfektan</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="disinfektan" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Incisi</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="incisi" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Temuan Operasi</label>
                    <div class="col-md-9">
                        <textarea class="form-control" name="temuan" rows="4" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Tindakan Operasi</label>
                    <div class="col-md-9">
                        <textarea class="form-control" name="tindakan" rows="4" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Pendarahan</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="pendarahan" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Advice Post Ops</label>
                    <div class="col-md-9">
                        <textarea class="form-control" name="advice" rows="4" required></textarea>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-12">Pemeriksaan PA</label>
                    <select class="form-control" id="example-select" name="pemeriksaan_pa" required>
                        <option value="tidak">Tidak</option>
                        <option value="ya">Ya</option>
                    </select>
                </div>


                <div class="form-group row">
                    <label class="col-12">Jenis Operasi</label>
                    <select class="form-control" id="example-select" name="jenis_operasi" required>
                        <option value="kecil">Kecil</option>
                        <option value="sedang">Sedang</option>
                        <option value="besar">Besar</option>
                        <option value="khusus">Khusus/Canggih</option>
                    </select>
                </div>

                <div class="form-group row">
                    <label class="col-12">Tanggal Operasi</label>
                    <div class="col-lg-9">
                        <input type="text" class="js-datepicker form-control" id="example-datepicker3" name="tanggal" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Waktu Mulai</label>
                    <div class='input-group date col-md-9'>
                        <input type='text' name="waktu_mulai" class="form-control wickedpicker-mulai" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Waktu Selesai</label>
                    <div class='input-group date col-md-9'>
                        <input type='text' name="waktu_selesai" class="form-control wickedpicker-selesai" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Lama Anastesi</label>
                    <div class='input-group date col-md-9'>
                        <input type='text' name="anastesi" class="form-control wickedpicker2" required>
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

<div class="col-lg-12"><hr></div>
<div class="content pt-0">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="font-w400">Penggunaan Obat dan Alat Pasca Operasi</h3>
            @if($obatpasca->isEmpty())
            <form id="hasil_pasca" method="POST" action="{{url('/kamaroperasi/pelaksanaan/pasca/obat')}}">
                {{csrf_field()}}
                <input type="hidden" name="operasi_id" value="{{$transaksi->id}}">
                <label class="col-12">Pilih Obat<star class="star">*</star></label>
                <div id="pascaobat">
                    @foreach($rencana as $rencanas)
                    <div class="form-group row items-pasca">                        
                        <div class="col-lg-6">
                            {{--<h4 class="font-w400">{{$rencanas->obat->name}}</h4>
                            <input type="hidden" name="pascaobats[]" value="{{$rencanas->obat_id}}">--}}
                            <select class="js-select2-item-pasca" name="pascaobats[]" style="width: 100%">
                                @foreach($items as $item)
                                @if($item->id == $rencanas->obat_id)
                                <option value="{{$item->id}}" selected="selected"> {{$item->name}}</option>
                                @else
                                <option value="{{$item->id}}"> {{$item->name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="number" id="jumlah" class="form-control" placeholder="Jumlah" name="pascajumlah[]" value="{{$rencanas->jumlah_obat}}">
                        </div>
                    </div>
                    @endforeach
                </div>
                <div id="submit">
                    <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                </div>
            </form>
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-2 offset-md-4">
                    <button type="button" class="btn btn-primary btn-wd" id="btnPascaAdd">
                        <i class="fa fa-plus" aria-hidden="true"></i> Tambah Obat
                    </button>
                </div>
            </div>
            @else
            @foreach($obatpasca as $obatpascas) 
            <div class="row">
                <div class="col-lg-6">
                    <h5 class="font-w400"><small>Nama Obat</small><br> {{$obatpascas->obat->name}}</h5>
                </div>
                <div class="col-lg-3">
                    <h5 class="font-w400"><small>Jumlah</small><br> {{ $obatpascas->jumlah_obat}}</h5>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>