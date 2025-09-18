<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getProfile(Request $request)
    {
        return response()->json($request->user());
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $rules = [
            'name' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|max:2048',
            'phone_number' => 'nullable|string|max:255',
            'short_bio' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'work_info' => 'nullable|string|max:255',
            'height' => 'nullable|numeric',
            'height_unit' => 'nullable|string|max:10',
            'weight' => 'nullable|numeric',
            'weight_unit' => 'nullable|string|max:10',
            'gender' => 'nullable|string|max:255',
            'race' => 'nullable|string|max:255',
            'sexual_preferences' => 'nullable|string|max:255',
            'hiv_status' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'relationship_status' => 'nullable|string|max:255',
            'social_links' => 'nullable|string',
            'role' => 'nullable|string|max:255',
        ];

        if ($user->role === 'trucker') {
            $rules['operate_truck'] = 'required|string|max:255';
            $rules['dot_license_file'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120';
            $rules['dot_verified'] = 'nullable|boolean';
        }

        $validated = $request->validate($rules);

        // Handle profile_photo upload
        if ($request->hasFile('profile_photo')) {
            $validated['profile_photo'] = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        // Truckers only: handle dot_license_file upload
        if ($user->role === 'trucker' && $request->hasFile('dot_license_file')) {
            $validated['dot_license_file'] = $request->file('dot_license_file')->store('dot_licenses', 'public');
        }

        $user->update($validated);

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user
        ]);
    }
}
