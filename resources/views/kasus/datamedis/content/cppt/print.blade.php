<head>
    <title>Print Detail CPPT</title>
    <style type="text/css">
    body{
        font-family: sans-serif;
        white-space: pre-line;
        font-size: 11px;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }

    .centered{
        text-align: center;
    }

    .bot{
        border-bottom: 1px solid black;
    }

    .righted{
        text-align: right;
    }

    .bordered{
        border: 1px solid black;
        padding:10px 5px;
    }

    .big{
        font-weight: bold;
        font-size: 16px;
    }
</style>
</head>
<body>
    <table width="100%">
        <tr>
            <td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
        </tr>
    </table>
    <br><br>
    
    <table>
        <tr>
            <td class="centered big">DETAIL CPPT</td>
        </tr>
    </table>
    <br>

    <table>
        <tr>
            <td width="20%">No RM</td>
            <td width="80%">: {{{$kasus->pasien->no_rm}}}</td>
        </tr>
        <tr>
            <td>Nama Pasien</td>
            <td>: {{{$kasus->pasien->name}}}</td>
        </tr>
        <tr>
            <td>Tgl Lahir / Umur</td>
            <td>: {{date("j F Y", strtotime($kasus->pasien->date_of_birth))}} / {{{$kasus->pasien->age}}}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: @if($kasus->pasien->gender == 1) Laki-Laki @else Perempuan @endif</td>
        </tr>
    </table>
    <hr><br><br>

    <div class="block-content soap-item">
        @if($cppt->jenis == 'adime')
        <p>
            <small style="text-decoration: underline;">ASSESSMENT</small><br>
            {{{ $cppt->assessment }}}
        </p>
        <br>
        <p>
            <small style="text-decoration: underline;">DIAGNOSIS</small><br>
            {{{ $cppt->subjective }}}
        </p>
        <br>
        <p>
            <small style="text-decoration: underline;">INTERVENTION</small><br>
            {{{ $cppt->objective }}}
        </p>
        <br>
        <p>
            <small style="text-decoration: underline;">MONITORING/EVALUTION</small><br>
            {{{ $cppt->plan }}}
        </p>
        <br>
        <p>
            <small style="text-decoration: underline;">EVALUTION</small><br>
            {{{ $cppt->ppa }}}
        </p>
        @else
        <p>
            <small style="text-decoration: underline;">SUBJECTIVE</small><br>
            {{{ $cppt->subjective }}}
        </p>
        <br>
        <p>
            <small style="text-decoration: underline;">OBJECTIVE</small><br>
            {{{ $cppt->objective }}}
        </p>
        <br>
        <p>
            <small style="text-decoration: underline;">ASSESSMENT</small><br>
            {{{ $cppt->assessment }}}
        </p>
        <br>
        <p>
            <small style="text-decoration: underline;">PLAN</small><br>
            {{{ $cppt->plan }}}
        </p>
        <br>
        <p>
            <small style="text-decoration: underline;">INSTRUKSI DOKTER / IMPLEMENTASI PPA</small><br>
            {{ $cppt->ppa }}
        </p>
        @endif
        <hr>
        <p>
            <small>DIBUAT OLEH</small><br>
            {{{ $cppt->creator->name }}}<br>
            {{{ $cppt->tanggal }}}
        </p>
    </div>
</body>