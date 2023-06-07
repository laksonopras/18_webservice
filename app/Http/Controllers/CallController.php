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
    public function store(Request $request, $id)
    {
        $call = Call::create([
            'user_id' => auth('user')->user()->id,
            'partner_id' => $id,
            'user_coordinate' => 0,
            'message' => $request->message

        ]);
        return response()->json([
            'status' => true,
            'message' => 'your call is being processed',
            'call' => $call
        ]);
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
            'message' => 'Show all data',
            'call' => $call
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function historyUser()
    {
        $call = Call::where('user_id', auth('user')->user()->id)->with(['partner'])->get();
        return response()->json([
            'status' => true,
            'message' => 'Show all data',
            'call' => $call
        ]);
    }
    public function historyPartner($id)
    {
        $call = Call::where('partner_id', $id)->with('user')->get();
        return response()->json([
            'status' => true,
            'message' => 'Show all data',
            'call' => $call
        ]);
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
            'order_status' => $request->order_status,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'progress has been continued',
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
        ]);
    }
}
