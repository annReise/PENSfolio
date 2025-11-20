<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// pastikan ketiga import ini ada & nama namespace cocok
use App\Models\Profile;
use App\Models\Portfolio;
use App\Models\Skill;

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
    ];

    /**
     * Relationships
     */

    // User -> Profile (One to One)
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // User -> Portfolios (One to Many)
    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    // User -> Skills (Many to Many)
    public function skills()
    {
        // kalau nama pivot: skill_user (default Laravel), ini sudah cukup
        return $this->belongsToMany(Skill::class)->withTimestamps();
        // jika pivot punya kolom level:
        // return $this->belongsToMany(Skill::class)->withPivot('level')->withTimestamps();
    }

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
            'password'          => 'hashed',
        ];
    }
}
