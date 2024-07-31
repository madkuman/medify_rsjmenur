<div class="row mx-0">
   {{-- <div class="form-group col-lg-3 col-12">
        <label for="penyedia">Tanggal Transaksi</label>
        <div class="input-group">
          <input type="text" class="js-datepicker form-control datepicker" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" value="" autocomplete="off" id="tanggalTransaksi" name="date" placeholder="Masukkan Tanggal Transaksi" required>
          <div class="input-group-append">
            <button type="button" class="btn btn-secondary" id="clearTanggal">
                <i class="fa fa-close"></i>
            </button>
        </div>
    </div>
</div>--}}
<div class="form-group col-lg-3 col-12">
    <label for="example-select2">Asal Layanan</label>
    <select class="js-select2 form-control" id="jenisLayanan" name="jenis_layanan" style="width: 100%;" data-placeholder="Pilih Asal Layanan" required="required">
        <option value="0">Semua</option>
        <option value="Rawat Inap">Rawat Inap</option>
        <option value="Rawat Jalan">Rawat Jalan</option>
        <option value="IGD">IGD</option>
    </select>
</div>
<div class="form-group col-lg-3 col-12">
    <label>Jenis Layanan</label>
    <select class="js-example-basic-multiple form-control js-select2" id="jenisPemeriksaan" name="pemeriksaan[]" multiple="multiple" data-placeholder="Pilih Layanan" style="width: 100%;">
        @foreach($pemeriksaan ?? [] as $item)
                <option value="{{$item->deskripsi}}">{{$item->deskripsi}}</option>
        @endforeach
    </select>
</div>
<div class="col-lg-3 col-12 mt-30">
    <a href="{{url($link.'/transaksi/new')}}" type="btn" class="btn btn-primary" style="float: right;"><i class="fa fa-plus"></i> Buat Transaksi</a>
</div>

</div>
<div class="clearfix"></div>
<div class="block-content">
    <table class="table table-bordered table-striped table-vcenter dataTable no-footer px-15" aria-describedby="DataTables_info" id="datatable">
        <thead>
            <tr>
                <th class="text-center" style="width: 7%;">No. RM</th>
                <th style="width: 20%;">Pasien</th>
                <th class="text-center text-center full-only" style="width: 10%">Alamat</th>
                <th class="text-center text-center full-only" style="width: 10%">Jenis</th>
                <th class="text-center text-center full-only" style="width: 6%;">No. Asuransi</th>
                <th class="text-center text-center full-only" style="width: 10%;">Asal Layanan</th>
                <th class="d-none d-sm-table-cell text-center full-only" style="width: 10%;">Waktu Permintaan</th>
                <th class="text-center text-center full-only" style="width: 11%;">Tgl Rencana Periksa</th>
                <th style="width: 17%">Daftar Layanan</th>
                <th style="width: 2%;"></th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0 ?>
            @foreach($transaksi as $item)
            <?php $i++; ?>
            <tr>
                <td class="text-center" scope="row">{{$item->pasien->no_rm}}</td>
                <td>

                    <h5 class="py-0 my-0">{{$item->pasien->name}}</h5>
                    <div class="font-w400 font-size-sm text-muted">
                        {{$item->pasien->jenis_kelamin}}, 
                        {{$item->pasien->age}} tahun
                    </div>
                </td>
                <td class="d-none d-sm-table-cell text-center full-only">
                    {{$item->pasien->address}}
                </td>                        
                <td class="d-none d-sm-table-cell text-center full-only">
                    {{$item->pembayaran['perusahaan']['tipe']['nama']}}
                </td>
                <td class="d-none d-sm-table-cell text-center full-only">
                    {{$item->pembayaran['no_asuransi']}}
                </td>
                <td class="d-none d-sm-table-cell text-center full-only" data-search="{{$item->asal->departemen->nama ?? 'Tanpa Kasus'}}">
                    {{ $item->asal['nama'] ?? 'Tanpa Kasus'}}
                </td>
                <td class="d-none d-sm-table-cell text-center full-only" data-order="{{date('YmdHi', strtotime($item->created_at))}}"
                    >
                    {{ date('d F, H:i', strtotime($item->created_at)) }}
                </td>
                <td class="d-none d-sm-table-cell text-center full-only"
                data-order="{{$item->daysRemaining() == 0 ? '0' : $item->daysRemaining()}}">
                @if(!is_null($item->inspected_at))
                {{ date('d F Y', strtotime($item->inspected_at)) }}                        
                @else
                -
                @endif
                </td>
                <td>
                    <ul>
                        @foreach($item->detail as $detail)
                            @if(!is_null($detail->tarif))
                                <li>{{$detail->tarif->deskripsi}}</li>
                            @endif
                        @endforeach
                    </ul>
                </td>
            <td style="border: none;" class="text-center">
                <a href="{{url($link.'/transaksi/permintaan')}}/{{$item->slug}}" class="btn btn-primary">Layani</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
