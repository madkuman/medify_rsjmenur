<tr>
    <td>{{$an->nomor_antrian}}</td>
    <td>{{date('d F y, H:i', strtotime($an->created_at))}}</td>
    <td><span class="badge {{str_replace('btn', 'badge', $an->level->class)}}">{{$an->level->nama}}</span></td>
    <td>
        <button type="button" class="btn btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Panggil 
        	<i class="fa fa-angle-down"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(164px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
            <a class="dropdown-item" href="javascript:void(0)" onclick="call(1, '{{$an->nomor_antrian}}')">
                Loket 1
            </a>
            <a class="dropdown-item" href="javascript:void(0)" onclick="call(2, '{{$an->nomor_antrian}}')">
                Loket 2
            </a>
            <a class="dropdown-item" href="javascript:void(0)" onclick="call(3, '{{$an->nomor_antrian}}')">
                Loket 3
            </a>
        </div>
    </td>
</tr>