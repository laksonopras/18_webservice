<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Partner;
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
        if($validate->fails()){
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
                'user_id' => auth('user')->user()->id
            ]);
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
        $partner = Partner::where('operational_status', 'where', 1)->with(['category'])->get();
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
        $partner = auth('partner')->user();
        if($partner){
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
        //
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
        ],400);
    }
    public function getAvatar($id){
        $partner = Partner::find($id);
        return response()->file( Storage::disk('local')->path($partner->avatar)); //PAKE YANG INI
        //return response()->json($user);
    }
}
