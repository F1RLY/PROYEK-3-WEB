<?php

namespace App\Http\Controllers;

use App\Models\video;
use Illuminate\Http\Request;

class videoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public static function getVideoListFromProyekId(int $proyekId){
        $videoList = video::select('videoCode' ,'lokasi')->where('proyekId', $proyekId)->get();
        return $videoList;
    }
}
