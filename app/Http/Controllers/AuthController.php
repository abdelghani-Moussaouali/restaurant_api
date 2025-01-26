<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResouece;
use App\Models\Customer;

use App\Models\User;
use App\Models\Visiter;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $field = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);
        $user = User::create($field);
        Customer::create([
            'users_id' => $user->id,
        ]);
        $token = $user->createToken($request->name);
        return [
            'user' => new UserResouece($user),
            'token' => $token->plainTextToken,
        ];
    }
    public function update(Request $request)
    {

        $field = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);
        $user = $request->user();
        // $userRequest = User::find('id',$request->id);
        $user->update($field);
        $token = $user->createToken($request->name);
        return [
            'user' => new UserResouece($user),
            'token' => $token->plainTextToken,

        ];
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:8',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(
                ['message' => 'confirm your email & password and try again',],
                401,
            );
        } 
        $token = $user->createToken($user->name);
        return response()->json([
            'message' => 'you log in your compte secussfully',
            'token' => $token->plainTextToken,

        ], 200,);
    }
    public function logout(Request $request)
    {
        try {
            $request->user()->delete();
            $request->user()->tokens()->delete();
            return response()->json(
                [
                    'message' => 'you logout from your compte'
                ],
                200,
            );
        } catch (Exception $ex) {
            return response()->json(
                [
                    'message' => $ex->getMessage(),
                ],
                200,
            );
        }
    }
}
