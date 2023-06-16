<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(){
        $package = Package::all();
        return response()->json([
            'status' => true,
            'message' => 'Show all package',
            'package' => $package
        ]);
    }
}
