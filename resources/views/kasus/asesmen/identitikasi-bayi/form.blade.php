<input type="hidden" name="id" id="id" value="">
<section>
    <div class="row">
        <div class="col-md-12">
            <h5>Bagan Kematangan Neuromuskular</h5>
        </div>
        <div class="col-md-12">
            <table class="table mews w-100 table-bordered" >
                <tr class="text-center">
                    <th>Parameter</th>
                    @for($i = -1 ; $i <= 5 ; $i++)
                    <th width="10%">{{$i}}</th>
                    @endfor
                    <th width="10%">Skor</th>
                </tr>
                @foreach($data_bagan_neuromuskular as $bagan_neuromuskular)
                <tr>
                    <td>{!! $bagan_neuromuskular->parameter !!}</td>
                    @for($i = -1 ; $i <= 5 ; $i++)
                    <td class="text-center">
                        @if(!in_array($i, $bagan_neuromuskular->skip))
                        <label class="mews-item">
                            <input type="radio" value="{{$i}}"  name="neuromuskular_{{$bagan_neuromuskular->variabel}}" onchange="calculate(this, 'neuromuskular', 'neuromuskular_{{$bagan_neuromuskular->variabel}}')">
                            <div><img src="{{ url('assets/img/asesmen/asesmen-identitikasi-bayi/' . $bagan_neuromuskular->variabel . '_' . $i . '.png') }}" width="73px" alt=""></div>
                        </label>
                        @endif
                    </td>
                    @endfor
                    <td class="text-center skor_neuromuskular_{{$bagan_neuromuskular->variabel}}">0</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="8"  class="text-right">Jumlah</td>
                    <td class="text-center total_skor_neuromuskular">0</td>
                    <input type="hidden" class="input_total_skor_neuromuskular" name="total_skor_neuromuskular">
                </tr>
            </table>
        </div>
        <div class="col-md-12 mt-3">
            <h5>New Ballard Score</h5>
        </div>
        <div class="col-md-12">
            <table class="table mews w-100 table-bordered" >
                <tr class="text-center">
                    <th>Parameter</th>
                    @for($i = -1 ; $i <= 5 ; $i++)
                    <th width="14%">{{$i}}</th>
                    @endfor
                    <th width="8%">Skor</th>
                </tr>
                @foreach($data_bagan_ballard as $ballard)
                <tr>
                    <td>{!! $ballard->parameter !!}</td>
                    @foreach($ballard->data as $index => $text)
                    <td class="text-justify">
                        <label class="mews-item">
                            <input type="radio" value="{{$index -1}}"  name="ballard_{{$ballard->variabel}}" onchange="calculate(this, 'ballard', 'ballard_{{$ballard->variabel}}')">
                            <div>{!! $text !!}</div>
                        </label>
                    </td>
                    @endforeach
                    <td class="text-center skor_ballard_{{$ballard->variabel}}">0</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="8"  class="text-right">Jumlah</td>
                    <td class="text-center total_skor_ballard">0</td>
                    <input type="hidden" class="input_total_skor_ballard" name="total_skor_ballard">
                </tr>
            </table>
        </div>
        <div class="col-md-12 mt-3">
            <h5>Skor Getasi : <span class="total_skor"></span></h5>
        </div>
        <div class="col-md-12">
            <table class="table w-100 table-borderless tabel-getasi">
                <tr class="text-center">
                    <td>Nilai</td>
                    <td>Minggu</td>
                </tr>
                @php $j = 25 @endphp
                @for($i = 0 ; $i <= 50; $i += 5)
                <tr class="text-center tr_getasi_{{$i}}">
                    <td>{{$i}}</td>
                    <td>{{$j++}}</td>
                </tr>

                @if($i == 50) @continue @endif
                <tr class="text-center tr_getasi_{{$i}}_between">
                    <td>{{$i + 1}} - {{$i + 4}}</td>
                    <td>{{$j++}}</td>
                </tr>
                @endfor
            </table>
        </div>
    </div>