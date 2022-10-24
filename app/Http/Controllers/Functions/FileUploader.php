<?php

namespace App\Http\Controllers\Functions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use File;
use Image;

class FileUploader extends Controller
{
    static protected $imagemagick = "imagick";

    public function createThumbnail($now_date, $file_url, $origin){
        $picturePath = 'uploads/'.$origin.'/300x300/'.$now_date.'/';
        $name = substr($file_url, strrpos($file_url, '/')+1);
        $name = explode('.', $name);
        $ext = $name[1];
        $name = $name[0];
        if(in_array($ext, ['png', 'jpeg', 'jpg', 'bmp', 'gif', 'svg'])){
            $thumbnail_dir = rtrim(public_path(), '/').'/'.$picturePath;
            $name_thumbnail = $name.'_300x300.'.$ext;
            if (!file_exists($thumbnail_dir) && !is_dir($thumbnail_dir)) {
                mkdir($thumbnail_dir, 0777, true);
            }
            $img = Image::make(public_path().'/'.$file_url);
            $img->fit(300);
            $img->save($thumbnail_dir.$name_thumbnail);
            $path = $picturePath.$name_thumbnail;
            return [
                'path' => $path,
                'type' => 'image'];
        } else if(in_array($ext, ['mp4', '3gp', 'mkv', 'avi', 'webm', 'flv']))
            return [
                'path' => 'assets/icons/svg/video.svg',
                'type' => 'video'];
        else if(in_array($ext, ['docx', 'doc']))
            return [
                'path' => 'assets/icons/svg/word.svg',
                'type' => 'word'];
        else if(in_array($ext, ['xls', 'xlsx']))
            return [
                'path' => 'assets/icons/svg/excel.svg',
                'type' => 'excel'];
        else if($ext == 'pdf')
        {
            if(extension_loaded(self::$imagemagick))
            {
                $target_im = 'uploads/'.$origin.'/300x300/'.$name.'_300x300.jpg';
                // exec('convert -thumbnail "1280x800>" -density 300 -background white -alpha remove '.public_path().'/'.$file_url.' '.public_path().$target_im);
                $im = new \Imagick();
                $im->setResolution(640, 480);     //set the resolution of the resulting jpg
                $im->setBackgroundColor('white');
                $im->readImage(public_path().'/'.$file_url.'[0]');    //[0] for the first page
                $im->setImageFormat('jpg');
                $im->scaleImage(500, 500, true);
                $im->mergeImageLayers(\Imagick::LAYERMETHOD_FLATTEN);
                $im->setImageAlphaChannel(\Imagick::ALPHACHANNEL_REMOVE);
                file_put_contents(public_path().'/'.$target_im, $im);
                return [
                    'path' => $target_im,
                    'type' => 'pdf'];                
            }
            else
            {
                return [
                    'path' => 'assets/icons/svg/pdf.svg',
                    'type' => 'pdf'];
            }
        }
        else {
            return [
                'path' => 'assets/icons/svg/contract.svg',
                'type' => 'other'];            
        }
    }
}