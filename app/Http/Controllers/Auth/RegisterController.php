<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\ValidIsAdmin;
use Illuminate\Http\{Request};
use Illuminate\Support\Facades\{Hash, Validator};
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name"     => ["required", "min:3", "max:255"],
            "email"    => ["required", "min:3", "max:255", "email", "unique:users,email", "confirmed"],
            "password" => ["required", "min:8", "max:40", "confirmed"],
            "isAdmin"  => ["nullable", new ValidIsAdmin()],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        User::create([
            "name"     => $request->name,
            "email"    => $request->email,
            "password" => Hash::make($request->password),
            "isAdmin"  => $request->isAdmin,
        ]);

        return response()->json(["message" => "User successfully registered"], Response::HTTP_CREATED);
    }
}
