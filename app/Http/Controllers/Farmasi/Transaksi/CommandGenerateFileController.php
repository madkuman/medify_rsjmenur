<?php

namespace App\Http\Controllers\Farmasi\Transaksi;

use App\Models\Farmasi\TransaksiObat;
use App\Models\Hospital\Laporan;
use App\Models\Hospital\Logger;
use App\Models\Hospital\ZipperDetail;
use App\Models\Pasien\PembayaranPerusahaan;
use Carbon\Carbon;
use DOMDocument;
use Illuminate\Http\Request;
use  App\PDFMerger\PDFMerger;
use Illuminate\Support\Facades\DB;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class CommandGenerateFileController
{
    protected $logger = null;
    protected $logger_data = [];

    function initLogger($params)
    {
        $logger = new Logger();
        $logger->slug = 'farmasi:eresep-kolektif';
        $logger->status = 'start';
        $logger->created_by = 1;
        $logger->param = $params;
        $logger->save();

        $this->logger = $logger;
    }

    function setLoggerData($data)
    {
        $logger_data = $this->logger_data;
        array_push($logger_data, $data);

        $this->logger_data = $logger_data;

        $this->logger->data = $logger_data;
        $this->logger->save();
    }

    private function formatError(\Exception $exception)
    {
        $e_data = [
            'code' => $exception->getCode(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'message' => $exception->getMessage(),
            'trace' => $exception->getTrace()
        ];
        return json_encode($e_data);
    }

    public function preGeneratePenagihanPaketTransaksi($transaksi, $laporan_id, $params)
    {
        try {
            $this->initLogger($params);
            $dest_dir = null;
            $one = 0;
            $detail = 0;
            $date_min = $params['date_min'];
            $date_max = $params['date_max'];
            $file_list = $params['file_list'];
            $filename = $params['filename'][0] ?? 'no_rm';

            if ($params['jenis_cetak'][0] == 'one') {
                $one = 1;
            } else {
                $detail = 1;
            }

            $base_path = '/zipfile/' . Carbon::parse(now())->format('d-m-Y') . '/';

            $id = $transaksi->pluck('id')->take(5)->toArray();
            $id = implode('-', $id);

            $tgl = indonesian_date($date_min) . '-' . indonesian_date($date_max);

            $zipname = $tgl . '.zip';
            $public_zip_path = public_path() . $base_path;

            #make directori
            if (!file_exists($public_zip_path))
                mkdir($public_zip_path, 0777, true);

            $zip_path = $public_zip_path . $zipname;
            $zip = new \ZipArchive;


            if (file_exists($zip_path)) {
                chmod($zip_path, 0777);
                unlink($zip_path);
            }

            #open zip path and create
            $is_open = $zip->open($zip_path, \ZipArchive::CREATE);
            $zip->open($zip_path, \ZipArchive::CREATE);

            if ($is_open === FALSE) return false;

            $jumlah_data = count($transaksi ?? []); #buat check aja jika 1 langsung donwload berupa pdf bukan zip
            foreach ($transaksi as $value) :
                $pdf_merge = new PdfMerger;
                // $pdf_merge = PdfMerger::init();

                try {
                    $departemen = $value->kasus->lokasi->lokasi->lokasi_departemen_id ?? 'Farmasi';

                    if ($departemen == 3) :
                        $lokasi = 'Ranap';
                    elseif (in_array($departemen, [1, 2])) :
                        $lokasi = 'Rajal';
                    else :
                        $lokasi = 'Farmasi';
                    endif;

                    // dd($filename);
                    if ($filename == 'nama_pasien') {
                        $nama_folder = $value->kasus->pasien->name ?? 'TANPA NAMA';
                    } else if ($filename == 'no_sep') {
                        $nama_folder = $value->kasus->sep->no_sep ?? 'BELUM PUNYA SEP';
                    } else {
                        $nama_folder = $value->kasus->pasien->no_rm ?? 'TANPA NAMA';
                    }

                    $sep_filename = 'File-merge-' . $nama_folder . '.pdf';
                    $sep_filename = preg_replace('/(\/|\\\)/', ' ', $sep_filename);
                    $tanggal = isset($value->tanggal) ? Carbon::parse($value->tanggal)->format('d-m-Y') : ($value->created_at->format('d-m-Y') ?? 'Tanggal Tidak Ditemukan');

                    $folder_name = 'downloads/farmasi/e-resep/' . $tanggal . '/' . $nama_folder . '/';
                    if ($dest_dir != null)
                        $folder_name = $dest_dir . '/' . $nama_folder . '/';

                    $path_save = public_path($folder_name);
                    $path_folder_zip = $lokasi . '/' . $tanggal . '/' . $nama_folder . '/';
                    if ($one) {
                        $path_folder_zip = '';
                    }
                    if (!file_exists($path_save)) mkdir($path_save, 0777, true);

                    $zipping = [
                        'zip' => $zip,
                        'path' => $path_folder_zip,
                        'pdf_merge' => $pdf_merge,
                    ];

                    $result_zip = $this->printFiletransaksiEachFile($value, $path_save, $zipping, $one, $detail, $file_list, $nama_folder);
                    $zip = $result_zip['zip'];
                    $pdf_merge = $result_zip['pdf_merge'];
                } catch (\Exception $e) {
                    $laporan_err = Laporan::find($laporan_id);
                    $laporan_err->status = -1;
                    $laporan_err->error = $this->formatError($e);
                    $laporan_err->save();
                    app('App\Http\Controllers\Error\Handler')->bugsnag($e);
                    return 'generate failed';
                }

            endforeach;
            //            dd($result_zip);
            $save_pdf_merge = '';
            if ($jumlah_data > 0) {
                if ($one) {
                    $filename = date('my') . '-' . "TRANS#$tgl.pdf";
                    $save_pdf_merge = $public_zip_path . $filename;
                    $pdf_merge->merge('file', $save_pdf_merge);
                    // $pdf_merge->save($save_pdf_merge);
                    // $zip->addFromString($result_zip['path'] . $filename,  file_get_contents($save_pdf_merge));
                }

                foreach (($result_zip['arr_image_to_pdf'] ?? []) as $key => $value) {
                    \File::delete($value);
                }

                $laporan = Laporan::find($laporan_id);
                $laporan->file_name = $zipname;
                $laporan->file_path = $base_path . $zipname;
                $laporan->status = 1;
                $laporan->save();

                if ($zip != null) {
                    $zip->close();
                }

                return 'generated';
            } else {
                $laporan_err = Laporan::find($laporan_id);
                $laporan_err->status = -1;
                $laporan_err->error = json_encode([
                    'code' => 0,
                    'file' => 'app/Http/Controllers/Farmasi/Transaksi/CommandGenerateFileController.php',
                    'line' => 160,
                    'message' => 'Tidak ada transaksi'
                ]);
                $laporan_err->save();
            }
        } catch (\Exception $exception) {
            $laporan_err = Laporan::find($laporan_id);
            $laporan_err->status = -1;
            $laporan_err->error = $this->formatError($exception);
            $laporan_err->save();
        }
    }

    #default generic
    public function printFileTransaksiEachFile($transaksi, $path, $zip = [], $one, $detail, $list_file, $file_name)
    {
        $arr_image_to_pdf = [];
        $arr_image_to_pdf_full_page = [];
        if ($detail == 0 && $one == 0) {
            $message = 'Silahkan Hidupkan salah 1 fitur Pemberkasan One / Detail';
            dd($message);
        }

        $pdf_merge = new PdfMerger;
        // $pdf_merge =  PdfMerger::init();

        $request = request()->merge(['id' => $transaksi->id]);
        $kasus = $transaksi->kasus ?? null;
        $request_transaksi = request()->merge([
            'id' => $transaksi->id,
            'from_command_generate' => true, #only dsini
        ]);
        $param_download = [
            'is_download'  => true,
            'path'         => $path,
            'transaksi_id' => $transaksi->id,
        ];
        $urutan_ke = 1;
        foreach ($list_file as $key => $value) {

            try {
                $list_file_download = $this->listFileDownload(
                    $zip,
                    $path,
                    $one,
                    $pdf_merge,
                    $detail,
                    $request_transaksi,
                    $request,
                    $param_download,
                    $kasus,
                    $transaksi,
                    $arr_image_to_pdf,
                    $urutan_ke,
                    $file_select = $value
                );
            } catch (\Exception $exception) {
                $this->setLoggerData([
                    'id' => $transaksi->id,
                    'file_select' => $value,
                    'exception' => [
                        'code' => $exception->getCode(),
                        'file' => $exception->getFile(),
                        'line' => $exception->getLine(),
                        'message' => $exception->getMessage(),
                    ]
                ]);
                $list_file_download = "gagal";
            }
            $urutan_ke++;
            if (is_string($list_file_download)) {
                continue;
            }
            $zip = $list_file_download['zip'];
            $pdf_merge = $list_file_download['pdf_merge'];
            $arr_image_to_pdf = $list_file_download['arr_image_to_pdf'];
            if ($arr_image_to_pdf != null)
                array_push($arr_image_to_pdf, $arr_image_to_pdf_full_page);
        }

        if ($one) {
            //penamaan file didalam zip bila setting satu file
            $zip['pdf_merge'] = $pdf_merge;
            $zip['arr_image_to_pdf'] = $arr_image_to_pdf;
            $filename = date('my') . '-' . "TRANSOBAT#$file_name.pdf";
            $pdf_merge->merge('file', $path . $filename);
            // $zip['zip']->addFile($path . $filename, $filename);
            copy($path . $filename, $filename);
        }
        return $zip;
    }

    public function listFileDownload(
        $zip = [],
        $path,
        $one,
        $pdf_merge,
        $detail,
        $request_transaksi,
        $request,
        $param_download,
        $kasus,
        $transaksi,
        $arr_image_to_pdf,
        $urutan_ke,
        $file_select #file yang mau didownload yang mana,
    ) {
        if ($kasus == null) return;
        if ($file_select == 'billing') {
            $tagihan_id = $transaksi->kasus->daftarTagihanLatest->id;
            $filename = "$urutan_ke. Tagihan_Billing_Kasus_$tagihan_id.pdf";
            $param_download['filename'] = $filename;

            $request->merge([
                'ipwl' => 0,
            ]);

            if (count($zip) > 0) {
                if (!file_exists($path . $filename)) {
                    $filename = (new \App\Http\Controllers\Kasus\Tagihan\ViewController())->print($request, $kasus->nomor_kasus, $tagihan_id, $param_download);
                }


                if ($one) {
                    $pdf_merge = $pdf_merge->addPDF($path . $filename, 'all');
                }

                if ($detail && $zip['zip'] != null) {
                    // $zip['zip']->addFile($path . $filename, $zip['path'] . $filename);
                    copy($path . $filename, $zip['path'] . $filename); #copy
                }
            } else {
                $filename = (new \App\Http\Controllers\Kasus\Tagihan\ViewController())->print($request, $kasus->nomor_kasus, $tagihan_id, $param_download);
            }
        } else if ($file_select == 'resep') {
            if (!is_null($transaksi->final_detail)) :
                $id = $transaksi->final_detail->id;
                $farmasi = $transaksi->owner_detail;
                $filename = "$urutan_ke. Print_Resep_$id.pdf";
                $param_download['filename'] = $filename;
                #proses ziping
                if (count($zip) > 0) {
                    if (!file_exists($path . $filename)) :
                        $request->merge([
                            'nomor_resep' => $transaksi->no_resep,
                            'dokter-jenis' => NULL,
                        ]);


                        $filename = (new \App\Http\Controllers\Farmasi\Transaksi\ViewController())->printResep($request, $farmasi, $transaksi->slug, $param_download);
                    endif;

                    if ($one) {
                        $pdf_merge = $pdf_merge->addPDF($path . $filename, 'all');
                    }

                    if ($detail && $zip['zip'] != null) {
                        // $zip['zip']->addFile($path . $filename, $zip['path'] . $filename);
                        copy($path . $filename, $zip['path'] . $filename); #copy
                    }
                } else {
                    #hanya untuk pregenerate
                    $filename = (new \App\Http\Controllers\Farmasi\Transaksi\ViewController())->printResep($request, $farmasi, $transaksi->slug, $param_download);
                }
            endif;
        } else if ($file_select == 'profil') {
            if (!is_null($transaksi->final_detail)) :
                $pasien_id = $transaksi->pasien_detail->id;
                $filename = "$urutan_ke. Print_Profil_$pasien_id.pdf";
                $param_download['filename'] = $filename;
                #proses ziping
                if (count($zip) > 0) {
                    if (!file_exists($path . $filename)) :
                        $filename = (new \App\Http\Controllers\Pasien\Pasien\ViewController())->printprofile($pasien_id, $param_download);
                    endif;

                    if ($one) {
                        $pdf_merge = $pdf_merge->addPDF($path . $filename, 'all');
                    }

                    if ($detail && $zip['zip'] != null) {
                        // $zip['zip']->addFile($path . $filename, $zip['path'] . $filename);
                        copy($path . $filename, $zip['path'] . $filename); #copy
                    }
                } else {
                    #hanya untuk pregenerate
                    $filename = (new \App\Http\Controllers\Pasien\Pasien\ViewController())->printprofile($pasien_id, $param_download);
                }
            endif;
        } else if ($file_select == 'lab-pa') {
            #skip dulu
            #belum dipakai karena ada kelas
            if (isset($transaksi->kasus->tagihan) && $transaksi->kasus->tagihan->hasPenunjang('labpa')) :
                $labpa = $kasus->penunjangLabPA;
                foreach ($labpa as $key => $value) {
                    if ($value->status == -1) {
                        continue;
                    } //jika batal trx tidak perlu generate
                    $filename = "$urutan_ke. LABPA_Permintaan_" . $value->id . '.pdf';
                    $param_download['filename'] = $filename;
                    if (count($zip) > 0) {

                        #ambil dokumen labpk
                        foreach ($value->dokumen as $value_dokumen) {
                            $extention = null;
                            $get_extention = explode('.', $value_dokumen->file);
                            $extention     = end($get_extention);
                            $path_dokumen_labpa = public_path($value_dokumen->file);
                            if (empty($extention)) $extention = 'html';
                            $judul = str_replace(' ', '_', $value_dokumen->title ?? '');
                            $judul = str_replace('/', '_', $judul ?? '');
                            $filename =  "$urutan_ke. LABPA_Hasil_" . $transaksi->id . '_' . $judul . '_' . $value_dokumen->id . '.' . $extention;

                            if (file_exists($path_dokumen_labpa)) {
                                //sanitize judul penunjang
                                if ($one) {
                                    if ($extention != 'pdf' && $extention != 'html' && $value_dokumen->file_type != 'image') continue;
                                    if ($value_dokumen->file_type == 'image') {
                                        $html = '<img src="' . asset($value_dokumen->file) . '" style="width:100%">';
                                        $pdf_blank = \App::make('dompdf.wrapper');
                                        $pdf_blank->loadHTML($html);
                                        $filename =  "$urutan_ke. LABPA_Hasil_" . $transaksi->id . '_' . $judul . '_' . $value_dokumen->id . '.pdf';

                                        $pdf_blank->save($param_download['path'] . $filename);
                                        $pdf_merge = $pdf_merge->addPDF($param_download['path'] . $filename, 'all');
                                    } else {
                                        $pdf_merge = $pdf_merge->addPDF($path_dokumen_labpa, 'all');
                                    }
                                    array_push($arr_image_to_pdf, $param_download['path'] . $filename);
                                }

                                if ($detail && $zip['zip'] != null) {
                                    copy($path_dokumen_labpa, $param_download['path'] . $filename);
                                    // $zip['zip']->addFile($path_dokumen_labpa, $zip['path'] . $filename);
                                    copy($path_dokumen_labpa, $zip['path'] . $filename); #copy
                                }
                            }
                        }
                    } else {
                        app(\App\Http\Controllers\LabPA\Transaction\ViewController::class)->cetakPermintaan($value->slug, $param_download);
                    }
                }
            endif;
        } else if ($file_select == 'hasil-lab') {
            if (isset($transaksi->kasus->tagihan) && $transaksi->kasus->tagihan->hasPenunjang('labpk')) :
                $labpk = $kasus->penunjang_labpk;
                foreach ($labpk as $key => $value) {
                    if ($value->status == -1) {
                        continue;
                    } //jika batal trx tidak perlu generate
                    $filename = "$urutan_ke. LABPK_Permintaan_" . $value->id . '.pdf';
                    $param_download['filename'] = $filename;

                    if (count($zip) > 0) {
                        if (!file_exists($path . $filename)) :
                            $filename = app(\App\Http\Controllers\LabPK\Transaksi\ViewController::class)->cetakPermintaan($value->slug, $param_download);
                        endif;
                        #ambil dokumen labpk
                        foreach ($value->dokumen as $value_dokumen) {
                            $extention = null;
                            $get_extention = explode('.', $value_dokumen->path);
                            $extention     = end($get_extention);
                            $path_dokumen_labpk = public_path($value_dokumen->path);
                            if (empty($extention)) $extention = 'html';
                            $judul = str_replace(' ', '_', $value_dokumen->title ?? '');
                            $judul = str_replace('/', '_', $judul ?? '');
                            $filename =  "$urutan_ke. LABPK_Hasil_" . $transaksi->id . '_' . $judul . '_' . $value_dokumen->id . '.' . $extention;

                            if (file_exists($path_dokumen_labpk)) {
                                //sanitize judul penunjang
                                if ($one) {
                                    if ($extention != 'pdf' && $extention != 'html' && $value_dokumen->type != 'image') continue;
                                    if ($value_dokumen->type == 'image') {
                                        $html = '<img src="' . asset($value_dokumen->path) . '" style="width:100%">';
                                        $pdf_blank = \App::make('dompdf.wrapper');
                                        $pdf_blank->loadHTML($html);
                                        $filename =  "$urutan_ke. LABPK_Hasil_" . $transaksi->id . '_' . $judul . '_' . $value_dokumen->id . '.pdf';

                                        $pdf_blank->save($param_download['path'] . $filename);
                                        $pdf_merge = $pdf_merge->addPDF($param_download['path'] . $filename, 'all');
                                    } else {
                                        $pdf_merge = $pdf_merge->addPDF($path_dokumen_labpk, 'all');
                                    }
                                    array_push($arr_image_to_pdf, $param_download['path'] . $filename);
                                }

                                if ($detail && $zip['zip'] != null) {
                                    copy($path_dokumen_labpk, $param_download['path'] . $filename);
                                    // $zip['zip']->addFile($path_dokumen_labpk, $zip['path'] . $filename);
                                    copy($path_dokumen_labpk, $zip['path'] . $filename); #copy
                                }
                            }
                        }
                    } else {
                        app(\App\Http\Controllers\LabPK\Transaksi\ViewController::class)->cetakPermintaan($value->slug, $param_download);
                    }
                }
            endif;
        } else if ($file_select == 'sep') {
            if (isset($kasus->sep) && $kasus->pembayaran->perusahaan->type == 1) :

                $sep = $kasus->sep;
                $bpjs_real = json_decode(app(\App\Http\Controllers\BPJS\API\Sep\ReadController::class)->get($sep->no_sep));
                if (($bpjs_real->metaData->code ?? null) == 200) {
                    $filename = "$urutan_ke. Print_SEP_" . $sep->no_sep . '.pdf';
                    $param_download['filename'] = $filename;

                    $request_sep = new Request([
                        'pasien_id' => $transaksi->pasien->id ?? null
                    ]);
                    if (count($zip) > 0) {
                        if (!file_exists($path . $filename)) :
                            $filename = app(\App\Http\Controllers\BPJS\SEP\ViewController::class)->print($sep->no_sep, $param_download);
                        endif;
                        if ($one) {
                            $pdf_merge = $pdf_merge->addPDF($path . $filename, 'all', 'L');
                        }
                        if ($detail && $zip['zip'] != null) {
                            // $zip['zip']->addFile($path . $filename, $zip['path'] . $filename);
                            copy($path . $filename, $zip['path'] . $filename); #copy
                        }
                    } else {
                        app(\App\Http\Controllers\BPJS\SEP\ViewController::class)->print($sep->no_sep, $param_download);
                    }
                }

            endif;
        } else if ($file_select == 'identitas') {
            if (count($zip) > 0) {
                if (!empty($transaksi->pasien_detail)) {
                    $pasien = $transaksi->pasien_detail;

                    if (!is_null($pasien->ktp)) {

                        $get_extention = explode('.', $pasien->ktp);
                        $extention     = end($get_extention);
                        $path_dokumen_ktp = public_path($pasien->ktp);
                        $filename = "$urutan_ke. KTP_$pasien->no_rm.$extention";
                        // dd($get_extention, $extention, $path_dokumen_ktp);
                        if (file_exists($path_dokumen_ktp)) {

                            #jika ektensionnya pdf
                            if ($extention == 'pdf') {
                                if ($one) {
                                    $pdf_merge = $pdf_merge->addPDF($path_dokumen_ktp, 'all');
                                }
                                if ($detail && $zip['zip'] != null) {
                                    // $zip['zip']->addFile($path_dokumen_ktp, $zip['path'] . $filename . '.' . $extention);
                                    copy($path_dokumen_ktp, $zip['path'] . $filename . '.' . $extention); #copy
                                }
                            } else {
                                if ($one) {
                                    $html = '<img src="' . asset($pasien->ktp) . '" style="width:100%">';
                                    $pdf_blank = \App::make('dompdf.wrapper');
                                    $pdf_blank->loadHTML($html);
                                    $filename = $filename = "$urutan_ke. KTP_$pasien->no_rm.pdf";
                                    $pdf_blank->save($param_download['path'] . $filename);
                                    $pdf_merge = $pdf_merge->addPDF($param_download['path'] . $filename, 'all');
                                    array_push($arr_image_to_pdf, $param_download['path'] . $filename);
                                }
                                if ($detail && $zip['zip'] != null) {
                                    // $zip['zip']->addFile($pasien->ktp, $zip['path'] . $filename);
                                    copy($pasien->ktp, $zip['path'] . $filename); #copy
                                }
                            }
                        }
                    }
                }
            }
        } else {
            return 'Not FOUND';
        }

        $result = [
            'pdf_merge' => $pdf_merge,
            'zip' => $zip,
            'arr_image_to_pdf' => $arr_image_to_pdf,
        ];
        return $result;
    }

    protected $time_start = null;
    protected $last_checkpoint = null;
    function timeLogStart()
    {
        $this->time_start = microtime(true);
        $this->last_checkpoint = microtime(true);
    }
    function timeLogStamp($string)
    {
        $last_checkpoint = $this->last_checkpoint;
        $this->last_checkpoint = microtime(true);
        $diff_checkpoint = number_format($this->last_checkpoint - $last_checkpoint, 2, ".", "");
        $diff_elapsed = number_format($this->last_checkpoint - $this->time_start, 2, ".", "");
        echo "\n" . now()->format('H:i') . " " . $diff_checkpoint . " " . $diff_elapsed . " | " . $string;
    }

    function invokeZipper($zipper, $param = [])
    {
        $this->timeLogStart();
        $this->timeLogStamp('start');
        $param = (object) $param;
        try {
            $params = json_decode($zipper->param, true);
            $this->initLogger($params);
            $limit = $param->limit ?? 500;
            $zipper_detail = $zipper->zipper_detail()->where('status', 0)->limit($limit)->get();

            $continue = true;
            $count_pending = $zipper_detail->count();
            if ($count_pending != 0) {
                $this->timeLogStamp('loaded ' . $count_pending);
                $dest_dir = null;
                $one = 0;
                $detail = 0;
                $date_min = $params['date_min'];
                $date_max = $params['date_max'];
                $file_list = $params['file_list'];
                $filename = $params['filename'][0] ?? 'no_rm';

                if ($params['jenis_cetak'][0] == 'one') {
                    $one = 1;
                } else {
                    $detail = 1;
                }

                if (!empty($zipper->path)) {
                    $zipname = $zipper->filename;
                    $zip_path = public_path() . $zipper->path;
                } else {
                    $base_path = '/zipfile/zipper-' . $zipper->id . '/';

                    $tgl = indonesian_date($date_min) . '-' . indonesian_date($date_max);
                    $zipname = $tgl . '.zip';
                    $public_zip_path = public_path() . $base_path;

                    #make directori
                    if (!file_exists($public_zip_path))
                        mkdir($public_zip_path, 0777, true);

                    $zip_path = $public_zip_path . $zipname;

                    $zipper->filename = $zipname;
                    $zipper->path = $base_path . $zipname;
                    $zipper->save();
                }

                $zip = new \ZipArchive;
                if (file_exists($zip_path)) {
                    chmod($zip_path, 0777);
                }

                if (1) {
                    $this->timeLogStamp('zip open');
                    # script aneh gk jelas
                    $asuransi_tipe_id = $params['asuransi_tipe_id'];
                    $perusahaan_tipe = PembayaranPerusahaan::with(['tipe' => function ($q) use ($asuransi_tipe_id) {
                        $q->where('id', $asuransi_tipe_id);
                    }])
                        ->pluck('id');
                    $eager = [
                        'pembayaran_detail' => function ($q) use ($perusahaan_tipe) {
                            $q->whereIn('perusahaan_id', $perusahaan_tipe);
                        },
                        'kasus',
                        'final_detail'
                    ];
                    $data_transaksi = TransaksiObat::with($eager)->whereIn('id', $zipper_detail->pluck('referensi_id')->toArray())->get()->keyBy('id');
                    $this->timeLogStamp('data loaded ' . $data_transaksi->count());
                    $number = 1;
                    foreach ($zipper_detail as $item) :
                        $value = $data_transaksi[$item->referensi_id];

                        $departemen = $value->kasus->lokasi->lokasi->lokasi_departemen_id ?? 'Farmasi';

                        if ($departemen == 3) :
                            $lokasi = 'Ranap';
                        elseif (in_array($departemen, [1, 2])) :
                            $lokasi = 'Rajal';
                        else :
                            $lokasi = 'Farmasi';
                        endif;

                        // dd($filename);
                        if ($filename == 'nama_pasien') {
                            $nama_folder = $value->kasus->pasien->name ?? 'TANPA NAMA';
                        } else if ($filename == 'no_sep') {
                            $nama_folder = $value->kasus->sep->no_sep ?? 'BELUM PUNYA SEP';
                        } else {
                            $nama_folder = $value->kasus->pasien->no_rm ?? 'TANPA NAMA';
                        }

                        $sep_filename = 'File-merge-' . $nama_folder . '.pdf';
                        $sep_filename = preg_replace('/(\/|\\\)/', ' ', $sep_filename);
                        $tanggal = isset($value->tanggal) ? Carbon::parse($value->tanggal)->format('d-m-Y') : ($value->created_at->format('d-m-Y') ?? 'Tanggal Tidak Ditemukan');

                        $folder_name = 'downloads/farmasi/e-resep/' . $tanggal . '/' . $nama_folder . '/';
                        if ($dest_dir != null)
                            $folder_name = $dest_dir . '/' . $nama_folder . '/';

                        $path_save = public_path($folder_name);
                        $path_folder_zip = $lokasi . '/' . $tanggal . '/' . $nama_folder . '/';
                        if ($one) {
                            $path_folder_zip = '';
                        }
                        $path_folder_zip = public_path('zipfile/zipper-' . $zipper->id . "/file_list/" . $path_folder_zip);
                        if (!file_exists($path_save)) mkdir($path_save, 0777, true);
                        if (!file_exists($path_folder_zip)) mkdir($path_folder_zip, 0777, true);

                        $zipping = [
                            'zip' => $zip,
                            'path' => $path_folder_zip,
                        ];

                        $result_zip = $this->printFiletransaksiEachFile($value, $path_save, $zipping, $one, $detail, $file_list, $nama_folder);
                        $zip = $result_zip['zip'];
                        $this->timeLogStamp(($number++) . "|" . $item->referensi_id);

                    endforeach;
                    // $zip->close();
                    // $this->timeLogStamp('zip closed');

                    ZipperDetail::whereIn('id', $zipper_detail->pluck('id'))->update(['status' => 1]);

                    $zipper->last_process_at = now();
                    $count_done = $zipper->zipper_detail()->where('status', 1)->count([DB::raw(1)]);
                    $count_all = $zipper->zipper_detail()->count([DB::raw(1)]);
                    $zipper->percentage = $count_done / $count_all  * 100;
                    $zipper->save();

                    $count_pending = $count_all - $count_done;
                    $this->timeLogStamp('status update');
                } else {
                    $zipper->status = -1;
                    $zipper->error_message = 'file zip tidak dapat dibuka';
                    $zipper->save();
                }
            }

            if ($count_pending == 0) {
                $zipper->status = 1;
                $zipper->percentage = 100;
                $zipper->save();

                $this->timeLogStamp('creating zip file');
                $this->zippFileList($zipper);
                $this->timeLogStamp('zip file created');

                $laporan = $zipper->laporan;
                if ($laporan != null) {
                    if (!empty($zipper->path)) {
                        $laporan->file_name = $zipper->filename;
                        $laporan->file_path = $zipper->path;
                        $laporan->status = 1;
                        $laporan->save();
                    } else {
                        $laporan->status = -1;
                        $laporan->file_name = "Tidak ada data transaksi";
                        $laporan->save();
                    }
                }
                $continue = false;
                $this->timeLogStamp('zipper finish');
            }

            return [
                'continue' => $continue,
            ];
        } catch (\Exception $exception) {
            $this->setLoggerData([
                'main' => true,
                'exception' => [
                    'code' => $exception->getCode(),
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                    'message' => $exception->getMessage(),
                ]
            ]);
            return [
                'continue' => false,
            ];
        }
    }

    function zippFileList($zipper)
    {
        $params = json_decode($zipper->param, true);
        $date_min = $params['date_min'];
        $date_max = $params['date_max'];
        if (!empty($zipper->path)) {
            $zipname = $zipper->filename;
            $zip_path = public_path() . $zipper->path;
        } else {
            $base_path = '/zipfile/zipper-' . $zipper->id . '/';

            $tgl = indonesian_date($date_min) . '-' . indonesian_date($date_max);
            $zipname = $tgl . '.zip';
            $public_zip_path = public_path() . $base_path;

            #make directori
            if (!file_exists($public_zip_path))
                mkdir($public_zip_path, 0777, true);

            $zip_path = $public_zip_path . $zipname;

            $zipper->filename = $zipname;
            $zipper->path = $base_path . $zipname;
            $zipper->save();
        }

        $zip = new \ZipArchive;
        if (file_exists($zip_path)) {
            chmod($zip_path, 0777);
        }

        if ($zip->open($zip_path, \ZipArchive::CREATE)) {
            $source = public_path("zipfile/zipper-" . $zipper->id . "/file_list");
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
            foreach ($files as $file) {
                $file = str_replace('\\', '/', $file);

                // Ignore "." and ".." folders
                if (in_array(substr($file, strrpos($file, '/') + 1), array('.', '..')))
                    continue;

                $file = realpath($file);

                if (is_dir($file) === true) {
                    $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                } else if (is_file($file) === true) {
                    $zip->addFile($file, str_replace($source . '/', '', $file));
                }
            }

            $zip->close();
            return true;
        } else {
            $zipper->status = -1;
            $zipper->error_message = 'file zip tidak dapat dibuka';
            $zipper->save();
            return false;
        }
    }
}
