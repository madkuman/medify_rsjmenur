@php $autoselect_farmasi = false; @endphp
<div class="modal fade" id="modal-create-resep" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Tambah Resep</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-12">
                        <form action="{{url('kasus')}}/{{ $nomor_kasus }}/datamedis/resep/create" id="form_create_resep" method="post" class="main-form-container">
                        {{ csrf_field() }}
                        <input type="hidden" id="pasien" name="pasien" value="{{$kasus->pasien_id}}">
                        <input type="hidden" id="metode_pembayaran" name="metode_pembayaran" value="{{$kasus->pasien_pembayaran_id}}">
                        <div class="row">
                            <div class="col-8">
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
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Jenis Resep</label>
                                    <select class="form-control" name="jenis_resep">
                                        <option value="standard">Pelayanan</option>
                                        <option value="pulang">Pulang</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-8">
                                <label class="css-control css-control-primary css-checkbox">
                                    <input type="checkbox" name="kirim-farmasi" id="resepKirimFarmasiCheck" class="css-control-input" checked>
                                    <span class="css-control-indicator"></span> Kirimkan permintaan ke farmasi tersebut.
                                </label>
                            </div>
                            <div class="col-4">
                                <label class="css-control css-control-primary css-checkbox">
                                    <input type="checkbox" name="cito" class="css-control-input">
                                    <span class="css-control-indicator"></span> Cito
                                </label>
                            </div>
                            <div class="col-12">
                                <div class="bg-warning p-10 mt-10"> Informasi Alergi : 
                                    @php $i = 0 @endphp
                                    @forelse($kasus->identitas->alergi_obat_array as $item)
                                    <span class="badge badge-pill badge-primary">{{$item}}</span>
                                    @empty
                                    Tidak memiliki alergi
                                    @endforelse
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div id="form-resep" @if(!$autoselect_farmasi) style="display: none;" @endif>
                            @if($user->profesi != 1)
                            <div class="row">
                                <div class="col-12">
                                    @include('kasus.datamedis.content.resep.components.dokter-create',['id_radio' => 'dokter'])
                                </div>
                            </div>
                            @else
                            <input type="hidden" name="dokter-jenis" value="rsal">
                            <input type="hidden" name="dokter-rsal" value="{{$user->id}}">

                            @endif

                            <div class="form-group">
                                <label>Paket Obat</label><i class="fa fa-spin fa-spinner" id="loading-paket"></i>
                                <br>
                                <select class="form-control js-select2" id="selectPaket" data-width="100%">
                                    <option value="" disabled="" selected="">Pilih Paket</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    @include('kasus.datamedis.content.resep.components.form', ['extra_id' => ""])
                                </div>
                                <div class="col-4 py-20">
                                    <div class="histori-resep-container">
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <div class="col-12 text-center">
                                    <label class="css-control css-control-primary css-checkbox div-override-checkbox">
                                        <input type="checkbox" class="override-checkbox css-control-input"/>
                                        <span class="css-control-indicator"></span> <strong>Abaikan Peringatan</strong>
                                    </label>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" id="" class="btn submit-resep btn-click-animate btn-hero btn-alt-primary min-width-175">
                                        <i class="fa fa-send mr-5"></i> Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>