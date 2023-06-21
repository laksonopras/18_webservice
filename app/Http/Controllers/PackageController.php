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
    public function store(Request $request)
    {
        $package = Package::create([
            'package_name' => $request->package_name,
            'count_month' => $request->count_month,
            'price' => $request->price,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'package has added',
            'package' => $package
        ]);
    }

    public function show($id)
    {
        $package = Package::find($id);
        return response()->json([
            'status' => true,
            'message' => 'Show package',
            'categories' => $package
        ]);
    }

    public function update(Request $request, $id)
    {
        $package = Package::find($id);
        $package->update([
            'package_name' => $request->package_name,
            'count_month' => $request->count_month,
            'price' => $request->price,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'package has updated',
            'categories' => $package
        ]);
    }

    public function destroy($id)
    {
        Package::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'package has deleted'
        ]);
    }
}
