<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalityType extends Model
{
    use HasFactory;

    protected $table = 'personality_types';

    protected $fillable = [
        'type',
        'description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'personality_id');
    }
    public function editType()
    {
        $personalityTypes = PersonalityType::all(); // Fetch all personality types
        $user = auth()->user(); // Get the authenticated user

        return view('profile.edit-type', compact('personalityTypes', 'user'));
    }
}
