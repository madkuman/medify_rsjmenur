<tr id="harga-tr-${trCount}" class="harga-tr">
    <th class="text-center index-num" scope="row">${trCount}</th>
    <td class="text-center">
        <select class="form-control" name="tipe[]" data-placeholder="Pilih Tipe Tarif">
            @foreach($tipe as $item)
            <option value="{{$item->id}}">{{$item->nama}}</option>
            @endforeach
        </select>
    </td>
    <td class="text-center">
        <select class="form-control" name="kelas[]" data-placeholder="Pilih Tipe Tarif">
            @foreach($kelas as $item)
            <option value="{{$item->id}}">{{$item->nama}}</option>
            @endforeach
            <option value="0">Semua Kelas</option>
        </select>
    </td>
    <td class="text-center ">
        <input type="text" class="form-control input-harga" name="harga[]" value="0">
    </td>
    <td class="text-right">
        <button class="btn btn-alt-danger btn-sm remove" type="button"><i class="fa fa-remove"></i></button>
    </td>
</tr>