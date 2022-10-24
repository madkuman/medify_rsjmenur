@section('css')

@endsection

<div class="block-header">
    <div class="block-title">Berikut Jawaban Kuisioner Anda</div>
    <button id="btn-edit" data-id="{{$kuisioner->id}}" class="btn btn-sm btn-alt-info btn-hero pull-right" {{$temp->edited == 1 ? 'disabled' : ''}} >
    Edit Jawaban
    </button>
</div>
<table class="table table-bordered table-striped table-vcenter no-footer" style="width: 100%">
    <thead>
        <tr class="text-center">
            <th style="width: 5%">No</th>
            <th style="width: 45%">Pertanyaan</th>
            <th style="width: 15%">Tipe</th>
            <th style="width: 35%">Jawaban</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($jawaban as $item)
            @if (!empty($item['pertanyaan']))
                <tr>
                    <td class="text-center">{{$no++}}</td>
                    <td>{{$item['pertanyaan']}}</td>
                    <td class="text-center">{{$item['tipe']->jenis ?? '-'}}</td>
                    <td class="text-center">{{$item['jawab'] ?? '-'}}</td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>