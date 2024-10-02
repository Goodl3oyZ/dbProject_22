<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; //add this line
use App\Models\UserBio;
use Illuminate\Support\Facades\Auth; //add this line
use Illuminate\Support\Facades\Storage; //add this line
use App\Models\PersonalityType; // Import PersonalityType model

class UserController extends Controller
{
    public function showBio()
    {
        $user = Auth::user(); // Retrieve the currently authenticated user
        $bio = $user->bio; // Access the related bio for the user
        return view('profile.show-bio', compact('user', 'bio'));
    }
    public function updateBio(Request $request)
    {
        $user = Auth::user();
        $bio = $user->bio;
        $request->validate([
            'bio' => 'required|string',
        ]);

        if ($bio) {
            $bio->update([
                'bio' => $request->input('bio'),
            ]);
        } else {
            $user->bio()->create([
                'bio' => $request->input('bio'),
            ]);
        }
        return redirect()->route('profile.show-bio')
            ->with('status', 'Bio updated successfully!');
    }

    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $user = Auth::user();
        if ($request->file('profile_photo')) {
            $fileName = time() . '_' . $request->file('profile_photo')->getClientOriginalName();
            $filePath = $request->file('profile_photo')->storeAs('uploads/profile_photos', $fileName, 'public');
            // Delete old photo if exists
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            $user->profile_photo = $filePath;
            $user->save();
        }
        return redirect()->route('profile.edit')->with('status', 'profile-photo-updated');
    }

    public function showType()
    {
        // ดึงข้อมูลทั้งหมดจากตาราง personality_types
        $personalityTypes = PersonalityType::all();

        // ดึงข้อมูลผู้ใช้ที่ล็อกอิน
        $user = auth()->user();

        // ส่งตัวแปรไปยัง view
        return view('profile.show-type', compact('personalityTypes', 'user'));
    }

    public function updateType(Request $request)
    {
        $request->validate([
            'personality_type_id' => 'required|exists:personality_types,id',
        ]);

        $user = auth()->user();
        $user->personality_id = $request->input('personality_type_id');
        $user->save();

        return redirect()->route('profile.show-type')->with('status', 'Personality type updated successfully!');
    }
    public function showProfile()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }
}