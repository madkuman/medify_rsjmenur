<?php

namespace App\Http\Controllers\LabPK\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\Transaksi;
use App\Models\LabPK\Service;
use App\Models\LabPK\Result;
use App\Models\FrontOffice\PatientsInsurance;
use App\Models\FrontOffice\InsuranceCompany;
use App\Models\LabPK\TransaksiDetail;
use App\Models\FrontOffice\Patients;
use App\Models\LabPK\Dokumen;
use App\Models\LabPK\PemeriksaanHasil;
use DB;
use DataTables;
use Datetime;
use App\Exports\LabPK\InvoiceHistori;
define('RELASI', ['kelas', 'pasien', 'pembayaran', 'pembayaran.perusahaan', 'pembayaran.perusahaan.tipe', 'asal', 'asal.departemen','kasus','detail.tarif']);

class ReadController extends Controller
{
    static protected $link = "labpk";

    public function getServices() 
    {
        try {
            $services = Service::all();
        } catch (Exception $e) {
            return json_encode(['data' => NULL, 'status' => '500']);
        }
        return json_encode(['data' => $services ]);
    }

    public function getBySlug($slug, $relations = NULL)
    {
        $trans = Transaksi::where('slug', $slug);
        if(!is_null($relations))    $trans = $trans->with($relations);
        return $trans->first();
    }

    //deprecated
    public function getUnread($date_start = NULL,$date_end = NULL)
    {
        if(is_null($date_start))
            return Transaksi::where('status',0)->with(RELASI)->get();
        else
            return Transaksi::where('status',0)->whereBetween('created_at',[$date_start,$date_end])
        ->with(RELASI)->get();
    }

    public function countTotal()
    {
        try {
            $total = TransactionDetail::count();
        } catch (Exception $e) {

        }
        return json_encode(['data' => $total]);
    }

    public function getPatientService($slug) {
        return Transaksi::where('slug',$slug)->with('kelas', 'pasien', 'pembayaran.perusahaan.tipe', 'asal', 'kasus','detail.tarif.labpk_form_tarif.form.detail','detail.hasil','spesimen.spesimen.kategori')->first();
    }

    public function getTransaksiDetail($slug)
    {
        try {
            $detail = TransaksiDetail::where('slug', $slug)->first();
            if(empty($detail))
                return NULL;
            return $detail;
        } catch (\Exception $e) {
            if(config('app.debug'))
                dd($e);
            return FALSE;            
        }
    }
    public function check($id) {
        try {
            $transactions = TransactionDetail::with('transaction_detail.transactionDetail_service')->find($id);
        } catch (Exception $e) {
            return json_encode(['data' => NULL, 'status' => '500']);
        }
        return json_encode(['data' => $transactions]);
    }

    public function getDocument($id)
    {
        try {
            $photos = Dokumen::where('transaksi_id', $id)->where('status', 1)->get();
        } catch (Exception $e) {
            if(config('app.debug'))

                return FALSE;
        }
        return $photos;
    }

    public function getResult($id)
    {
        try {
            // $result = Transaksi::;
            $result = Transaksi::search('', function ($algolia, $query, $options) use ($id) {
                $options['facetFilters'] = "id:".$id;
                return $algolia->search($query,$options);
            })->raw();
            // dd($result);
            return $result;
        } catch (Exception $e) {
            return FALSE;
        }
    }

    private function getHistoriData($req)
    {
        $no_rm = $req->get('no_rm');
        $nama = $req->get('nama');
        $date_start = $req->get('tanggal_mulai');
        $date_end = $req->get('tanggal_akhir');
        $jenis_pasien = $req->get('jenis_pasien');
        $asal_ruang = $req->get('asal_ruang');
        $tipe_transaksi = $req->get('tipe_transaksi');
        $jenis_layanan = $req->get('jenis_layanan');
        $status = $req->get('status');
        $jenis_pemeriksaan = $req->get('jenis_pemeriksaan');

        $history = Transaksi::where('status', '!=', 0);

        if($status)
            $history = $history->StatusFilter($status);
        if($tipe_transaksi)
            $history = $history->where('tarif_tipe_id', $tipe_transaksi);
        if($nama)
            $history = $history->PasienHasName($nama);
        if($no_rm)
            $history = $history->PasienHasNoRm($no_rm);

        if($date_start || $date_end){
            if($date_start == $date_end)
                $history = $history->whereDate('result_created_at', $date_end);
            else if(is_null($date_start))
                $history = $history->whereDate('result_created_at', '<=', $date_end);
            else if(is_null($date_end))
                $history = $history->whereDate('result_created_at', '>=', $date_start);
            else
                $history = $history->whereBetween('result_created_at', [$date_start, $date_end]);
        }
        if($asal_ruang)
            $history = $history->AsalFilter($asal_ruang);

        if(!empty($jenis_pemeriksaan)){
            if(is_string($jenis_pemeriksaan)) $jenis_pemeriksaan = explode(',',$jenis_pemeriksaan);
            $history = $history->whereHas('detail',function($cat) use($jenis_pemeriksaan){
                $cat->whereIn('tarif_id', $jenis_pemeriksaan);
            },'>=',count($jenis_pemeriksaan));
        }

        $history = $history->with('pembayaran.perusahaan', 'pembayaran.perusahaan.tipe', 'pasien', 'asal', 'detail', 'detail.tarif')->orderBy('result_created_at', 'desc');

        if($jenis_pasien != 'none'){
            $history = $history->get();
            $history = $history->filter( function($value, $key) use($jenis_pasien){
                return $value->pembayaran['perusahaan']['type'] == $jenis_pasien;
            });
        }
        
        return $history;
    }

