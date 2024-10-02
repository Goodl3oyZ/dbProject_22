<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Cart;

class User extends Authenticatable
{
    public function bio(): HasOne
    {
        return $this->hasOne(UserBio::class, 'user_id');
    }

    public function diaryEntries()
    {
        return $this->hasMany(DiaryEntry::class);
    }

    public function personalityType(): BelongsTo
    {
        return $this->belongsTo(PersonalityType::class, 'personality_id');
    }
    public function carts()
    {
        return $this->hasOne(Cart::class, 'userId');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'userId');
    }

    public function promotion()
    {
        return $this->hasMany(Promotion::class, 'userId');
    }

    public function review()
    {
        return $this->hasMany(Review::class, 'userId');
    }
    protected static function booted()
    {
        static::created(function ($user) {
            // Automatically create a cart for the newly registered user
            $user->carts()->create(['amount' => 0]);
        });
    }

    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'userName',
        'email',
        'password',
        'birthdate',
        'profile_photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
