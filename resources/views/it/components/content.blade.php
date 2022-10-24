
<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Daftar Penyebab</h3>
        <div class="block-options">
        </div>
    </div>
    <div class="block-content">
        @include('it.components.filter')

        <div class="block">
            <div class="block-content">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th style="width: 200px">Masalah</th>
                            <th>Info Pelaporan</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th style="width: 80px">Response Time (Menit)</th>
                            <th style="width: 80px">Aksi</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($komplains as $komplain)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$komplain->pesan}}</td>
                            <td><strong>{{$komplain->lokasi}}</strong><br> oleh : {{$komplain->creator->name}}</td>
                            <td>{{indonesian_date($komplain->created_at,'d M  Y H:i')}}</td>
                            <td>
                                @if(!empty($komplain->waktu_respon))
                                <span class="badge badge-primary">Selesai</span>
                                @else
                                <span class="badge badge-secondary">Pending</span>
                                @endif
                            </td>
                            <td>

                                @if(!empty($komplain->waktu_respon))
                                @php $selisih = $komplain->waktu_respon->diffInMinutes($komplain->waktu_komplain) ?? '' @endphp
                                {{$selisih}}
                                @endif
                            <td>
                                @if(empty($komplain->waktu_respon))
                                <a href="{{url('')}}/it/komplain/{{$komplain->id}}/respon" class="btn btn-primary btn-sm btn-respon">Respon</a>
                                @else
                                <a href="{{url('')}}/it/komplain/{{$komplain->id}}/respon" class="btn btn-secondary btn-sm  btn-respon">Edit</a>
                                <button class="btn btn-info btn-sm button-info" 
                                data-respon="{{nl2br($komplain->respon)}}" 
                                data-wakturespon="{{$komplain->waktu_respon->format('d M Y H:i')}}"  
                                data-teknisi="{{$komplain->teknisinya->name}}"
                                >Info</button>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm button-delete" 
                                data-id="{{$komplain->id}}"
                                >Hapus</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>