<table>
	<tr>
		<td class="centered title"><b>REKAPITULASI KORPS PERSONEL MILITER</b></td>
	</tr>
	<tr>
		<td class="centered title"><b>{{$date}}</b></td>
	</tr>
</table>
<br>
<table width="100%">
	<tr>
		<th width="30%" class="centered no-bottom-only orange-col"><b>KETERANGAN</b></th>
		<th width="70%" class="centered no-bottom-only orange-col"><b>KORPS</b></th>
	</tr>
</table>

<!-- START FIRST TABLE -->
<?php $start = 0; $offset = floor(count($korps) / 2) + 1; ?>
<table>
	<tr>
		<th width="5%" class="centered bordered orange-col"><b>KODE</b></th>
		<th width="20%" class="centered bordered orange-col"><b>PANGKAT</b></th>
		<?php for($i=$start; $i<$offset;$i++){ ?>
			<th width="" class="centered bordered orange-col"><b>{{$korps[$i]}}</b></th>
		<?php } ?>
		<!-- <th class="centered bordered orange-col"><b>JUMLAH TOTAL</b></th> -->
	</tr>
	<?php $total = array_fill(0, $offset+1, 0);?>
	@foreach($data['korps'] as $key => $val)
		<tr>
			<td class="centered bordered grey-col">{{$val['kode']}}</td>
			<td class="centered bordered">{{$key}}</td>
		<?php for($i=$start; $i<$offset;$i++){ ?>
				<th class="centered bordered"><b>{{isset($val['value'][$korps[$i]]) ? $val['value'][$korps[$i]] : ''}}</b></th>
				<?php  if(isset($val['value'][$korps[$i]]))	$total[$i] += $val['value'][$korps[$i]]; ?>	
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

<!-- START SECOND TABLE -->

<?php $start = $offset; $offset = count($korps); ?>
<table>
	<tr>
		<th width="5%" class="centered bordered orange-col"><b>KODE</b></th>
		<th width="20%" class="centered bordered orange-col"><b>PANGKAT</b></th>
		<?php $i = $start; ?>
		<?php for($i=$start; $i<$offset;$i++){ ?>
			<th width="" class="centered bordered orange-col"><b>{{$korps[$i]}}</b></th>
		<?php } ?>
		<th class="centered bordered orange-col"><b>JUMLAH TOTAL</b></th>
	</tr>
	<?php $total = array_fill($start, $offset, 0);$allTotal = 0;?>
	@foreach($data['korps'] as $key => $val)
		<tr>
			<td class="centered bordered grey-col">{{$val['kode']}}</td>
			<td class="centered bordered">{{$key}}</td>
			<?php $i = $start; ?>
		<?php for($i=$start; $i<$offset;$i++){ ?>
				<th class="centered bordered"><b>{{isset($val['value'][$korps[$i]]) ? $val['value'][$korps[$i]] : ''}}</b></th>
				<?php  if(isset($val['value'][$korps[$i]]))	$total[$i] += $val['value'][$korps[$i]]; ?>	
			<?php } ?>
			<td class="centered bordered mint-col"><b>{{isset($val['total']) ? $val['total'] : ''}}</b></td>
		</tr>
		<?php $allTotal += $val['total']; ?>
	@endforeach
	<tr>
		<td class="centered bordered yellow-col" colspan="2"><b>JUMLAH TOTAL</b></td>
		<?php $i = $start; ?>
		<?php for($i=$start; $i<$offset;$i++){ ?>
			<th class="centered bordered yellow-col"><b>{{$total[$i]}}</b></th>
		<?php } ?>
		<td class="centered bordered orange-col"><b>JUMLAH TOTAL</b></td>
	</tr>
</table>