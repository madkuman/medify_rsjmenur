<?php

namespace App\Http\Controllers\BPJS\API\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use Carbon\Carbon;
use GuzzleHttp\Exception\RequestException;

class ReadController extends Controller
{
	public function getFaskes(Request $request)
	{
		 $nama = $request->faskes;
		 $jenis = 2; // Rumah Sakit - lihat dari dokumentasi 
		 try
		 {
			 $faskes = app('App\Http\Controllers\ThirdParty\BPJS\VClaim\Referensi\FaskesController')->getFaskes($nama, $jenis);
			 return $faskes;
			 
		 } catch (RequestException $e) {
			 // echo Psr7\str($e->getRequest());
			 if ($e->hasResponse()) {
				 echo Psr7\str($e->getResponse());
			 }
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		 }catch (\Exception $e){
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			 // echo Psr7\str($e);
		 }
	}
 
	public function getPoli(Request $request)
	{
		 $param = $request->poli;
		 if(empty($param) || $param == "")
			 $param = "a";
		 try
		 {
			 $poli = app('App\Http\Controllers\ThirdParty\BPJS\VClaim\Referensi\PoliController')->getPoli($param);
			 return $poli;
		 } catch (RequestException $e) {
			 // echo Psr7\str($e->getRequest());
 
			 if ($e->hasResponse()) {
				 echo Psr7\str($e->getResponse());
			 }
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		 }catch (\Exception $e){
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			 // echo Psr7\str($e);
		 }
	}
 
	public function getSpesialis(Request $request)
	{
		 try
		 {
			 $spesialis = app('App\Http\Controllers\ThirdParty\BPJS\VClaim\Referensi\SpesialisController')->getSpesialis();
			 return $spesialis;
		 } catch (RequestException $e) {
			 // echo Psr7\str($e->getRequest());
			 if ($e->hasResponse()) {
				 echo Psr7\str($e->getResponse());
			 }
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		 }catch (\Exception $e){
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			 // echo Psr7\str($e);
		 }
	}
 
	public function getDPJP(Request $request, $jp, $spesialis)
	{
		 $date = Carbon::now();
		 $tgl = $date->year.'-'.$date->month.'-'.$date->day;
		 try
		 {
			 $dpjp = app('App\Http\Controllers\ThirdParty\BPJS\VClaim\Referensi\DpjpController')->getDpjp($jp, $tgl, $spesialis);
			 return $dpjp;
		 } catch (RequestException $e) {
			 // echo Psr7\str($e->getRequest());
			 if ($e->hasResponse()) {
				 echo Psr7\str($e->getResponse());
			 }
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		 }catch (\Exception $e){
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			 // echo Psr7\str($e);
		 }
	}
 
	public function getPropinsi(Request $request)
	{
		 try
		 {
			 $provinsi = app('App\Http\Controllers\ThirdParty\BPJS\VClaim\Referensi\PropinsiController')->getPropinsi();
			 return $provinsi;
		 } catch (RequestException $e) {
			 if ($e->hasResponse()) {
				 echo Psr7\str($e->getResponse());
			 }
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		 }catch (\Exception $e){
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			 // echo Psr7\str($e);
		 }
	}
	public function getKabupaten(Request $request, $propinsi)
	{
		 try
		 {
			 $kabupaten = app('App\Http\Controllers\ThirdParty\BPJS\VClaim\Referensi\KabupatenController')->getKabupaten($propinsi);
			 return $kabupaten;
		 } catch (RequestException $e) {
			 if ($e->hasResponse()) {
				 echo Psr7\str($e->getResponse());
			 }
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		 }catch (\Exception $e){
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			 // echo Psr7\str($e);
		 }
	}
	public function getKecamatan(Request $request, $kabupaten)
	{
		 try
		 {
			 $kecamatan = app('App\Http\Controllers\ThirdParty\BPJS\VClaim\Referensi\KecamatanController')->getKecamatan($kabupaten);
			 return $kecamatan;
			 
		 } catch (RequestException $e) {
			 if ($e->hasResponse()) {
				 echo Psr7\str($e->getResponse());
			 }
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		 }catch (\Exception $e){
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			 // echo Psr7\str($e);
		 }
	}
 
	public function getKelasApplicare(Request $request)
	{
		 try
		 {
			 $applicare = app('App\Http\Controllers\ThirdParty\BPJS\VClaim\Referensi\ApplicareController')->kelas();
			 return $applicare;
 
		 } catch (RequestException $e) {
			 if ($e->hasResponse()) {
				 echo Psr7\str($e->getResponse());
			 }
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		 }catch (\Exception $e){
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			 // echo Psr7\str($e);
		 }
	}
 
