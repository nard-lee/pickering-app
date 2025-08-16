<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller 
{
    public function login(LoginRequest $request)
    {   
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) 
        {
            $request->session()->regenerate();

            return response()->json([
                'message' => 'Login successful'
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }   

    public function signup(SignupRequest $request)
    {
        try 
        {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'email_verified_at' => null,
            ]);

            Auth::login($user);
            $request->session()->regenerate();

            return response()->json([
                'message' => 'Signup successful'
            ]);
        } 
        catch (\Exception $e) 
        {
            return response()->json([
                'message' => 'Something went wrong. Please try again.'
            ], 422);
        }
    }
}