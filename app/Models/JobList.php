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


    public function scopeAuthUser($query)
    {
        $auth_user_id = auth()->id();
        return $query->where('user_id', $auth_user_id);
    }

    public function scopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'job_list_id', 'id');
    }
}
