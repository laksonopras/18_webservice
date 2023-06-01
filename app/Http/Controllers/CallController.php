<?php

namespace App\Http\Controllers;

use App\Models\Call;
use Illuminate\Http\Request;

class CallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $call = Call::all();
        return response()->json([
            'status' => true,
            'message' => 'Show all Call',
            'Call' => $call
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

        $call = Call::create([
            'user_id' => $request->user_id,
            'partner_id' => $request->partner_id,
            'user_coordinate' => $request->user_coordinate,
            'order_status' => $request->sub_price,

        ]);
        return response()->json([
            'status' => true,
            'message' => 'input success',
            'call' => $call
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
        $call = Call::find($id);
        return response()->json([
            'status' => true,
            'message' => 'Show Call success',
            'call' => $call
        ]);
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
        $call = Call::find($id);
        $call->update([
            'user_id' => $request->user_id,
            'partner_id' => $request->partner_id,
            'user_coordinate' => $request->user_coordinate,
            'order_status' => $request->sub_price,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Call has updated',
            'call' => $call
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Call::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'delete success',
        ], 400);
    }
}
