<div class="items-info">
  Menampilkan <code>{{ (($items->currentPage()-1)*$items->perPage())+1 }}</code>-<code>{{ (($items->currentPage())*$items->perPage()) > $items->total() ? $items->total() : (($items->currentPage())*$items->perPage()) }}</code> dari total <code>{{$items->total()}}</code> data
</div>