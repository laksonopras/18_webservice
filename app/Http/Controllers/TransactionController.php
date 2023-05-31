<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::all();
        return response()->json([
            'status' => true,
            'message' => 'Show all transaction',
            'transaction' => $transaction
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
        $transaction = Transaction::create([
            'quantity' => $request->quantity,
            'admin_id' => auth('admin')->user()->id,
            'sub_price' => $request->sub_price,
            'price' => $request->price,
            'partner_id' => $request->partner_id
        ]);
        return response()->json([
            'status' => true,
            'message' => 'input success',
            'transaction' => $transaction
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
        $transaction = Transaction::find($id);
        return response()->json([
            'status' => true,
            'message' => 'Show transaction success',
            'transaction' => $transaction
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
        $transaction = Transaction::find($id);
        $transaction->update([
            'quantity' => $request->quantity,
            'admin_id' => auth('admin')->user()->id,
            'sub_price' => $request->sub_price,
            'price' => $request->price,
            'partner_id' => $request->partner_id
        ]);
        return response()->json([
            'status' => true,
            'message' => 'transaction has updated',
            'transaction' => $transaction
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
        Transaction::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'delete success',
        ], 400);
    }
}
