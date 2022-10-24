<div class="col-lg-6 pr-5">
    <div class="block mb-0">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                Hal Yang Harus Dikerjakan
            </h3>
        </div>
        <div class="block-content">
            <form id="add-todo" action="{{url()->current()}}/todo/new" method="POST">
                {{csrf_field()}}
                <div class="input-group input-group-lg">
                    <input class="form-control" type="text" id="new-todo" name="desc" placeholder="Tambahkan To Do">
                    <div class="input-group-append">
                        <button class="btn btn-secondary input-group-text">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
            </form>

            @if(!empty($todos[0]))
            <table class="js-table-checkable table table-hover">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 70px;">
                            <label class="css-control css-control-primary css-checkbox py-0">
                                <span class="css-control-indicator"></span>
                            </label>
                        </th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($todos as $item)
                    <tr onclick="confirmToDo({{$item->id}})" id="todo-{{$item->id}}">
                        <td class="text-center">
                            <label class="css-control css-control-primary css-checkbox">
                                <input type="checkbox" class="css-control-input" id="row_1" name="row_1">
                                <span class="css-control-indicator"></span>
                            </label>
                        </td>
                        <td>
                            <p class="font-w600 mb-0">{{$item->creator->name}}</p>
                            <p class="text-muted mb-0">{{$item->desc}}</p>
                            <em class="text-muted">{{$item->tanggal}}</em>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="text-center py-100">
                <h4 class="font-w400 mb-5">Tidak ada Hal Yang Harus Dikerjakan</h4>
            </div>
            @endif
        </div>
    </div>
</div>