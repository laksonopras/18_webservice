<?php

namespace App\Http\Controllers;

use App\Models\Img_partner;
use Illuminate\Http\Request;

class ImagePartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $img_partner = Img_partner::all();
        return response()->json([
            'status' => true,
            'message' => 'input success',
            'img_partner' => $img_partner
        ], 400);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $img_partner = Img_partner::create([
            'partner_id' => $request->partner_id_partner,
            'img_path' => $request->img_partners

        ]);
        return response()->json([
            'status' => true,
            'message' => 'input success',
            'img_partner' => $img_partner
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
        $img_partner = Img_partner::all();
        return response()->json([
            'status' => true,
            'message' => 'input success',
            'img_partner' => $img_partner
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
        $img_partner = Img_partner::find($id);
        $img_partner->update([
            'partner_id' => $request->partner_id,
            'img_path' => $request->image_path

        ]);

        $img_partner->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Img_partner::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'input success',
        ], 400);
    }
}
