<!doctype html>
<html lang="en" class="no-focus" ng-app="medifyApp">
<head>
    @include('layouts.components2.header')
</head>
<body>
    <div style="position: fixed; top:100px; left: 48%; z-index: 2000; display: none" id="loading-top">
        <i class="fa fa-4x fa-asterisk fa-spin text-info"></i>
    </div>
    
    <div id="page-container" class="page-header-fixed main-content-boxed">  
        <div id="page-overlay" onclick="closeNav()"></div>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="text-align: center; font-weight: bold;">Daftar Stok Barang {{$item->item_detail ? $item->item_detail->nama : $item->nama}}</h3>
                <br>
            </div>
            <h4 class="block-title" style="text-align: center;">@forelse($item->item_detail ? $item->item_detail->kategori_item : [] as $gori)
                {{$gori->detail_kategori->nama}}
                @empty -
                @endforelse
            </h4>
            <div class="block-content">
                <table class="table table-bordered table-hover table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">ID</th>
                            <th style="width: 60%">Unit</th>
                            <th class="text-center" style="width: 10%;">Jumlah Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @foreach($stok as $row)
                        <tr>
                            <th class="text-center">{{$i++}}</th>
                            <td>{{$row['farmasi']}}</td>
                            <td class="text-center">{{$row['stok']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @yield('additionaljs')
</body>
</html>
