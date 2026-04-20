<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\gambar;
use App\Models\gambarProyek;
use App\Models\Proyek;

class gambarController extends Controller
{
    
    public static function getAllProjectImageByProjectId( int $id ){
        $imageProyekArr = gambarProyek::where('proyekId', $id)->get();
        $imageLocationArr = array();

        foreach($imageProyekArr as $proyekImg){
            $imageId = $proyekImg['gambarId'];
            $imagesQuery = gambar::where('id', $imageId)->get()->first();
            $imageData = [
                'lokasi' => $imagesQuery['lokasi'],
                'imageID' => $imagesQuery['imageCode']
            ];
            array_push($imageLocationArr, $imageData);
        }

        return $imageLocationArr;
    }

    public static function getAllProjectImageByRepoCode($repoCode){
        $proyekID = proyek::where('repoCode', $repoCode)->get()->first()['id'];
        $imageArr = self::getAllProjectImageByProjectId($proyekID);
        return $imageArr;
    }

    public static function checkImageFile( array &$file ){
        $response = [
            'massage' => '',
            'success' => false,
        ];
        $allowed = array('jpg', 'jpeg', 'png');

        $fileExt = explode('.', $file['name']);
        $fileActualExt = strtolower(end($fileExt));

        if( !in_array($fileActualExt, $allowed)){
            $response['massage'] = 'you canot upload file of this type';
            return $response;
        }
        if( $file['error'] === 1 ){
            $response['massage'] = 'something wrong with your image';
            return $response;
        }
        if( (int)$file['size'] > 500000 ){
            $response['massage'] = 'maximum image is 20mb';
            return $response;
        }

        $response['massage'] = 'image success';
        $response['success'] = true;

        return $response;
    }

    public static function uploadProyekImage(&$proyekId, Request $request, &$image, $key){
        if( isset( $image ) ){
            
            $request->validate([
                $key => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            ]);
            
            $newImageName = uniqid().".".request()->file($key)->getClientOriginalExtension();

            $newGambar = gambar::create([
                'lokasi' => $newImageName,
                'imageCode' => uniqid()
            ]);
            $newGambarProyek = gambarProyek::create([
                'proyekId' => $proyekId,
                'gambarId' => $newGambar->id
            ]);
            request()->file($key)->move( public_path('/images/proyek'), $newImageName );
        }
    }

    public static function deleteProyekImage(&$proyekId, $gambarProyekId){
        $gambar = gambar::where('id',  $gambarProyekId);
        $gambarProyek = gambarProyek::where('gambarId', $gambar->id);

        $gambarProyek->delete();
        $gambar->delete();
    }

    public static function updateProyekImage($repoCode, &$file){
        $proyekID = proyek::where('repoCode', $repoCode)->get()->first()['id'];
        $oldImageList = self::getAllProjectImageByRepoCode($repoCode);
        $gambarProyekIDArr = gambarProyek::where('proyekId', $proyekID)->get();

        for( $i=0 ; $i<count($file); $i++ ){
            $newImageName = $file[$i]['name'];
            $alreadyExist = false;
            foreach($oldImageList as $oldImage){
                if($oldImage['originalName'] == $newImageName){
                    $alreadyExist = true;
                    break;
                }
            }
            if($alreadyExist){
                self::uploadProyekImage($proyekID, $file[$i]);
            }
        }

        for($i=0; $i<count($oldImageList); $i++){
            $oldImageName = $oldImageList[$i]['originalName'];
            $alreadyExist = false;
            foreach($file as $fileItem){
                if($oldImageName == $fileItem['name']){
                    $alreadyExist = true;
                    break;
                }
            }
            if($alreadyExist){
                self::deleteProyekImage($proyekID, $oldImageList[$i]);
            }
        }
        
        foreach( $file as $img){
            self::uploadProyekImage($proyekID, $img);
        }

        $response = [
            'massage' => '',
            'success' => false,
        ];

        $response['massage'] = 'image success';
        $response['success'] = true;
        $response['jumlahFile'] = count($file);
        return $response;
    }

}
