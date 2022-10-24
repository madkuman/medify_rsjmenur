<div class="main-nav-header">
	<div class="content">
		<div class="submain-nav-header">
			<ul class="nav gizi-main-nav nav-pills push  nav-fill">
				<li class="nav-item">
					<a class="nav-link 
					@if($status == 'home') 
					active
					@endif
					" href="{{url('gizi')}}"><i class="fas fa-home"></i><p>Dashboard</p></a>
				</li>
				<li class="nav-item">
					<a class="nav-link 
					@if($status == 'pemesanan') 
					active
					@endif
					" href="{{url('gizi/pemesanan')}}"><i class="fas fa-clipboard-list"></i><p>Pemesanan</p></a>
				</li>
				<li class="nav-item d-none">
					<a class="nav-link 
					@if($status == 'monitoring') 
					active
					@endif
					" href="{{url('gizi/monitoring')}}"><i class="fas fa-clipboard-list"></i><p>Monitoring</p></a>
				</li>
				<li class="nav-item d-none">
					<a class="nav-link
					@if($status == 'belanja') 
					active
					@endif
					" href="{{url('gizi/belanja')}}"><i class="fas fa-shopping-bag"></i><p>Belanja</p></a>
				</li>
				<li class="nav-item d-none">
					<a class="nav-link 
					@if($status == 'produksi') 
					active
					@endif
					" href="{{url('gizi/produksi')}}"><i class="fas fa-mortar-pestle"></i><p>Produksi</p></a>
				</li>
				<li class="nav-item">
					<a class="nav-link
					@if($status == 'pengantaran') 
					active
					@endif
					" href="{{url('gizi/pengantaran')}}"><i class="fas fa-dolly"></i><p>Pengantaran</p></a>
				</li>
				<li class="nav-item d-none">
					<a class="nav-link
					@if($status == 'stok') 
					active
					@endif
					" href="{{url('gizi/stok-bahan')}}"><i class="fas fa-cubes"></i><p>Stok Bahan</p></a>
				</li>
				<li class="nav-item">
					<a class="nav-link
					@if($status == 'pengaturan') 
					active
					@endif
					" href="{{url('gizi/pengaturan')}}"><i class="fas fa-cog"></i><p>Pengaturan</p></a>
				</li>
				<li class="nav-item">
					<a class="nav-link
					@if($status == 'laporan') 
					active
					@endif
					" href="{{url('gizi/laporan')}}"><i class="fas fa-chart-line"></i><p>Laporan</p></a>
				</li>
			</ul>
		</div>
	</div>
</div>