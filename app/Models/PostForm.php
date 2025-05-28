<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostForm extends Model
{
    
    protected $fillable = [
        'title',
        'content',
        'photo'
    ];
    
}
