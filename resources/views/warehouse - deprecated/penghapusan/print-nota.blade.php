<!DOCTYPE html>
<html>
<head>
    <title>Nota</title>
    <style type="text/css">
    table {
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
</style>
</head>
<body>
    <h1>Penghapusan #{{$penghapusan->slug}}</h1>
    <label>TANGGAL Penghapusan</label>
    <h5>{{ date('d F Y', strtotime($penghapusan->tanggal)) }}</h5>
    <label>NO REFERENSI</label>
    <h4>{{ is_null($penghapusan->nomor_referensi) ? "-" : $penghapusan->nomor_referensi }}</h4>
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
            @foreach($items as $row)

            @php 
            $harga = is_null($row->detail_item->harga_saat_itu) ? $row->detail_item->detail_item->harga : $row->detail_item->harga_saat_itu;
            @endphp
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$row->detail_item->detail_item->nama}}</td>
                <td>{{$row->jumlah}} {{$row->detail_item->detail_item->satuan}}</td>
                <td>Rp. {{number_format($harga)}}</td>
                <td>Rp. {{number_format($harga*$row->jumlah)}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>