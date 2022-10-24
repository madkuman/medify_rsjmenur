
<div class="modal" id="modal-analisa-resep" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/transaksi/analisa')}}">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$transaksi->id}}">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Analisa Resep {{$transaksi->final_detail->nomor_resep}}</h3>
                        @php $analisa = json_decode($transaksi->final_detail->analisa_resep) @endphp
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close" style="color:yellow;">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                    <div class="block-content" style="font-size: 13px">
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3"><label>Nama Pasien</label></div>
                                    <div class="col-1"><label>:</label></div>
                                    <div class="col-8"><label>{{$transaksi->pasien_detail ? $transaksi->pasien_detail->name : $transaksi->nama_pasien}}</label></div>
                                </div>
                                <div class="row">
                                    <div class="col-3"><label>Berat Badan</label></div>
                                    <div class="col-1"><label>:</label></div>
                                    <div class="col-8"><label>{{ $transaksi->kasus_detail->identitas->berat_badan ?? "-"}} Kg</label></div>
                                </div>
                                <br>
                                <br>
                                <h6>1. Syarat Administrasi</h6>
                                <div class="row">
                                    <div class="col-5">
                                        <label>- Tgl Resep</label>                                            
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="tgl-resep">
                                            <input type="radio" class="css-control-input" name="tgl_resep" value="yes" @if($analisa && $analisa->tgl_resep == 'yes') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Ada
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="tgl-resep">
                                            <input type="radio" class="css-control-input" name="tgl_resep" value="no" @if($analisa && $analisa->tgl_resep == 'no') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Ada
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>- Nama Dokter</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="nama-dokter">
                                            <input type="radio" class="css-control-input" name="nama_dokter" value="yes" @if($analisa && $analisa->nama_dokter == 'yes') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Ada
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="nama-dokter">
                                            <input type="radio" class="css-control-input" name="nama_dokter" value="no" @if($analisa && $analisa->nama_dokter == 'no') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Ada
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>- Nama Pasien</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="nama-pasien">
                                            <input type="radio" class="css-control-input" name="nama_pasien" value="yes" @if($analisa && $analisa->nama_pasien == 'yes') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Ada
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="nama-pasien">
                                            <input type="radio" class="css-control-input" name="nama_pasien" value="no" @if($analisa && $analisa->nama_pasien == 'no') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Ada
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>- Umur / BB</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="umur-bb">
                                            <input type="radio" class="css-control-input" name="umur_bb" value="yes" @if($analisa && $analisa->umur_bb == 'yes') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Ada
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="umur-bb">
                                            <input type="radio" class="css-control-input" name="umur_bb" value="no" @if($analisa && $analisa->umur_bb == 'no') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Ada
                                        </label>
                                    </div>
                                </div>
                                <br>
                                <h6>2. Syarat Farmasetika</h6>
                                <div class="row">
                                    <div class="col-5">
                                        <label>- Tepat bentuk sediaan</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-bentuk">
                                            <input type="radio" class="css-control-input" name="tepat_bentuk" value="yes" @if($analisa && $analisa->tepat_bentuk == 'yes') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Ada
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-bentuk">
                                            <input type="radio" class="css-control-input" name="tepat_bentuk" value="no" @if($analisa && $analisa->tepat_bentuk == 'no') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Ada
                                        </label>
                                    </div>
                                </div>
                                <br>
                                <h6>3. Syarat Farklin</h6>
                                <div class="row">
                                    <div class="col-5">
                                        <label>- Tepat dosis</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-dosis">
                                            <input type="radio" class="css-control-input" name="tepat_dosis" value="yes" @if($analisa && $analisa->tepat_dosis == 'yes') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Ada
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-dosis">
                                            <input type="radio" class="css-control-input" name="tepat_dosis" value="no" @if($analisa && $analisa->tepat_dosis == 'no') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Ada
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>- Tepat obat</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-obat">
                                            <input type="radio" class="css-control-input" name="tepat_obat" value="yes" @if($analisa && $analisa->tepat_obat == 'yes') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Ada
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-obat">
                                            <input type="radio" class="css-control-input" name="tepat_obat" value="no" @if($analisa && $analisa->tepat_obat == 'no') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Ada
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>- ESO Potensil</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="eso-potensil">
                                            <input type="radio" class="css-control-input" name="eso_potensil" value="yes" @if($analisa && $analisa->eso_potensil == 'yes') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Ada
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="eso-potensil">
                                            <input type="radio" class="css-control-input" name="eso_potensil" value="no" @if($analisa && $analisa->eso_potensil == 'no') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Ada
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>- Interaksi Potensial</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="interaksi-potensial">
                                            <input type="radio" class="css-control-input" name="interaksi_potensial" value="yes" @if($analisa && $analisa->interaksi_potensial == 'yes') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Ada
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-primary css-radio" id="css-control-sm interaksi-potensial">
                                            <input type="radio" class="css-control-input" name="interaksi_potensial"> <span style="font-size: 13px" class="css-control-indicator" value="no" @if($analisa && $analisa->interaksi_potensial == 'no') checked @endif></span> Tidak Ada
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>- Duplikasi Obat</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="duplikasi-obat">
                                            <input type="radio" class="css-control-input" name="duplikasi_obat" value="yes" @if($analisa && $analisa->duplikasi_obat == 'yes') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Ada
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="duplikasi-obat">
                                            <input type="radio" class="css-control-input" name="duplikasi_obat" value="no" @if($analisa && $analisa->duplikasi_obat == 'no') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Ada
                                        </label>
                                    </div>
                                </div>
                                <br>
                                <h6>4. Tindak Lanjut</h6>
                                <div class="row">
                                    <div class="col-5">
                                        <label>- Tlp Dokter</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="tlp-dokter">
                                            <input type="radio" class="css-control-input" name="tlp_dokter" value="yes" @if($analisa && $analisa->tlp_dokter == 'yes') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Ada
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="tlp-dokter">
                                            <input type="radio" class="css-control-input" name="tlp_dokter" value="no" @if($analisa && $analisa->tlp_dokter == 'no') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Ada
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>- KIE</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="kie">
                                            <input type="radio" class="css-control-input" name="kie" value="yes" @if($analisa && $analisa->kie == 'yes') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Ada
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-css-control-sm control css-control-primary css-radio" id="kie">
                                            <input type="radio" class="css-control-input" name="kie" value="no" @if($analisa && $analisa->kie == 'no') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Ada
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>- Perubahan Farmasetika</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="farmasetika">
                                            <input type="radio" class="css-control-input" name="farmasetika" value="yes" @if($analisa && $analisa->farmasetika == 'yes') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Ada
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-css-control-sm control css-control-primary css-radio" id="farmasetika">
                                            <input type="radio" class="css-control-input" name="farmasetika" value="no" @if($analisa && $analisa->farmasetika == 'no') checked @endif> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Ada
                                        </label>
                                    </div>
                                </div>
                                <br>
                                <h6>5. Benar</h6>
                                <div class="row">
                                    <div class="col-2">
                                        <label class="css-control css-control-primary css-checkbox">
                                            <input type="checkbox" class="css-control-input" name="benar_pasien" value="yes" {{$analisa && $analisa->benar_pasien == 'yes' ? 'checked': ''}}>
                                            <span class="css-control-indicator"></span> Pasien
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-primary css-checkbox">
                                            <input type="checkbox" class="css-control-input" name="benar_dosis" value="yes" {{$analisa && $analisa->benar_dosis == 'yes' ? 'checked': ''}}>
                                            <span class="css-control-indicator"></span> Dosis
                                        </label>
                                    </div>
                                    <div class="col-7">
                                        <label class="css-control css-control-primary css-checkbox">
                                            <input type="checkbox" class="css-control-input" name="benar_wpo" value="yes" {{$analisa && $analisa->benar_wpo == 'yes' ? 'checked': ''}}>
                                            <span class="css-control-indicator"></span> Waktu Pemberian Obat
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <label class="css-control css-control-primary css-checkbox">
                                            <input type="checkbox" class="css-control-input" name="benar_obat" value="yes" {{$analisa && $analisa->benar_obat == 'yes' ? 'checked': ''}}>
                                            <span class="css-control-indicator"></span> Obat
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-primary css-checkbox">
                                            <input type="checkbox" class="css-control-input" name="benar_am" {{$analisa && $analisa->benar_am == 'yes' ? 'checked': ''}}>
                                            <span class="css-control-indicator"></span> Aturan Minum
                                        </label>
                                    </div>
                                </div>
                                <br>
                                <h6>5. Assessment</h6>
                                <div class="row form-group">
                                    <div class="col-12">
                                        <textarea class="form-control" name="assessment" placeholder="Tulis assessment disini..." rows="4">@if($analisa && isset($analisa->assessment)){{$analisa->assessment}} @endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Barang</th>
                                            <th>Jumlah</th>
                                            <th>Aturan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $j=1; $total=0 @endphp
                                        @foreach($transaksi->final_detail->resep_detail as $detail)
                                        @if(is_null($detail->obat_detail))
                                        <tr>
                                            <td>{{$j++}}</td>
                                            <td>{{$detail->nama_obat}} <br> @if(!$detail->tipe)(Obat Tidak Tersedia di Farmasi Ini)@endif</td>
                                            <td>{{$detail->jumlah}} {{ $detail->satuan }} </td>
                                            <td>{{$detail->aturan}}</td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td>{{$j++}}</td>
                                            <td>{{$detail->nama_obat}}</td>
                                            <td>{{$detail->jumlah}} {{ $detail->satuan }} </td>
                                            <td>{{$detail->aturan}}</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-primary" id="btn-simpan-analisa">
                        <i class="fa fa-check"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>