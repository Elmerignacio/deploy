<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function store(Request $request)
    {
        // Validate the image and student_id
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'student_id' => 'required'
        ]);

        $studentId = $request->student_id;

        // Check if a profile already exists for the student
        $existingProfile = DB::table('avatar')
            ->where('student_id', $studentId)
            ->first();

        // If exists, delete the old image
        if ($existingProfile && $existingProfile->profile) {
            Storage::disk('public')->delete($existingProfile->profile);
        }

        // Store the new image in 'public/images'
        $path = $request->file('image')->store('images', 'public');

        // Insert or update the record
        DB::table('avatar')->updateOrInsert(
            ['student_id' => $studentId],   // Match by student_id
            ['profile' => $path]            // Update profile path
        );

        return back()->with('success', 'Profile image uploaded successfully!');
    }
}
