<div class="bg-image bg-image-bottom mb-20" style="background-image: url('{{asset('assets/img/photos/photo34@2x.jpg')}}');">
	<div class="bg-primary-dark-op">
		<div class="content content-top overflow-hidden pt-30">
			<div class="pt-0 pb-20">
				<h1 class="font-w700 text-white" >
				{{$kasir->nama}}</h1>
			</div>
		</div>
	</div>
</div>

<div class="bg-white mb-20" >
	<div class="sidebar-content" >

		<div class="content-side content-side-full pt-10"  style="overflow: visible;">
			<ul class="nav-main-header">
				<li>
					<a @if($sidebar_active == 'transaksi') class="active" @endif href="{{url('kasir/'.$kasir->id.'/transaksi')}}"><i class="si si-calculator"></i><span class="sidebar-mini-hide">Transaksi</span></a>
				</li>
				<li>
					<a @if($sidebar_active == 'history') class="active" @endif href="{{url('kasir/'.$kasir->id.'/transaksi/history')}}">
						<i class="si si-book-open"></i><span class="sidebar-mini-hide">Histori Transaksi</span>
					</a>
				</li>
				<li>
					<a @if($sidebar_active == 'deposit') class="active" @endif href="{{url('kasir/'.$kasir->id.'/deposit')}}">
						<i class="si si-wallet"></i><span class="sidebar-mini-hide">Deposit</span>
					</a>
				</li>
				<li class="float-right">
					<a @if($sidebar_active == 'switch') class="active" @endif href="{{url('kasir')}}"><i class="si si-arrow-left"></i><span class="sidebar-mini-hide">Ganti Kasir</span></a>
				</li>
			</ul>
		</div>
	</div>
</div>
<!-- END Hero -->