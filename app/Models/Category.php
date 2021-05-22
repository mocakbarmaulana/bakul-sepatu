<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Mutator
    public function setSlugAttribute($value){
        $this->attributes['slug'] = Str::slug($value);
    }
}
