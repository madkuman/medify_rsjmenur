<form method="POST" action="{{url('kuisioner/jawaban/baru')}}">
    {{ csrf_field() }}
    <input type="hidden" name="jawabanid" value="{{$jawaban_id}}">
    <input type="hidden" name="kuisionerid" value="{{$kuisioner->id}}">
    <input type="hidden" name="slug" value="{{$kuisioner->slug}}">
    <div class="row">
        <div class="col-12">
            <table style="width: 100%">
            @php
                $no = 1;
            @endphp
            @forelse ($jawaban as $item)
                @if (!empty($item['pertanyaan_id']))
                    @php
                        $val = json_decode($item['pertanyaan']->val_pilihan);
                    @endphp
                    @switch($item['pertanyaan']->tipe)
                        @case('puas')
                            <tr class="font-w600">
                                <td class="text-center" style="width: 30px">{{$no++}}.</td>
                                <td>{{$item['pertanyaan']->pertanyaan}}</td>
                            </tr>
                            <tr class="{{$loop->iteration == $loop->last ? '' : 'pilihan'}}">
                                <td><input type="hidden" name="pertanyaan[]" value="{{$item['pertanyaan']->id.'_'.$item['pertanyaan']->tipe}}"></td>
                                <td>
                                    <div class="row">
                                        <div class="col-12 col-md-2">
                                            <label class="css-control css-control-primary css-radio">
                                                <input type="radio" class="css-control-input" name="puas_{{$item['pertanyaan']->id}}" value="Puas" {{$item['jawab'] == 'Puas' ? 'checked': ''}} required>
                                                <span class="css-control-indicator"></span> Puas
                                            </label>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label class="css-control css-control-primary css-radio">
                                                <input type="radio" class="css-control-input" name="puas_{{$item['pertanyaan']->id}}" value="Tidak Puas" {{$item['jawab'] == 'Tidak Puas' ? 'checked': ''}} required>
                                                <span class="css-control-indicator"></span> Tidak Puas
                                            </label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @break
                        @case('sesuai')
                            <tr class="font-w600">
                                <td class="text-center" style="width: 30px">{{$no++}}.</td>
                                <td>{{$item['pertanyaan']->pertanyaan}}</td>
                            </tr>
                            <tr class="{{$loop->iteration == $loop->last ? '' : 'pilihan'}}">
                                <td><input type="hidden" name="pertanyaan[]" value="{{$item['pertanyaan']->id.'_'.$item['pertanyaan']->tipe}}"></td>
                                <td>
                                    <div class="row">
                                        <div class="col-12 col-md-2">
                                            <label class="css-control css-control-primary css-radio">
                                                <input type="radio" class="css-control-input" name="sesuai_{{$item['pertanyaan']->id}}" value="Sesuai" {{$item['jawab'] == 'Sesuai' ? 'checked': ''}} required>
                                                <span class="css-control-indicator"></span> Sesuai
                                            </label>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label class="css-control css-control-primary css-radio">
                                                <input type="radio" class="css-control-input" name="sesuai_{{$item['pertanyaan']->id}}" value="Tidak Sesuai" {{$item['jawab'] == 'Tidak Sesuai' ? 'checked': ''}} required>
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
                                <td class="text-center" style="width: 30px">{{$no++}}.</td>
                                <td>{{$item['pertanyaan']->pertanyaan}}</td>
                            </tr>
                            <tr class="{{$loop->iteration == $loop->last ? '' : 'pilihan'}}">
                                <td><input type="hidden" name="pertanyaan[]" value="{{$item['pertanyaan']->id.'_'.$item['pertanyaan']->tipe}}"></td>
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
                                                            <input type="radio" class="css-control-input custom-radio" name="pilgan_{{$item['pertanyaan']->id}}" value="{{$key.'_'.$value}}" onclick="changeCircle('pilgan_{{$item['pertanyaan']->id}}','pilgan_{{$item['pertanyaan']->id.'_'.$huruf}}')" {{$key == $item['jawab'] ? 'checked': ''}} required>
                                                            <span id="pilgan_{{$item['pertanyaan']->id.'_'.$huruf}}" class="btn btn-circle {{$key == $item['jawab'] ? 'btn-primary': 'btn-outline-primary'}} mb-5 pilgan_{{$item['pertanyaan']->id}}" style="margin-top:2px;margin-right:2px !important;padding:2px;font-size:12px;min-width: 20px;height: 20px;">{{$huruf++}}</span>
                                                        </label>
                                                    </td>
                                                    <td valign="top" style="width: 23%;padding-left: 5px;padding-right: 5px">
                                                        {{$value}}
                                                    </td>
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
                                <td class="text-center" style="width: 30px">{{$no++}}.</td>
                                <td>{{$item['pertanyaan']->pertanyaan}}</td>
                            </tr>
                            <tr class="{{$loop->iteration == $loop->last ? '' : 'pilihan'}}">
                                <td><input type="hidden" name="pertanyaan[]" value="{{$item['pertanyaan']->id.'_'.$item['pertanyaan']->tipe}}"></td>
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
                                                    <label class="css-control css-control-info css-radio">
                                                        <input type="radio" class="css-control-input" name="skala_{{$item['pertanyaan']->id}}" value="{{$key.'_'.$value}}"  {{$item['jawab'] == $key ? 'checked': ''}} required>
                                                        <span class="css-control-indicator"></span>
                                                    </label>
                                                </td>
                                                <td valign="top" style="width: 23%;padding-left: 5px;padding-right: 5px;padding-top: 7px !important">
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
                                <td class="text-center" style="width: 30px">{{$no++}}.</td>
                                <td>{{$item['pertanyaan']->pertanyaan}}</td>
                            </tr>
                            <tr class="{{$loop->iteration == $loop->last ? '' : 'pilihan'}}">
                                <td><input type="hidden" name="pertanyaan[]" value="{{$item['pertanyaan']->id.'_'.$item['pertanyaan']->tipe}}"></td>
                                <td>
                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            <input type="text" class="form-control" name="textbox_{{$item['pertanyaan']->id}}" value="{{$item['jawab']}}" required>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @break    
                        @case('textarea')
                            <tr class="font-w600">
                                <td class="text-center" style="width: 30px">{{$no++}}.</td>
                                <td>{{$item['pertanyaan']->pertanyaan}}</td>
                            </tr>
                            <tr class="{{$loop->iteration == $loop->last ? '' : 'pilihan'}}">
                                <td><input type="hidden" name="pertanyaan[]" value="{{$item['pertanyaan']->id.'_'.$item['pertanyaan']->tipe}}"></td>
                                <td>
                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            <textarea name="textarea_{{$item['pertanyaan']->id}}" class="form-control" rows="6" required>{{$item['jawab']}}</textarea>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @break
                        @default
                            
                    @endswitch
                @endif
            @empty
                <div class="text-center">
                    <h4>Data jawaban tidak tersedia</h4>
                </div>
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