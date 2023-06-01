<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Banner;
use App\Models\Partner;
use App\Models\SquareFeed;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GetPictController extends Controller
{
    public function getBanner($id){
        try {
            $banner = Banner::find($id);
            return response()->file( Storage::disk('local')->path($banner->img_path));
        }catch (Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'image not available'
            ]);
        }
        
    }
    public function getSquareFeed($id){
        try {
            $squarefeed = SquareFeed::find($id);
            return response()->file( Storage::disk('local')->path($squarefeed->img_path));
        }catch (Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'image not available'
            ]);
        }
    }
    public function getPartner($id)
    {
        try{
            $partner = Partner::find($id);
            return response()->file(Storage::disk('local')->path($partner->avatar));
        }catch (Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'image not available'
            ]);
        }
    }
    public function getUserbyToken(){
        try{
            $user = User::find(auth('user')->user()->id);
            return response()->file( Storage::disk('local')->path($user->avatar));
        }catch (Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'image not available'
            ]);
        }
    }
    public function getUserbyId($id){
        try{
            $user = User::find($id);
            return response()->file( Storage::disk('local')->path($user->avatar));
        }catch (Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'image not available'
            ]);
        }
    }
    public function getAdminbyToken(){
        try{
            $admin = Admin::find(auth('admin')->user()->id);
            return response()->file( Storage::disk('local')->path($admin->avatar));
        }catch (Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'image not available'
            ]);
        }
    }
    public function getAdminbyId($id){
        try{
            $admin = Admin::find($id);
            return response()->file( Storage::disk('local')->path($admin->avatar));
        }catch (Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'image not available'
            ]);
        }
    }
}
