<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'job_list_id', 'cover_letter', 'applied_at'];

    protected $casts = [
        'user_id' => 'integer',
        'job_list_id' => 'integer'
    ];


    public function jobList()
    {
        return $this->belongsTo(JobList::class, 'job_list_id', 'id');
    }
}
