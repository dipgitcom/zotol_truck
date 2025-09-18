<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('backend.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Base validation rules
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'profile_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'phone_number' => ['nullable', 'string', 'max:255'],
            'short_bio' => ['nullable', 'string'],
            'address' => ['nullable', 'string', 'max:255'],
            'work_info' => ['nullable', 'string', 'max:255'],
            'height' => ['nullable', 'numeric'],
            'height_unit' => ['nullable', 'string', 'max:10'],
            'weight' => ['nullable', 'numeric'],
            'weight_unit' => ['nullable', 'string', 'max:10'],
            'gender' => ['nullable', 'string', 'max:255'],
            'race' => ['nullable', 'string', 'max:255'],
            'sexual_preferences' => ['nullable', 'string', 'max:255'],
            'hiv_status' => ['nullable', 'string', 'max:255'],
            'dob' => ['nullable', 'date'],
            'relationship_status' => ['nullable', 'string', 'max:255'],
            'social_links' => ['nullable', 'string'],
            'role' => ['nullable', 'string', 'max:255'],
        ];

        // Additional validation for trucker role
        if ($user->role === 'trucker') {
            $rules['operate_truck'] = ['required', 'string', 'max:255'];
            $rules['dot_license_file'] = ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'];
            $rules['dot_verified'] = ['nullable', 'boolean'];
        }

        $validated = $request->validate($rules);

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $validated['profile_photo'] = $path;
        }

        // Handle DOT license file upload for truckers
        if ($user->role === 'trucker' && $request->hasFile('dot_license_file')) {
            $path = $request->file('dot_license_file')->store('dot-licenses', 'public');
            $validated['dot_license_file'] = $path;
        }

        // Update user profile
        $user->update($validated);

        // Refresh user instance with latest data
        $user->refresh();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
