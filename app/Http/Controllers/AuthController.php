<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'          => 'nullable|string|max:255',
            'username'      => 'required|string|max:255|unique:users,username',
            'email'         => 'nullable|email|max:255|unique:users,email',
            'image_profile' => 'nullable|string|max:255',
            'password'      => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name'          => $data['name'] ?? null,
            'username'      => $data['username'],
            'email'         => $data['email'] ?? null,
            'image_profile' => $data['image_profile'] ?? null,
            'password'      => Hash::make($data['password']),
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user'  => $user,
            'token' => $token,
        ], 201);
    }

    // login dengan "login" = email atau username
    public function store(Request $request)
    {

        $credentials = $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ]);

        // karena field login bisa email/username, biasanya bikin custom:
        $field = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (! Auth::attempt([$field => $credentials['login'], 'password' => $credentials['password']])) {
            return back()->withErrors([
                'login' => 'Credentials Invalid',
            ])->withInput();
        }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }
    public function login()
    {
        return view('auth.login');
    }
    public function me(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'id'          => $user->id,
            'name'        => $user->name,
            'username'    => $user->username,
            'email'       => $user->email,
            'image_profile' => $user->image_profile,
            'roles'       => $user->getRoleNames(),
            'permissions' => $user->getAllPermissions()->pluck('name'),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
