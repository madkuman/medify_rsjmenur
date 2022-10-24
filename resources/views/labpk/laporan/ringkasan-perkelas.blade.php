<table class="table-bordered thead-light" style="width: 100%;">
    <thead>
        <tr class="bg-primary-light" >
            <th rowspan="2" style="width: 20px; font-size: 10; text-align: center;"><b>NO</b></th>
            <th rowspan="2" style="width: 180px; font-size: 10; text-align: center;"><b>PASIEN</b></th>
            <th colspan="8" style="width: 400px; font-size: 10; text-align: center;"><b>BPJS</b></th>
            <th rowspan="2" style="width: 50px; font-size: 10; text-align: center;"><b>UMUM</b></th>
            <th rowspan="2" style="width: 50px; font-size: 10; text-align: center;"><b>JUMLAH</b></th>
        </tr>
        <tr class="bg-primary-light" >
            <th style="font-size: 10; text-align: center;"><b>AL</b></th>
            <th style="font-size: 10; text-align: center;"><b>S.AL</b></th>
            <th style="font-size: 10; text-align: center;"><b>KEL.AL</b></th>
            <th style="font-size: 10; text-align: center;"><b>NON AL</b></th>
            <th style="font-size: 10; text-align: center;"><b>HANK</b></th>
            <th style="font-size: 10; text-align: center;"><b>ANH</b></th>
            <th style="font-size: 10; text-align: center;"><b>JMK</b></th>
            <th style="font-size: 10; text-align: center;"><b>MADR</b></th>
        </tr>
    </thead>
    <?php 
        $singleMonth = date("F", strtotime($month));
     ?>
    <tbody>
        @foreach($perKelas as $key => $value)
            @foreach($value as $index => $row)
                <tr style="text-align: center;">
                    <td style="font-size: 10"></td>
                    <td style="font-size: 10; text-align: left"><b>{{$title['short'][$key]}} 
                    @if($index == 0)
                    1-15 
                    @elseif($index == 1)
                    16-31
                    @endif
                    {{$singleMonth}}
                    </b></td>
                    <?php $total = 0; ?>
                    @foreach($row as $col)
                        <td style="font-size: 10">{{count($col)}}</td>
                        <?php $total += count($col); ?>
                    @endforeach
                    <td style="font-size: 10">{{$total}}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>