<div class="row mx-0">
    <div class="form-group col-lg-3 col-12">
        <label for="penyedia">Tanggal Transaksi</label>
        <input type="text" class="js-datepicker form-control datepicker" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" value="{{$tanggal ?? ''}}" autocomplete="off" id="tanggalTransaksi" name="date" placeholder="Masukkan Tanggal Transaksi" required>
    </div>
    <div class="form-group col-lg-3 col-12">
        <label for="example-select2">Jenis Layanan</label>
        <select class="js-select2 form-control" id="jenisLayanan" name="jenis_layanan" style="width: 100%;" data-placeholder="Pilih Jenis Layanan" required="required">
            <option value="0">Semua</option>
            <option value="Rawat Inap">Rawat Inap</option>
            <option value="Rawat Jalan">Rawat Jalan</option>
            <option value="IGD">IGD</option>
        </select>
    </div>
</div>

<div class="clearfix"></div>
<div class="block-content">
    <table class="table table-bordered table-striped table-vcenter no-footer" aria-describedby="DataTables_info" id="datatable">
        <thead>
            <tr>
                <th class="text-center" style="width: 7%;">No. RM</th>
                <th style="width: 32%;">Pasien</th>
                <th class="text-center text-center full-only" style="width: 10%">Alamat</th>
                <th class="text-center full-only" style="width: 10%">Jenis</th>
                <th class="text-center full-only" style="width: 6%;">No. Asuransi</th>
                <th class="d-none d-sm-table-cell text-center full-only" style="width: 15%;">Waktu Pemeriksaan</th>
                <th class="text-center full-only" style="width: 10%;">Asal Ruangan</th>
                <th class="text-center" style="width: 4%;"></th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0 ?>
            @foreach($transaksi as $item)
            <?php $i++ ?>
            <tr>
                <td class="text-center" scope="row" >{{$item->pasien->no_rm ?? ''}}</td>
                <td>
                    <h5 class="py-0 my-0">{{$item->pasien->name}}</h5>
                    <div class="font-w400 font-size-sm text-muted">
                        <?php if($item->pasien->gender == 1) {echo "Laki-laki";}
                        else {echo "Perempuan";}?>, 
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
                <td class="d-none d-sm-table-cell text-center full-only" data-order="{{date('YmdHi', strtotime($item->result_created_at))}}">
                    {{ is_null($item->result_created_at) ? '-' : date('d F Y, H:i', strtotime($item->result_created_at)) }}
                </td>
                <td class="d-none d-sm-table-cell text-center full-only" data-search="{{$item->asal->departemen->nama ?? 'Tanpa Kasus'}}">
                    {{ $item->asal['nama'] ?? 'Tanpa Kasus'}}
                </td>
                <td style="border: none;" class="text-center">
                    <a href="{{url($link.'/transaksi/hasil')}}/{{$item->slug}}" class="btn btn-info">Lihat</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>