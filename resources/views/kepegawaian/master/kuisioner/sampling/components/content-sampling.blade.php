<form method="POST" action="{{url()->current().'/baru'}}">
    {{ csrf_field() }}
    <input type="hidden" name="kuisionerid" value="{{$kuisioner->id}}">
    <input type="hidden" name="slug" value="{{$kuisioner->slug}}">
    <div class="row">
        <div class="col-12">
            <table style="width: 100%">
            @forelse ($kuisioner->pertanyaan as $item)
                @php
                    $val = json_decode($item->val_pilihan);
                @endphp
                @switch($item->tipe)
                    @case('puas')
                        <tr class="font-w600">
                            <td class="text-center" style="width: 30px">{{$loop->iteration}}.</td>
                            <td>{{$item->pertanyaan}}</td>
                        </tr>
                        <tr class="{{$loop->iteration == $loop->last ? '' : 'pilihan'}}">
                            <td><input type="hidden" name="pertanyaan[]" value="{{$item->id.'_'.$item->tipe}}"></td>
                            <td>
                                <div class="row">
                                    <div class="col-12 col-md-2">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="puas_{{$item->id}}" value="Puas" required>
                                            <span class="css-control-indicator"></span> Puas
                                        </label>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="puas_{{$item->id}}" value="Tidak Puas" required>
                                            <span class="css-control-indicator"></span> Tidak Puas
                                        </label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @break
                    @case('sesuai')
                        <tr class="font-w600">
                            <td class="text-center" style="width: 30px">{{$loop->iteration}}.</td>
                            <td>{{$item->pertanyaan}}</td>
                        </tr>
                        <tr class="{{$loop->iteration == $loop->last ? '' : 'pilihan'}}">
                            <td><input type="hidden" name="pertanyaan[]" value="{{$item->id.'_'.$item->tipe}}"></td>
                            <td>
                                <div class="row">
                                    <div class="col-12 col-md-2">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="sesuai_{{$item->id}}" value="Sesuai" required>
                                            <span class="css-control-indicator"></span> Sesuai
                                        </label>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="sesuai_{{$item->id}}" value="Tidak Sesuai" required>
                                            <span class="css-control-indicator"></span> Tidak Sesuai
                                        </label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @break
                    @case('pilgan')
                        @php
                        $huruf = 'A';
                        @endphp
                        <tr class="font-w600">
                            <td class="text-center" style="width: 30px">{{$loop->iteration}}.</td>
                            <td>{{$item->pertanyaan}}</td>
                        </tr>
                        <tr class="{{$loop->iteration == $loop->last ? '' : 'pilihan'}}">
                            <td><input type="hidden" name="pertanyaan[]" value="{{$item->id.'_'.$item->tipe}}"></td>
                            <td>
                                <table style="width: 100%">
                                    <tr>
                                        @php $num = 0; @endphp
                                        @foreach ($val as $key => $value)
                                            @if ($key != 'jenis' && $key != 'dibalik')
                                                @if ($num % 4 == 0)
                                                </tr><tr>
                                                @endif
                                                <td valign="top" style="width: 2%">
                                                    <label class="">
                                                        <input type="radio" class="css-control-input" name="pilgan_{{$item->id}}" value="{{$key.'_'.$value}}" onclick="changeCircle('pilgan_{{$item->id}}','pilgan_{{$item->id.'_'.$huruf}}')" required>
                                                        <span id="pilgan_{{$item->id.'_'.$huruf}}" class="btn btn-circle btn-outline-primary mb-5 pilgan_{{$item->id}}" style="margin-top:2px;margin-right:2px !important;padding:2px;font-size:12px;min-width: 20px;height: 20px;">{{$huruf++}}</span>
                                                    </label>
                                                </td>
                                                <td valign="top" style="width: 23%;padding-left: 5px;padding-right: 5px">
                                                    {{$value}}
                                                </td>
                                                @php $num++; @endphp
                                            @endif
                                        @endforeach
                                        @if ($num < 5)
                                            @php $addtd = 4 - $num; @endphp
                                            @for ($i = 0; $i < $addtd; $i++)
                                                <td style="width: 25%;padding-left: 5px;padding-right: 5px">&nbsp;</td>
                                            @endfor
                                        @endif
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        @break
                    @case('skala')
                        <tr class="font-w600">
                            <td class="text-center" style="width: 30px">{{$loop->iteration}}.</td>
                            <td>{{$item->pertanyaan}}</td>
                        </tr>
                        <tr class="{{$loop->iteration == $loop->last ? '' : 'pilihan'}}">
                            <td><input type="hidden" name="pertanyaan[]" value="{{$item->id.'_'.$item->tipe}}"></td>
                            <td>
                                <table style="width: 100%">
                                    <tr>
                                        @php $num = 0; @endphp
                                        @foreach ($val as $key => $value)
                                            @if ($key != 'jenis' && $key != 'dibalik')
                                                @if ($num % 4 == 0)
                                                </tr><tr>
                                                @endif
                                                <td valign="top" style="width: 2%">
                                                    <label class="css-control css-control-info css-radio pt-0">
                                                        <input type="radio" class="css-control-input" name="skala_{{$item->id}}" value="{{$key.'_'.$value}}" required>
                                                        <span class="css-control-indicator"></span>
                                                    </label>
                                                </td>
                                                <td valign="top" style="width: 23%;padding-left: 5px;padding-right: 5px">
                                                    {{$key.'. '.$value}}
                                                </td>
                                                @php $num++; @endphp
                                            @endif
                                        @endforeach
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        @break
                    @case('textbox')
                        <tr class="font-w600">
                            <td class="text-center" style="width: 30px">{{$loop->iteration}}.</td>
                            <td>{{$item->pertanyaan}}</td>
                        </tr>
                        <tr class="{{$loop->iteration == $loop->last ? '' : 'pilihan'}}">
                            <td><input type="hidden" name="pertanyaan[]" value="{{$item->id.'_'.$item->tipe}}"></td>
                            <td>
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <input type="text" class="form-control" name="textbox_{{$item->id}}" required>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @break    
                    @case('textarea')
                        <tr class="font-w600">
                            <td class="text-center" style="width: 30px">{{$loop->iteration}}.</td>
                            <td>{{$item->pertanyaan}}</td>
                        </tr>
                        <tr class="{{$loop->iteration == $loop->last ? '' : 'pilihan'}}">
                            <td><input type="hidden" name="pertanyaan[]" value="{{$item->id.'_'.$item->tipe}}"></td>
                            <td>
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <textarea name="textarea_{{$item->id}}" class="form-control" rows="6" required></textarea>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @break
                    @default
                        
                @endswitch
            @empty
                
            @endforelse
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <input type="submit" class="btn-alt btn-hero btn-primary min-width-125 pull-right" value="Simpan" {{$kuisioner->pertanyaan->count() > 0 ? '' : 'disabled' }}>
        </div>
    </div>
</form>