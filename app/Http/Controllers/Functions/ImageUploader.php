<?php

namespace App\Http\Controllers\Functions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use File;
use Image;

class ImageUploader extends Controller
{
    	public function upload($file,$type, $file_type = 'image')
    	{
            $ext_document = ['pdf','csv','xml','xls','xlsx'];
            $ext_image = ["jpg", "png", "jpeg", "bmp", "svg", "webp"];
            $ext_video = ["mp4", "webm", "3gp"];
            // if ttd get only directory
            if($type =='ttd'){
                $data = $this->getPathTtd('png');
            }
            else {
                $ext = $file->extension();
                
                if($type =='pasien'){
                    $data = $this->getPathPasien($ext);
                } 
                elseif($type =='poliklinik'){
                    $data = $this->getPathPoliklinik($ext);
                } 
                elseif($type =='user'){
                    $data = $this->getPathUser($ext);
                } 
                elseif($type =='grup'){
                    $data = $this->getPathGrup($ext);
                } 
                elseif($type =='banner'){
                    $data = $this->getPathGrupBanner($ext);
                }
                elseif($type =='rawatinap'){
                    $data = $this->getPathRawatInap($ext);
                }
                elseif($type =='penunjang'){
                    $data = $this->getPathPenunjang($ext);
                }
                elseif($type =='faktur'){
                    $data = $this->getPathFaktur($ext);
                }
                elseif($type == 'asset'){
                    $data = $this->getPathAsset($ext);
                } 
                elseif($type == 'asset-logo-rs-online'){
                    $data = $this->getPathLogoRsOnline($ext);
                }
                elseif($type == 'identitypasien'){
                    $data = $this->getPathIdentityPasien($ext);
                }
                elseif($type == 'psikologi'){
                    $data = $this->getPathPsikologi($ext);
                }
                elseif($type == 'it'){
                    $data = $this->getPathIt($ext);
                }
                elseif($type == 'e-usulan'){
                    $data = $this->getPathEusulan($ext);
                }
                elseif($type == 'data-import'){
                    //dilakukan karena ada bug xlsx terbaca ZIP
                    $ext_new = explode(".", $file->getClientOriginalName());
                    $ext_new = $ext_new[count($ext_new)-1];
                    $ext = $ext_new;
                    $data = $this->getPathDataImport($ext,$file_type,$file);
                }
            }

            if ($type == 'ttd') {
                if (!file_exists($data['public_path']) && !is_dir($data['public_path'])) {
                    mkdir($data['public_path'], 0777, true);         
                }
            } 
            elseif(in_array($ext, $ext_document))
            {
                $uploaded_file = $file->store($data['path']);
                Storage::setVisibility($uploaded_file, 'public');

                if (!file_exists($data['public_path']) && !is_dir($data['public_path'])) {
                    mkdir($data['public_path'], 0777, true);
                }

                File::move(storage_path('app').'/'.$uploaded_file, public_path().'/'.rtrim($data['public_path'], '/').'/'.$data['name']);
            }
            else {
                #di store dulu di storage
                $uploaded_file = $file->store($data['path']);
                #di public in biar bisa diakses
                Storage::setVisibility($uploaded_file, 'public');

                #di move
                if (!file_exists($data['public_path']) && !is_dir($data['public_path'])) {
                    mkdir($data['public_path'], 0777, true);         
                }
                File::move(storage_path('app').'/'.$uploaded_file, public_path().'/'.rtrim($data['public_path'], '/').'/'.$data['name']);

                #create_thumbnail
                if($type != 'banner' && $type != 'faktur' && $file_type != 'video' && $type != 'psikologi'){
                    $thumbnail_dir = rtrim($data['public_path'], '/').'/'.$data['folder_thumbnail'].'/';
                    if (!file_exists($thumbnail_dir) && !is_dir($thumbnail_dir)) {
                        mkdir($thumbnail_dir, 0777, true);
                    }
                    $img = Image::make($data['public_path'].'/'.$data['name']);
                    $img->fit($data['size']);
                    $img->save($thumbnail_dir.$data['name_thumbnail']);
                    $data['file_thumbnail'] = $thumbnail_dir.$data['name_thumbnail'];
                } else {
                    $data['file_thumbnail'] = 'assets/img/placeholder.jpg';
                }
            }

    		#declare for return
    		$data['file_original'] = $data['public_path'].$data['name'];

    		return $data;

    	}

