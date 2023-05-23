<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Partner;

class PartnerController extends Controller
{

    /**
     * Triggers an action that is not logged yet.
     * 
     * @return \Illuminate\Http\Response
     */
    public function _construct(){
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $rules = array(
            'username' => ['required'],
            'email' => ['required', 'email', 'unique:partners'],
            'password' => ['required', 'min:8'],
            'address' => ['required'],
            'coordinate' => ['required', 'float'],
            'description' => ['required'],
        );
        
        $validate = Validator::make($request->all(), $rules);
        if($validate->fails()){
            return response()->json([
                'status' => false,
                'message' => $validate->messages()->first()
            ]);
        } else {
            $partner = partner::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            return response()->json([
                'status' => true,
                'message' => 'successfully register',
                'partner' => [
                    'username' => $partner->username,
                    'email' => $partner->email
                ]
            ],400);
        }
    }

    /**
     * Authentication for a user.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        $credentials = request(['email', 'password']);

        if (!$token = Auth::guard('partner')->attempt($credentials)) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }
        $partner = Partner::where('email', $request->email)->first();
        $partner->token = $token; 
        $partner->save();      
        return response()->json([
            'status' => true,
            'message' => 'successfully login',
            'partner' => $partner
        ],400);
    }

    public function logout()
    {

        auth('partner')->logout();

        return response()->json([
            'status' => true,
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            ],400);
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
        //
    }
}
