	<table>
		<tr>
			<td class="centered title"><b>REKAPITULASI PENDIDIKAN PERSONEL MILITER</b></td>
		</tr>
		<tr>
			<td class="centered title"><b>{{$date}}</b></td>
		</tr>
	</table>
	<br>
	<table width="100%">
	<tr>
		<th width="19%" class="centered no-bottom-only orange-col"><b></b></th>
		<th width="81%" class="centered no-bottom-only orange-col"><b>KUALIFIKASI</b></th>
	</tr>
	</table>
	<?php $start = 0; $offset = floor(count($kualifikasi) /2) +1; ?>
	<table>
		<tr>
			<th width="" rowspan="2" class="centered bordered orange-col"><b>KODE</b></th>
			<th width="%" rowspan="2" class="centered bordered orange-col"><b>PANGKAT</b></th>
			<?php for($i=$start; $i<$offset;$i++){ ?>
				<th width="" class="centered bordered orange-col"><b>{{$i+1}}</b></th>
			<?php } ?>
		</tr>
		<tr>
			<?php for($i=$start; $i<$offset;$i++){ ?>
				<th width="" class="centered bordered orange-col"><b>{{$kualifikasi[$i]->nama}}</b></th>
			<?php } ?>
		</tr>
		<?php $total = array_fill($start, $offset, 0); ?>
		@foreach($data['MILITER'] as $key => $val)
			<tr>
				<td class="centered bordered grey-col">{{$val['kode']}}</td>
				<td class="centered bordered blue-col"><b>{{$key}}</b></td>
				<?php for($i=$start; $i<$offset;$i++){ ?>
					<th class="centered bordered"><b>{{isset($val['value'][$kualifikasi[$i]->nama]) ? $val['value'][$kualifikasi[$i]->nama] : ''}}</b></th>
					<?php  if(isset($val['value'][$kualifikasi[$i]->nama]))	$total[$i] += $val['value'][$kualifikasi[$i]->nama]; ?>	
				<?php } ?>
			</tr>
		@endforeach
		<tr>
			<td class="centered bordered yellow-col" colspan="2"><b>JUMLAH TOTAL</b></td>
			<?php for($i=$start; $i<$offset;$i++){ ?>
				<th class="centered bordered yellow-col"><b>{{$total[$i]}}</b></th>
			<?php } ?>
		</tr>
	</table>
	<!-- END TABLE PART 1 -->

	<!-- TABLE PART 2 -->
	<table width="100%">
	<tr>
		<th width="19%" class="centered no-bottom-only orange-col"><b></b></th>
		<th width="81%" class="centered no-bottom-only orange-col"><b>KUALIFIKASI</b></th>
	</tr>
	</table>
	<?php $start = $offset+1; $offset = count($kualifikasi); ?>
	<table>
		<tr>
			<th width="" rowspan="2" class="centered bordered orange-col"><b>KODE</b></th>
			<th width="%" rowspan="2" class="centered bordered orange-col"><b>PANGKAT</b></th>
			<?php for($i=$start; $i<$offset;$i++){ ?>
				<th width="" class="centered bordered orange-col"><b>{{$i}}</b></th>
			<?php } ?>
		</tr>
		<tr>
			<?php for($i=$start; $i<$offset;$i++){ ?>
				<th width="" class="centered bordered orange-col"><b>{{$kualifikasi[$i]->nama}}</b></th>
			<?php } ?>
		</tr>
		<?php $total = array_fill($start, $offset, 0); ?>
		@foreach($data['MILITER'] as $key => $val)
			<tr>
				<td class="centered bordered grey-col">{{$val['kode']}}</td>
				<td class="centered bordered blue-col"><b>{{$key}}</b></td>
				<?php for($i=$start; $i<$offset;$i++){ ?>
					<th class="centered bordered"><b>{{isset($val['value'][$kualifikasi[$i]->nama]) ? $val['value'][$kualifikasi[$i]->nama] : ''}}</b></th>
					<?php  if(isset($val['value'][$kualifikasi[$i]->nama]))	$total[$i] += $val['value'][$kualifikasi[$i]->nama]; ?>	
				<?php } ?>
			</tr>
		@endforeach
		<tr>
			<td class="centered bordered yellow-col" colspan="2"><b>JUMLAH TOTAL</b></td>
			<?php for($i=$start; $i<$offset;$i++){ ?>
				<th class="centered bordered yellow-col"><b>{{$total[$i]}}</b></th>
			<?php } ?>
		</tr>
	</table>
	<!-- END TABLE PART 2 -->