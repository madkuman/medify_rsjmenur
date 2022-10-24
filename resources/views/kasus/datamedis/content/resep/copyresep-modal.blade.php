<div class="modal fade" id="resepModalCopy" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Buat Resep</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form action="{{url('kasus')}}/{{ $nomor_kasus }}/datamedis/resep/create" method="post">
                        <input type="hidden" id="pasien" name="pasien" value="{{$kasus->pasien_id}}">
                        <input type="hidden" id="metode_pembayaran" name="metode_pembayaran" value="{{$kasus->pasien_pembayaran_id}}">
                        <input type="hidden" name="dokter-jenis" value="rsal">
                        <input type="hidden" name="dokter-rsal" value="{{$user->id}}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Pilih Tujuan Farmasi</label>
                                    <select class="form-control" id="nama-apotek" name="nama-apotek" required="">
                                        <option value="" disabled="" selected="">Pilih Tujuan Farmasi</option>
                                        @foreach ( $pharmacies as $pharmacy )
                                            @if($pharmacy->jenis_detail->nama == 'Gudang') @continue @endif
                                            <option value="{{ $pharmacy->id }}" data-slug="{{ $pharmacy->slug }}" @if($autoselect_id == $pharmacy->id) selected
                                                    @php $autoselect_farmasi = true; @endphp
                                                    @endif>{{ $pharmacy->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="css-control css-control-primary css-checkbox">
                                    <input type="checkbox" name="kirim-farmasi" id="resepKirimFarmasiCheck" class="css-control-input" checked>
                                    <span class="css-control-indicator"></span> Kirimkan permintaan ke farmasi tersebut.
                                </label>
                                <hr>
                            </div>
                        </div>
                        @include('kasus.datamedis.content.resep.components.form', ['extra_id' => "-copy"])
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <label class="css-control css-control-primary css-checkbox div-override-checkbox">
                                    <input type="checkbox" class="override-checkbox css-control-input"/>
                                    <span class="css-control-indicator"></span> <strong>Abaikan Peringatan</strong>
                                </label>
                                <button type="submit" class="btn btn-hero btn-alt-primary min-width-175 submit-resep">
                                    <i class="fa fa-send mr-5"></i> Buat Resep
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>