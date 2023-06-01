<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
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
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8'],
        );

        $validate = Validator::make($request->all(), $rules);
        if($validate->fails()){
            return response()->json([
                'status' => false,
                'message' => $validate->messages()
            ]);
        } else {
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return response()->json([
                'status' => true,
                'message' => 'successfully register',
                'user' => $user
            ]);
        }
    }

    /**
     * Authentication for a user.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        $credentials = request(['email', 'password']);

        if (!$token = Auth::guard('user')->attempt($credentials)) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ]);
        }
        $user = User::where('email', $request->email)->first();
        $user->remember_token = $token; 
        $user->save();      
        return response()->json([
            'status' => true,
            'message' => 'successfully login',
            'token' => $user->remember_token,
            'user' => $user
        ],200);
    }

    public function logout()
    {

        auth('user')->logout();
        return response()->json([
            'status' => true,
            'message' => 'Successfully logged out'
        ],200);
    }

    public function setAvatar(Request $request){
        $user = User::find(auth('user')->user()->id);
        if($user->avatar && Storage::exists($user->avatar)){
            Storage::delete($user->avatar);
        }
        $user->avatar = Storage::putFile('avatar', $request->file('avatar'));
        $user->save();


        // $user->update([
        //     'avatar' => Storage::putFileAs('avatar', $request->file('avatar'))
        // ]);
        return response()->json([
            'status' => true,
            'message' =>'succes',
            'user' =>$user
        ]);
    }

    public function getAvatar($id){

        $user = User::find($id);
        return response()->file( Storage::disk('local')->path($user->avatar)); //PAKE YANG INI
    }
    public function getUserAvatar(){

        $user = User::find(auth('user')->user()->id);
        return response()->file( Storage::disk('local')->path($user->avatar)); //PAKE YANG INI
        //return response()->json($user);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return response()->json([
            'status' => true,
            'message' =>'Show all user',
            'users' => $user
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
        $user = auth('user')->user();
        if($user){
            return response()->json([
                'status' => true,
                'message' => 'Show All Data',
                'user' => $user
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
    public function update(Request $request)
    {
        $user = User::find(auth('user')->user()->id);
        if($request->username){
            $user->username = $request->username;
        }
        if($request->phone_number){
            $user->phone_number = $request->phone_number;
        }
        if($request->file('avatar')){
            if($user->avatar && Storage::exists($user->avatar)){
                Storage::delete($user->avatar);
            }
            $user->avatar = Storage::putFile('avatar', $request->file('avatar'));
        }
        $user->save();
        return response()->json([
            'status' => true,
            'message' =>'succes',
            'user' =>$user
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
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'status' => true,
            'message' => 'User has deleted'
        ]);
    }
}
