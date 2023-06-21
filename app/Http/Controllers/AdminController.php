<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function _construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {
        $rules = array(
            'username' => ['required'],
            'email' => ['required', 'email', 'unique:admins'],
            'password' => ['required', Rules\Password::defaults()]
        );

        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validate->messages()->first()
            ]);
        } else {
            $admin = Admin::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                
            ]);
            return response()->json([
                'status' => true,
                'message' => 'successfully register',
                'admin' => $admin
            ]);
        }
    }

    public function login(Request $request)
    {
        $rules = array(
            'email' => ['required', 'email'],
            'password' => ['required', Rules\Password::defaults()]
        );
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validate->messages()->first()
            ]);
        } else {
            $credentials = request(['email', 'password']);
            if (!$token = Auth::guard('admin')->attempt($credentials)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email and password invalid.'
                ]);
            }
            $admin = Admin::where('email', $request->email)->first();
            $admin->token = $token;
            $admin->save();
            return response()->json([
                'status' => true,
                'message' => 'successfully login',
                'token' => $admin->token,
                'admin' => $admin
            ]);
        }
    }

    public function logout()
    {
        $admin = Admin::where('email', auth('admin')->user()->email)->first();
        $admin->token = null;
        $admin->save();
        auth('admin')->logout();
        return response()->json([
            'status' => true,
            'message' => 'Successfully logged out'
        ]);
    }

    public function index()
    {
        $admin = Admin::all();
        return response()->json([
            'status' => true,
            'message' => 'Show all admin',
            'admin' => $admin
        ]);
    }

    public function getByToken()
    {
        $admin = Admin::find(auth('admin')->user()->id);

        return response()->json([
            'status' => true,
            'message' => 'Show all data',
            'admin' => $admin
            
        ]);
    }

    public function getById($id)
    {
        $admin = Admin::find($id);
        return response()->json([
            'status' => true,
            'message' => 'Show all data',
            'admin' => $admin
        ]);
    }

    public function update(Request $request)
    {
        $admin = Admin::find(auth('admin')->user()->id);
        if ($request->email) {
            $admin->email = $request->email;
        }
        if ($request->username) {
            $admin->username = $request->username;
        }
        if ($request->password) {
            $admin->password = bcrypt($request->password);
        }
        if ($request->file('avatar')) {
            if ($admin->avatar && Storage::exists($admin->avatar)) {
                Storage::delete($admin->avatar);
            }
            $admin->avatar = Storage::putFile('admin', $request->file('avatar'));
        }
        $admin->save();
        return response()->json([
            'status' => true,
            'message' => 'Show all data',
            'admin' => $admin
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
        Admin::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'admin has deleted'
        ]);
    }
}
