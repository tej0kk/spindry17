<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserApiController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'password' => 'required'
            ],
            [
                'name.required' => 'username tidak boleh kosong !',
                'password.required' => 'password tidak boleh kosong !'
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'message' => json_decode($validator->errors())
                ]
            );
        }
        $credential = [
            'name' => $request->name,
            'password' => $request->password
        ];

        if (Auth::attempt($credential)) {
            $user = User::where('name', $request->name)->first();
            $token = $user->createToken('authToken')->plainTextToken;
            $user->token = $token;
            $user->token_type = 'Bearer';
            $data = [
                'status' => 'success',
                'message' => 'user berhasil login hore !',
                'data' => $user,
            ];
            return response()->json($data);
        } else {
            $data = [
                'status' => 'success',
                'message' => 'user gagal login hore !',
                'data' => NULL,
            ];
            return response()->json($data);
        }
    }

    public function logout()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user->tokens()->delete();
        return response()->json(
            [
                'status' => 'success',
                'message' => 'berhasil keluar',
                'data' => NULL,
            ]
        );
    }
}