	public function getDiagnosa(Request $request)
	{
		 $param = $request->diagnosa;
		 try
		 {
			 $diagnosa = app('App\Http\Controllers\ThirdParty\BPJS\VClaim\Referensi\DiagnosaController')->getDiagnosa($param);
			 return $diagnosa;
		 } catch (RequestException $e) {
			 // echo Psr7\str($e->getRequest());
 
			 if ($e->hasResponse()) {
				 echo Psr7\str($e->getResponse());
			 }
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		 }catch (\Exception $e){
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			 // echo Psr7\str($e);
		 }
	}
 
	public function getProgramPrb(Request $request)
	{
		 try
		 {
			 $content = app(\App\Http\Controllers\ThirdParty\BPJS\VClaim\Referensi\ProgramPrbController::class)->getProgramPrb();
			 
			 #example-response
			 // $content = '{ "metaData": { "code": "200", "message": "Sukses" }, "response": { "list": [ { "kode": "01 ", "nama": "Diabetes Mellitus" }, { "kode": "02 ", "nama": "Hypertensi" }, { "kode": "03 ", "nama": "Asthma" }, { "kode": "04 ", "nama": "Penyakit Jantung" }, { "kode": "05 ", "nama": "PPOK (Penyakit Paru Obstruktif Kronik)" }, { "kode": "06 ", "nama": "Schizophrenia" }, { "kode": "07 ", "nama": "Stroke" }, { "kode": "08 ", "nama": "Epilepsi" }, { "kode": "09 ", "nama": "Systemic Lupus Erythematosus" } ] } }';
 
			 return $content;
		 } catch (RequestException $e) {
			 if ($e->hasResponse()) {
				 echo Psr7\str($e->getResponse());
			 }
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		 }catch (\Exception $e){
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		 }
	}
 
	public function getObatGenerikProgramPrb(Request $request)
	{
			$param = [
				'nama_obat' => $request->nama_obat,
		 ];
		 try
		 {
			 $content = app(\App\Http\Controllers\ThirdParty\BPJS\VClaim\Referensi\ObatGenerikController::class)->getObatGenerik($param);
 
			 #example-response
			 // $content = '{ "metaData": { "code": "200", "message": "Sukses" }, "response": { "list": [ { "kode": "00019100017", "nama": "Analog Insulin Long Acting inj 100 UI/ml" }, { "kode": "00012300016", "nama": "Analog Insulin Mix Acting inj 100 UI/ml" } ] } }';
 
			 return $content;
		 } catch (RequestException $e) {
			 if ($e->hasResponse()) {
				 echo Psr7\str($e->getResponse());
			 }
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		 }catch (\Exception $e){
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		 }
	}
 
	public function getDiagnosaProgramPrb(Request $request)
	{
		 try
		 {
			 $content = app(\App\Http\Controllers\ThirdParty\BPJS\VClaim\Referensi\DiagnosaPrbController::class)->getDiagnosaPrb();
 
			 #example-response
			 // $content = '{ "metaData": { "code": "200", "message": "Sukses" }, "response": { "list": [ { "kode": "00019100017", "nama": "Analog Insulin Long Acting inj 100 UI/ml" }, { "kode": "00012300016", "nama": "Analog Insulin Mix Acting inj 100 UI/ml" } ] } }';
 
			 return $content;
		 } catch (RequestException $e) {
			 if ($e->hasResponse()) {
				 echo Psr7\str($e->getResponse());
			 }
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		 }catch (\Exception $e){
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		 }
	}
 
	public function getObatGenerikPrb(Request $request)
	{
		try {
			 $content = app(\App\Http\Controllers\ThirdParty\BPJS\VClaim\Referensi\ObatGenerikController::class)->getObatGenerik($request);
 
			 #example-response
			 // $content = '{ "metaData": { "code": "200", "message": "Sukses" }, "response": { "list": [ { "kode": "00019100017", "nama": "Analog Insulin Long Acting inj 100 UI/ml" }, { "kode": "00012300016", "nama": "Analog Insulin Mix Acting inj 100 UI/ml" } ] } }';
 
			 return $content;
		} catch (RequestException $e) {
			 if ($e->hasResponse()) {
				 echo Psr7\str($e->getResponse());
			 }
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		 } catch (\Exception $e) {
			 app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
	}
}
