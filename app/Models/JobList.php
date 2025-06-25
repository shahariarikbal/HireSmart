<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobList extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'job_type',
        'experience_level',
        'is_active',
        'avatar',
        'user_id',
        'description',
        'location',
        'salary_min',
        'salary_max',
    ];
}
