<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Technician;

class TechnicianController extends Controller
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
            'email' => ['required', 'email', 'unique:technicians'],
            'password' => ['required', 'min:8'],
        );
        
        $validate = Validator::make($request->all(), $rules);
        if($validate->fails()){
            return response()->json([
                'status' => false,
                'message' => $validate->messages()->first()
            ]);
        } else {
            $technician = Technician::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            return response()->json([
                'status' => true,
                'message' => 'successfully register',
                'technician' => [
                    'username' => $technician->username,
                    'email' => $technician->email
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

        if (!$token = Auth::guard('technician')->attempt($credentials)) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }
        $technician = technician::where('email', $request->email)->first();
        $technician->token = $token; 
        $technician->save();      
        return response()->json([
            'status' => true,
            'message' => 'successfully login',
            'technician' => $technician
        ],400);
    }

    public function logout()
    {

        auth('technician')->logout();

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
        $technician = auth('technician')->user();
        if($technician){
            return response()->json([
                'status' => true,
                'message' => 'Show All Data',
                'technician' => $technician
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
