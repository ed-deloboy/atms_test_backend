<?php

namespace App\Http\Controllers\Api;



use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 401);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => "Пользователь не найден",
            ], 401);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => "Не верный пароль",
            ], 401);
        }

        $access_token =  $user->createToken(config('app.name'))->accessToken;

        return response()->json([
            'status' => true,
            'user_id' => $user->id,
            'user_email' => $user->email,
            "token_type" => "Bearer",
            'access_token' => $access_token,
        ], 200);
    }

    public function register(Request $request)
    {
        $generate_pass = 12345678;

        $input = $request->all();
        $input['phone'] = preg_replace("/[^+0-9]/s", "", strip_tags(trim($request->phone)));
        $validator = Validator::make($input, [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:6|max:20|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 500);
        }

        $input['password'] = Hash::make($generate_pass);
        $user = User::create($input);
        $success['token'] = $user->createToken(config('app.name'))->accessToken;

        return response()->json([
            'status' => true,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'token_type' => 'Bearer',
            'token' => $success['token'],
        ], 200);
    }
}
