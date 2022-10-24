<table>
    <thead>
        <tr>
            <th colspan="6">DEPARTEMEN PENUNJANG KLINIK</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th colspan="6">SUB DEPARTEMEN PATOLOGI ANATOMI</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th colspan="14">LAPORAN PELAYANAN LAB PATOLOGI ANATOMI {{config('app.name')}}</th>
        </tr>
        <tr>
            <th colspan="14">{{$invoices['month']}}</th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th colspan="2" rowspan=3>JENIS PEMERIKSAAN</th>
            <th colspan="3">HISPATOLOGI</th>
            <th colspan="8">SITOLOGI</th>
            <th rowspan="3">JUMLAH TOTAL</th>
        </tr>
        <tr>
            <th rowspan="2"> &nbsp; HE</th>
            <th rowspan="2">IHC</th>
            <th>VRIES</th>
            <th rowspan="2">FNAB</th>
            <th>PAP</th>
            <th>CAIRAN</th>
            <th>CAIRAN</th>
            <th>CAIRAN</th>
            <th rowspan="2">URINE</th>
            <th rowspan="2">BR BRUSHING</th>
            <th rowspan="2">BR WASHING</th>
        </tr>
        <tr>
            <th>COUPE</th>
            <th>SMEAR</th>
            <th>SPUTUM</th>
            <th>ASCITES</th>
            <th>PLEURA</th>
        </tr>
        <tr>
            <th colspan="2">JENIS PASIEN</th>
            <th>1</th>
            <th> </th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
            <th>7</th>
            <th>8</th>
            <th>9</th>
            <th>10</th>
            <th>-</th>
        </tr>
        <tr>
            @php $total_biaya1 = 0 @endphp
            <th rowspan="3">TNI AD</th>
            <th>MIL</th>
            <th>{{count($invoices[3]['histo'])}}</th>
            @php $total_biaya1 += count($invoices[3]['histo']) @endphp
            <th></th>
            <th>{{count($invoices[3]['vriescoupe'])}}</th>
            @php $total_biaya1 += count($invoices[3]['vriescoupe']) @endphp
            <th>{{count($invoices[3]['fnab'])}}</th>
            @php $total_biaya1 += count($invoices[3]['fnab']) @endphp
            <th>{{count($invoices[3]['papsmear'])}}</th>
            @php $total_biaya1 += count($invoices[3]['papsmear']) @endphp
            <th>{{count($invoices[3]['sputum'])}}</th>
            @php $total_biaya1 += count($invoices[3]['sputum']) @endphp
            <th>{{count($invoices[3]['ascites'])}}</th>
            @php $total_biaya1 += count($invoices[3]['ascites']) @endphp
            <th>{{count($invoices[3]['pleura'])}}</th>
            @php $total_biaya1 += count($invoices[3]['pleura']) @endphp
            <th>{{count($invoices[3]['urine'])}}</th>
            @php $total_biaya1 += count($invoices[3]['urine']) @endphp
            <th>{{count($invoices[3]['brushing'])}}</th>
            @php $total_biaya1 += count($invoices[3]['brushing']) @endphp
            <th>{{count($invoices[3]['washing'])}}</th>
            @php $total_biaya1 += count($invoices[3]['washing']) @endphp
            <th>{{$total_biaya1}}</th>
        </tr>
        <tr>
            @php $total_biaya2 = 0 @endphp
            <th>SP</th>
            <th>{{count($invoices[9]['histo'])}}</th>
            @php $total_biaya2 += count($invoices[9]['histo']) @endphp
            <th> </th>
            <th>{{count($invoices[9]['vriescoupe'])}}</th>
            @php $total_biaya2 += count($invoices[9]['vriescoupe']) @endphp
            <th>{{count($invoices[9]['fnab'])}}</th>
            @php $total_biaya2 += count($invoices[9]['fnab']) @endphp
            <th>{{count($invoices[9]['papsmear'])}}</th>
            @php $total_biaya2 += count($invoices[9]['papsmear']) @endphp
            <th>{{count($invoices[9]['sputum'])}}</th>
            @php $total_biaya2 += count($invoices[9]['sputum']) @endphp
            <th>{{count($invoices[9]['ascites'])}}</th>
            @php $total_biaya2 += count($invoices[9]['ascites']) @endphp
            <th>{{count($invoices[9]['pleura'])}}</th>
            @php $total_biaya2 += count($invoices[9]['pleura']) @endphp
            <th>{{count($invoices[9]['urine'])}}</th>
            @php $total_biaya2 += count($invoices[9]['urine']) @endphp
