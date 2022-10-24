<div class="block-content ">
    <div class="row">
        <div class="col-lg-12 mb-10">
            @if(session('my_role_'.$kasus->nomor_kasus))
            @if(!empty($diagnosis))
            <button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modalAlatMedisBaru"><i class="fa fa-plus"></i> Penggunaan Alat Medis Baru</button>  
            @else  
            <button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modalAlatMedisBaru"><i class="fa fa-plus"></i> Penggunaan Alat Medis Baru</button>
            @endif
            <h4>Penggunaan Alat Medis</h4>
            @endif
        </div>
        <table class="table">
            <tr>
                <th class="text-center">No</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th class="text-center">Aksi</th>
            </tr>
            @foreach($permintaan as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->itemsTemplate->name}}</td>
                    <td>{{$item->jumlah}}</td>
                    <td align="center"><button class="btn btn-primary selesai" data-toggle="modal" data-target="#modalAlatMedisSelesai" items_template_id="{{$item->items_template_id}}" jumlah="{{$item->jumlah}}"><i class="fa fa-check"></i> Selesai</button></td>
                </tr>
            @endforeach
        </table>

        @empty($permintaan)
            <div class="col-12 text-center py-50">
                <h4 class="font-w400 mb-5">Belum ada penggunaan Alat Medis</h4>
                <p>Klik tombol <b>Penggunaan Alat Medis Baru</b> untuk melakukan penggunaan alat medis</p>
            </div>
        @endempty
        

    </div>
</div>