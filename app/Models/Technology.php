<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    /** @use HasFactory<\Database\Factories\TechnologyFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
