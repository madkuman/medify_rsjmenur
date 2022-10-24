<!DOCTYPE html>
<html>
<head>
    <style>
    table ,  th,  td {
        border: 1px solid black;
        border-collapse: collapse;
    }
     td,  th{
        padding: 3px;
    }

    table.table-borderless , .table-borderless th, .table-borderless td
    {
        border:none;
    }

    h4{
        text-align: center
    }
    .nama-pasien{
        width: 150px !important;
        table-layout: fixed;
        white-space: nowrap !important;
        overflow: hidden;
    }
</style>
</head>
<body>
    <h4>DAFTAR PERMINTAAN FILE RM</h4>

    <table class="table-borderless">
        <tr>
            <td>Dicetak Oleh</td>
            <td>:</td>
            <td>{{Auth::user()->name}}</td>
        </tr>
        <tr>
            <td>Waktu Cetak</td>
            <td>:</td>
            <td>{{\Carbon\Carbon::now()->format('d F Y H:i')}}</td>
        </tr>
    </table>
    <br>
    <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>No RM</th>
                <th class="">Nama Pasien</th>
                <th class="" style="width: 200px;">Tujuan Pengiriman</th>
                <th class="" style="width: 150px">Waktu Permintaan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permintaan as $item)
            @if(!empty($item->pasien->name))
            @if(substr($item->pasien->no_rm, -2) <= $rm_index_max && substr($item->pasien->no_rm, -2) >= $rm_index_min)
            <tr>
                <td class="text-center">{{$loop->iteration}}</td>
                <td class="font-w600">#{{$item->pasien->no_rm}}</td>
                <td class="nama-pasien">{{$item->pasien->name}}</td>
                <td class="">{{$item->holder_user->name ?? ''}}  {{$item->holder_group->name ?? ''}}</td>
                <td>{{$item->created_at->format('d F, H:i')}}</td>
            </tr>
            @endif
            @endif
            @endforeach
        </tbody>
    </table>
</body>
<script type="text/javascript">
    window.print()
</script>
</html>