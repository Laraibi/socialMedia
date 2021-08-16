<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use hash



use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //
    public function register(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $success = true;
            $message = 'User register successfully';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $success = true;
            $message = 'User login successfully';
        } else {
            $success = false;
            $message = 'Unauthorised';
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
            // 'check' => Auth::check()
            // 'guard' => auth()->guard()->getName()
        ];
        return response()->json($response);
    }

    /**
     * Logout
     */
    public function logout()
    {
        try {
            Session::flush();
            $success = true;
            $message = 'Successfully logged out';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    public function editProfile(Request $request)
    {
        $request->validate(['user_id' => 'required', 'name' => 'required']);
        $user = User::find($request->user_id);
        if ($user) {
            $user->name = $request->name;
            $user->DateOfBirth = $request->Dob;
            $user->image_path = $request->user_image;
            $user->save();
            return response()->json($user);
        } else {
            return response('user not found', 404);
        }
    }

    public function getUsers()
    {
        $user = Auth::user();
        return response()->json(User::where('id', '<>', $user->id)->get());
    }

    public function getUser(Request $request)
    {
        $request->validate(['user_id' => 'required']);
        return response()->json(User::find($request->user_id));
    }
}
