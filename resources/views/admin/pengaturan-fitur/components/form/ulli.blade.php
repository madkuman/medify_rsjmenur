<div class="col-12 col-sm-12 col-md-{{ $col }}">
    <label for="">{{ $judul }}</label>
    <div class=""> {{ $deskripsi }}</div>
    <ul>
        {{-- later di recursive kan --}}
        @foreach ($ulli as $item)
            @if (is_array($item))
                <ul>
                    @foreach ($item as $item_2)
                        <li>{!! $item_2 !!}</li>
                    @endforeach
                </ul>
            @else
                <li>{!! $item !!}</li>
            @endif
        @endforeach
    </ul>
</div>
