<table class="table table-bordered table-striped table-vcenter no-footer table2" style="width: 100%">
	<thead>
        <tr>
        	<th class=" d-sm-table-cell text-center th3" style="width: 5%; vertical-align: middle;" rowspan="1">#</th>
            <th class=" d-sm-table-cell text-center th3" style="width: 15%;vertical-align: middle;" rowspan="1">Jenis</th>
            @foreach($kelas as $k)
                <th class=" d-sm-table-cell text-center th3" style="width: 10%;vertical-align: middle;" rowspan="1">{{$k}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
    	<?php $i = 1; ?>
    	@foreach($detail as $key => $d)
            <tr>
            	<td class=" d-sm-table-cell text-center ">{{$i}}</td>
            	<td class=" d-sm-table-cell text-center ">{{$key}}</td>
            	@foreach($kelas as $k)
                    <td class=" d-sm-table-cell text-center ">Rp {{isset($d[$k]) ? number_format($d[$k], 0) : '0'}}</td>
                @endforeach
            </tr>
            <?php $i++; ?>
        @endforeach
    </tbody>
</table>