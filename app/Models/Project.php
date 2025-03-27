<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectsFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'repository_url',
        'demo_url',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
