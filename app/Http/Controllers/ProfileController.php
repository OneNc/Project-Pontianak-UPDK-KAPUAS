<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', [
            'user' => Auth::user(),
        ]);
    }
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $oldUsername = $user->username;
        $validated = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'username'      => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
            'email'         => ['nullable', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'image_profile' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);
        if ($request->hasFile('image_profile')) {
            $file = $request->file('image_profile');
            $image = Image::read($file->getRealPath())->cover(500, 500);
            $extension = $file->getClientOriginalExtension();
            $fileName  = 'profile_' . $user->id . '_' . time() . '.' . $extension;
            $path      = 'profile/' . $fileName;
            Storage::disk('public')->put($path, (string) $image->encode());
            if (!empty($user->image_profile) && Storage::disk('public')->exists($user->image_profile)) {
                Storage::disk('public')->delete($user->image_profile);
            }
            $validated['image_profile'] = $path;
        }
        $validated['username'] = strtolower($validated['username']);
        $user->update($validated);
        if ($oldUsername !== $user->username) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->with('status', 'Successfully. Please log in again.');
        }
        return back()->with('success', 'Profile updated successfully.');
    }
    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'currentPassword' => ['required'],
            'newPassword'     => ['required', 'min:8'],
            'confirmPassword' => ['required', 'same:newPassword'],
        ]);
        if (!Hash::check($request->currentPassword, $user->password)) {
            return back()->withErrors([
                'currentPassword' => 'Credentials Invalid.',
            ]);
        }
        $user->update([
            'password' => Hash::make($request->newPassword),
        ]);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()
            ->route('login')
            ->with('status', 'Successfully. Please log in again.');
    }
}
