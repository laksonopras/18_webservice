<?php

namespace App\Http\Controllers;

use App\Models\Kemajuan;
use Illuminate\Http\Request;

class ProgresController extends Controller
{
    public function index(){
        $progres = Kemajuan::all();
        return response()->json([
            'status' => true,
            'message' => 'All progres has showed',
            'progres' => $progres
        ]);
    }
}
