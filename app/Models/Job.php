<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company_name',
        'company_logo',
        'description',
        'requirements',
        'location',
        'employment_type',
        'apply_link',
        'deadline',
    ];

    protected $casts = [
        'deadline' => 'date',
    ];
}
