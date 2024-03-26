<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Profiler\Profile as ProfilerProfile;

class profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'image'
    ];

    // relation profile to user
    public function user(){
        return $this->belongsTo(User::class);
    }

    // accessor image profile
    public function image() : Attribute{
        return Attribute::make(
            get: fn($value) => asset('/storage/profile/' . $value)
        );
    }

// 
}
