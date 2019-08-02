<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function edit($token)
    {
        return response()->json(User::where('identification_token', $token)->first());
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4|max:16'
        ]);

        User::where('identification_token', $request->input('token'))
                    ->update(['name' => $request->input('name')]);

        return response()->json([
            'data' => User::where('identification_token', $request->input('token'))->first(),
            'message' => 'Profile updated successfully!'
        ]);
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:4|max:8'
        ]);

        $user = User::where('identification_token', $request->input('token'))
                ->update(['password' => Hash::make($request->input('password')) ]);

        return response()->json([
            'message' => 'Password updated successfully!'
        ]);
    }
}