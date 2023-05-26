<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::all();
        return response()->json([
            'status' => true,
            'message' => 'input success',
            'banner' => $banner
        ], 400);
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
        $banner = Banner::create([
            'img' => $request->banner,
            'admin_id' => $request->admin_id
        ]);
        return response()->json([
            'status' => true,
            'message' => 'input success',
            'banner' => $banner
        ], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banner = Banner::where('id', 'like', $id)->get()->first();
        return response()->json([
            'status' => true,
            'message' => 'input success',
            'banner' => $banner
        ], 400);
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
        $banner = Banner::find($id);
        $banner->update([
            'img' => $request->banner,
            'admin_id' => $request->admin_id,
        ]);

        if ($request->banner) {
            $banner->img = $request->banner;
        }
        if ($request->banner) {
            $banner->admin_id = $request->admin_id;
        }
        $banner->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Banner::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'input success',
        ], 400);
    }
}