    public function getHistori(Request $req)
    {
        try {
            $history = $this->getHistoriData($req);
            return Datatables::of($history)
            ->editColumn('status', function($history){
                if($history->status == -1){
                    return '<span class="badge badge-danger">Batal</span>';
                }elseif($history->status == 1 && empty($history->verified_at)){
                    return '<span class="badge badge-warning">Belum Verifikasi</span>';
                }elseif($history->status == 1 && !empty($history->verified_at)){
                    return '<span class="badge badge-success">Terverifikasi</span>';
                }
            })
            ->editColumn('patient_id', function($history){
                if($history->pasien){
                    $pasien_name = $history->pasien->name;
                    $age = $history->pasien->age;
                    if($history->pasien->gender == 1)
                        $gender = "Laki-laki";
                    else
                        $gender = "Perempuan";
                        // return $pasien_name;
                    return '<td>                            
                    <h5 class="py-0 my-0">'.$pasien_name.'</h5>
                    <div class="font-w400 font-size-sm text-muted">
                    '.$gender.', 
                    '.$age.' tahun</div>
                    </td>';
                }
                return '-';
            })
            ->addColumn('pasien_rm', function($history){
                if($history->pasien)
                    return $history->pasien->no_rm;
                return '-';
            })
            ->addColumn('harga_total', function($history){
                $total = 0;
                if($history->harga_total){
                    $total = $history->harga_total;
                }
                return 'Rp.'.number_format($total);
            })
            ->editColumn('kasus_id', function($history){
                return $history->pembayaran['perusahaan']['tipe']['nama'];
            })
            ->editColumn('result_created_at', function($history){
                if($history->status == -1)
                    $content = "Batal - ${history['alasan_batal']}";
                $content = is_null($history->result_created_at) ? '-' : date('d F Y, H:i', strtotime($history->result_created_at));
                $order = date('YmdHi', strtotime($history->result_created_at));
                return '<td data-order="'.$order.'">'.$content.'</td>';
            })
            ->editColumn('created_at', function($history){
                $content = date('d F Y, H:i', strtotime($history->created_at));
                $order = date('YmdHi', strtotime($history->created_at));
                return '<td data-order="'.$order.'">'.$content.'</td>';
            })
            ->editColumn('lokasi_id', function($history){
                return $history->asal['nama'] ?? 'Tanpa Kasus';
            })
            ->addColumn('layanan', function($history){
                $rowText = $history->detail->reduce( function($description, $item) {
                    $deskripsi = (!is_null($item->tarif)) ? $item->tarif->deskripsi : ' ';
                    return $description .= '<li>'.$deskripsi.'</li>';
                }, '<ul>');
                return $rowText.'</ul>';
            })
            ->addColumn('action', function($history){
                return '<a href="'.url('/labpk/transaksi/hasil/'.$history->slug).'" class="btn btn-primary">Lihat Hasil</a>
                ';
            })->escapeColumns([])
            ->make(true);
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public function historiDownload(Request $req)
    {
        $filename = 'Histori Lab LabPK';
        $date_start = $req->get('tanggal_mulai');
        $date_end = $req->get('tanggal_akhir');

        if($date_start && $date_end)
            $filename .= ' '.$date_start.' - '.$date_end;

        $history = $this->getHistoriData($req);
        if($req->jenis_pasien == 'none')
            $history = $history->get();

        $data['start'] = $date_start;
        $data['end'] = $date_end;
        $data['history'] = $history;
        $data['row_number'] = count($data['history']);
        try {
            return (new InvoiceHistori($data))->download($filename.'.xlsx');
        } catch (\Exception $e) {
            return FALSE;
        }
    }

    public function getUnverifiedTransaction($date_start = NULL,$date_end = NULL)
    {
        if(is_null($date_start))
            return Transaksi::where('status', 1)->whereNull('verified_at')->orderBy('result_created_at', 'desc')->with(RELASI)->get();
        else
            return Transaksi::where('status', 1)->whereNull('verified_at')->orderBy('result_created_at', 'desc')->whereBetween('result_created_at',[$date_start,$date_end])->with(RELASI)->get();
    }

    public function getTransactionDetailBySlug($slug)
    {
        return TransaksiDetail::where('slug', $slug)->first();
    }

}