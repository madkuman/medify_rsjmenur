<div class="row" id="bpjs_from_wrapper">
    <div class="col-8">
        <div class="block content pb-20">
            <h4 class="mb-10">SEP BPJS</h4>
            <table class="table-borderless" style="width: 100%">
                <tr>
                    <th width="140px">Nama Pasien</th>
                    <td>:</td>
                    <td>{{$kasus->pasien->name}}</td>
                </tr>
                <tr>
                    <th>No RM Pasien</th>
                    <td>:</td>
                    <td>{{$kasus->pasien->no_rm}}</td>
                </tr>
                <tr>
                    <th>Jenis Layanan</th>
                    <td>:</td>
                    @php $jenis_layanan = $kasus->active_sep->jenis_pelayanan ?? '' @endphp
                    <td> @if($jenis_layanan == 1) Rawat Inap @else Rawat Jalan @endif</td>
                </tr>
                <tr>
                    <th>Nomor SEP</th>
                    <td>:</td>
                    @php $nomor_sep_aktif = $kasus->active_sep->no_sep ?? '' @endphp
                    <td>{{$nomor_sep_aktif ?? ''}}</td>
                </tr>
            </table>

            <div class="py-20 row">
                <div class="form-group col-12 mb-0">
                    <label>Pilih SEP</label>
                </div>
                <div class="form-group mb-0 col-12" id="sep_select_wrapper">
                    <div class="input-group ">
                        <select name="sep" class="form-control js-select2" id="sep_select" data-placeholder="Nomor SEP Pasien" style="width: 80%">
                            <option value=""></option>
                            @foreach($sep as $item)
                            @if(isset($item->no_sep))
                            <option value="{{json_encode($item)}}" @if(isset($nomor_sep_aktif) && $nomor_sep_aktif == $item->no_sep) selected="" @endif>
                                {{$item->no_sep}} - @if($item->jenis_pelayanan == 1) Rawat Inap @else Rawat Jalan @endif - {{!is_null($item->tgl_sep) ? indonesian_date(strtotime($item->tgl_sep)) : indonesian_date($item->created_at)}}
                            </option>
                            @endif
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-alt-primary" id="sep_select_refresh">
                                <i class="fa fa-refresh"></i>
                            </button>
                            <button type="button" class="btn btn-alt-primary" style="display: none;" id="sep_select_loading" disabled="">
                                <i class="fa fa-asterisk fa-spin"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12" id="sep_manual_wrapper">
                <div class="form-group input-group">
                    <label class="css-control css-control-primary css-checkbox">
                        <input type="checkbox" class="css-control-input" id="custom_sep_check">
                        <span class="css-control-indicator"></span> Nomor SEP yang saya cari tidak terdaftar
                    </label>
                </div>
                <div class="form-group"  id="sep_custom_wrapper" style="display: none;">
                    <label>Nomor SEP</label>
                    <input type="text" name="custom_sep" id="custom_sep" class="form-control" placeholder="Nomor SEP Pasien" value="{{$nomor_sep_aktif}}">
                </div>
            </div>
            <div class="col-12" id="sep_create_wrapper">
                @if(!config('medify.third-party.vclaim.on_v2'))
                    <button type="button" class="btn btn-info" id="sep_button_auto">
                        <i class="fa fa-plus"></i> Buat SEP Otomatis
                    </button>
                @endif
                <button type="button" class="btn btn-outline-info" id="sep_button">
                    <i class="fa fa-plus"></i> Buat SEP Manual
                </button>   
            </div>
        </div>  
    </div>
</div>