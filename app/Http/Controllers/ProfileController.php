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
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile (name, email, photo).
     */
    public function update(Request $request): RedirectResponse
{
    $user = $request->user();

    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
        'profile_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
    ]);

    if ($request->hasFile('profile_photo')) {
        $path = $request->file('profile_photo')->store('profile-photos', 'public');
        $validated['profile_photo'] = $path;
    }

    $user->update($validated);

    // Ensure we fetch fresh data
    $user->refresh();

    return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');

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