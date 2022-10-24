<table>
	<tr>
		<td class="centered title"><b>REKAPITULASI PENDIDIKAN PERSONEL PNS DAN PHL</b></td>
	</tr>
	<tr>
		<td class="centered title"><b>{{$date}}</b></td>
	</tr>
</table>
<br>
<table width="100%">
	<tr>
		<th width="28%" class="centered no-bottom-only orange-col"><b>Status Pegawai</b></th>
		<th width="72%" class="centered no-bottom-only orange-col"><b>KUALIFIKASI</b></th>
	</tr>
</table>

<!-- START FIRST TABLE -->
<?php $start = 0; $offset = floor((count($kualifikasi) / 2)) +1; ?>
<table>
	<tr>
		<th width="6%" rowspan="2" class="centered bordered orange-col"><b>Peg</b></th>
		<th width="6%" rowspan="2" class="centered bordered orange-col"><b>Kode</b></th>
		<th width="16%" rowspan="2" class="centered bordered orange-col"><b>Pangkat</b></th>
		<?php for($i=$start; $i<$offset;$i++){ ?>
			<th width="" class="centered bordered orange-col"><b>{{$i+1}}</b></th>
		<?php } ?>
	</tr>
	<tr>
		<?php for($i=$start; $i<$offset;$i++){ ?>
			<th width="" class="centered bordered orange-col"><b>{{$kualifikasi[$i]->nama}}</b></th>
		<?php } ?>
	</tr>

	<!-- START PNS TABLE -->
	<?php $subTotal['PNS'] = array_fill(0, $offset+1, 0); $subTotal['PHL'] = array_fill(0, $offset+1, 0); $firstY = true;?>
	@foreach($data['PNS'] as $key => $val)
		<tr>
			<?php if($firstY){ $firstY = false; ?><td rowspan="{{count($data['PNS'])+1}}" class="centered bordered green-col">PNS</td> <?php } ?>
			<td class="centered bordered">{{$val['kode']}}</td>
			<td class="centered bordered blue-col"><b>{{$key}}</b></td>
			<?php for($i=$start; $i<$offset;$i++){ ?>
				<th class="centered bordered"><b>{{isset($val['value'][$kualifikasi[$i]->nama]) ? $val['value'][$kualifikasi[$i]->nama] : ''}}</b></th>
				<?php if(isset($val['value'][$kualifikasi[$i]->nama]))	$subTotal['PNS'][$i] += $val['value'][$kualifikasi[$i]->nama]; ?>	
			<?php } ?>
		</tr>
	@endforeach
	<tr>
		<td colspan="2" class="centered bordered mint-col"><b>Total</b></td>
		<?php for($i=$start; $i<$offset;$i++){ ?>
			<th class="centered bordered mint-col"><b>{{$subTotal['PNS'][$i]}}</b></th>
		<?php } ?>
	</tr>
	<!-- START PHL TABLE -->
	<?php $firstY = true; ?>
	@foreach($data['PHL'] as $key => $val)
		<tr>
			<?php if($firstY){ $firstY = false; ?><td rowspan="{{count($data['PHL'])+1}}" class="centered bordered green-col">PHL</td> <?php } ?>
			<td class="centered bordered">{{$val['kode']}}</td>
			<td class="centered bordered blue-col"><b>{{$key}}</b></td>
			<?php for($i=$start; $i<$offset;$i++){ ?>
				<th class="centered bordered"><b>{{isset($val['value'][$kualifikasi[$i]->nama]) ? $val['value'][$kualifikasi[$i]->nama] : ''}}</b></th>
				<?php if(isset($val['value'][$kualifikasi[$i]->nama]))	$subTotal['PHL'][$i] += $val['value'][$kualifikasi[$i]->nama]; ?>	
			<?php } ?>
		</tr>
	@endforeach
	<tr>
		<td colspan="2" class="centered bordered mint-col"><b>Total</b></td>
		<?php for($i=$start; $i<$offset;$i++){ ?>
			<th class="centered bordered mint-col"><b>{{$subTotal['PHL'][$i]}}</b></th>
		<?php } ?>
	</tr>
	<tr>
		<td class="centered bordered yellow-col" colspan="3"><b>JUMLAH TOTAL</b></td>
		<?php for($i=$start; $i<$offset;$i++){ ?>
			<th class="centered bordered yellow-col"><b>{{$subTotal['PNS'][$i] + $subTotal['PHL'][$i]}}</b></th>
		<?php } ?>	
	</tr>
