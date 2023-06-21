<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Models\Partner;
use App\Models\User;
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
            'link_google_map' => $request->link_google_map,
            'message' => $request->message,
            'order_status' => 1,
            'address' => $request->address
        ]);
        $user = User::find($call->user_id);
        $user->ordering = $call->id;
        $user->save();
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
        $call = Call::find($id)->with(['progres']);
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
        $call = Call::where('user_id', auth('user')->user()->id)->where('order_status', '>=', 6 )->with(['partner', 'progres'])->orderBy('created_at', 'DESC')->get();
        return response()->json([
            'status' => true,
            'message' => 'Show all data',
            'call' => $call
        ]);
    }

    public function processing(){
        $call = Call::where('user_id', auth('user')->user()->id)->where('order_status', '<', 6 )->with(['partner', 'progres'])->orderBy('created_at', 'DESC')->get();
        return response()->json([
            'status' => true,
            'message' => 'Show all data',
            'call' => $call
        ]);
    }

    public function historyPartner($id)
    {
        $call = Call::where('partner_id', $id)->with(['user', 'progres'])->orderBy('created_at', 'DESC')->get();
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

        if($call->order_status >= 6){
            $user = User::find($call->user_id);
            $user->ordering = 0;
            $user->save();
            if($call->order_status == 6){
                $partner = Partner::find($call->partner_id);
                $partner->update(['count_order' => $partner->count_order + 1]);
            }
        }
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
