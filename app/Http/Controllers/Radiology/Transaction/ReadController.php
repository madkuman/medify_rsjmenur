<?php

namespace App\Http\Controllers\Radiology\Transaction;

use App\Models\Kasus\Penunjang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Radiology\Transaction;
use App\Models\Radiology\Service;
use App\Models\FrontOffice\PatientsInsurance;
use App\Models\FrontOffice\InsuranceCompany;
use App\Models\Radiology\TransactionDetail;
use App\Models\FrontOffice\Patients;
use App\Models\Radiology\Photo;
use DB;
use DataTables;
use Datetime;
use App\Exports\Radiologi\HistoriDownload;

define('RELASI', ['kelas', 'pasien', 'pembayaran', 'pembayaran.perusahaan', 'pembayaran.perusahaan.tipe', 'asal', 'asal.departemen','kasus']);

class ReadController extends Controller
{
    static protected $link = "radiologi";

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
        $trans = Transaction::where('slug', $slug);
        if(!is_null($relations))    $trans = $trans->with($relations);
        return $trans->first();
    }

    public function getUnread($date_start = NULL,$date_end = NULL)
    {
        if(is_null($date_start))
            return Transaction::where('status',0)->with(RELASI)->get();
        else
            return Transaction::where('status',0)->whereBetween('created_at',[$date_start,$date_end])
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
        return Transaction::where('slug',$slug)->with('kelas', 'pasien', 'pembayaran', 'pembayaran.perusahaan', 'pembayaran.perusahaan.tipe', 'asal', 'kasus', 'detail', 'detail.tarif')->first();
    }

    public function getTransactionDetail($id) {
        try {
            $detail = TransactionDetail::find($id);
            if(empty($detail))
                return NULL;
        } catch (\Exception $e) {
            return NULL;
        }
        return $detail;
    }

    public function check($id) {
        try {
            $transactions = TransactionDetail::with('transaction_detail.transactionDetail_service')->find($id);
        } catch (Exception $e) {
            return json_encode(['data' => NULL, 'status' => '500']);
        }
        return json_encode(['data' => $transactions]);
    }

    public function getPhotos($id)
    {
        try {
            $photos = Photo::where('transaction_id', $id)->where('status', 1)->get();
        } catch (Exception $e) {
            return FALSE;
        }
        return $photos;
    }

    public function getResult($id)
    {
        try {
            // $result = Transaction::;
            $result = Transaction::search('', function ($algolia, $query, $options) use ($id) {
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

        $history = Transaction::where('status', '!=', 0);
        if($status)
            $history = $history->StatusFilter($status);
        if($jenis_layanan)
            $history = $history->TarifHistoriFilter($jenis_layanan);
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
                return '<a href="'.url('/radiologi/transaksi/hasil/'.$history->slug).'" class="btn btn-info">Lihat Hasil</a>
                ';
            })->escapeColumns([])
            ->make(true);
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public function historiDownload(Request $req)
    {
        $filename = 'Histori Lab Radiologi';
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
            return (new HistoriDownload($data))->download($filename.'.xlsx');
        } catch (\Exception $e) {
            return FALSE;
        }
    }

    public function getUnverifiedTransaction($date_start = NULL,$date_end = NULL)
    {
        if(is_null($date_start))
            return Transaction::where('status', 1)->whereNull('verified_by')->orderBy('result_created_at', 'desc')->with(RELASI)->get();
        else
            return Transaction::where('status', 1)->whereNull('verified_by')->orderBy('result_created_at', 'desc')->whereBetween('result_created_at',[$date_start,$date_end])->with(RELASI)->get();
    }

    public function getPhotosPenunjang($id)
    {
        try {
            $photos = Penunjang::select('created_by','id','judul as title','file_type as type','file_thumb as thumbnail_path','file as path','updated_at','id as flag_penunjang')->where('type', self::$link)->where('penunjang_permintaan_id',$id)->get();
        } catch (Exception $e) {
            return FALSE;
        }
        return $photos;
    }

    public function getBmhp($transaksi_id){
        $all_data = app('App\Http\Controllers\Radiology\TransaksiBmhp\ReadController')->getJoinedDatabyTransaksi($transaksi_id);
        return $all_data;
    }

}