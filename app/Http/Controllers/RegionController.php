<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\PostalCode;
use App\Models\Province;
use App\Models\Village;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function getProvince(){
        $province = Province::all();
        return response()->json([
            'status' => true,
            'message' => 'Show all province list',
            'provinsi' => $province
        ]);
    }
    public function getCity($id){
        $city = City::where('province_id', $id)->get();
        return response()->json([
            'status' => true,
            'message' => 'Show all city list',
            'kota' => $city
        ]);
    }
    public function getDistrict($id){
        $district = District::where('city_id', $id)->get();
        return response()->json([
            'status' => true,
            'message' => 'Show all district list',
            'kecamatan' => $district
        ]);
    }
    public function getVillage($id){
        $village = Village::where('district_id', $id)->get();
        return response()->json([
            'status' => true,
            'message' => 'Show all village list',
            'kelurahan' => $village
        ]);
    }
    public function getPostalCode($id){
        $postalCode = Village::find($id)->with('Postal_code');
        return response()->json([
            'status' => true,
            'message' => 'Show all postal code',
            'kode_pos' => $postalCode
        ]);
    }
}
