<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image'
    ];

    // Function Relation with news
    public function news()
    {
        //  One to many Relation
        return $this->hasMany(News::class);
    }

    // Accessor with category
    public  function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/category/' . $value)
        );
    }
}
