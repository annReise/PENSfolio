<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
    ];

    // Relasi many-to-many ke User
    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('level')
                    ->withTimestamps();
    }
}
