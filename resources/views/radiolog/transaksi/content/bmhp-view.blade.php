<h6>PENGGUNAAN BMHP</h6>
<table class="table table-bordered">
    <tr>
        <th>BMHP</th>
        <th>Jumlah</th>
    </tr>
    @foreach($bmhp as $item_bmhp)
    <tr>
        <td>{{$item_bmhp->nama}}</td>
        <td>{{$item_bmhp->jumlah}}</td>
    </tr>
    @endforeach
</table>