        public function uploadBase64($file,$type)
        {
            if($type =='user'){
                $data = $this->getPathUser('jpg');
            } 

            $img = Image::make(file_get_contents($file))->save($data['public_path'].$data['name']);
            return $data['public_path'].$data['name'];
        }

    	private function getPathPasien($ext)
    	{
    		$dateTime = date('dmYHis');

    		$data['name_original'] = 'MedifyPatientImage-'.$dateTime.'-'.str_random(10);
    		$data['name']= $data['name_original'].'.'.$ext;
    		$data['path'] = 'public/pasien';
    		$data['public_path'] = 'uploads/pasien/';
    		$data['name_thumbnail'] = $data['name_original'].'_300x300.'.$ext;
    		$data['size'] = 300;
    		$data['folder_thumbnail'] = '300x300';
    		return $data;
        }
        
        private function getPathIdentityPasien($ext)
    	{
    		$dateTime = date('dmYHis');

    		$data['name_original'] = 'MedifyIdentityPatientImage-'.$dateTime.'-'.str_random(10);
    		$data['name']= $data['name_original'].'.'.$ext;
    		$data['path'] = 'public/pasien';
    		$data['public_path'] = 'uploads/pasien/';
    		$data['name_thumbnail'] = $data['name_original'].'_300x300.'.$ext;
    		$data['size'] = 300;
    		$data['folder_thumbnail'] = '300x300';
    		return $data;
    	}


        private function getPathPoliklinik($ext)
        {
            $dateTime = date('dmYHis');

            $data['name_original'] = 'MedifyPoliklinikLogo-'.$dateTime.'-'.str_random(10);
            $data['name']= $data['name_original'].'.'.$ext;
            $data['path'] = 'public/poliklinik';
            $data['public_path'] = 'uploads/rawatjalan/poliklinik/';
            $data['name_thumbnail'] = $data['name_original'].'_300x300.'.$ext;
            $data['size'] = 300;
            $data['folder_thumbnail'] = '300x300';
            return $data;
        }


        private function getPathUser($ext)
        {
            $dateTime = date('dmYHis');

            $data['name_original'] = 'MedifyUser-'.$dateTime.'-'.str_random(10);
            $data['name']= $data['name_original'].'.'.$ext;
            $data['path'] = 'public/users';
            $data['public_path'] = 'uploads/users/';
            $data['name_thumbnail'] = $data['name_original'].'_300x300.'.$ext;
            $data['size'] = 300;
            $data['folder_thumbnail'] = '300x300';
            return $data;
        }

        private function getPathGrup($ext)
        {
            $dateTime = date('dmYHis');

            $data['name_original'] = 'MedifyGrup-'.$dateTime.'-'.str_random(10);
            $data['name']= $data['name_original'].'.'.$ext;
            $data['path'] = 'public/grup';
            $data['public_path'] = 'uploads/groups/photo/';
            $data['name_thumbnail'] = $data['name_original'].'_300x300.'.$ext;
            $data['size'] = 300;
            $data['folder_thumbnail'] = '300x300';
            return $data;
        }

        private function getPathGrupBanner($ext)
        {
            $dateTime = date('dmYHis');

            $data['name_original'] = 'MedifyGrupBanner-'.$dateTime.'-'.str_random(10);
            $data['name']= $data['name_original'].'.'.$ext;
            $data['path'] = 'public/banner';
            $data['public_path'] = 'uploads/groups/banner/';
            return $data;
        }

        private function getPathRawatInap($ext)
        {
            $dateTime = date('dmYHis');

            $data['name_original'] = 'MedifyFacilityImage-'.$dateTime.'-'.str_random(10);
            $data['name']= $data['name_original'].'.'.$ext;
            $data['path'] = 'public/rawatinap';
            $data['public_path'] = 'uploads/rawatinap/';
            $data['name_thumbnail'] = $data['name_original'].'_300x300.'.$ext;
            $data['size'] = 300;
            $data['folder_thumbnail'] = '300x300';
            return $data;
        }

