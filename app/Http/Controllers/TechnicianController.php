<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
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
            return $validate->messages();
        } else {
            $technician = Technician::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'successfully register',
                'data' => [
                    'technician' => [
                        'username' => $technician->username,
                        'email' => $technician->email
                    ],
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

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $technician = Technician::where('email', $request->email)->first();
        $technician->token = $token; 
        $technician->save();
        return $this->respondWithToken($token);
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            //'expires_in' => auth('customers')->factory()->getTTL() * 60
        ]);
    }
    public function me()
    {
        return response()->json(auth()->user());
    }
}
