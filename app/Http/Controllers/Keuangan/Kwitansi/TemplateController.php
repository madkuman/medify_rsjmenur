<?php

namespace App\Http\Controllers\Keuangan\Kwitansi;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\Template;
use PhpOffice\PhpWord\Settings;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Keuangan\Kwitansi;
use DB;

class TemplateController extends Controller
{

    public function createWordKwitansi(Request $request, $id)
    {
        $settings = new Settings();
        $settings->setOutputEscapingEnabled(true);

        $kwitansi = Kwitansi::find($id);
        // dd($kwitansi);
            
        $templateProcessor = new Template('plugins/template/keuangan_kwitansi.docx');
        $templateProcessor->setValue('lembar', $kwitansi->lembar);
        if($kwitansi->type == 1)
        {
            $templateProcessor->setValue('type', 'PEMASUKAN / P̶E̶N̶G̶E̶L̶U̶A̶R̶A̶N̶');
        }
        else
        {
            $templateProcessor->setValue('type', 'P̶E̶M̶A̶S̶U̶K̶A̶N̶ / PENGELUARAN');
        }
        
        $templateProcessor->setValue('tahun', $kwitansi->tahun_anggaran);
        $templateProcessor->setValue('tanggal', date('d F Y', strtotime($kwitansi->tanggal_transaksi)));
        $templateProcessor->setValue('kodeAnggaran', $kwitansi->kode_anggaran);
        $templateProcessor->setValue('jenisTransaksi', $kwitansi->jenis_transaksi);
        $templateProcessor->setValue('nominku', $kwitansi->nominku);
        $templateProcessor->setValue('npwp', $kwitansi->npwp);
        $templateProcessor->setValue('jumlahTagihan', number_format($kwitansi->subtotal));
        $templateProcessor->setValue('ppn', number_format($kwitansi->ppn));
        $templateProcessor->setValue('pph21', number_format($kwitansi->pph21));
        $templateProcessor->setValue('pph22', number_format($kwitansi->pph22));
        $templateProcessor->setValue('pph23', number_format($kwitansi->pph23));
        $templateProcessor->setValue('jumlahPotongan', number_format($kwitansi->ppn+$kwitansi->pph21+$kwitansi->pph22+$kwitansi->pph23));
        $templateProcessor->setValue('jumlahBayar', number_format($kwitansi->ppn+$kwitansi->pph21+$kwitansi->pph22+$kwitansi->pph23+$kwitansi->subtotal));
        $templateProcessor->setValue('terimaDari', $kwitansi->terima_dari);
        $templateProcessor->setValue('uangTotal', 'Rp '.number_format($kwitansi->ppn+$kwitansi->pph21+$kwitansi->pph22+$kwitansi->pph23+$kwitansi->subtotal.''));
        $templateProcessor->setValue('keperluan', $kwitansi->keperluan);
        $templateProcessor->setValue('tanggal', $kwitansi->tanggal);
        $templateProcessor->setValue('keterangan', $kwitansi->keterangan);
        $templateProcessor->setValue('namaBayar', $kwitansi->pembayar_nama);
        $templateProcessor->setValue('pangkatBayar', $kwitansi->pembayar_pangkat);
        $templateProcessor->setValue('jabatanBayar', $kwitansi->pembayar_jabatan);
        $templateProcessor->setValue('namaTerima', $kwitansi->penerima_nama);
        $templateProcessor->setValue('pangkatTerima', $kwitansi->penerima_pangkat);
        $templateProcessor->setValue('jabatanTerima', $kwitansi->penerima_jabatan);

        // $objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($wordTest, 'Word2007');
        try{
            $templateProcessor->saveAs('uploads/kwitansi/Kwitansi-'.$kwitansi->penerima_nama.'.docx');
            // $objectWriter->save(storage_path('P1 - Pekerjaan Penyediaan CPE Managed Services untuk Layanan Astinet, Indihome dan Wifi Station untuk RSUD Dr Soetomo.docx'));
        }
        catch (Exception $e){

        }
        return response()->download('uploads/kwitansi/Kwitansi-'.$kwitansi->penerima_nama.'.docx');
    }
}
