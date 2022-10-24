<!DOCTYPE html>
<html>
<head>
	<title>Nota</title>
</head>
<body>
	<h1>Pengadaan #{{$pengadaan->slug}}</h1>
	<label>PENYEDIA</label>
	<h4 class="text-primary">{{$pengadaan->supplier_detail->nama}}</h4>
	<label>TANGGAL TRANSAKSI</label>
	<h5>{{ date('d F Y', strtotime($pengadaan->tanggal)) }}</h5>
	<label>NO REFERENSI</label>
	<h4>{{ is_null($pengadaan->nomor_referensi) ? "-" : $pengadaan->nomor_referensi }}</h4>
	<table class="table table-vcenter">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1 @endphp
                    @foreach($items as $row)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$row->detail_item->nama}}</td>
                        <td>{{$row->jumlah_total}} {{$row->detail_item->satuan}}</td>
                        <td>Rp. {{number_format($row->harga_saat_itu)}}</td>
                        <td>Rp. {{number_format($row->subtotal)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
</body>
</html>