</table>

<!-- START SECOND TABLE -->
<?php $start = $offset+1; $offset = count($kualifikasi); ?>
<table>
	<tr>
		<th width="6%" rowspan="2" class="centered bordered orange-col"><b>Peg</b></th>
		<th width="6%" rowspan="2" class="centered bordered orange-col"><b>Kode</b></th>
		<th width="16%" rowspan="2" class="centered bordered orange-col"><b>Pangkat</b></th>
		<?php $i = $start; ?>
		<?php for($i=$start; $i<$offset;$i++){ ?>
			<th width="" class="centered bordered orange-col"><b>{{$i}}</b></th>
		<?php } ?>	
	</tr>
	<tr>
		<?php $i = $start; ?>
		<?php for($i=$start; $i<$offset;$i++){ ?>
			<th width="" class="centered bordered orange-col"><b>{{$kualifikasi[$i]->nama}}</b></th>
		<?php } ?>
	</tr>

	<!-- START PNS TABLE -->
	<?php $subTotal['PNS'] = array_fill(1, $offset, 0); $subTotal['PHL'] = array_fill(1, $offset, 0); $firstY = true;?>
	@foreach($data['PNS'] as $key => $val)
		<tr>
			<?php if($firstY){ $firstY = false; ?><td rowspan="{{count($data['PNS'])+1}}" class="centered bordered green-col">PNS</td> <?php } ?>
			<td class="centered bordered">{{$val['kode']}}</td>
			<td class="centered bordered blue-col"><b>{{$key}}</b></td>
			<?php $i = $start; ?>
			<?php for($i=$start; $i<$offset;$i++){ ?>
				<th class="centered bordered"><b>{{isset($val['value'][$kualifikasi[$i]->nama]) ? $val['value'][$kualifikasi[$i]->nama] : ''}}</b></th>
				<?php if(isset($val['value'][$kualifikasi[$i]->nama]))	$subTotal['PNS'][$i] += $val['value'][$kualifikasi[$i]->nama]; ?>	
			<?php } ?>
		</tr>
	@endforeach
	<tr>
		<td colspan="2" class="centered bordered mint-col"><b>Total</b></td>
		<?php $i = $start; ?>
		<?php for($i=$start; $i<$offset;$i++){ ?>
			<th class="centered bordered mint-col"><b>{{$subTotal['PNS'][$i]}}</b></th>
<?php } ?>
	</tr>
	<!-- START PHL TABLE -->
	<?php $firstY = true; ?>
	@foreach($data['PHL'] as $key => $val)
		<tr>
			<?php if($firstY){ $firstY = false; ?><td rowspan="{{count($data['PHL'])+1}}" class="centered bordered green-col">PHL</td> <?php } ?>
			<td class="centered bordered">{{$val['kode']}}</td>
			<td class="centered bordered blue-col"><b>{{$key}}</b></td>
			<?php $i = $start; ?>
		<?php for($i=$start; $i<$offset;$i++){ ?>
				<th class="centered bordered"><b>{{isset($val['value'][$kualifikasi[$i]->nama]) ? $val['value'][$kualifikasi[$i]->nama] : ''}}</b></th>
				<?php if(isset($val['value'][$kualifikasi[$i]->nama]))	$subTotal['PHL'][$i] += $val['value'][$kualifikasi[$i]->nama]; ?>	
			<?php } ?>
		</tr>
	@endforeach
	<tr>
		<td colspan="2" class="centered bordered mint-col"><b>Total</b></td>
		<?php $i = $start; ?>
		<?php for($i=$start; $i<$offset;$i++){ ?>
			<th class="centered bordered mint-col"><b>{{$subTotal['PHL'][$i]}}</b></th>
<?php } ?>
	</tr>
	<tr>
		<td class="centered bordered yellow-col" colspan="3"><b>JUMLAH TOTAL</b></td>
		<?php $i = $start; ?>
		<?php for($i=$start; $i<$offset;$i++){ ?>
			<th class="centered bordered yellow-col"><b>{{$subTotal['PNS'][$i] + $subTotal['PHL'][$i]}}</b></th>
<?php } ?>	
	</tr>
</table>