@extends('farmasi.layouts.main')

@section('title')
Farmasi Detail Transaksi Kemoterapi
@endsection

@section('css')
    <style type="text/css">
        .bordered {
            border-bottom: 1px solid #eaecee;
        }
        .modal-content {
            border-radius: 0;
        }
        .modal-lg {
            max-width: 80% !important;
        }
        .no-border {
            border-top: 0 !important;
            border-right: 0 !important;
            border-left: 0 !important;
            border-bottom: 0;
            border-radius: 0 !important;
        }
        .editable-click {
            border-bottom: dashed 1px #0088cc;
        }    
    </style>
@endsection

@section('content')
<div class="block">
    <div class="block-content bordered">
        <div class="row">
            <h3 class="block-title col-lg-5 col-12">Edit Transaksi #{{$transaksi->slug}}</h3>
        </div>
    </div>

    <div class="block-content">
        <div class="block block-transparent">
            <div class="row">
                <div class="col-md-5">
                    <div style="border: 1px solid #eaecee; width: 250px;  padding: 10px;">
                        <div class="font-size-lg text-black mb-5">
                            <strong>{{$transaksi->pasien_detail ? $transaksi->pasien_detail->name : $transaksi->nama_pasien}}</strong>
                        </div>
                        <address>
                            @if($transaksi->pasien_detail)
                                @if($transaksi->pasien_detail->gender == 1) Laki-Laki
                                @else Perempuan
                                @endif
                                , {{$transaksi->pasien_detail->age}} Tahun<br>
                                #{{$transaksi->pasien_detail->id}}<br>
                            @endif
                        </address>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Metode Pembayaran</label>
                    <h5>@if($transaksi->pembayaran_detail)
                            {{$transaksi->pembayaran_detail->perusahaan->nama}} - Kelas {{$transaksi->pembayaran_detail->kelas->nama}}
                            @else -
                            @endif
                    </h5>
                    <label>No Sep</label>
                    <h5>{{$transaksi->sep_detail ? $transaksi->sep_detail->no_sep : "-"}}</h5>
                </div>
                <div class="col-md-3">
                    <label>Asal Pelayanan</label>
                    <h5>{{$transaksi->lokasi ? $transaksi->lokasi->nama : "-"}}</h5>
                    <label>Penulis Resep</label>
                    <h5>{{$transaksi->created_by_detail->name}}</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                </div>
                <div class="col-md-3">
                    <label>Sisa Plafon</label>
                    <h5>{{$transaksi->sep_detail ? "Rp. ".number_format($transaksi->sep_detail->sisa_plafon) : "-"}}</h5>
                </div>
            </div>
        </div>
        <hr class="my-5 mb-20">

        <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/transaksi')}}/edit">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$transaksi->id}}">
            <input type="hidden" name="farmasi" value="{{$transaksi->farmasi_id}}">
            <input type="hidden" name="is_kemo" value="true">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Tanggal Transaksi </label>
                        <input type="text" class="js-datepicker form-control datepicker" name="tanggal_transaksi" placeholder="Pilih Tanggal" id="tanggal_transaksi" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{implode('-', array_reverse(explode('-', explode(' ',$transaksi->created_at)[0])))}}" data-date-format="dd-mm-yyyy" autocomplete="off" required>
                    </div>
                </div>
            </div>
            <hr class="my-5">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Nomor Resep</label>
                        <input type="text" class="form-control" id="no-resep" name="nomor_resep" placeholder="Nomor Resep" value="{{$transaksi->final_detail->nomor_resep}}">
                    </div>
                    <div class="form-group">
                        @include('farmasi.transaksi.modals.components.dokter',['id_radio' => 'edit'])
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Nomor Antrian</label>
                        <input type="text" class="form-control" id="no-antrian" name="no_antrian" placeholder="Nomor Antrian" value="{{$transaksi->no_antrian}}">
                    </div>
                    <div class="form-group">
                        <label for="penyedia">Keterangan <small>(Opsional)</small></label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Isikan Keterangan" value="{{$transaksi->deskripsi}}">
                    </div>
                </div>
            </div>
            <hr class="my-5">
            <div class="row">
                <div class="col-6">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Isi resep obat</h3>
                    </div>
                    <div class="block-content">
                        <input type="hidden" class="input" name="count" value="0" id="counter_kemo">
                        <input type="hidden" class="input" name="" value="0" id="check_resep_id_kemo">
                        <input type="hidden" class="input" name="" value="false" id="is_edit_kemo">
                        <div class="form-group row">
                            <label for="penyedia">Tipe Obat </label>
                            <select class="js-select2 form-control" id="tipe_kemo" name="" style="width: 100%;" data-placeholder="Pilih Satuan">
                                @foreach($tipe as $tip)
                                <option value="{{$tip->nama}}">{{$tip->nama}}</option>
                                @endforeach
                            </select>
                            <p class="text-warning"></p>
                        </div>
                        <div class="row">
                            <div class="col-12 px-0">
                                <div class="form-group" id="kemo-row">
                                    <label>Obat</label>
                                    <div class="row kemo-obat-wrapper">
                                        <h1 class="text-kemo" id="kemo-text-1" hidden></h1>
                                        <input type="hidden" class="form-control harga-kemo" id="harga-kemo-1">
                                        <div class="col-7">
                                            <select class="js-select2 form-control barang-kemo barang-kemo-racik" id="kemo-select2-1" style="width: 100%;" data-placeholder="Pilih Barang">
                                                <option></option>
                                            </select>
                                            <p class="text-warning"></p>
                                        </div>
                                        <div class="col-2 pr-0">
                                            <input type="number" class="form-control jumlah-obat-kemo" id="jumlah-kemo" placeholder="Jumlah Amp/Vial">
                                            <p class="text-warning"></p>
                                        </div>
                                        <div class="col-2 pr-0">
                                            <input type="number" class="form-control volume-obat-kemo" id="volume-kemo" placeholder="Volume Amp/Vial (mg)">
                                            <p class="text-warning"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center pb-10" id="tambahKemo">
                            <button type="button" class="btn btn-lg btn-circle btn-outline-primary" id="btnAddKemo">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>

                        <div class="form-group row">
                            <label>Dosis yang dibutuhkan</label>
                            <input type="number" class="form-control" id="dosis_kemo" placeholder="Dosis yang dibutuhkan">
                            <p class="text-warning"></p>
                        </div>

                        <div class="form-group row">
                            <div class="col-6 pl-0">
                                <label for="penyedia">Cara Pemberian</label>
                                <select class="js-select2 form-control" id="cara_pemberian" name="" data-tags="true" style="width: 100%;">
                                    <option value="IV Drip">IV Drip</option>
                                    <option value="IV Bolus">IV Bolus</option>
                                    <option value="IV Pump">IV Pump</option>
                                </select>
                            </div>
                            <div class="col-6 pr-0">
                                <label for="penyedia">Lama Pemberian</label>
                                <select class="js-select2 form-control" id="lama_pemberian" name="" data-tags="true" style="width: 100%;">
                                    <option value="30 Menit">30 Menit</option>
                                    <option value="2 jam">2 jam</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-6 pl-0">
                                <label for="penyedia">Nama Infus</label>
                                <div style="width: 100%;">
                                    <select class="js-select2 form-control barang-kemo" id="nama-infus" style="width: 100%;" data-placeholder="Pilih Infus">
                                        <option></option>
                                    </select>
                                    <p class="text-warning"></p>
                                </div>
                            </div>
                            <div class="col-2 pr-0">
                                <label for="penyedia">Jml Infus</label>
                                <input type="number" class="form-control" id="jumlah_infus" name="" placeholder="Jumlah Infus">
                            </div>
                            <div class="col-2 pr-0">
                                <label for="penyedia">Vol Infus</label>
                                <input type="text" class="form-control" id="volume_infus" name="" placeholder="Vol Infus">
                            </div>
                            <div class="col-2 pr-0">
                                <label for="penyedia">Vol Pelarut</label>
                                <input type="text" class="form-control" id="volume_pelarut" name="" placeholder="Vol Pelarut">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-6 pl-0">
                                <label for="penyedia">Nama Dagang</label>
                                <input type="text" class="form-control" id="dagang" name="" placeholder="Nama Dagang">
                            </div>
                            <div class="col-6 pr-0">
                                <label for="penyedia">Pabrik</label>
                                <input type="text" class="form-control" id="pabrik" name="" placeholder="Pabrik">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-6 pl-0">
                                <label for="penyedia">No. Batch</label>
                                <input type="text" class="form-control" id="batch" name="" placeholder="No Batch">
                            </div>
                            <div class="col-6 pr-0">
                                <label for="penyedia">Exp. Date</label>
                                <input type="text" class="js-datepicker form-control datepicker" name="exp_date" placeholder="Pilih Tanggal" id="exp_date_kemo" data-week-start="1" data-autoclose="true" data-today-highlight="true"  data-date-format="dd-mm-yyyy" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 pl-0">
                                <label for="penyedia">Kondisi Penyimpanan</label>
                            </div>
                            <div class="col-6 pl-0">
                                <select class="js-select2 form-control" id="kondisi" name="" style="width: 100%;">
                                    <option value="Suhu Ruangan">Suhu Ruangan</option>
                                    <option value="Suhu Lemari es">Suhu Lemari es</option>
                                </select>
                            </div>
                            <div class="col-6 pr-0">
                                <select class="js-select2 form-control" id="penyimpanan" name="" style="width: 100%;">
                                    <option value="Tempat Terang">Tempat Terang</option>
                                    <option value="Terlindung Cahaya">Terlindung Cahaya</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 pl-0">
                                <label for="penyedia">Stabilitas</label>
                            </div>
                            <div class="col-6 pl-0">
                                <select class="js-select2 form-control" id="stabilitas_time" name="" style="width: 100%;" data-tags="true">
                                    <option value="8 Jam">8 Jam</option>
                                    <option value="4 Jam">4 Jam</option>
                                    <option value="12 Jam">12 Jam</option>
                                </select>
                            </div>
                            <div class="col-6 pr-0">
                                <input type="text" class="js-datepicker form-control datepicker" name="stabilitas_date" placeholder="Pilih Tanggal" id="stabilitas_date" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" autocomplete="off">
                            </div>
                        </div>

                        {{-- <div id="div-spinner" class="d-none text-center">
                            <span class="fa fa-4x fa-spinner fa-spin text-info"></span>
                        </div> --}}
                        <div id="editResepBtn" class="">
                            <div class="row">
                                <div class="col">
                                    <div class="text-center pb-10 d-none">
                                        <button type="button" class="btn btn-sm btn-square" id="btn-cancel">
                                            <i class="fa fa-times" aria-hidden="true"></i>&nbsp; Batal
                                        </button>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="text-center pb-10 d-none">
                                        <button type="button" class="btn btn-sm btn-success btn-square" id="">
                                            <i class="fa fa-check" aria-hidden="true"></i>&nbsp; Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center pb-10" id="">
                            <button type="button" class="btn btn-sm btn-primary btn-square mt-20" id="btn-add-kanker">
                                <i class="fa fa-plus mr-2" aria-hidden="true"></i> Tambahkan Obat
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row" id="">
                        <div class="col-md-12 resep-jadi" id="resep-jadi">
                            @foreach($transaksi->final_detail->resep_detail as $detail)
                            <a class="block block-link-shadow" href="javascript:void(0)">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title"></h3>
                                    <div class="block-options">
                                        <button type="button" class="btn btn-sm btn-secondary btn-ubah" data-id="{{$loop->iteration-1}}">Ubah</button>
                                        <button type="button" class="btn btn-sm btn-secondary btn-hapus">Hapus</button>
                                    </div>
                                </div>
                                <div class="block-content block-content-full clearfix">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-borderless table-vcenter kemo">
                                                <tbody>
                                                    @php $obat_racikan = []; 
                                                        $obat_nama = []; 
                                                        $obat_harga = []; 
                                                        $obat_jumlah = []; 
                                                        $obat_volume = []; 
                                                        $obat_obj = []; 
                                                    @endphp
                                                    <tr>
                                                        <td>Tipe Obat</td>
                                                        <td>:</td>
                                                        <td>{{$detail->satuan}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama dan Vol Infus</td>
                                                        <td>:</td>
                                                        <td>{{$detail->obat_detail->item_detail->nama.' ('.$detail->volume_infus}}) - {{$detail->jumlah}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Volume Pelarut</td>
                                                        <td>:</td>
                                                        <td>{{$detail->volume_pelarut}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama Dagang</td>
                                                        <td>:</td>
                                                        <td>{{$detail->dagang}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pabrik</td>
                                                        <td>:</td>
                                                        <td>{{$detail->pabrik}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Obat</td>
                                                        <td>:</td>
                                                        <td>
                                                        @foreach ($detail->racikan as $racikan)
                                                            @php
                                                                array_push($obat_racikan, $racikan->obat_id);
                                                                array_push($obat_nama, $racikan->nama_obat);
                                                                array_push($obat_harga, $racikan->harga);
                                                                array_push($obat_jumlah, $racikan->jumlah);
                                                                array_push($obat_volume, $racikan->jumlah);
                                                                array_push($obat_obj, $racikan->obat_detail->item_detail);
                                                            @endphp
                                                            {{$racikan->nama_obat}} ({{$racikan->volume}}) - {{$racikan->jumlah}}
                                                        @endforeach
                                                        </td>
                                                         @php
                                                        $input = array(
                                                        'obat_obj' => $obat_obj,
                                                        'obat' => $obat_racikan,
                                                        'hargaObat' => $obat_harga,
                                                        'jumlah_racikan' => $obat_jumlah,
                                                        'volume_racikan' => $obat_volume,
                                                        'jenis' => 'racikan',
                                                        'tipe' => $detail->satuan,    
                                                        'satuan' => $detail->satuan,
                                                        'racikan' => $detail->nama_obat,
                                                        'obat' => $obat_racikan,
                                                        'jumlah' => $detail->jumlah,
                                                        'keterangan' => $detail->keterangan,
                                                        'aturan' => $detail->aturan,
                                                        'dosis' => $detail->dosis,
                                                        'cara_pemberian' => $detail->satuan_penggunaan,
                                                        'lama_pemberian' => $detail->lama_pemberian,
                                                        'volume_pelarut' => $detail->volume_pelarut,
                                                        'nama_infus' => $detail->obat_detail->item_detail->nama,
                                                        'id_infus' => $detail->obat_id,
                                                        'volume_infus' => $detail->volume_infus,
                                                        'jumlah_infus' => $detail->jumlah,
                                                        'dagang' => $detail->dagang,
                                                        'pabrik' => $detail->pabrik,
                                                        'batch' => $detail->batch,
                                                        'exp_date' => $detail->exp_date,
                                                        'kondisi' => $detail->kondisi,
                                                        'penyimpanan' => $detail->penyimpanan,
                                                        'stabilitas_date' => $detail->stabilitas_date,
                                                        'stabilitas_time' => $detail->stabilitas_time,
                                                        'dukRS' => $detail->dukunganrs,
                                                        'satuan_penggunaan' => $detail->satuan_penggunaan
                                                        )
                                                    @endphp
                                                     <input type="hidden" class="input" name="input[]" value='{{json_encode($input)}}'>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless table-vcenter kemo">
                                                <tbody>
                                                    <tr>
                                                        <td>Dosis yg dibutuhkan</td>
                                                        <td>:</td>
                                                        <td>{{$detail->dosis}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Cara Pemberian</td>
                                                        <td>:</td>
                                                        <td>{{$detail->satuan_penggunaan}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lama Pemberian</td>
                                                        <td>:</td>
                                                        <td>{{$detail->lama_pemberian}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kondisi Penyimpanan</td>
                                                        <td>:</td>
                                                        <td>{{$detail->kondisi}} <br> {{$detail->penyimpanan}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Stabilitas</td>
                                                        <td>:</td>
                                                        <td>{{$detail->stabilitas_date}} <br> {{$detail->stabilitas_time}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>No. Batch</td>
                                                        <td>:</td>
                                                        <td>{{$detail->batch}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Exp Date</td>
                                                        <td>:</td>
                                                        <td>{{$detail->exp_date}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-12">
                    <div class="float-right">
                        <a href="{{url('farmasi/'.session('farmasi')->slug.'/transaksi/'.$transaksi->slug)}}" class="btn btn-secondary btn-square">Batal</a>
                        <span>&nbsp;</span>
                        <button type="submit" class="btn btn-primary btn-square" id="btnSimpan">Simpan Perubahan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
$('#kemo-select2-1').select2({
    ajax: {
        url: API_URL+"/farmasi/{{session('farmasi')->slug}}/item/get",
        dataType: 'json',
        delay: 250,
        data: function (params) 
        {
            return {
                keyword: params.term,
                page: params.page
            };
        },
        processResults: function (data, params) {
            params.page = params.page || 1;
            return {
                results: data.data,
            };
        },
        cache: true
    },
    escapeMarkup: function (markup) { return markup; },
    minimumInputLength: 3,
    placeholder: "Cari Barang",
    templateResult: formatBarang,
    templateSelection: formatBarangSelectionKemo
});

function formatBarang (item) {
    if (item.loading) {
        return item.text;
    }

    var stok = 0;
    if(item.stok)
        stok = item.stok.aggregate;
    var markup = item.item_detail.nama + " ("+item.item_detail.satuan+") - Stok : " + stok + " - Harga : "+item.item_detail.harga;

    return markup;
}


function formatBarangSelectionKemo (item) {
    if(item.kadal){
        var kadaluarsa = item.kadal.kadal.split('-').reverse().join('/');
        $('#exp_date_kemo').val(kadaluarsa)
    }
    if(item.item_detail){
        tipeObatDb = item.item_detail.satuan;

        var stok = 0;
        if(item.stok)
            stok = item.stok.aggregate;
        return item.item_detail.nama + " ("+item.item_detail.satuan+") - Stok : " + stok + " - Harga : "+item.harga;  
    } 
    else return item.text;
}
</script>
    @include('farmasi.transaksi.js.transaksi-baru-kemoterapi-js')
@endsection
