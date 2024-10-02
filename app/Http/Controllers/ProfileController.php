<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\PersonalityType; // Import PersonalityType model


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
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

        return Redirect::to('/');
    }
    public function editType()
    {
        // ดึงข้อมูล personality types ทั้งหมด
        $personalityTypes = PersonalityType::all();
        // ดึงข้อมูล user ที่ล็อกอินอยู่
        $user = auth()->user();

        // ส่งตัวแปรไปยัง view
        return view('profile.edit-type', compact('personalityTypes', 'user'));
    }

    public function updateType(Request $request)
    {
        // Validation
        $request->validate([
            'personality_type_id' => 'required|exists:personality_types,id',
        ]);

        // อัปเดตข้อมูล personality type ของผู้ใช้
        $user = auth()->user();
        $user->personality_id = $request->input('personality_type_id');
        $user->save();

        return redirect()->route('profile.edit-type')->with('status', 'Personality type updated successfully!');
    }
}
