<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /** @use HasFactory<\Database\Factories\NewsFactory> */
    use HasFactory;

    protected $guarded = [];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? asset('storage/' . $value) : asset('images/default.png'),
        );
    }
}
