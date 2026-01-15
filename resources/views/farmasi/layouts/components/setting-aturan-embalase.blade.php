
<div class="row">
    <div class="col-md-8">
        <h5>Embalase</h5>
        <table style="width: 100%" cellpadding="5px" id="farmasi-pengaturan-embalase">
            <tbody>
                <tr>
                    <td><label>Jenis Pembayaran</label></td>
                    <td><label for="">Kategori</label></td>
                    <td><label for="">Jenis Embalase</label></td>
                    <td width="150px"><label>Harga</label></td>
                    <td width="1"></td>
                </tr>
                @forelse (session('farmasi')->aturan_embalase as $index => $item)
                    @include('farmasi.layouts.components.setting-aturan-embalase-row', ['index' => $index, 'item' => $item])
                @empty
                    @php
                        $index = 0;
                    @endphp
                    @include('farmasi.layouts.components.setting-aturan-embalase-row', ['index' => $index, 'item' => null])
                @endforelse
            </tbody>
        </table>
        <div class="mt-3 mb-3 pb-2" id="loader">
            <center>
                <button type="button" class="btn btn-lg btn-circle btn-outline-primary btn-add-embalase" data-index="{{ $index + 1 }}">
                    <i class="fa fa-plus"></i>
                </button>
                <center class="d-none" id="spinner"><i class="fa fa-2x fa-asterisk fa-spin text-info"></i></center>
            </center>
        </div>
    </div>
</div>
