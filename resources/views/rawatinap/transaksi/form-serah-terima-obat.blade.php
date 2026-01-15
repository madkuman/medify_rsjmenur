@extends('rawatinap.layouts.form')

@section('title')
    Rawat Inap - Serah Terima Obat
@endsection

@section('content')
    <div class="content">
        <div class="block p-10">
            <div class="block-header">
                <h3 class="block-title">
                    Serah Terima Obat
                </h3>
            </div>
            <div class="block-content">
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" id="form-buat">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="header col-12">
                                    <div class="col-lg-12 col-12">
                                        <h6 class="text-uppercase">Buat pesanan baru</h6>
                                    </div>
                                </div>
                                <div class="body col-12">
                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Tanggal Serah</label>
                                            <input type="text" class="form-control js-datepicker" name="tanggal_serah" data-date-format="dd/mm/yyyy"
                                                value="{{ date('d/m/Y') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Transaksi Farmasi</label>
                                            <select name="transaksi_farmasi_id[]" class="form-control js-select2-multiple" multiple>
                                                @foreach ($list_transaksi_farmasi as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nomor_antrian }} - #{{ $item->slug }} -
                                                        {{ $item->owner_detail->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
										<div class="pt-3">
											<table width="100%" style=" text-align: center">
												<thead>
													<tr>
														<th colspan="5" class="text-center">Aturan Pakai</th>
													</tr>
													<tr>
														<th style="">1 <br>(07.00)</th>
														<th style="">2 <br>(13.00)</th>
														<th style="">3 <br>(19.00)</th>
														<th style="">4 <br>(24.00)</th>
														<th style="">5 <br>(22.00)</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td style="">
															<label class="css-control css-control-lg css-control-primary css-checkbox">
																<input type="checkbox" class="css-control-input" name="aturan_pakai[1]" value="1"> <span class="css-control-indicator"></span>
															</label>
														</td>
														<td style="">
															<label class="css-control css-control-lg css-control-primary css-checkbox">
																<input type="checkbox" class="css-control-input" name="aturan_pakai[2]" value="2"> <span class="css-control-indicator"></span>
															</label>
														</td>
														<td style="">
															<label class="css-control css-control-lg css-control-primary css-checkbox">
																<input type="checkbox" class="css-control-input" name="aturan_pakai[3]" value="3"> <span class="css-control-indicator"></span>
															</label>
														</td>
														<td style="">
															<label class="css-control css-control-lg css-control-primary css-checkbox">
																<input type="checkbox" class="css-control-input" name="aturan_pakai[4]" value="4"> <span class="css-control-indicator"></span>
															</label>
														</td>
														<td style="">
															<label class="css-control css-control-lg css-control-primary css-checkbox">
																<input type="checkbox" class="css-control-input" name="aturan_pakai[5]" value="5"> <span class="css-control-indicator"></span>
															</label>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
                                        <div class="pt-3">
                                            <table class="table table-bordered table-vcenter">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Telaah Obat</th>
                                                        <th class="text-center">Penerimaan Perawat</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $list_telaah = [
                                                            'nama_pasien' => 'Nama Pasien',
                                                            'no_rm' => 'No. Rekam Medis',
                                                            'tanggal_lahir' => 'Tanggal Lahir',
                                                            'nama_obat' => 'Nama Obat',
                                                            'dosis_bentuk_kekuatan_sediaan' => 'Dosis, bentuk, kekuatan sediaan',
                                                            'jumlah' => 'Jumlah',
                                                            'rute_pemberian' => 'Rute Pemberian',
                                                            'waktu_frekuensi_aturan_pakai' => 'Waktu/frekuensi aturan pakai',
                                                        ];
                                                    @endphp
                                                    @foreach ($list_telaah as $key => $value)
                                                        <tr>
                                                            <td width="300px">{{ $value }}</td>
                                                            <td class="text-center">
																<input type="checkbox" name="telaah[penerimaan_perawat][{{ $key }}]" value="1"
																	checked>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
											</table>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-hero btn-success btn-lg pull-left">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @if (session('window_close'))
        <script>
            swal({
                title: 'Berhasil',
                html: 'Berhasil melakukan serah terima obat',
                type: 'success',
            }).then(function() {
                close();
            });
        </script>
    @endif
@endsection
