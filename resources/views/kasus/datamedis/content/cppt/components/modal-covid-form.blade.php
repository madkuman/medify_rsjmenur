<div class="modal fade" id="modal-covid-form" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Update Status COVID</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    @php $status = $kasus->covid_status->status ?? 'none' @endphp
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/covid-19/update-status" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Status COVID Pasien</label>
                            <div class="custom-control custom-radio mb-5">
                                <input class="custom-control-input" type="radio" name="status" id="status_covid_odp" value="odp" @if($status == 'odp') checked @endif>
                                <label class="custom-control-label" for="status_covid_odp">ODP (Orang Dalam Pemantauan)</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input class="custom-control-input" type="radio" name="status" id="status_covid_otg" value="otg" @if($status == 'otg') checked @endif>
                                <label class="custom-control-label" for="status_covid_otg">OTG (Orang Tanpa Gejala)</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input class="custom-control-input" type="radio" name="status" id="status_covid_pdp" value="pdp" @if($status == 'pdp') checked @endif>
                                <label class="custom-control-label" for="status_covid_pdp">PDP (Pasien Dalam Pengawasan)</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input class="custom-control-input" type="radio" name="status" id="status_covid_probable" value="probable" @if($status == 'probable') checked @endif>
                                <label class="custom-control-label" for="status_covid_probable">Probable COVID19</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input class="custom-control-input" type="radio" name="status" id="status_covid_negatif" value="negatif" @if($status == 'negatif') checked @endif>
                                <label class="custom-control-label" for="status_covid_negatif">Negatif COVID19</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input class="custom-control-input" type="radio" name="status" id="status_covid_positif" value="positif" @if($status == 'positif') checked @endif>
                                <label class="custom-control-label" for="status_covid_positif">Positif COVID19</label>
                            </div>
                        </div>
                        @if(!$has_covid_diagnosis)
                        <div class="form-group" id="jadikan_diagnosis_utama" style="display: none">
                            <label>Diagnosa ICD10</label><br>
                            <label class="css-control css-control-primary css-checkbox">
                                <input type="checkbox" name="diagnosis_utama" class="css-control-input" value="on">
                                <span class="css-control-indicator"></span> Jadikan Diagnosis Utama
                            </label><br>
                            <small>Sistem akan menambahkan otomatis diagnosis <strong>B34.2</strong> kedalam menu diagnosis</small>
                        </div>
                        @endif
                        <div class="form-group">
                            <label>Keterangan <small>*Wajib diisi</small></label>
                            <textarea name="keterangan" required class="form-control" placeholder="Dasar merubah status pasien. Misal : Berdasarkan hasil SWAB, berdasarkan hasil Asesmen"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-alt btn-click-animate btn-hero btn-primary float-right">
                                <i class="fa fa-send mr-5"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>