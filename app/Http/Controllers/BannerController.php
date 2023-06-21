<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::with('admin')->get();
        return response()->json([
            'status' => true,
            'message' => 'Show all banner',
            'banner' => $banner
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'image' => ['required', File::types(['jpg', 'jpeg', 'png', 'gif'])->max(12 * 1024)]
        );

        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validate->messages()->first()
            ]);
        } else {
            $banner = Banner::create([
                'img_path' => Storage::putFile('banner', $request->file('image')),
                'admin_id' => auth('admin')->user()->id
            ]);
            return response()->json([
                'status' => true,
                'message' => 'input success',
                'banner' => $banner
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'image' => ['required', File::types(['jpg', 'jpeg', 'png', 'gif'])->max(12 * 1024)]
        );

        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validate->messages()->first()
            ]);
        } else {
            $banner = Banner::find($id);
            if ($banner->img_path && Storage::exists($banner->img_path)) {
                Storage::delete($banner->img_path);
            }
            $banner->img_path = Storage::putFile('banner', $request->file('image'));
            $banner->save();
            return response()->json([
                'status' => true,
                'message' => 'Banner has updated'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        $delete = Storage::delete($banner->img_path);
        $banner->delete();
        return response()->json([
            'status' => true,
            'message' => 'delete success',
        ]);
    }
}
