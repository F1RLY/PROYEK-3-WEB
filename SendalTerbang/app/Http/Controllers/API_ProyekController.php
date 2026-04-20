<?php

namespace App\Http\Controllers;

use App\Models\proyek;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class API_ProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($index = 1)
    {
        try {
            $limit = 20;
            $proyekQuery = proyek::orderBy("updated_at", "desc")->offset(pow(10, $index-1)-1)->take($limit)->get();
            $proyekData = [];
            foreach($proyekQuery as $proyek){
                $proyekSingleData = proyekController::getProyekById($proyek['id']);
                array_push($proyekData, $proyekSingleData);
            }
            $response = [
                "massage" => "successfull get proyek data",
                "success" => true,
                "data" => $proyekData
            ];
            return response()->json($response, Response::HTTP_OK );
        } catch (\Throwable $th) {
            $response = [
                "massage" => "failed to get proyek data",
                "success" => false,
                "data" => null
            ];
            return response()->json($response, Response::HTTP_OK );
        }
    }

        public function getProyekDataByKeyword($keyword = "")
    {
        try {
            $limit = 10;
            $proyekData = proyekController::getProyekByKeyWord($keyword);
            $response = [
                "massage" => "successfull get proyek data",
                "success" => true,
                "data" => $proyekData
            ];
            return response()->json($response, Response::HTTP_OK );
        } catch (\Throwable $th) {
            $response = [
                "massage" => "failed to get proyek data",
                "success" => false,
                "data" => null
            ];
            return response()->json($response, Response::HTTP_OK );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(proyek $proyek)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, proyek $proyek)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(proyek $proyek)
    {
        //
    }
}
