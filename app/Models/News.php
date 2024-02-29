<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'image',
        'slug',
        'content'
    ];

    //  PUBLIC RELATIONSHIP WITH CATEGORY
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Accessor Image news
    public function image()
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/news/' . $value)
        );
    }

}
