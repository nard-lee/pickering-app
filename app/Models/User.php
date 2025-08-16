<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar',
        'auth_provider',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    public static function updateOrCreate($googleUser)
    {
        $userExists = self::where('email', $googleUser->getEmail())->first();

        if ($userExists) {
            $userExists->update([
                'google_id' => $userExists->google_id ?? $googleUser->getId(),
                'avatar' => $userExists->avatar ?? $googleUser->getAvatar(),
                'auth_provider' => 'google',
                'email_verified_at' => $userExists->email_verified_at ?? now()
            ]);

            return $userExists;
        }

        return self::create([
            'email' => $googleUser->getEmail(),
            'name' => $googleUser->getName(),
            'google_id' => $googleUser->getId(),
            'avatar' => $googleUser->getAvatar() ?? null,
            'auth_provider' => 'google',
            'password' => null,
            'email_verified_at' => now()
        ]);
    }
}
