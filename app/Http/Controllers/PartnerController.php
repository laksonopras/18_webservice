<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'partner_name' => ['required'],
            'address' => ['required'],
            'avatar' => ['required'],
            'phone_number' => ['required'],
            'description' => ['required'],
            'category_id' => ['required']
        );

        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validate->messages()->first()
            ]);
        } else {
            $partner = partner::create([
                'partner_name' => $request->partner_name,
                'email' => $request->email,
                'address' => $request->address,
                'avatar' => Storage::putFile('avatar_partner', $request->file('avatar')),
                'phone_number' => $request->phone_number,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'coordinate' => 0,
                'user_id' => auth('user')->user()->id
            ]);
            $user = User::find(auth('user')->user()->id);
            $user->update(['role' => 1]);
            return response()->json([
                'status' => true,
                'message' => 'successfully register',
                'partner' => $partner
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partner = Partner::with(['category', 'admin'])->get();
        return response()->json([
            'status' => true,
            'message' => 'Show All Data',
            'partner' => $partner
        ]);
    }
    public function getOpenPartner()
    {
        $partner = Partner::where('account_status', 1)->where('operational_status', 1)->with(['category'])->get();
        return response()->json([
            'status' => true,
            'message' => 'Show All Data',
            'partner' => $partner
        ]);
    }
    public function getActivePartner()
    {
        $partner = Partner::where('account_status', 1)->with(['category'])->get();
        return response()->json([
            'status' => true,
            'message' => 'Show All Data',
            'partner' => $partner
        ]);
    }
    public function getUnactivePartner()
    {
        $partner = Partner::where('account_status', 0)->with(['category'])->get();
        return response()->json([
            'status' => true,
            'message' => 'Show All Data',
            'partner' => $partner
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $partner = Partner::where('user_id', auth('user')->user()->id)->with(['category', 'admin'])->get()->first();
        if ($partner) {
            return response()->json([
                'status' => true,
                'message' => 'Show All Data',
                'partner' => $partner

            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized'
        ]);
    }

    public function showDetail($id)
    {

        $partner = Partner::with(['category', 'admin'])->find($id);
        if (!$partner) {
            return response()->json([
                'status' => false,
                'message' => 'Partner not found.'
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Partner details retrieved successfully.',
            'partner' => $partner
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


    public function updateForUser(Request $request){
        $partner = Partner::find(auth('user')->user()->id);
        if($request->partner_name){
            $partner->partner_name = $request->partner_name;
        }
        if($request->email){
            $partner->email = $request->email;
        }
        if($request->phone_number){
            $partner->phone_number = $request->phone_number;
        }
        if($request->address){
            $partner->address = $request->address;
        }
        if($request->coordinate){
            $partner->coordinate = $request->coordinate;
        }
        if($request->file('avatar')){
            if($partner->avatar && Storage::exists($partner->avatar)){
                Storage::delete($partner->avatar);
            }
            $partner->avatar = Storage::putFile('partner', $request->file('avatar'));
        }
        if($request->coordinate){
            $partner->coordinate = $request->coordinate;
        }
        if($request->description){
            $partner->description = $request->description;
        }
        if($request->operational_status){
            $partner->operational_status = $request->operational_status;
        }
        $partner->save();
        return response()->json([
            'status' => true,
            'message' =>'succes',
            'partner' => $partner
        ]);
    }

    public function updateForAdmin(Request $request, $id)
    {
        $partner = Partner::find($id);
        if($request->partner_name){
            $partner->partner_name = $request->partner_name;
        }
        if($request->email){
            $partner->email = $request->email;
        }
        if($request->phone_number){
            $partner->phone_number = $request->phone_number;
        }
        if($request->address){
            $partner->address = $request->address;
        }
        if($request->coordinate){
            $partner->coordinate = $request->coordinate;
        }
        if($request->file('avatar')){
            if($partner->avatar && Storage::exists($partner->avatar)){
                Storage::delete($partner->avatar);
            }
            $partner->avatar = Storage::putFile('partner', $request->file('avatar'));
        }
        if($request->description){
            $partner->description = $request->description;
        }
        if($request->operational_status){
            $partner->operational_status = $request->operational_status;
        }
        if($request->count_order){
            $partner->count_order = $request->count_order;
        }
        if($request->account_status){
            $partner->account_status = $request->account_status;
        }
        if($request->request_status){
            if($request->request_status == 0 ){
                $user = User::find(auth('user')->user()->id);
                $user->update(['role' => 0]);
            }
            $partner->request_status = $request->request_status;
        }
        $partner->save();
        return response()->json([
            'status' => true,
            'message' =>'succes',
            'partner' => $partner
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
        Partner::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'partner telah dihapus'
        ]);
    }
}