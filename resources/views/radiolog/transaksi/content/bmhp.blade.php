<h6>PENGGUNAAN BMHP</h6>
<table class="table table-bordered">
    <tr>
        <th>BMHP</th>
        <th>Jumlah</th>
    </tr>
    @foreach($bmhp as $item_bmhp)
    <tr>
        <td>{{$item_bmhp->nama}}</td>
        <td><input class="form-control" type="number" value="{{$item_bmhp->jumlah}}" name="bmhp[{{$item_bmhp->id}}]"></td>
    </tr>
    @endforeach
</table>