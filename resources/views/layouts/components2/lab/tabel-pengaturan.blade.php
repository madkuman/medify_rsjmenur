<table class="table table-bordered table-striped table-vcenter no-footer" aria-describedby="DataTables_info" id="pengaturanTable" style="width: 100%">
    <thead>
        <tr >
            <th>Nama</th>
            <th>Kategori</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($tarif as $row)
        <tr>
            <td class="font-w600">{{$row['deskripsi']}}</td>
            <td>{{$row->kategori->nama}}</td>
            <td style="border: none;" class="text-center">
                <a href="{{url($link.'/pengaturan/layanan')}}/{{$row->id}}" class="btn btn-primary full-only">Lihat Harga</a>
                <a href="{{url($link.'/pengaturan/layanan')}}/{{$row->id}}" class="btn btn-primary mobile-block">
                    <i class="fa fa-search"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>