        private function getPathPenunjang($ext)
        {
            $dateTime = date('dmYHis');

            $data['name_original'] = 'MedifyKasusPenunjang-'.$dateTime.'-'.str_random(10);
            $data['name']= $data['name_original'].'.'.$ext;
            $data['path'] = 'public/penunjang';
            $data['public_path'] = 'uploads/kasus/penunjang/';
            $data['name_thumbnail'] = $data['name_original'].'_300x300.'.$ext;
            $data['size'] = 300;
            $data['folder_thumbnail'] = '300x300';
            return $data;
        }

        private function getPathTtd($ext)
        {
            $dateTime = date('dmYHis');

            $data['name_original'] = 'MedifyKasusTTDPasien-'.$dateTime.'-'.str_random(10);
            $data['name']= $data['name_original'].'.'.$ext;
            $data['path'] = 'public/ttd';
            $data['public_path'] = 'uploads/kasus/ttd/';
            $data['name_thumbnail'] = $data['name_original'].'_300x300.'.$ext;
            $data['size'] = 300;
            $data['folder_thumbnail'] = '300x300';
            return $data;
        }

        private function getPathFaktur($ext)
        {
            $dateTime = date('dmYHis');

            $data['name_original'] = 'MedifyPengeluaranFaktur-'.$dateTime.'-'.str_random(10);
            $data['name']= $data['name_original'].'.'.$ext;
            $data['path'] = 'public/faktur';
            $data['public_path'] = 'uploads/keuangan/faktur/';
            return $data;
        }

        private function getPathAsset($ext)
        {
            $dateTime = date('dmYHis');

            $data['name_original'] = 'logo-'.$dateTime.'-'.str_random(10);
            $data['name']= $data['name_original'].'.'.$ext;
            $data['path'] = 'public';
            $data['public_path'] = 'uploads/';
            $data['name_thumbnail'] = $data['name_original'].'_150x150.'.$ext;
            $data['size'] = 150;
            $data['folder_thumbnail'] = '150x150';
            return $data;
        }

        private function getPathLogoRsOnline($ext)
        {
            $dateTime = date('dmYHis');

            $data['name_original'] = 'logo-header-rs-online';
            $data['name']= $data['name_original'].'.png'; // must .png
            $data['path'] = 'public';
            $data['public_path'] = 'uploads/';
            $data['name_thumbnail'] = $data['name_original'].'_150x150.png';
            $data['size'] = 150;
            $data['folder_thumbnail'] = '150x150';
            return $data;
        }

        private function getPathDataImport($ext,$jenis,$file)
        {
            $dateTime = Carbon::now()->timestamp;
            $original_name = $file->getClientOriginalName();
            $original_name = str_replace(".".$ext, "", $original_name);
            $data['name_original'] = $jenis.'--'.$original_name.'--'.$dateTime;
            $data['name']= $data['name_original'].'.'.$ext;
            $data['path'] = 'public';
            $data['public_path'] = 'uploads/data-import';
            return $data;
        }

        private function getPathPsikologi($ext)
        {
            $dateTime = date('dmYHis');

            $data['name_original'] = 'psikologi-'.$dateTime.'-'.str_random(10);
            $data['name']= $data['name_original'].'.'.$ext;
            $data['path'] = 'public/psikologi';
            $data['public_path'] = 'uploads/psikologi/';
            $data['name_thumbnail'] = $data['name_original'].'_300x300.'.$ext;
            $data['size'] = 300;
            $data['folder_thumbnail'] = '300x300';
            return $data;
        }

    private function getPathIt($ext)
    {
        $dateTime = date('dmYHis');

        $data['name_original'] = 'it-komplain-'.$dateTime.'-'.str_random(10);
        $data['name']= $data['name_original'].'.'.$ext;
        $data['path'] = 'public/it';
        $data['public_path'] = 'uploads/it/';
        $data['name_thumbnail'] = $data['name_original'].'_300x300.'.$ext;
        $data['size'] = 300;
        $data['folder_thumbnail'] = '300x300';
        return $data;
    }
    private function getPathEusulan($ext)
    {
        $dateTime = date('dmYHis');

        $data['name_original'] = 'e-usulan-'.$dateTime.'-'.str_random(10);
        $data['name']= $data['name_original'].'.'.$ext;
        $data['path'] = 'public/eusulan';
        $data['public_path'] = 'uploads/eusulan/';
        $data['name_thumbnail'] = $data['name_original'].'_300x300.'.$ext;
        $data['size'] = 300;
        $data['folder_thumbnail'] = '300x300';
        $data['ext'] = $ext;
        return $data;
    }
}
