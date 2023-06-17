<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\DateStatus;
use App\Models\Package;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::orderBy('created_at')->get();

        // Add date/time information to each transaction object
        foreach ($transactions as $transaction) {
            $transaction->date_time = $transaction->created_at->format('Y-m-d H:i:s');
        }

        return response()->json([
            'status' => true,
            'message' => 'Show all transactions',
            'transactions' => $transactions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function forMitra()
    {
        $transaction = Transaction::where('partner_id', auth('user')->user()->partner_id)->get();
        
        return response()->json([
            'status' => true,
            'message' => 'Show all transactions',
            'transaction' => $transaction
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // try {
            $package = Package::find($request->package_id);
            $transaction = Transaction::create([
                'id' => Uuid::uuid4()->toString(),
                'package_name' => $package->package_name,
                'count_month' => $package->count_month,
                'price' => $package->price,
                'date_start' => $request->date_start,
                'date_end' => date('Y-m-d', strtotime("+ $package->count_month month", strtotime( $request->date_start ))),
                'partner_id' => auth('user')->user()->partner_id,
                'admin_id' => Admin::inRandomOrder()->first()->id,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'input success',
                'transaction' => $transaction
            ]);
        // } catch (Exception $e) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Transaction failed'
        //     ]);
        // }
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
    public function status(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        $transaction->update([
            'status' => $request->status,
            'admin_id' => auth('admin')->user()->id
        ]);
        if ($transaction->status == 0) {
            return response()->json([
                'status' => false,
                'message' => "Bukti tidak valid",
                'transaction' => $transaction
            ]);
        } else {
            $date_start = date('d-m-Y  H:i:s');
            $date_status = DateStatus::create([
                'partner_id' => $transaction->partner_id,
                'transaction_id' => $transaction->id,
                'date_start' => $date_start,
                'date_end' => date('d-m-Y  H:i:s', strtotime($transaction->quantity, strtotime($date_start)))
            ]);
            return response()->json([
                'status' => true,
                'message' => "Transaction accepted",
                'transaction' => $date_status
            ]);
        }
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
        if ($request->file('payment_proof')) {
            if ($transaction->payment_proof && Storage::exists($transaction->payment_proof)) {
                Storage::delete($transaction->payment_proof);
            }
            $transaction->payment_proof = Storage::putFile('payment_proof', $request->file('payment_proof'));
        }
        if ($request->status || $request->status == 0) {
            $transaction->status = $request->status;
        }

        $transaction->save();

        // $transaction->update([
        //     'payment_proof' => $request->payment_proof,
        // ]);
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
        ]);
    }
}
