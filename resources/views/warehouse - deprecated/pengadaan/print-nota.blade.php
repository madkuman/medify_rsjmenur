<!DOCTYPE html>
<html>
<head>
	<title>Nota</title>
    <style type="text/css">
        .table {
            width: 100%;
            max-width: 100%;
            border-collapse: collapse;
        }
        .table-bordered, .table-bordered td, .table-bordered th {
            border: 1px solid #000;
        }
        .table-bordered td {
            padding: 2px 3px 2px 3px;
            font-weight: normal;
        }
        .text-small {
            /*font-size: 13px;*/
        }
        .mt-25 {
          margin-top:25px;
        }
        .mt-10 {
          margin-top:10px;
        }
    </style>
</head>
<body>
    <div class="mt-25">
        <div class="text-center header-title">
          <b>Kwitansi Pengadaan #{{$pengadaan->slug}}</b>
        </div>
    </div>

    <div class="mt-25">
        <div style="position: relative;">
          <div>
            <table class="text-small">
              <tr>
                <td>Penyedia</td>
                <td>:</td>
                <td>{{ $pengadaan->supplier_detail->nama }}</td>
              </tr>
              <tr>
                <td>No. Surat Jalan</td>
                <td>:</td>
                <td>{{ $pengadaan->nomor_surat_jalan ? $pengadaan->nomor_surat_jalan : "-" }}</td>
              </tr>
              <tr>
                <td>No. Faktur</td>
                <td>:</td>
                <td>{{ is_null($pengadaan->nomor_referensi) ? "-" : $pengadaan->nomor_referensi }}</td>
              </tr>
            </table>
          </div>
          <div style="position: absolute; top: 0; right: 0">
            <table class="text-small">
              <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ date('d F Y', strtotime($pengadaan->tanggal)) }}</td>
              </tr>
            </table>
          </div>
        </div>
    </div>

    <div class="mt-25">
    	<table class="table table-bordered text-small">
            <thead>
                <tr>
                    <th align="center">No.</th>
                    <th align="center">Barang</th>
                    <th align="center">Jumlah</th>
                    <th align="center">Kadaluarsa</th>
                    <th align="center">Harga Satuan</th>
                    <th align="center">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($pengadaan->log as $row)
                <tr>
                    <td align="center">{{$i++}}.</td>
                    <td>{{$row->detail_item->detail_item->nama}}</td>
                    <td align="center">{{$row->jumlah}} {{$row->detail_item->detail_item->satuan}}</td>
                    <td align="center">{{ date('d F Y', strtotime($row->detail_item->kadaluarsa)) }}</td>
                    <td align="right">Rp. {{number_format($row->harga_saat_itu)}}</td>
                    <td align="right">Rp. {{number_format($row->subtotal)}}</td>
                </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total</td>
                    <td align="right">Rp. {{number_format($pengadaan->total_harga)}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>