<th>{{count($invoices[9]['brushing'])}}</th>
            @php $total_biaya2 += count($invoices[9]['brushing']) @endphp
            <th>{{count($invoices[9]['washing'])}}</th>
            @php $total_biaya2 += count($invoices[9]['washing']) @endphp
            <th>{{$total_biaya2}}</th>
        </tr>
        <tr>
            @php $total_biaya3 = 0 @endphp
            <th>KEL</th>
            <th>{{count($invoices[12]['histo'])}}</th>
            @php $total_biaya3 += count($invoices[12]['histo']) @endphp
            <th> </th>
            <th>{{count($invoices[12]['vriescoupe'])}}</th>
            @php $total_biaya3 += count($invoices[12]['vriescoupe']) @endphp
            <th>{{count($invoices[12]['fnab'])}}</th>
            @php $total_biaya3 += count($invoices[12]['fnab']) @endphp
            <th>{{count($invoices[12]['papsmear'])}}</th>
            @php $total_biaya3 += count($invoices[12]['papsmear']) @endphp
            <th>{{count($invoices[12]['sputum'])}}</th>
            @php $total_biaya3 += count($invoices[12]['sputum']) @endphp
            <th>{{count($invoices[12]['ascites'])}}</th>
            @php $total_biaya3 += count($invoices[12]['ascites']) @endphp
            <th>{{count($invoices[12]['pleura'])}}</th>
            @php $total_biaya3 += count($invoices[12]['pleura']) @endphp
            <th>{{count($invoices[12]['urine'])}}</th>
            @php $total_biaya3 += count($invoices[12]['urine']) @endphp
            <th>{{count($invoices[12]['brushing'])}}</th>
            @php $total_biaya3 += count($invoices[12]['brushing']) @endphp
            <th>{{count($invoices[12]['washing'])}}</th>
            @php $total_biaya3 += count($invoices[12]['washing']) @endphp
            <th>{{$total_biaya3}}</th>
        </tr>
        <tr>
            @php $total_biaya4 = 0 @endphp
            <th rowspan="3">TNI AL</th>
            <th>MIL</th>
            <th>{{count($invoices[1]['histo'])}}</th>
            @php $total_biaya4 += count($invoices[1]['histo']) @endphp
            <th> </th>
            <th>{{count($invoices[1]['vriescoupe'])}}</th>
            @php $total_biaya4 += count($invoices[1]['vriescoupe']) @endphp
            <th>{{count($invoices[1]['fnab'])}}</th>
            @php $total_biaya4 += count($invoices[1]['fnab']) @endphp
            <th>{{count($invoices[1]['papsmear'])}}</th>
            @php $total_biaya4 += count($invoices[1]['papsmear']) @endphp
            <th>{{count($invoices[1]['sputum'])}}</th>
            @php $total_biaya4 += count($invoices[1]['sputum']) @endphp
            <th>{{count($invoices[1]['ascites'])}}</th>
            @php $total_biaya4 += count($invoices[1]['ascites']) @endphp
            <th>{{count($invoices[1]['pleura'])}}</th>
            @php $total_biaya4 += count($invoices[1]['pleura']) @endphp
            <th>{{count($invoices[1]['urine'])}}</th>
            @php $total_biaya4 += count($invoices[1]['urine']) @endphp
            <th>{{count($invoices[1]['brushing'])}}</th>
            @php $total_biaya4 += count($invoices[1]['brushing']) @endphp
            <th>{{count($invoices[1]['washing'])}}</th>
            @php $total_biaya4 += count($invoices[1]['washing']) @endphp
            <th>{{$total_biaya4}}</th>
        </tr>
        <tr>
            @php $total_biaya5 = 0 @endphp
            <th>SP</th>
            <th>{{count($invoices[7]['histo'])}}</th>
            @php $total_biaya5 += count($invoices[7]['histo']) @endphp
            <th> </th>
            <th>{{count($invoices[7]['vriescoupe'])}}</th>
            @php $total_biaya5 += count($invoices[7]['vriescoupe']) @endphp
            <th>{{count($invoices[7]['fnab'])}}</th>
            @php $total_biaya5 += count($invoices[7]['fnab']) @endphp
            <th>{{count($invoices[7]['papsmear'])}}</th>
            @php $total_biaya5 += count($invoices[7]['papsmear']) @endphp
            <th>{{count($invoices[7]['sputum'])}}</th>
            @php $total_biaya5 += count($invoices[7]['sputum']) @endphp
            <th>{{count($invoices[7]['ascites'])}}</th>
            @php $total_biaya5 += count($invoices[7]['ascites']) @endphp
            <th>{{count($invoices[7]['pleura'])}}</th>
            @php $total_biaya5 += count($invoices[7]['pleura']) @endphp
            <th>{{count($invoices[7]['urine'])}}</th>
            @php $total_biaya5 += count($invoices[7]['urine']) @endphp
            <th>{{count($invoices[7]['brushing'])}}</th>
            @php $total_biaya5 += count($invoices[7]['brushing']) @endphp
            <th>{{count($invoices[7]['washing'])}}</th>
            @php $total_biaya5 += count($invoices[7]['washing']) @endphp
            <th>{{$total_biaya5}}</th>
        </tr>
        <tr>
            @php $total_biaya6 = 0 @endphp
            <th>KEL</th>
            <th>{{count($invoices[10]['histo'])}}</th>
            @php $total_biaya6 += count($invoices[10]['histo']) @endphp
            <th> </th>
            <th>{{count($invoices[10]['vriescoupe'])}}</th>
            @php $total_biaya6 += count($invoices[10]['vriescoupe']) @endphp
            <th>{{count($invoices[10]['fnab'])}}</th>
            @php $total_biaya6 += count($invoices[10]['fnab']) @endphp
            <th>{{count($invoices[10]['papsmear'])}}</th>
            @php $total_biaya6 += count($invoices[10]['papsmear']) @endphp
            <th>{{count($invoices[10]['sputum'])}}</th>
            @php $total_biaya6 += count($invoices[10]['sputum']) @endphp
            <th>{{count($invoices[10]['ascites'])}}</th>
            @php $total_biaya6 += count($invoices[10]['ascites']) @endphp
            <th>{{count($invoices[10]['pleura'])}}</th>
            @php $total_biaya6 += count($invoices[10]['pleura']) @endphp
            <th>{{count($invoices[10]['urine'])}}</th>
            @php $total_biaya6 += count($invoices[10]['urine']) @endphp
            <th>{{count($invoices[10]['brushing'])}}</th>
            @php $total_biaya6 += count($invoices[10]['brushing']) @endphp
            <th>{{count($invoices[10]['washing'])}}</th>
            @php $total_biaya6 += count($invoices[10]['washing']) @endphp
            <th>{{$total_biaya6}}</th>
        </tr>
        <tr>
            @php $total_biaya7 = 0 @endphp
            <th rowspan="3">TNI AU</th>
            <th>MIL</th>
            <th>{{count($invoices[2]['histo'])}}</th>
            @php $total_biaya7 += count($invoices[2]['histo']) @endphp
            <th> </th>
            <th>{{count($invoices[2]['vriescoupe'])}}</th>
            @php $total_biaya7 += count($invoices[2]['vriescoupe']) @endphp
            <th>{{count($invoices[2]['fnab'])}}</th>
            @php $total_biaya7 += count($invoices[2]['fnab']) @endphp
            <th>{{count($invoices[2]['papsmear'])}}</th>
            @php $total_biaya7 += count($invoices[2]['papsmear']) @endphp
            <th>{{count($invoices[2]['sputum'])}}</th>
            @php $total_biaya7 += count($invoices[2]['sputum']) @endphp
            <th>{{count($invoices[2]['ascites'])}}</th>
            @php $total_biaya7 += count($invoices[2]['ascites']) @endphp
            <th>{{count($invoices[2]['pleura'])}}</th>
            @php $total_biaya7 += count($invoices[2]['pleura']) @endphp
            <th>{{count($invoices[2]['urine'])}}</th>
            @php $total_biaya7 += count($invoices[2]['urine']) @endphp
            <th>{{count($invoices[2]['brushing'])}}</th>
            @php $total_biaya7 += count($invoices[2]['brushing']) @endphp
            <th>{{count($invoices[2]['washing'])}}</th>
            @php $total_biaya7 += count($invoices[2]['washing']) @endphp
            <th>{{$total_biaya7}}</th>
        </tr>
        <tr>
            @php $total_biaya8 = 0 @endphp
            <th>SP</th>
            <th>{{count($invoices[8]['histo'])}}</th>
            @php $total_biaya8 += count($invoices[8]['histo']) @endphp
            <th> </th>
            <th>{{count($invoices[8]['vriescoupe'])}}</th>
            @php $total_biaya8 += count($invoices[8]['vriescoupe']) @endphp
            <th>{{count($invoices[8]['fnab'])}}</th>
            @php $total_biaya8 += count($invoices[8]['fnab']) @endphp
            <th>{{count($invoices[8]['papsmear'])}}</th>
            @php $total_biaya8 += count($invoices[8]['papsmear']) @endphp
            <th>{{count($invoices[8]['sputum'])}}</th>
            @php $total_biaya8 += count($invoices[8]['sputum']) @endphp
            <th>{{count($invoices[8]['ascites'])}}</th>
            @php $total_biaya8 += count($invoices[8]['ascites']) @endphp
            <th>{{count($invoices[8]['pleura'])}}</th>
            @php $total_biaya8 += count($invoices[8]['pleura']) @endphp
            <th>{{count($invoices[8]['urine'])}}</th>
            @php $total_biaya8 += count($invoices[8]['urine']) @endphp
            <th>{{count($invoices[8]['brushing'])}}</th>
            @php $total_biaya8 += count($invoices[8]['brushing']) @endphp
            <th>{{count($invoices[8]['washing'])}}</th>
            @php $total_biaya8 += count($invoices[8]['washing']) @endphp
            <th>{{$total_biaya8}}</th>
        </tr>
        <tr>
            @php $total_biaya9 = 0 @endphp
            <th>KEL</th>
            <th>{{count($invoices[11]['histo'])}}</th>
            @php $total_biaya9 += count($invoices[11]['histo']) @endphp
            <th> </th>
            <th>{{count($invoices[11]['vriescoupe'])}}</th>
            @php $total_biaya9 += count($invoices[11]['vriescoupe']) @endphp
            <th>{{count($invoices[11]['fnab'])}}</th>
            @php $total_biaya9 += count($invoices[11]['fnab']) @endphp
            <th>{{count($invoices[11]['papsmear'])}}</th>
            @php $total_biaya9 += count($invoices[11]['papsmear']) @endphp
            <th>{{count($invoices[11]['sputum'])}}</th>
            @php $total_biaya9 += count($invoices[11]['sputum']) @endphp
            <th>{{count($invoices[11]['ascites'])}}</th>
            @php $total_biaya9 += count($invoices[11]['ascites']) @endphp
            <th>{{count($invoices[11]['pleura'])}}</th>
            @php $total_biaya9 += count($invoices[11]['pleura']) @endphp
            <th>{{count($invoices[11]['urine'])}}</th>
            @php $total_biaya9 += count($invoices[11]['urine']) @endphp
            <th>{{count($invoices[11]['brushing'])}}</th>
            @php $total_biaya9 += count($invoices[11]['brushing']) @endphp
            <th>{{count($invoices[11]['washing'])}}</th>
            @php $total_biaya9 += count($invoices[11]['washing']) @endphp
            <th>{{$total_biaya9}}</th>
        </tr>
        <tr>
            @php $total_biaya10 = 0 @endphp
            <th rowspan="3">ASKES</th>
            <th>PUR</th>
            <th>{{count($invoices[4]['histo'])}}</th>
            @php $total_biaya10 += count($invoices[4]['histo']) @endphp
            <th> </th>
            <th>{{count($invoices[4]['vriescoupe'])}}</th>
            @php $total_biaya10 += count($invoices[4]['vriescoupe']) @endphp
            <th>{{count($invoices[4]['fnab'])}}</th>
            @php $total_biaya10 += count($invoices[4]['fnab']) @endphp
            <th>{{count($invoices[4]['papsmear'])}}</th>
            @php $total_biaya10 += count($invoices[4]['papsmear']) @endphp
            <th>{{count($invoices[4]['sputum'])}}</th>
            @php $total_biaya10 += count($invoices[4]['sputum']) @endphp
            <th>{{count($invoices[4]['ascites'])}}</th>
            @php $total_biaya10 += count($invoices[4]['ascites']) @endphp
            <th>{{count($invoices[4]['pleura'])}}</th>
            @php $total_biaya10 += count($invoices[4]['pleura']) @endphp
            <th>{{count($invoices[4]['urine'])}}</th>
            @php $total_biaya10 += count($invoices[4]['urine']) @endphp
            <th>{{count($invoices[4]['brushing'])}}</th>
            @php $total_biaya10 += count($invoices[4]['brushing']) @endphp
            <th>{{count($invoices[4]['washing'])}}</th>
            @php $total_biaya10 += count($invoices[4]['washing']) @endphp
            <th>{{$total_biaya10}}</th>
        </tr>
        <tr>
            @php $total_biaya11 = 0 @endphp
            <th>ANH</th>
            <th>{{count($invoices[13]['histo'])}}</th>
            @php $total_biaya11 += count($invoices[13]['histo']) @endphp
            <th> </th>
            <th>{{count($invoices[13]['vriescoupe'])}}</th>
            @php $total_biaya11 += count($invoices[13]['vriescoupe']) @endphp
            <th>{{count($invoices[13]['fnab'])}}</th>
            @php $total_biaya11 += count($invoices[13]['fnab']) @endphp
            <th>{{count($invoices[13]['papsmear'])}}</th>
            @php $total_biaya11 += count($invoices[13]['papsmear']) @endphp
            <th>{{count($invoices[13]['sputum'])}}</th>
            @php $total_biaya11 += count($invoices[13]['sputum']) @endphp
            <th>{{count($invoices[13]['ascites'])}}</th>
            @php $total_biaya11 += count($invoices[13]['ascites']) @endphp
            <th>{{count($invoices[13]['pleura'])}}</th>
            @php $total_biaya11 += count($invoices[13]['pleura']) @endphp
            <th>{{count($invoices[13]['urine'])}}</th>
            @php $total_biaya11 += count($invoices[13]['urine']) @endphp
            <th>{{count($invoices[13]['brushing'])}}</th>
            @php $total_biaya11 += count($invoices[13]['brushing']) @endphp
            <th>{{count($invoices[13]['washing'])}}</th>
            @php $total_biaya11 += count($invoices[13]['washing']) @endphp
            <th>{{$total_biaya11}}</th>
        </tr>
        <tr>
            @php $total_biaya12 = 0 @endphp
            <th>ASKIN</th>
            <th> </th>
            <th> </th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            @php $total_biaya13 = 0 @endphp
            <th colspan="2">PC</th>
            <th>{{count($invoices[80]['histo'])}}</th>
            @php $total_biaya13 += count($invoices[80]['histo']) @endphp
            <th> </th>
            <th>{{count($invoices[80]['vriescoupe'])}}</th>
            @php $total_biaya13 += count($invoices[80]['vriescoupe']) @endphp
            <th>{{count($invoices[80]['fnab'])}}</th>
            @php $total_biaya13 += count($invoices[80]['fnab']) @endphp
            <th>{{count($invoices[80]['papsmear'])}}</th>
            @php $total_biaya13 += count($invoices[80]['papsmear']) @endphp
            <th>{{count($invoices[80]['sputum'])}}</th>
            @php $total_biaya13 += count($invoices[80]['sputum']) @endphp
            <th>{{count($invoices[80]['ascites'])}}</th>
            @php $total_biaya13 += count($invoices[80]['ascites']) @endphp
            <th>{{count($invoices[80]['pleura'])}}</th>
            @php $total_biaya13 += count($invoices[80]['pleura']) @endphp
            <th>{{count($invoices[80]['urine'])}}</th>
            @php $total_biaya13 += count($invoices[80]['urine']) @endphp
            <th>{{count($invoices[80]['brushing'])}}</th>
            @php $total_biaya13 += count($invoices[80]['brushing']) @endphp
            <th>{{count($invoices[80]['washing'])}}</th>
            @php $total_biaya13 += count($invoices[80]['washing']) @endphp
            <th>{{$total_biaya13}}</th>
        </tr>

        @php $total_histo = count($invoices[3]['histo']) + count($invoices[9]['histo']) + count($invoices[12]['histo']) + count($invoices[1]['histo']) + count($invoices[7]['histo']) + count($invoices[10]['histo']) + count($invoices[2]['histo']) + count($invoices[8]['histo']) + count($invoices[11]['histo']) + count($invoices[4]['histo']) + count($invoices[13]['histo']) + count($invoices[80]['histo']) @endphp

        @php $total_vriescoupe = count($invoices[3]['vriescoupe']) + count($invoices[9]['vriescoupe']) + count($invoices[12]['vriescoupe']) + count($invoices[1]['vriescoupe']) + count($invoices[7]['vriescoupe']) + count($invoices[10]['vriescoupe']) + count($invoices[2]['vriescoupe']) + count($invoices[8]['vriescoupe']) + count($invoices[11]['vriescoupe']) + count($invoices[4]['vriescoupe']) + count($invoices[13]['vriescoupe']) + count($invoices[80]['vriescoupe']) @endphp

        @php $total_fnab = count($invoices[3]['fnab']) + count($invoices[9]['fnab']) + count($invoices[12]['fnab']) + count($invoices[1]['fnab']) + count($invoices[7]['fnab']) + count($invoices[10]['fnab']) + count($invoices[2]['fnab']) + count($invoices[8]['fnab']) + count($invoices[11]['fnab']) + count($invoices[4]['fnab']) + count($invoices[13]['fnab']) + count($invoices[80]['fnab']) @endphp

        @php $total_papsmear = count($invoices[3]['papsmear']) + count($invoices[9]['papsmear']) + count($invoices[12]['papsmear']) + count($invoices[1]['papsmear']) + count($invoices[7]['papsmear']) + count($invoices[10]['papsmear']) + count($invoices[2]['papsmear']) + count($invoices[8]['papsmear']) + count($invoices[11]['papsmear']) + count($invoices[4]['papsmear']) + count($invoices[13]['papsmear']) + count($invoices[80]['papsmear']) @endphp

        @php $total_sputum = count($invoices[3]['sputum']) + count($invoices[9]['sputum']) + count($invoices[12]['sputum']) + count($invoices[1]['sputum']) + count($invoices[7]['sputum']) + count($invoices[10]['sputum']) + count($invoices[2]['sputum']) + count($invoices[8]['sputum']) + count($invoices[11]['sputum']) + count($invoices[4]['sputum']) + count($invoices[13]['sputum']) + count($invoices[80]['sputum']) @endphp

        @php $total_ascites = count($invoices[3]['ascites']) + count($invoices[9]['ascites']) + count($invoices[12]['ascites']) + count($invoices[1]['ascites']) + count($invoices[7]['ascites']) + count($invoices[10]['ascites']) + count($invoices[2]['ascites']) + count($invoices[8]['ascites']) + count($invoices[11]['ascites']) + count($invoices[4]['ascites']) + count($invoices[13]['ascites']) + count($invoices[80]['ascites']) @endphp

        @php $total_pleura = count($invoices[3]['pleura']) + count($invoices[9]['pleura']) + count($invoices[12]['pleura']) + count($invoices[1]['pleura']) + count($invoices[7]['pleura']) + count($invoices[10]['pleura']) + count($invoices[2]['pleura']) + count($invoices[8]['pleura']) + count($invoices[11]['pleura']) + count($invoices[4]['pleura']) + count($invoices[13]['pleura']) + count($invoices[80]['pleura']) @endphp

        @php $total_urine = count($invoices[3]['urine']) + count($invoices[9]['urine']) + count($invoices[12]['urine']) + count($invoices[1]['urine']) + count($invoices[7]['urine']) + count($invoices[10]['urine']) + count($invoices[2]['urine']) + count($invoices[8]['urine']) + count($invoices[11]['urine']) + count($invoices[4]['urine']) + count($invoices[13]['urine']) + count($invoices[80]['urine']) @endphp

        @php $total_brushing = count($invoices[3]['brushing']) + count($invoices[9]['brushing']) + count($invoices[12]['brushing']) + count($invoices[1]['brushing']) + count($invoices[7]['brushing']) + count($invoices[10]['brushing']) + count($invoices[2]['brushing']) + count($invoices[8]['brushing']) + count($invoices[11]['brushing']) + count($invoices[4]['brushing']) + count($invoices[13]['brushing']) + count($invoices[80]['brushing']) @endphp

        @php $total_washing = count($invoices[3]['washing']) + count($invoices[9]['washing']) + count($invoices[12]['washing']) + count($invoices[1]['washing']) + count($invoices[7]['washing']) + count($invoices[10]['washing']) + count($invoices[2]['washing']) + count($invoices[8]['washing']) + count($invoices[11]['washing']) + count($invoices[4]['washing']) + count($invoices[13]['washing']) + count($invoices[80]['washing']) @endphp

        @php $total_biaya_all = $total_histo + $total_vriescoupe + $total_fnab + $total_papsmear + $total_sputum + $total_ascites + $total_pleura + $total_urine + $total_brushing + $total_washing @endphp

        <tr>
            <th colspan="2">JUMLAH</th>
            <th>{{$total_histo}}</th>
            <th> </th>
            <th>{{$total_vriescoupe}}</th>
            <th>{{$total_fnab}}</th>
            <th>{{$total_papsmear}}</th>
            <th>{{$total_sputum}}</th>
            <th>{{$total_ascites}}</th>
            <th>{{$total_pleura}}</th>
            <th>{{$total_urine}}</th>
            <th>{{$total_brushing}}</th>
            <th>{{$total_washing}}</th>
            <th>{{$total_biaya_all}}</th>
        </tr>
        <tr>
            <th colspan="14"></th>
        </tr>
        <tr>
            <th colspan="11"></th>
            <th colspan="3">Surabaya, {{date("d F Y")}}</th>
        </tr>
        <tr>
            <th colspan="11"></th>
            <th colspan="3">Kasubdep Patologi Anatomi</th>
        </tr>
        
        <tr>
            <th colspan="14"></th>
        </tr>
        <tr>
            <th colspan="14"></th>
        </tr>
        
        
    </thead>
</table>
